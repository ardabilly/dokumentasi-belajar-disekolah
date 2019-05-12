<?php 
ob_start();

//----
// Class manage
//----

include_once'../App Code/Class_Member.php';
$c_Member = new Class_Member();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

// Variable

$s_ErrorMessage = "";

$s_BorrowID = $c_Member->string_Set_BorrowID();
$s_EmployeeID = $_COOKIE["cookie_AkunPerpus"];

$s_MemberID = "";
if(isset($_POST["txt_MemberID"]) && strlen(trim($_POST["txt_MemberID"])) !=0)
	$s_MemberID = trim($_POST["txt_MemberID"]);

$add_OneDay = $c_Variable->string_Set_DateTimeNow();
$add_OneDay = strtotime($add_OneDay) + (3600*24);
$add_OneDay = date("Y-m-d H:i:s", $add_OneDay);
$s_BorrowDate = explode(" ", $c_Variable->string_Set_DateTimeNow())[0];
if(isset($_POST["txt_BorrowDate"]) && strlen(trim($_POST["txt_BorrowDate"])) !=0)
	$s_BorrowDate = trim($_POST["txt_BorrowDate"]);

$s_ReturnDate = explode(" ", $add_OneDay)[0];
if(isset($_POST["txt_ReturnDate"]) && strlen(trim($_POST["txt_ReturnDate"])) !=0)
	$s_ReturnDate = trim($_POST["txt_ReturnDate"]);

// event submit

$b_Validation = true;
if(isset($_POST["btn_Submit"]))
{
	// member id
	if (strlen($s_MemberID)==0) 
	{
		$s_ErrorMessage .= "please field member id<br/>";
		$b_Validation = false;
	}
	else if(!$c_Member->bool_Check_MemberID($s_MemberID))
	{
		$s_ErrorMessage .= "member id invalid <br/>";
		$b_Validation = false;
	}

	// borrow date

	$dt_DateTimeNow = strtotime($c_Variable->string_Set_DateTimeNow());
	$dt_BorrowDateTime = strtotime($s_BorrowDate ." 00:00:00");
	$dt_ReturnDateTime =strtotime($s_ReturnDate . " 00:00:00");
	if (strlen($s_BorrowDate) == 0) 
	{
		$s_ErrorMessage .= "Please field borrow date<br/>";
		$b_Validation = false;
	}
	else if(!$c_Variable->bool_Check_ValidateDate($s_BorrowDate . " 00:00:00"))
	{
		$s_ErrorMessage .= "borrow date invalid format <br/>";
		$b_Validation = false;
	}
	else if($dt_BorrowDateTime > $dt_DateTimeNow)
	{
		$s_ErrorMessage .= "Borrow date can not greather date now <br/>";
		$b_Validation = false;
	}

	// Return date

	if(strlen($s_ReturnDate) == 0)
	{
		$s_ErrorMessage .= "Please field Return date<br/>";
		$b_Validation = false;
	}
	else if(!$c_Variable->bool_Check_ValidateDate($s_ReturnDate. " 00:00:00"))
	{
		$s_ErrorMessage .= "Return date invalid<br/>";
		$b_Validation = false;
	}
	else if($dt_ReturnDateTime < $dt_BorrowDateTime)
	{
		$s_ErrorMessage .= "Return date can not less borrow date<br/>";
		$b_Validation = false;
	}

    /*
     * Validasi true, My SQL Bridge
     */

    if($b_Validation)
    {
    	$b_Check = $c_Member->bool_Insert_BorrowData($s_BorrowID, $s_MemberID,$s_EmployeeID,$s_BorrowDate,$s_ReturnDate);
    	if($b_Check)
    	{
    		echo $c_Variable->string_Set_RedirectPage("memberborrowbookinsert.php?id=$s_BorrowID");
    	}
    	else
    		$s_ErrorMessage = "Can not insert this data";
    }
}

 ?>

 <div class="Form">
 	<style type="text/css">
 		.Form .Lable
 		{
 			width: 140px;
 		}
 	</style>
 	<form action="" method="post" enctype="multipart/form-data" name="form-manage">
 		<div class="Row">
 			<span class="TitleMessage">Form Noted Borrowed</span>
 		</div>
 		<div class="Row">
 			<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
 		</div>

 		<div class="Row">
 			<span class="Lable">Member ID</span>
 			<input type="text" name="txt_MemberID" value="<?=$s_MemberID?>" class="TextBox">
 		</div>

 		<div class="Row">
 			<span class="Lable">Borrow Date</span>
 			<input type="text" name="txt_BorrowDate" value="<?=$s_BorrowDate?>" class="TextBox" placeholder="format [yyyy-mm-dd]"/>
 		</div>

 		<div class="Row">
 			<span class="Lable">Return Date</span>
 			<input type="text" name="txt_ReturnDate" value="<?=$s_ReturnDate?>" class="TextBox" placeholder="format [yyyy-mm-dd]"/>
 		</div>

 		<div class="Row">
 			<input type="submit" name="btn_Submit" value="Submit" class="ButtonSubmit"/>
 			<span>&nbsp;&nbsp;</span>
 			<input type="reset" value="Reset" class="ButtonReset" name=""/>
 			<span>&nbsp;&nbsp;</span>
 			<input type="button" value="Back" class="ButtonBack" onclick="window.history.back();" name=""/>
 		</div>
 	</form>
 </div>

 <?php 
 ob_flush();
  ?>