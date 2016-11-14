<?php
require_once("./src/configs/config.php");

// Create connection
$mysqli = new mysqli(SERVERNAME, USERNAME, PASSWORD);
// Check connection
if ($mysqli->connect_error) {
   echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} 

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS " . DB;
if ($mysqli->query($sql) !== TRUE) { 
    echo "Error creating database: " . $mysqli->error;
} else{
	$mysqli->query("use " . DB);
}

$sql = "CREATE TABLE IF NOT EXISTS Charts(md5 CHAR(32), title CHAR(80), data TEXT)";
if ($mysqli->query($sql) !== TRUE) {
	echo "Error creating table: " . $mysqli->error;
}

$mysqli->close();
