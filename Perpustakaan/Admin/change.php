<!DOCTYPE html>
<html>
<head>
<?php include_once './Body Part/Tag Head.php'; ?>
	<title></title>
</head>
<body>
<?php include_once'./Body Part/Body Top.php';?>

<div class="xBodyCenter">
	<?php 
		if (isset($_GET["action"]) && $_GET["action"] === "Username") 
		{
			include_once'./Change/Form Manage Username.php';
		}
		elseif (isset($_GET["action"]) && $_GET["action"] === "Password") 
		{
			include_once'./Change/Form Manage Password.php';
		}
	 ?>
</div>
</body>
</html>