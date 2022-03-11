<?php

namespace App\Actions\File;

use Illuminate\Support\Facades\Storage;

class FileDelete
{
    public static function delete($image,$path=null){
        @unlink($image);
        Storage::delete($path);
    }
}
