<?php
namespace NetApp;

class Subnet 
{
    private $subnetAddr;
    private $mask;

    public function __construct($subnetAddr, $mask) {
        $this->subnetAddr = $subnetAddr;
        $this->mask = $mask;
    }

    public function webServerScan() {
        $start = $this->subnetAddr + 1;
        $end = $this->subnetAddr | ( ~ $this->mask);
        $port = 80;

        echo "<table>";
        for ($ip = $start; $ip <= $end; $ip++) {
            $strIp = long2ip($ip);
            echo "<table>";

            $connection = @fsockopen($strIp, $port, $err_code, $err_str, 0.6);

            if (is_resource($connection)) {
                echo "<td>" . $strIp . "</td>";
                echo "<td>" . gethostbyaddr($strIp) . "</td>";
                echo "<td>" . $port . "</td>";
                echo "<td>" . getservbyport($port, "tcp") . "</td>";
                echo "<td>Open</td>";
                echo "<td></td>";
                fclose($connection);
            } else {
                echo "<td>" . $strIp . "</td>";
                echo "<td></td>";
                echo "<td>" . $port . "</td>";
                echo "<td>" . getservbyport($port, "tcp") . "</td>";
                echo "<td>Closed</td>";
                echo "<td>" . $err_code . " - " . $err_str . "</td>";
            }

            echo "</tr>";
        }
        echo "</table>";
    }
}

