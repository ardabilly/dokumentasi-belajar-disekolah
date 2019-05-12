<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";
$db = mysql_connect($hostname, $username, $password) or die ("Koneksi gagal!");
    mysql_select_db($dbname);
?>