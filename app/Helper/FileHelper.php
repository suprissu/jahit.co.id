<?php

namespace App\Helper;

use Carbon\Carbon;
use Image;

class FileHelper
{
    public const RESIZED_FILE_WIDTH = 300;
    
    public static function saveResizedImageToPublic($image, $dir)
    {
        $imageName = time() . rand() . '.' . self::validatedExtension($image->getClientOriginalExtension());
        $imageFullPath = public_path($dir) . '/' . $imageName;
    
        try {
            // Resize image to expected width and height following aspect ratio, then save
            Image::make($image)->resize(self::RESIZED_FILE_WIDTH, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($imageFullPath);
        
            return $dir . '/' . $imageName;
        } catch (NotSupportedException $e) {
            self::saveImageToPublic($image, $dir);
        }
        
    }

    public static function saveImageToPublic($image, $dir)
    {
        $imageName = time() . rand() . '.' . self::validatedExtension($image->getClientOriginalExtension());
        $imageFullPath = public_path($dir) . '/' . $imageName;
    
        try {
            Image::make($image)->save($imageFullPath);

            return $dir . '/' . $imageName;
        } catch (NotSupportedException $e) {
            self::saveFileToPublic($image, $dir);
        }
    }

    public static function saveFileToPublic($file, $dir)
    {
        $imageName = time() . rand() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path($dir);
        $file->move($destinationPath, $imageName);

        return $dir . '/' . $imageName;
    }

    public static function validatedExtension($extension)
    {
        switch ($extension) {
            case "jfif":
                return "jpg";
                break;
            default:
                return $extension;
        }
    }
}