<!DOCTYPE html>
<html>
<head>
<?php include_once'./Body Part/Tag Head.php'; ?>
	<title></title>
</head>
<body>
<?php include_once'./Body Part/Body Top.php'; ?>

<div class="xBodyCenter">
	<?php
	if (isset($_GET["view"])) 
	{
		include_once'./Book/List Data Table.php';
	}
	else
	{
		include_once'./Book/List Data.php';
	}
	?>
</div>
</body>
</html>