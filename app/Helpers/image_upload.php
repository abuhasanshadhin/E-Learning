<?php
use Intervention\Image\Facades\Image;

function imageUpload($request, $image_name, $directory, $width = 200, $height = 200)
{
    $directory = $directory . '/';
    $image = $request->file($image_name);
    $image_name = $image->getClientOriginalName();
    $image_name_divide = explode('.', $image_name);
    $image_unique_name = $image_name_divide[0] . '_' . substr(md5(time()), 0, 8) . '.' . $image_name_divide[1];
    Image::make($image)->resize($width, $height)->save($directory . $image_unique_name);
    return $directory . $image_unique_name;
}

?>