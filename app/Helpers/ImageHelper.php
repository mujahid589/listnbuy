<?php

use Illuminate\Support\Facades\Storage;

/**
 * image upload
 *
 * @param object $file
 * @param string $path
 * @return string
 */
function uploadImage(?object $file, string $path): string
{
    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
     Storage::putFileAs("listnbuy/public/$path", $file, $fileName);
    //$storage=Storage::putFileAs("$path", $file, $fileName);

   // var_dump($storage);

  //  return "storage/$path/" . $fileName;

   return Storage::url("listnbuy/public/$path/" . $fileName);

}

/**
 * image delete
 *
 * @param string $image
 * @return void
 */
function deleteImage(?string $image)
{

    Storage::delete($image);
    $imageExists = file_exists($image);

    if ($imageExists) {
        @unlink($image);
    }
}
