<?php
ob_start();

$s_Database_IPAddress = "localhost";
$s_Database_Username = "root";
$s_Database_Password = "";
$s_Database_Name = "BelajarAkun";

// Create connection
$conn = new mysqli($s_Database_IPAddress, $s_Database_Username, $s_Database_Password, $s_Database_Name);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

ob_flush();
?>
