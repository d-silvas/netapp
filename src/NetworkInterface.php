<?php
namespace NetApp;

class NetworkInterface
{
    private $ip = 0;
    private $mask = 0; // This is the actual integer, eg ,for /24, this stores (11111111 11111111 1111111 000000) in decimal format
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

    /***
     * Accepts two strings "192.168.3.3", "255.255.255.0"
     */
    public function createFromIpMask ($ip, $mask) {
        $cidrArr = explode("/", $cidr);
        $intIp = ip2long($cidrArr[0]);
        $intMask = ip2long($cidrArr[1]);
        $intSubnetIp = $intIp & $intMask;
        $subnet = new Subnet($intSubnetIp, $intMask);

        return new static($intIp, $intMask, 0, $subnet);
    }

    public function getSubnet() {
        return $this->subnet;
    }
}