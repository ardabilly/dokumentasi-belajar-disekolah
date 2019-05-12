<?php
ob_start();

//===
//Class manag
//===

include_once'App Code/Class_Comment.php';
$c_Comment = new Class_Comment();

include_once'App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

// Variable

$s_ErrorMessage = "";

$s_CommentID = $c_Comment->string_Set_CommentID();

$s_Name = "";
if(isset($_POST["txt_Name"]) && strlen(trim($_POST["txt_Name"])) !=0)
	$s_Name = trim($_POST["txt_Name"]);

$s_CommentValue = "";
if(isset($_POST["txt_CommentValue"]) && strlen(trim($_POST["txt_CommentValue"])) !=0)
	$s_CommentValue = trim($_POST["txt_CommentValue"]);

$s_PhoneNumber = "";
if(isset($_POST["txt_PhoneNumber"]) && strlen(trim($_POST["txt_PhoneNumber"])) !=0)
	$s_PhoneNumber = trim($_POST["txt_PhoneNumber"]);

$s_Email = "";
if(isset($_POST["txt_Email"]) && strlen(trim($_POST["txt_Email"])) !=0)
	$s_Email = trim($_POST["txt_Email"]);

// event submit

$b_Validation = true;
if (isset($_POST["btn_Submit"])) 
{
	if (strlen($s_Name) == 0) 
	{
		$s_ErrorMessage .= "Please field name<br/>";
		$b_Validation = false;
	}
	else if(!$c_Variable->bool_Validation_HumanName($s_Name))
	{
		$s_ErrorMessage .= "Human name not us symbol or numberic<br/>";
		$b_Validation = false;
	}

	if(strlen($s_CommentValue) == 0)
	{
		$s_ErrorMessage .= "please field comment value<br/>";
		$b_Validation = false;
	}

	// Validasi contact

	if(strlen($s_PhoneNumber) ==0)
	{
		$s_ErrorMessage .= "please field phone number<br/>";
		$b_Validation = false;
	}
	else if(!$c_Variable->bool_Validation_PhoneNumber($s_PhoneNumber))
	{
		$s_ErrorMessage .= "phone number invalid<br/>";
		$b_Validation = false;
	}

	if(strlen($s_Email) != 0 && !$c_Variable->bool_Validation_Email($s_Email))
	{
		$s_ErrorMessage .= "Email invalid<br/>";
		$b_Validation = false;
	}

	/*
     * Validasi true, My SQL Bridge
     */
	if ($b_Validation) 
	{
		$b_Check = $c_Comment->bool_Insert_CommentData($s_CommentID, $s_Name, $s_CommentValue, $s_PhoneNumber, $s_Email);
		if ($b_Check) {
			
			echo $c_Variable->string_Set_RedirectPage("comment.php");
		}
		else
			$s_ErrorMessage = "Can not insert this data";
	}    

}
?>

<div class="container">
	<style type="text/css">
		.Form .Lable
		{
			width: 140px;
		}
	</style>
	<!-- 
	<form action="" class="form-horizontal" method="post" enctype="multipart/form-data" name="form-manage">
		<div class="Row">
			<span class="TitleMessage">Form Comment</span>
		</div>
		<div class="Row">
			<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
		</div>
		<div class="Row">
			<span for="usr">Name</span>
			<input type="text" name="txt_Name" value="<?=$s_Name?>" class="TextBox"/>
		</div>
		<div class="Row">
			<span for="comment">Comment</span>
			<textarea class="TextBox_Large" name="txt_CommentValue" ><?=$s_CommentValue?></textarea>
		</div>
		<div class="Row">
			<span class="Lable">Phone Number</span>
			<input type="text" name="txt_PhoneNumber" class="TextBox" value="<?=$s_PhoneNumber?>">
			<span>&nbsp;Not to be displayed</span>
		</div>
		<div class="Row">
			<span class="Lable">Email</span>
			<input type="text" name="txt_Email" class="TextBox" value="<?=$s_Email?>">
			<span>&nbsp;Not to be displayed</span>
		</div>
		<div class="Row">
			<input type="submit" name="btn_Submit" class="ButtonSubmit" value="Submit"/>
			<span>&nbsp;</span>
			<input type="reset" value="Reset" class="ButtonReset" name="">
			<span>&nbsp;</span>
			<input type="button" value="Back" class="ButtonBack" onclick="window.history.back();" name="">
		</div>
	</form>
</div> -->
<div class="container" style="margin-left: 18%;">
	<div class="col-xs-4 col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 style="text-align: center;">Form Comment</h2>
			</div>
			<div class="panel-body">
				<form class="form-vertikal" action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="usr">Nama</label>
						<input type="text" name="txt_Name" class="form-control" style="width: 50%;">
					</div>
					<div class="form-group">
						<label for="comment">Comment</label><br>
						<textarea class="comment" name="txt_CommentValue" ><?=$s_CommentValue?></textarea>
					</div>
					<div class="form-group">
						<label for="usr">PhoneNumber</label>
						<input type="text" name="txt_PhoneNumber" class="form-control" value="<?=$s_PhoneNumber?>" style="width: 50%;" placeholder="&nbsp;Not to be displayed"><span></span>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="Email" name="txt_Email" class="form-control" value="<?=$s_PhoneNumber?>" style="width: 50%;" placeholder="&nbsp;Not to be displayed"><span></span>
					</div>
					<div class="form-group">
						<input type="submit" name="btn_Submit" class="btn btn-default" value="Submit"/>
						<span>&nbsp;</span>
						<input type="reset" value="Reset" class="btn btn-danger" name="">
						<span>&nbsp;</span>
						<input type="button" value="Back" class="btn btn-primary" onclick="window.history.back();" name="">
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
<?php ob_flush(); ?>