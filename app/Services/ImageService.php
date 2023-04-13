<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class ImageService
{
    public function developImage(
        $image,
        $width = 500,
        $height = 500,
        $blur = 100
    ) {
        $imageBlur = Image::make($image)
            ->fit(500, 500)
            ->blur(100);
        $imageMake = Image::make($image);
        return $imageBlur
            ->insert($this->resizeImage($imageMake), "center")
            ->encode("jpg");
    }

    public function resizeImage($image, $requiredSize = 500)
    {
        $width = $image->width();
        $height = $image->height();

        // Check if image resize is required or not
        if ($requiredSize >= $width && $requiredSize >= $height) {
            return $image;
        }

        $aspectRatio = $width / $height;

        $newWidth = $requiredSize * $aspectRatio;
        $newHeight = $requiredSize;

        if ($aspectRatio >= 1.0) {
            $newWidth = $requiredSize;
            $newHeight = $requiredSize / $aspectRatio;
        }

        $image->resize($newWidth, $newHeight);
        return $image;
    }
}
