<?php
namespace NetApp;

class NetworkInterface
{
    private $ip = 0;
    private $mask = 0;
    private $gateway = 0;
    private $subnet;

    public function __construct ($ip, $mask, $gateway, $subnet) 
    {
        $this->ip = $ip;
        $this->mask = $mask;
        $this->gateway = $gateway;
        $this->subnet = $subnet;
    }

    /***
     * Accepts string "192.168.3.3/24"
     */
    public static function createFromCidr ($cidr)
    {
        $cidrArr = explode("/", $cidr);
        $intIp = ip2long($cidrArr[0]);
        $intMask = -1 << (32 - (int) $cidrArr[1]);
        $intSubnetIp = $intIp & $intMask;
        // $intBcIp = $intIp | ( ~ $intMask);
        $subnet = new Subnet($intSubnetIp, $intMask);

        return new static($intIp, $intMask, 0, $subnet);
    }

    public function getSubnet() {
        return $this->subnet;
    }
}