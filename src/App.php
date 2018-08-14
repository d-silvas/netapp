<?php
namespace NetApp;

class App
{
    private $localHost;

    public function __construct() 
    {
        $this->localHost = new Host();
        $this->localHost->addInterface(NetworkInterface::createFromCidr(gethostbyname(gethostname()) . "/24"));
        // $this->localHost->scanNet();
    }

    public function getLocalHost() 
    {
        return $this->localHost;
    }
}