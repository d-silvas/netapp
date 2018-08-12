<?php
require "../vendor/autoload.php";

// 1. Get local IP and sweep that network

use \NetApp\App as App;
use \NetApp\Host;
use \NetApp\Subnet;

$app = new App();

echo "<pre>";

var_dump($app->getLocalHost());

echo "</pre>";