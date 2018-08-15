<?php
session_start();

require "vendor/autoload.php";

use \NetApp\App as App;
use \NetApp\Host;
use \NetApp\Subnet;
use \NetApp\DB\DB as DB;

$db = new DB();
$app = new App($db);



echo "<pre>";
// var_dump($db->getTableList());
var_dump($app->getLocalHost());

echo "</pre>";