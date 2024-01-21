<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    public function uploadFile($file)
    {
        // Generate a unique name for the file
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        // Prevent duplicate filename.  Use counter as a safeguard to prevent infinite loop
        $count = 0;
        while(Storage::disk('local')->has($fileName) && $count < 10) {
            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $count++;
        }
        if(10 === $count ) {
            throw new \Exception("Could not generate a unique filename after $count tries");   
        }
        Storage::disk('public')->putFileAs('uploads', $file, $fileName);
        return 'uploads/' . $fileName;
    }

    public function deleteFile($filepath)
    {
        Storage::disk('public')->delete($filepath);
    }

    public function retrieveFileDownloadURL($filepath)
    {
        return Storage::url($filepath);
    }
}