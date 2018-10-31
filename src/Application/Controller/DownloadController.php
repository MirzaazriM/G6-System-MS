<?php

namespace Application\Controller;

use Model\Entity\ResponseBootstrap;
use Model\Service\DownloadService;
use Symfony\Component\HttpFoundation\Request;

class DownloadController
{
    private $downloadService;

    public function __construct(DownloadService $downloadService)
    {
        $this->downloadService = $downloadService;
    }

}