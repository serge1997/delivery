<?php
namespace App\Service\Base;

use Illuminate\Support\Traits\Conditionable;

abstract class BaseRepository
{
    use Conditionable;

    public function uploadImages($request, $image, $path, $size = null)
    {
        $imageName = $this->when($request->hasFile($image) && $request->file($image)->isValid(), function() use ($request, $image, $path, $size) {
            $image = $request->file($image);
            $extension = $image->extension();
            $name = md5($image->getClientOriginalName()) . strtotime("now") . "." . $extension;
            $image->move(public_path($path), $name);
            return $name;
        });
        return $imageName;
    }
}
