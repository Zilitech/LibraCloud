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

            // Use the correct PostgreSQL bin path wrapped in quotes for Windows
            $pgDumpPath = "C:/Program Files/PostgreSQL/18/bin/pg_dump.exe";

            $command = [
                $pgDumpPath,
                '-h', $dbHost,
                '-U', $dbUser,
                '-F', 'c',
                $dbName,
                '-f', $filePath
            ];

            $env = ['PGPASSWORD' => $dbPass];

            $process = proc_open(
                $command,
                [1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
                $pipes,
                null,
                $env
            );

            if (is_resource($process)) {
                $output = stream_get_contents($pipes[1]);
                $error = stream_get_contents($pipes[2]);
                fclose($pipes[1]);
                fclose($pipes[2]);
                $returnVar = proc_close($process);
            } else {
                $error = "Unable to start pg_dump process.";
                $returnVar = 1;
            }

            $status = $returnVar === 0 ? 'completed' : 'failed';
            $size = $status === 'completed' && file_exists($filePath) ? round(filesize($filePath) / 1024 / 1024, 2) . ' MB' : null;

            $backup = Backup::create([
                'name' => $fileName,
                'type' => 'database',
                'path' => $filePath,
                'size' => $size,
                'status' => $status
            ]);

            if ($status === 'failed') Log::error("Backup failed: " . $error);

            return response()->json([
                'success' => $status === 'completed',
                'message' => $status === 'completed' ? 'Backup completed successfully!' : 'Backup failed! Check logs.',
                'download_url' => $status === 'completed' ? route('system.backup.download', $backup->id) : null,
                'error_details' => $error
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

            $pgDumpPath = "C:/Program Files/PostgreSQL/18/bin/pg_dump.exe";
            $command = [$pgDumpPath, '-h', $dbHost, '-U', $dbUser, '-F', 'c', $dbName, '-f', $filePath];
            $env = ['PGPASSWORD' => $dbPass];

            $process = proc_open($command, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes, null, $env);

            if (is_resource($process)) {
                $output = stream_get_contents($pipes[1]);
                $error = stream_get_contents($pipes[2]);
                fclose($pipes[1]);
                fclose($pipes[2]);
                $returnVar = proc_close($process);
            } else {
                $error = "Unable to start pg_dump process.";
                $returnVar = 1;
            }

            $status = $returnVar === 0 ? 'completed' : 'failed';
            $size = $status === 'completed' && file_exists($filePath) ? round(filesize($filePath) / 1024 / 1024, 2) . ' MB' : null;

            Backup::create([
                'name' => $fileName,
                'type' => 'database',
                'path' => $filePath,
                'size' => $size,
                'status' => $status
            ]);

            if ($status === 'failed') Log::error("Automatic backup failed: " . $error);

        } catch (\Exception $e) {
            Log::error("Automatic backup exception: " . $e->getMessage());
        }
    }
}
