<?php
namespace NetApp;

class Subnet 
{
    private $hosts = [];

    public function __construct(Host $host) {
        $this->hosts[] = $host;
    }
}

