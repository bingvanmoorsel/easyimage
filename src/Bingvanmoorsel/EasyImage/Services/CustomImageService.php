<?php

namespace Bingvanmoorsel\EasyImage\Services;

use Intervention\Image\Facades\Image;

/**
 * Created by PhpStorm.
 * User: bingv
 * Date: 22-1-2017
 * Time: 1:39
 */
class CustomImageService
{

    public function fit($params, $url)
    {
        return Image::cache(function ($image) use ($params, $url) {
            $image->make($url)->fit($params[0], $params[1]);
        }, config('imagecache.lifetime'), true);

    }

    public function crop($params, $url)
    {
        return Image::cache(function ($image) use ($params, $url) {
            $image->make($url)->crop($params[0], $params[1]);
        }, config('imagecache.lifetime'), true);
    }

    public function greyscale($params, $url)
    {
        return Image::cache(function ($image) use ($params, $url) {
            $image->make($url)->greyscale();
        }, config('imagecache.lifetime'), true);
    }
}