<?php
ob_start();

$s_Database_IPAddress = "localhost";
$s_Username = "root";
$s_Password = "";
$s_DatabaseName = "BelajarBerita";

// Create connection
$conn = new mysqli($s_Database_IPAddress, $s_Username, $s_Password, $s_DatabaseName);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

ob_flush();
?>
