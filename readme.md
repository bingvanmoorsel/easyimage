# EasyImage

This is a small simple package that extends [intervention/imagecache](http://image.intervention.io/use/cache). All credits for that package belong to the creator.
This is my first package and i made this to help myself in some of my own projects. Feel free to comment, fork or even better: improve it!

## What does it do?
this package makes it possible to call the fit, crop and grayscale option right from the url. 

## Installation
require the package trough composer:
```console
composer require bingvanmoorsel/easyimage
```

Then add the the service providers:
```php
// config/app.php
Intervention\Image\ImageServiceProvider::class,
Bingvanmoorsel\EasyImage\Providers\EasyImageServiceProvider::class,
```

## How does it work?

First of all you need to setup Image Intervention described on this page:
[http://image.intervention.io/use/url](http://image.intervention.io/use/url)

This package extends the route in the config with an 'c_' so for example if your config is:

```php
// config/imagecache.php   
    'route' => 'img',
```
the package enables a route 'c_img'
###Explained
the URL is build up in 3 parts:
```php
http://<yourdomain>.com/c_<route>/<command>/<params>/<path-to-image>
```
placeholder   | description
------------- | -------------
yourdomain    | your website url.
route         | defined in app/imagecache.php
command       | The effect you want: fit, crop, grayscale
params        | required field and sepperated by a dash('-'), if no params place one dash.
path-to-image | The original path to the image.

###Examples of commands

```console
// Fit
http://<yourdomain>.com/c_img/fit/300-300/images/profiles/peter.jpg

// Crop
http://<yourdomain>.com/c_img/crop/300-300/images/profiles/peter.jpg

// Greyscale
http://<yourdomain>.com/c_img/greyscale/-/images/profiles/peter.jpg
```

## License

This package iss open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
