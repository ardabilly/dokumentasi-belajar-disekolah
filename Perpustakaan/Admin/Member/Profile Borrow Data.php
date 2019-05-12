<?php 
ob_start();

//class manage

include_once'../App Code/Class_Member.php';
$c_Member = new Class_Member();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

include_once'../App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

// variable

$s_BorrowID = $_GET["id"];
$array_DataBorrow = $c_Member->array_Get_DataBorrow($s_BorrowID);

$s_MemberName = $c_Member->array_Get_DataMember($array_DataBorrow[1])[1];
$s_ServiceName = $c_Employee->array_Get_DataEmployee($array_DataBorrow[2])[1];

 ?>

 <div class="BorrowData">
 	<div class="MemberData">
 		<span class="Name"><?=$s_MemberName?></span>
 		<span class="ID"><?=$array_DataBorrow[1]?> -&nbsp;</span>
 		<a href="memberprofile.php?id=<?=$array_DataBorrow[1]?>"> Profile </a>
 	</div>
 
	 <div class="AddNote">
	 	Borrow Date <b><?=date("l, F d, Y", strtotime($array_DataBorrow[3]))?></b>, Return Date <b><?=date("l, F d, Y", strtotime($array_DataBorrow[4]))?></b>
	 	<br/>
	 	Servicer <?=$array_DataBorrow[2]?> - <?=$s_ServiceName?>
	 </div>
</div>

<style type="text/css">
	.BorrowData
	{
		clear: both; float: left;
		width: 100%;
	}
	.BorrowData .MemberData
	{
		clear: both; float: left;
		border-left: 2px solid #0046ae;
		padding-left: 10px;
	}
	.BorrowData .MemberData .Name
	{
		clear: both; float: left;
		font-size: 20px;
		color: #ffffff;
	}
	.BorrowData .MemberData .ID
	{
		clear: both; float: left;
		font-size: 15px;
		color: #ffffff;

		margin-top: 5px;
	}
	.BorrowData .MemberData a
	{
		float: left;
		font-size: 15px;
		color: #0091b4;
		text-decoration: none;

		margin-top: 5px;
	}
	.BorrowData .MemberData a:hover
	{
		text-decoration: underline;
	}
	.BorrowData .AddNote
	{
		clear: both; float: left;
		font-size: 16px;
		color: white;

		margin-top: 20px;
	}
	.BorrowData .AddNote b
	{
		font-weight: normal;
		font-style: italic;

		color: #1adb00;
		font-size: 18px;
	}
</style>

<?php
ob_flush();
?>