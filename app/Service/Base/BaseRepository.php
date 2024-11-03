<?php
namespace App\Service\Base;

use Illuminate\Support\Traits\Conditionable;

abstract class BaseRepository
{
    use Conditionable;

    public function uploadImages($request, $image, $path, array $file_extensions = [], $size = null)
    {
        $imageName = $this->when($request->hasFile($image) && $request->file($image)->isValid(), function() use ($request, $image, $path, $file_extensions, $size) {
            $image = $request->file($image);
            $extension = $image->extension();
            if (!empty($file_extensions)){
                if (!in_array($extension, $file_extensions)){
                    throw new \Exception("Exentension du fichier invalide");
                }
            }
            $name = md5($image->getClientOriginalName()) . strtotime("now") . "." . $extension;
            $image->move(public_path($path), $name);
            return $name;
        });
        return $imageName;
    }
}
