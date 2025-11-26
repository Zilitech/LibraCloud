<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backup;
use Illuminate\Support\Facades\Log;

class BackupController extends Controller
{
    // Show backup page
    public function index()
    {
        $backups = Backup::orderBy('created_at', 'desc')->get();
        return view('system_backup', compact('backups'));
    }

    // Run manual backup
    public function runBackup(Request $request)
    {
        try {
            $fileName = 'backup_' . date('Y-m-d_His') . '.backup';
            $backupDir = storage_path('app/backups');

            if (!file_exists($backupDir)) mkdir($backupDir, 0755, true);

            $filePath = $backupDir . '/' . $fileName;

            $dbHost = env('DB_HOST', '127.0.0.1');
            $dbUser = env('DB_USERNAME', 'postgres');
            $dbPass = env('DB_PASSWORD', '12345');
            $dbName = env('DB_DATABASE', 'libracloud');

            $pgDumpPath = '"C:/Program Files/PostgreSQL/18/bin/pg_dump.exe"';

            // Windows-friendly command with password inline
            $command = "set PGPASSWORD={$dbPass} && $pgDumpPath -h $dbHost -U $dbUser -F c -f \"$filePath\" $dbName";

            // Execute command and capture output & return code
            exec($command . ' 2>&1', $output, $returnVar);

            $status = $returnVar === 0 ? 'completed' : 'failed';
            $size = $status === 'completed' && file_exists($filePath) ? round(filesize($filePath) / 1024 / 1024, 2) . ' MB' : null;

            $backup = Backup::create([
                'name' => $fileName,
                'type' => 'database',
                'path' => $filePath,
                'size' => $size,
                'status' => $status
            ]);

            if ($status === 'failed') Log::error("Backup failed: " . implode("\n", $output));

            return response()->json([
                'success' => $status === 'completed',
                'message' => $status === 'completed' ? 'Backup completed successfully!' : 'Backup failed! Check logs.',
                'download_url' => $status === 'completed' ? route('system.backup.download', $backup->id) : null,
                'error_details' => implode("\n", $output)
            ]);

        } catch (\Exception $e) {
            Log::error("Backup exception: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Backup failed! Exception occurred.',
                'download_url' => null,
                'error_details' => $e->getMessage()
            ]);
        }
    }

    // Download backup
    public function download($id)
    {
        $backup = Backup::findOrFail($id);
        if (file_exists($backup->path)) {
            return response()->download($backup->path, $backup->name);
        }
        return redirect()->back()->with('error', 'Backup file not found!');
    }

    // Download Latest 2 AM backup
    public function latest2am()
    {
        $backup = Backup::whereTime('created_at', '02:00:00')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$backup) $backup = Backup::latest()->first();

        if ($backup && file_exists($backup->path)) {
            return response()->download($backup->path, $backup->name);
        }

        return redirect()->back()->with('error', 'No backup found to download!');
    }

    // Delete backup
    public function destroy($id)
    {
        $backup = Backup::findOrFail($id);
        if (file_exists($backup->path)) unlink($backup->path);
        $backup->delete();
        return redirect()->back()->with('success', 'Backup deleted successfully');
    }

    // Automatic backup for cron
    public function autoBackup()
    {
        try {
            $fileName = 'backup_' . date('Y-m-d_His') . '.backup';
            $backupDir = storage_path('app/backups');
            if (!file_exists($backupDir)) mkdir($backupDir, 0755, true);
            $filePath = $backupDir . '/' . $fileName;

            $dbHost = env('DB_HOST', '127.0.0.1');
            $dbUser = env('DB_USERNAME', 'postgres');
            $dbPass = env('DB_PASSWORD', '12345');
            $dbName = env('DB_DATABASE', 'libracloud');

            $pgDumpPath = '"C:/Program Files/PostgreSQL/18/bin/pg_dump.exe"';
            $command = "set PGPASSWORD={$dbPass} && $pgDumpPath -h $dbHost -U $dbUser -F c -f \"$filePath\" $dbName";

            exec($command . ' 2>&1', $output, $returnVar);

            $status = $returnVar === 0 ? 'completed' : 'failed';
            $size = $status === 'completed' && file_exists($filePath) ? round(filesize($filePath)/1024/1024,2).' MB' : null;

            Backup::create([
                'name' => $fileName,
                'type' => 'database',
                'path' => $filePath,
                'size' => $size,
                'status' => $status
            ]);

            if ($status === 'failed') Log::error("Automatic backup failed: " . implode("\n", $output));

        } catch (\Exception $e) {
            Log::error("Automatic backup exception: " . $e->getMessage());
        }
    }
}
