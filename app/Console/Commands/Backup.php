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
        $backupPath = storage_path('app/backup');
        $backupFilename = 'backup.zip';

        // dump mysql 
        // $dumpFile = storage_path('app').'/database.sql';
        // $command = "mysqldump -h ".env('DB_HOST')." -u ".env('DB_USERNAME')." -p".env('DB_PASSWORD')." ".env('DB_DATABASE')." > ".$dumpFile;
        // exec($command);
        
        // Proses backup (contoh backup direktori storage)
        $command = "zip -r $backupFilename " . storage_path('app');
        $res = exec($command);
        // Upload backup ke S3
        $s3Path = 'backups/' . $backupFilename;
        $res = Storage::disk('s3')->put($s3Path, file_get_contents($backupFilename));
        // Hapus file backup lokal jika diinginkan
        unlink($backupFilename);

        $this->info('Daily backup completed successfully.');
    }
}
