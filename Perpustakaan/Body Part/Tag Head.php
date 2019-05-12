<?php
ob_start();
?>

<?php

//=============================================
// Class Management
//=============================================
include_once './App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

?>
<title><?=$c_Variable->string_Get_ProjectName()?></title>
<link rel="stylesheet" type="text/css" href="css/BodyTop.css" />
<link rel="stylesheet" type="text/css" href="css/BodyCenter.css" />
<link rel="stylesheet" href="lib/w3.css">
<script src="css/sweetalert-dev.js"></script>
<script src="css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/animate/animate.css">
<link rel="stylesheet" type="text/css" href="assets/animate/animate.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">



<?php
ob_flush();
?>
