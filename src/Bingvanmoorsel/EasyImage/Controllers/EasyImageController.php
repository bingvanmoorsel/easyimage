<?php

namespace Bingvanmoorsel\EasyImage\Controllers;

use Bingvanmoorsel\EasyImage\Services\CustomImageService;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use League\Flysystem\Exception;

/**
 * Created by PhpStorm.
 * User: bingv
 * Date: 22-1-2017
 * Time: 13:01
 */
class EasyImageController extends BaseController
{

    /**
     * @var CustomImageService
     */
    protected $customImageService;
    /**
     * @var
     */
    protected $image;
    /**
     * @var
     */
    protected $params;

    /**
     * EasyImageController constructor.
     * @param CustomImageService $customImageService
     */
    public function __construct(CustomImageService $customImageService)
    {
        $this->customImageService = $customImageService;
    }

    /**
     * @param $command
     * @param $paramString
     * @param $file
     * @return Response
     */
    public function getImage($command, $paramString, $file)
    {
        $this->convertParametersToArry($paramString);
        $this->forward($command, $file);

        return $this->getResponse();
    }

    /**
     * @param $paramString
     */
    private function convertParametersToArry($paramString)
    {
        $result = explode('-', $paramString);

        if(count($result) == 2 && empty($result[0]) && empty($result[1])){
            $this->params = [];
        }

        $this->params = explode('-', $paramString);
    }

    /**
     * @param $command
     * @param $file
     * @throws Exception
     */
    private function forward($command, $file)
    {
        if(!method_exists($this->customImageService, $command)){
            throw new Exception('Function not found on CustomImageService, try an other command.');
        }
        $this->image = $this->customImageService->{$command}($this->params, $file);
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $this->image);

        // return http response
        return new Response($this->image, 200, array(
            'Content-Type' => $mime,
            'Cache-Control' => 'max-age='.(config('imagecache.lifetime')*60).', public',
            'Etag' => md5($this->image)
        ));
    }

}