<?php
namespace NetApp;

class Host
{
    private $interfaces = array();

    public function __construct() {

    }

    public function addInterface (NetworkInterface $interface) 
    {
        $this->interfaces[] = $interface;
    }
}