<?php

namespace App\Actions\File;

use Illuminate\Support\Facades\Storage;

class FileUpload
{
    public static function upload($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs("listnbuy/public/$path", $file, $fileName);

        //return "storage/$path/" . $fileName;

        return Storage::url("listnbuy/public/$path/" . $fileName);
    }

    public static function uploadPrivateFile($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs("listnbuy/private/$path", $file, $fileName);

        //return "$path/" . $fileName;

        return Storage::url("listnbuy/private/$path/" . $fileName);
    }
}
