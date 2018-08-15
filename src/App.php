<?php
namespace NetApp;

class App
{
    private $localHost;
    private $db;

    /***
     * Creates a new Database to store data.
     */
    public function __construct(\NetApp\DB\DB $db) 
    {
        $this->db = $db;
        // if (empty($_SESSION['exists'])) {
        $this->db->rebuild();
        $this->db->getTables();
        // }
        $_SESSION['exists'] = true;

        $this->localHost = new Host();
        $this->localHost->addInterface(NetworkInterface::createFromCidr(gethostbyname(gethostname()) . "/24"));
        // $this->localHost->scanNet();
    }

    public function getLocalHost() 
    {
        return $this->localHost;
    }
}