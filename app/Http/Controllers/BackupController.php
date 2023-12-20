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

    public function make()
    {
        $backupFilename = 'backup.zip';
        $this->info('preparing to dump sql');
        // dump mysql 
        $dumpFile = storage_path('app').'/database.sql';
        $command = "mysqldump -h ".env('DB_HOST')." -u gema_backup -pIndonesia1979OKE ".env('DB_DATABASE')." > ".$dumpFile;
        exec($command);
        $this->info('sql dump complete');
        
        $this->info('archiving files...');
        // Proses backup (contoh backup direktori storage)
        $command = "zip -r $backupFilename " . storage_path('app')." && chown gema backup.zip && chmod 766 backup.zip";
        $res = exec($command);
        $this->info('complete...');
        
        $this->info('Moving to temp folder');
        $tempFilePath = 'temp/backup.zip';
        // Menyalin file lokal ke penyimpanan sementara
        Storage::disk('temp')->put($tempFilePath, file_get_contents($backupFilename));
        $this->info('Moving to temp folder complete');

    }

    public function upload()
    {
        $backupFilename = 'backup.zip';
        $tempFilePath = 'temp/backup.zip';

        $s3Path = 'backups/' . $backupFilename;
        Storage::disk('s3')->put($s3Path, Storage::disk('temp')->get($tempFilePath));
        // Hapus file backup lokal jika diinginkan
        $this->info('Uploading to s3 bucket complete');
        unlink($backupFilename);
        unlink($tempFilePath);

        $this->info('Daily backup completed successfully.');
    }
}
