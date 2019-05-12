<?php
ob_start();
//==================
// Class Management
//==================
include_once '../App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once '../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//===========
// Variable
//===========

$s_ErrorMessage = "";

$s_EmployeeID = $_COOKIE["cookie_AkunPerpus"];

$s_OldPassword = "";
if(isset($_POST["txt_OldPassword"]) && strlen(trim($_POST["txt_OldPassword"])) != 0)
	$s_OldPassword = trim($_POST["txt_OldPassword"]);

$s_NewPassword = "";
if(isset($_POST["txt_NewPassword"]) && strlen(trim($_POST["txt_NewPassword"])) != 0)
	$s_NewPassword = trim($_POST["txt_NewPassword"]);

$s_VerifyPassword = "";
if(isset($_POST["txt_VerifyPassword"]) && strlen(trim($_POST["txt_VerifyPassword"])) != 0)
	$s_VerifyPassword = trim($_POST["txt_VerifyPassword"]);

// Event Submit
$b_Validation = true;
if (isset($_POST["btn_Submit"])) 
{
	// Validasi Old Password

	if(strlen($s_OldPassword) == 0)
	{
		$s_ErrorMessage .= "Please Field old Password <br/>";
		$b_Validation = false;
	}
	elseif(!$c_Employee->bool_Check_EmployeeLogin_Password($s_EmployeeID, $s_OldPassword))
	{
		$s_ErrorMessage .= "old Password wrong <br />";
		$b_Validation = false;
	}

	// Validasi New Password

	if (strlen($s_NewPassword) == 0) 
	{
		$s_ErrorMessage .= "Please Field new Password <br/>";
		$b_Validation = false;
	}
	elseif (strlen($s_NewPassword) < 6) 
	{
		$s_ErrorMessage .= "New Password min 6 character <br/>";
		$b_Validation = false;
	}

	// Validasi Verify Password

	if (strlen($s_VerifyPassword) == 0) 
	{
		$s_ErrorMessage .= "Please field Verify Password <br/>";
		$b_Validation = false;
	}

	elseif($s_VerifyPassword !== $s_NewPassword)
	{
		$s_ErrorMessage .="Verify no match <br/>";
		$b_Validation = false;
	}

	// Validasi true

	if ($b_Validation) 
	{
		$b_Check = $c_Employee->bool_Update_EmployeeLogin_Password($s_EmployeeID,$s_NewPassword);
		if ($b_Check) 
		{
			echo $c_Variable->string_Set_MessageBox("Password match");
		}
		else
		{
			$s_ErrorMessage = "Can not update Password";
		}
	}
}
?>

<div class="container">
	<div class="col-xs-6 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2>Form Manage Password</h2>
			</div>
			<div class="panel-body">
				<form action="" method="post" enctype="multipart/form-data" class="form-vertikal" name="form-manage">
					<div class="form-group">
					<label for="pwd">Old Password</label>
						<input type="password" name="txt_OldPassword" value="<?=$s_OldPassword?>" class="form-control">
					</div>

					<div class="form-group">
					<label for="pwd">New Password</label>
						<input type="password" name="txt_NewPassword" value="<?=$s_NewPassword?>" class="form-control">
					</div>
					<div class="form-group">
					<label for="pwd">Verifiy Password</label>
						<input type="password" name="txt_VerifyPassword" value="<?=$s_VerifyPassword?>" class="form-control">
					</div>
					<div class="form-group">
						<input type="submit" name="btn_Submit" value="Submit" class="btn btn-default"/>
						<span>&nbsp;</span>
						<input type="reset" value="Reset" class="btn btn-danger"/>
					</div>
				</form>
			</div>
			<div class="panel-body">
				<div class="alert alert-danger"><span><?=$s_ErrorMessage?></span></div>
			</div>
		</div>
	</div>
</div>

<?php
ob_flush();
?>