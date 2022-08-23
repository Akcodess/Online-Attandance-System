<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "oas_db";

// Create Connection
$con =mysqli_connect($server,$user,$password,$db);

// Check Connection
if(!$con) {
    die("connection failed: ". mysqli_connect_error());
   }
?>