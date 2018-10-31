<?php

namespace Model\Service;
use Model\Mapper\SystemMapper;
class SystemService
{
    private $systemMapper;
    public function __construct(SystemMapper $systemMapper)
    {
        $this->systemMapper = $systemMapper;
    }
}