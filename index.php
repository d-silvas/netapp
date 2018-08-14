<?php
session_start();
if (empty($_SESSION['exists'])) {
    echo "New SESSION!<br>";
}
$_SESSION['exists'] = true;

require "vendor/autoload.php";

// 1. Get local IP and sweep that network

use \NetApp\App as App;
use \NetApp\Host;
use \NetApp\Subnet;
use \NetApp\DB\DB as DB;
use \NetApp\DB\CreateTables as CreateTables;
// use \NetApp\DB\ as Connection;
 
$db = new CreateTables((new Connection)->connect());
if ($db != null)
    echo 'Connected to the SQLite database successfully!<br>';
else
    echo 'Whoops, could not connect to the SQLite database!<br>';

$db->createTables();

$app = new App();

echo "<pre>";
var_dump($db->getTableList());
var_dump($app->getLocalHost());

echo "</pre>";