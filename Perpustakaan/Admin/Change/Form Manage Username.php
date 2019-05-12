<?php 
ob_start();

// CLASS MANAGEMENT

include_once'../App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();


// Variable

$s_ErrorMessage = "";

$s_EmployeeID = $_COOKIE["cookie_AkunPerpus"];

$s_NewUsername = "";
if (isset($_POST["txt_NewUsername"]) && strlen(trim($_POST["txt_NewUsername"])) != 0) 
	$s_NewUsername = trim($_POST["txt_NewUsername"]);

$s_Password = "";
if (isset($_POST["txt_Password"]) && strlen(trim($_POST["txt_Password"])) != 0)
	$s_Password = trim($_POST["txt_Password"]);

// Event submit

$b_Validation = true;
if(isset($_POST["btn_Submit"]))
{
	// Validasi username
	if(strlen($s_NewUsername) == 0)
	{
		$s_ErrorMessage .= "Please field new Username<br/>";
		$b_Validation = false;
	}
	elseif($c_Employee->bool_Check_EmployeeUsername($s_EmployeeID,$s_NewUsername))
	{
		$s_ErrorMessage .= "This Username is used by another employee";
		$b_Validation = false;
	}

	// Validasi Password 

	if(strlen($s_Password) == 0) 
	{
		$s_ErrorMessage .= " Please field your password ";
		$b_Validation = false;
	}
	elseif (!$c_Employee->bool_Check_EmployeeLogin_Password($s_EmployeeID,$s_Password)) 
	{
		$s_ErrorMessage .= "your Password typing Error";
		$b_Validation = false;
	}

	// Validasi True

	if($b_Validation)
	{
		$b_Check = $c_Employee->bool_Update_EmployeeLogin_Username($s_EmployeeID, $s_NewUsername);
		if($b_Check)
		{
			echo $c_Variable->string_Set_MessageBox("Username Update");
		}
		else
		{
			$s_ErrorMessage .= "Can not update Username";
		}
	}
}

?>
<!-- 
<div class="Form">
<style type="text/css">
	.Form .Lable
	{
		width: 120px;
	}
	
</style>
<form action="" method="post" enctype="multipart/form-data" name="form-manage">
	<div class="Row">
		<span class="TitleMessage">Form Manage Username</span>
	</div>	
	<div class="Row">
		<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
	</div>
	<div class="Row">
		<span class="Lable"> New Username </span>
		<input type="text" name="txt_NewUsername" value="<?=$s_NewUsername?>" class="TextBox">
	</div>	
	<div class="Row">
		<span class="Lable"> Password </span>
		<input type="password" name="txt_Password" value="<?=$s_Password?>" class="TextBox" />
	</div>
	<div class="Row">
		<input type="submit" name="btn_Submit" value="Submit" class="ButtonSubmit" >
		<span>&nbsp;</span>
		<input type="reset" value="Reset" class="ButtonReset">
	</div>
</form>
</div> -->

<div class="container">
	<div class="col-xs-6 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2>Form Manage Username</h2>
			</div>
			<div class="panel-body">
				<form action="" method="post" enctype="multipart/form-data" class="form-vertikal" name="form-manage">
					<div class="form-group">
					<label for="usr">New Username</label>
						<input type="text" name="txt_NewUsername" value="<?=$s_NewUsername?>" class="form-control">
					</div>
					<div class="form-group">
					<label for="pwd">Password</label>
						<input type="password" name="txt_Password" value="<?=$s_Password?>" class="form-control">
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
ob_start(); ?>