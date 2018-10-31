<?php

namespace Application\Controller;
use Model\Service\SystemService;

class SystemController
{
    private $systemService;

    public function __construct(SystemService $systemService)
    {
        $this->systemService = $systemService;
    }
}