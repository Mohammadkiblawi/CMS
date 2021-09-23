<?php

namespace App\Traits;

trait ImageUpload
{
    protected $avatar_path = "app/public/avatars";
    protected $image_path = "app/public/images";
    protected $image_height = 300;
    protected $image_width = 700;
    protected $avatar_height = 240;
    protected $avatar_width = 240;

    public function uploadImage($img)
    {
        $img_name = $this->imageName($img);
        \Image::make($img)->resize($this->image_width, $this->image_height)->save(storage_path($this->image_path . '/' . $img_name));
        return $img_name;
    }
    public function imageName($image)
    {
        return time() . '-' . $image->getClientOriginalName();
    }
    public function uploadAvatar($img)
    {
        $img_name = $this->imageName($img);
        \Image::make($img)->resize($this->avatar_width, $this->avatar_height)->save(storage_path($this->avatar_path . '/' . $img_name));
        return $img_name;
    }
}
