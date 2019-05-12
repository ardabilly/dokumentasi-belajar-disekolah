<?php
ob_start(); 
// CLASS MANAGEMENT

include_once'App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once'App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

if (isset($_COOKIE["cookie_AkunPerpus"])) {
	$s_EmployeeID = $_COOKIE["cookie_AkunPerpus"];

	$b_Check = $c_Employee->bool_Check_EmployeeID($s_EmployeeID);

	if (!$b_Check) {
		echo $c_Variable->string_Set_RedirectPage("employee.php?signout=true");
	}
	if ($b_Check) {
		echo $c_Variable->string_Set_RedirectPage("admin/");
	}
}

ob_flush();
 ?>