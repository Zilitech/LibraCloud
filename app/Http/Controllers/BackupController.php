<?php

// app/Http/Controllers/BackupController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    // Show backup page
    public function index()
    {
        $backups = Backup::orderBy('created_at', 'desc')->get();
        return view('system_backup', compact('backups'));
    }

    // Run full database backup
    public function runBackup(Request $request)
    {
        try {
            $fileName = 'backup_' . date('Y-m-d_His') . '.sql';
            $backupDir = storage_path('app/backups');

            if (!file_exists($backupDir)) {
                mkdir($backupDir, 0755, true);
            }

            $filePath = $backupDir . '/' . $fileName;

            $dbHost = env('DB_HOST');
            $dbUser = env('DB_USERNAME');
            $dbPass = env('DB_PASSWORD');
            $dbName = env('DB_DATABASE');

            // Full database backup command
            $command = "mysqldump -h $dbHost -u $dbUser -p$dbPass $dbName > $filePath";

            $returnVar = null;
            $output = null;
            exec($command, $output, $returnVar);

            $status = $returnVar === 0 ? 'completed' : 'failed';
            $size = $status === 'completed' ? round(filesize($filePath) / 1024 / 1024, 2) . ' MB' : null;

            Backup::create([
                'name' => $fileName,
                'type' => 'database',
                'path' => $filePath,
                'size' => $size,
                'status' => $status
            ]);

            return response()->json([
                'success' => $status === 'completed',
                'message' => $status === 'completed' ? 'Backup completed successfully!' : 'Backup failed!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    // Download backup
    public function download($id)
    {
        $backup = Backup::findOrFail($id);
        if(file_exists($backup->path)){
            return response()->download($backup->path, $backup->name);
        }
        return redirect()->back()->with('error','Backup file not found!');
    }

    // Delete backup
    public function destroy($id)
    {
        $backup = Backup::findOrFail($id);
        if(file_exists($backup->path)){
            unlink($backup->path);
        }
        $backup->delete();
        return redirect()->back()->with('success','Backup deleted successfully');
    }
}
