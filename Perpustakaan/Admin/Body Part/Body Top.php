<?php
ob_start();
?>

<?php

//=============================================
// Class Management
//=============================================
include_once '../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

include_once '../App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

//=============================================
// Check 
//=============================================

if(!isset($_COOKIE["cookie_AkunPerpus"]))
{
    echo $c_Variable->string_Set_RedirectPage("../");
}

//=============================================
// Variable
//=============================================

$s_EmployeeID = $_COOKIE["cookie_AkunPerpus"];
$s_FullName = $c_Employee->array_Get_DataEmployee($s_EmployeeID)[1];

?>
<div class="BodyTop">
<ul class="MainMenu animated lightSpeedIn">
<li>
<a href="index.php">Home</a>
</li>
<li>
<a href="book.php">Book</a>
<ul class='ChildMainMenu'>
<li>
<a href='bookinsert.php'>Insert</a>
</li>
<li>
<a href='book.php?view=Table'>Table View</a>
</li>
</ul>
</li>
<li>
<a href="member.php">Member</a>
<ul class='ChildMainMenu'>
<li>
<a href='memberinsert.php'>Insert</a>
</li>
<li>
<a href='memberborrow.php'>Borrow Data</a>
</li>
</ul>
</li>
<li>
<a href="comment.php">Comment</a>
</li>
<li>
<a href="news.php">News</a>
<ul class='ChildMainMenu'>
<li>
<a href='newsinsert.php'>Insert</a>
</li>
</ul>
</li>
<li>
<a href="employee.php">Employee</a>
<ul class='ChildMainMenu'>
<li>
<a href='employeeinsert.php'>Insert</a>
</li>
</ul>
</li>
<li>
<a href="#">Page</a>
<ul class='ChildMainMenu'>
<li><a href='change.php?action=Username'>Change Username</a></li>
<li><a href='change.php?action=Password'>Change Password</a></li>
<li><a href='../employee.php?signout=true'>Sign Out</a></li>
</ul>
</li>
</ul>

<div class="FormSearch animated slideInRight">
<form action="" method="get" enctype="multipart/form-data" name="form_Manage">
<input type="text" name="txt_Search" value="" class="Text" placeholder="Search" style="padding: 5px;"/>
<input type="submit" name="btn_Submit" value="&#8594;" class="Button" style="width: 30px; height: 31px;"/>
</form>
</div>
</div>

<div class="BodyTop1">
<div class="ProjectName  ">Admin <?=$c_Variable->string_Get_ProjectName()?></div>
<div class="Address animated slideInRight"><?=$c_Variable->string_Set_SystemName(0)?></div>
<div class="Project_Username" ><span style=" color: #0088c7;
    font-family: cursive;">Hi&nbsp;</span><?=$s_FullName?></div>
</div>

<?php
ob_flush();
?>
