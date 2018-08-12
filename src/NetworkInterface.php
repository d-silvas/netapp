<?php
namespace NetApp;

class NetworkInterface
{
    private $ip = 0;
    private $mask = 0;
    private $gateway = 0;
    private $subnet;

    public function __construct (int $ip = 0, int $mask = 0, int $gateway = 0) 
    {
        $this->ip = $ip;
        $this->mask = $mask;
        $this->gateway = $gateway;
    }

    public static function createFromCidr ($cidr = NULL)
    {
        // ["192.168.3.3", "24"]
        $cidr_arr = explode("/", $cidr);
        // "192.168.3.3"
        $str_ip = $cidr_arr[0];
        // -1062731005, or 3232236291 if we print it as unsigned int
        $int_ip = ip2long($str_ip);
        // 24
        $cidr_mask = (int) $cidr_arr[1];
        // -256, or 4294967040 if we print it as unsigned int
        $int_mask = -1 << (32 - (int) $cidr_mask);
        // -1062731008, or 3232236288
        $int_subnet_ip = $int_ip & $int_mask;
        // -1062730753, or 3232236543
        $int_broadcast_ip = $int_ip | ( ~ $int_mask);

        return new static($int_ip, $int_mask, 0);
    }
}