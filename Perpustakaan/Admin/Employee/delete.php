<?php
ob_start();

// CLASS MANAGEMENT

include_once'../App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

// CHECK

if (isset($_GET["action"]) && $_GET["action"] === "Delete" && isset($_GET["id"]) && strlen(trim($_GET["id"])) != 0 ) 
{
	$s_EmployeeID = $_GET["id"];

	$b_Check = $c_Employee->bool_Delete_EmployeeData($s_EmployeeID);
	if($b_Check)
	{
		$c_Employee->bool_Delete_ImageEmployee($s_EmployeeID, "../");
		echo $c_Variable->string_Set_RedirectPage("employee.php");
	}
	else
	{
		echo $c_Variable->string_Set_MessageBox("Can't delete this data");
		echo $c_Variable->string_Set_RedirectPage("employeeprofile.php?id=$s_EmployeeID");
	}
}

ob_flush();

?>