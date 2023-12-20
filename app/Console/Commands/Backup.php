<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Backup extends Command
{
    protected $signature = 'backup:daily';
    protected $description = 'Perform daily backup to S3';

    public function handle()
    {
        ini_set('memory_limit', '2048M');
        $backupPath = storage_path('app/backup');
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


        $this->info('Uploading to s3 bucket...');
        // Upload backup ke S3
        $s3Path = 'backups/' . $backupFilename;
        Storage::disk('s3')->put($s3Path, Storage::disk('temp')->get($tempFilePath));
        // Hapus file backup lokal jika diinginkan
        $this->info('Uploading to s3 bucket complete');
        unlink($backupFilename);
        unlink($tempFilePath);

        $this->info('Daily backup completed successfully.');
        ini_set('memory_limit', '256M');
    }
}
