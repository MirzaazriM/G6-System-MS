<?php

namespace Model\Service;
use Model\Entity\ResponseBootstrap;
use Model\Mapper\UploadMapper;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadService
{

    private $uploadMapper;
    private $response;

    public function __construct(UploadMapper $uploadMapper)
    {
        $this->uploadMapper = $uploadMapper;
        $this->response = new ResponseBootstrap();
    }


    /**
     * Upload file
     *
     * @param UploadedFile $uploadedFile
     * @return ResponseBootstrap
     */
    public function uploadFile(UploadedFile $uploadedFile):ResponseBootstrap
    {
        // get file name
        $fileName = $this->generateUniqueFileName().'.'.$uploadedFile->guessExtension();

        // moves the file to the directory where brochures are stored
        $upload = $uploadedFile->move(
            'resources',
            $fileName
        );

        // check if file is uploaded
        if(!empty($upload->getPath())){

            // get image info
            $info = getimagesize('resources/'.$upload->getBasename());
            list($width, $height) = $info;

            // set response
            $this->response->setStatus(200);
            $this->response->setData(
                [
                    "path" => "resources/".$upload->getFilename(),
                    "height" => $height,
                    "width" => $width
                ]
            );

        } else {
            $this->response->setStatus(304);
        }

        // return response
        return $this->response;
    }

    /**
     * Generate name for uploaded file
     *
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

}