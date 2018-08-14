<?php
namespace NetApp;

class Host
{
    private $interfaces = array();

    public function __construct() {

    }

    public function addInterface(NetworkInterface $interface) 
    {
        $this->interfaces[] = $interface;
    }

    public function getInterfaces()
    {
        return $this->interfaces;
    }

    public function scanNet() {
        $this->interfaces[0]->getSubnet()->webServerScan();
    }
}