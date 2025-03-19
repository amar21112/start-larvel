<?php

namespace App\Traits;

trait OfferTrait{

    public function saveImage($image,$folder)
    {
        $file_extention = $image->getClientOriginalExtension();
        $file_name = time().'.'.$file_extention;
        $path = $folder;
        $image->move($path,$file_name);

        return $file_name;
    }
    public function deleteImage($folder,$image)
    {
        $file_path = public_path($folder .$image);
        if (file_exists($file_path)) {
            unlink($file_path);
        }

    }
}
