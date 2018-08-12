<?php
namespace NetApp;

class App
{
    private $localHost;

    public function __construct() 
    {
        $this->localHost = new Host();
        $this->localHost->addInterface(NetworkInterface::createFromCidr(gethostbyname(gethostname()) . "/24"));
    }

    public function getLocalHost() 
    {
        return $this->localHost;
    }
}