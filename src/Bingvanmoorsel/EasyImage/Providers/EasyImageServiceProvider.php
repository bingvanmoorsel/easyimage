<?php
namespace Bingvanmoorsel\EasyImage\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: bingv
 * Date: 22-1-2017
 * Time: 12:12
 */
class EasyImageServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->registerRoutes();
    }

    private function registerRoutes()
    {
        // imagecache route
        if (is_string(config('imagecache.route'))) {

            $filename_pattern = '[ \w\\.\\/\\-\\@]+';

            // route to access template applied image file
            $this->app['router']->get('c_'.config('imagecache.route').'/{function}/{params}/{filename}', array(
                'uses' => 'Bingvanmoorsel\EasyImage\Controllers\EasyImageController@getImage',
                'as' => 'easy_imagecache'
            ))->where(array('filename' => $filename_pattern));
        }
    }
}