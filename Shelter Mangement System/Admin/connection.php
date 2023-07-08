<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="123456";
$dbname="tws";

if(!$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("Failed to connect");
}

