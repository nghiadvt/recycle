<?php

use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

if (!function_exists('createDirectory')) {

    /**
     * Create a path to save the file
     *
     * @param [string] $path
     */
    function createDirectory($path)
    {
        return storage_path($path);
    }
}

if (!function_exists('saveImage')) {

    /**
     * Move image to folder
     *
     * @param [object] $imageFile
     * @param [type] $path
     * @param [type] $type
     * @param [type] $width
     * @param [type] $height
     */
    function saveImage($imageFile, $path, $disk = null, $width = null, $height = null)
    {
        if (is_null($disk)) {
            $disk = config('filesystems.default');
        }
        $image = Image::make($imageFile);
        // Resize image if width and height are passed
        if ($width && $height) {
            $image->resize($width, $height);
        }
        // Save image
        return \Storage::disk($disk)->putFileAs($path, $imageFile, createImageName($imageFile));
    }
}

if (!function_exists('createImageName')) {

    /**
     * Create a new image name
     *
     * @param [object] $data: file image
     */
    function createImageName($data)
    {
        return Str::uuid() . '.' . $data->getClientOriginalExtension();
    }
}

if (!function_exists('deleteImage')) {

    /**
     * Move image to folder
     *
     * @param [string] $path

     */
    function deleteImage($path, $disk = null)
    {
        if (is_null($disk)) {
            $disk = config('filesystems.default');
        }

        // Save image
        return \Storage::disk($disk)->delete($path);
    }
}
