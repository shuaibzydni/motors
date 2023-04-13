<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;

class TestController extends Controller
{
    public function image()
    {
        $imagePath = "imgur/image3.jpeg";

        $imageBlur = Image::make($imagePath)
            ->fit(820, 420)
            ->blur(100);
        $image = Image::make($imagePath);
        $imageBlur->insert($this->resizeImage($image), "center");
        return $imageBlur->response("jpeg");
    }

    protected function resizeImage($image, $requiredSize = 820)
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

    public function fcm()
    {
        $recipients = [ 'dgPHXDBZNExZmiuJIzBWEt:APA91bHR2bPVBB4U3MAGHjRV9i94Rq7tF7Lqi4z4BMHYxX-eEdTk8n64aTufpgrplsM0KZF9EKiQZMemWRBefgvxpgCbQqZDTzdPO5-u353OLzYph6b4d-waSnPfI61eMmVDBg6LbFnb' ];

        return fcm()
            ->to($recipients)
            ->priority('high')
            ->timeToLive(0)
            ->data([
                'title' => 'Test Title',
                'body' => 'Test message',
            ])
            ->notification([
                'title' => 'Test FCM',
                'body' => 'This is a test of FCM',
            ])
            ->send();
    }
}
