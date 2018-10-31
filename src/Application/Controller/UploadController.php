<?php

namespace Application\Controller;

use Model\Entity\ResponseBootstrap;
use Model\Service\UploadService;
use Symfony\Component\HttpFoundation\Request;

class UploadController
{

    private $uploadService;
    private $response;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
        $this->response = new ResponseBootstrap();
    }


    /**
     * Add file
     *
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function post(Request $request)
    {
        // data
        $fileRaw = $request->files->all()['files'];

        // check if required data is set
        if(!empty($fileRaw)){
            return $this->uploadService->uploadFile($fileRaw);
        }else {
            $this->response->setStatus(404);
            $this->response->setMessage('Bad request');
        }

        // return response in case of incomplete data
        return $this->response;
    }

}