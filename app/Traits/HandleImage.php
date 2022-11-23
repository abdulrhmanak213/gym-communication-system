<?php

namespace App\Traits;

trait HandleImage
{
    public static function handle($image): string
    {
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
        return "images/".$imageName;
    }
}
