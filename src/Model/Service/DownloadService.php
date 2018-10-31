<?php

namespace Model\Service;

use Model\Entity\AdminCollection;
use Model\Entity\Admin;
use Model\Service\Facade\getAdminFacade;
use Model\Entity\ResponseBootstrap;
use Model\Mapper\DownloadMapper;

class DownloadService
{
    private $configuration;
    private $adminMapper;

    public function __construct(DownloadMapper $adminMapper)
    {
        $this->adminMapper = $adminMapper;
        $this->configuration = $adminMapper->getConfiguration();
    }

    /**
     * Get all admins
     *
     * @return ResponseBootstrap
     */
    public function getAdmins():ResponseBootstrap
    {
        // create new response object
        $response = new ResponseBootstrap();

        // here will go facade
        $facade = new getAdminFacade($this->adminMapper);
        $res = $facade->handleUsers();

        // convert collection to array
        $data = [];
        for ($i = 0; $i < count($res); $i++){
            $data[$i]['id'] = $res[$i]->getId();
            $data[$i]['user_name'] = $res[$i]->getUserName();
            $data[$i]['added_since'] = $res[$i]->getAddedSince();
            $data[$i]['scope'] = $res[$i]->getScope();
            $data[$i]['status'] = $res[$i]->getStatus();
            $data[$i]['email'] = $res[$i]->getEmail();
        }

        if (!empty($data)){
            $response->setStatus(200);
            $response->setMessage("Success");
            $response->setData(
                $data
            );
        } else {
            $response->setStatus(304);
            $response->setMessage('No content');
        }

        return $response;
    }
}