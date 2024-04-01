<?php

namespace App\Http\Controllers;

use App\Models\Backup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Artisan;
use ZipArchive;

class BackupController extends Controller
{
    public function index()
    {
        return view('backup.index', ['backups'=>Backup::all()]);
    }

    public function make()
    {
        
        $time_stamp = date('d-m-Y_his');
        if(!Storage::exists('backup'))Storage::makeDirectory('backup');
        echo ('preparing to dump sql');
        Artisan::call('snapshot:create database_'.$time_stamp);
        
        $this->zip($time_stamp);
        ini_set('memory_limit', '5096M');

        // moving database so backup storage
        $s3Path = $time_stamp.'/database_'.$time_stamp.'.sql';
        $res = Storage::disk('s3')->put($s3Path, file_get_contents(base_path().'/database/snapshots/database_'.$time_stamp.'.sql'));

        // // moving assets so backup storage
        $s3Path = $time_stamp.'/assets_'.$time_stamp.'.zip';
        Storage::disk('s3')->put($s3Path, file_get_contents(base_path().'/storage/app/backup/assets_'.$time_stamp.'.zip'));

 
        // insert log to database 
        function human_filesize($bytes, $decimals = 2) {
            $factor = floor((strlen($bytes) - 1) / 3);
            if ($factor > 0) $sz = 'KMGT';
            return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor - 1] . 'B';
        }

        $total_size = filesize(base_path().'/database/snapshots/database_'.$time_stamp.'.sql')+
        filesize(base_path().'/storage/app/backup/assets_'.$time_stamp.'.zip');
        
        Backup::create(['name'=>$time_stamp, 'size'=>human_filesize($total_size, 1)]);
        echo ('complete...');
        // Menyalin file lokal ke penyimpanan sementara
        return redirect()->back();
    }


    private function zip($time_stamp)
    {
        $zipcreated = storage_path('app/backup/assets_'.$time_stamp.'.zip');
        $basePath = storage_path('app/');
        $zip = new ZipArchive();
        if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) { 

            // Store the path into the variable 
            foreach(Storage::allFiles('/public') as $file){
                $zip ->addFile($basePath.$file, $file);
            }

            $zip ->close(); 
        }

    }

    public function delete($backupFilename)
    {
        // unlink file
        if(file_exists(base_path().'/database/snapshots/database_'.$backupFilename.'.sql')){
            Storage::disk('s3')->delete($backupFilename.'/database_'.$backupFilename.'.sql');
            unlink(base_path().'/database/snapshots/database_'.$backupFilename.'.sql');
        }

        if(file_exists(base_path().'/storage/app/backup/assets_'.$backupFilename.'.zip')){
            unlink(base_path().'/storage/app/backup/assets_'.$backupFilename.'.zip');   
        }

        // remove daatabase
        Backup::where('name', $backupFilename)->delete();
        return redirect()->back();
    }
}
