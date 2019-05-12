<?php
	ob_start();

	//=====
	//Class Management
	//=====

	include_once'../App Code/Class_Book.php';
	$c_Book = new Class_Book();

	include_once'../App Code/Class_Variable.php';
	$c_Variable = new Class_Variable();

	//===
	//Check
	//===

	if (isset($_GET["action"]) && $_GET["action"] === "Delete" && isset($_GET["id"]) && strlen(trim($_GET["id"])) !=0 ) 
	{
		$s_BookID = $_GET["id"];

		$b_Check = $c_Book->bool_Delete_BookData($s_BookID);
		if ($b_Check)
		{
			$c_Book->bool_Delete_ImageBook($s_BookID, "../");
			echo $c_Variable->string_Set_RedirectPage("book.php");
		}
		else
		{
			echo $c_Variable->string_Set_MessageBox("Can't Delete this data");
			echo $c_Variable->string_Set_RedirectPage("bookprofile.php?id=$s_BookID");
		}
	}

	ob_flush();
?>