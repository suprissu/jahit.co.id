<?php

namespace App\Helper;

use Carbon\Carbon;
use Image;

class FileHelper
{
    public const RESIZED_FILE_WIDTH = 300;
    
    public static function saveResizedImageToPublic($image, $dir)
    {
        $imageName = time() . rand() . '.' . $image->getClientOriginalExtension();
        $imageFullPath = public_path($dir) . '/' . $imageName;
    
        // Resize image to expected width and height following aspect ratio, then save
        Image::make($image)->resize(self::RESIZED_FILE_WIDTH, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($imageFullPath);

        return $dir . '/' . $imageName;
    }

    public static function saveImageToPublic($image, $dir)
    {
        $imageName = time() . rand() . '.' . $image->getClientOriginalExtension();
        $imageFullPath = public_path($dir) . '/' . $imageName;
    
        Image::make($image)->save($imageFullPath);

        return $dir . '/' . $imageName;
    }

    public static function saveFileToPublic($file, $dir)
    {
        $imageName = time() . rand() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path($dir);
        $file->move($destinationPath, $imageName);

        return $dir . '/' . $imageName;
    }
}