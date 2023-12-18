<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Artisan;
class BackupController extends Controller
{
    public function index()
    {
        $output=null;
        Artisan::call('backup:daily',[], $output);
        // $backupPath = storage_path('app/backup');
        // $backupFilename = 'backup_' . Carbon::now()->format('Y-m-d_H-i-s') . '.zip';
        // // dump mysql 
        // $dumpFile = storage_path('app').'/database.sql';
        
        // // $command = "mysqldump -h ".env('DB_HOST')." -u ".env('DB_USERNAME')." -p".env('DB_PASSWORD')." ".env('DB_DATABASE')." > ".$dumpFile;
        // // exec($command);

        // // Proses backup (contoh backup direktori storage)
        // $command = "7z a -tzip $backupFilename " . storage_path('app');
        // exec($command);

        // // Upload backup ke S3
        // $s3Path = 'backups/' . $backupFilename;
        // $res = Storage::disk('s3')->put($s3Path, file_get_contents($backupFilename));
        // // Hapus file backup lokal jika diinginkan
        // unlink($backupFilename);
       return response()->json(['message'=>'Daily backup completed successfully.', 'out'=>$output]);
    }
}
