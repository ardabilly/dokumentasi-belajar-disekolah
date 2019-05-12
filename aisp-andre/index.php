<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
		header("Location:login.php");
	}

	// include_once("class_supplier.php");
	// $var = new class_supplier();
?>
<html>
	<head>
		<title>Admin</title>
		<link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
	    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	    <script src="assets/jquery/jquery.min.js"></script>
	    <script src="assets/js/bootstrap.min.js"></script>
	</head>
	<style type="text/css">
	  nav li a{
	    color: #fff !important;
	    font-size: 13px;
	  }
	  nav li a:hover{
	  	background-color: transparent !important;
	  }

	  input,select,textarea{
	  	border:0 !important;
	  	border-bottom: 2px solid #286090 !important;
	  }
	  .well{
	  	border:1px solid #286090;
	  }
	  .welcome{
	  	color: #286090;
	  	border-left:15px solid #286090 !important
	  	
	  }
	  .th,.td{font-size: 12px;}
	  .dropdown-menu{
	  	background: #333;
	  }
	  .dropdown-toggle:hover{
	  	color: red;
	  }
	</style>

<?php include_once("menu.php");?>

<div class="main">
	<div class="container">
  <?php
	if(isset($_GET["page"]))
	{
		$page = $_GET["page"];
	}
	else
	{
		$page ="default_content.php";
	}
	
	$x = "$page.php";
	
	if(empty($x) || !file_exists($x))
	{
		include_once("default_content.php");
	}
	else
	{
		include_once($x);
	}
	?>
	</div>
</div>

</body>
</html>

<?php
if(isset($_GET["signout"]))
{
	session_start();
	session_destroy();
	header("Location:login.php");
}

?>