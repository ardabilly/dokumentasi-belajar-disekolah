<?php
ob_start();

//===============================================
// Class Management
//===============================================

include_once 'App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once 'App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//===============================================
// Sign Out
//===============================================

if(isset($_COOKIE["cookie_AkunPerpus"]) && isset($_GET["signout"]))
{
    setcookie("cookie_AkunPerpus", " ", time()-3600);
    unset($_COOKIE["cookie_AkunPerpus"]);
    echo $c_Variable->string_Set_RedirectPage("employee.php");
}

//===============================================
// Variable
//===============================================

$s_ErrorMessage = "";
$s_Username = "";
if(isset($_POST["txt_Username"]) && strlen(trim($_POST["txt_Username"])) != 0)
    $s_Username = trim($_POST["txt_Username"]);

$s_Password = "";
if(isset($_POST["txt_Password"]) && strlen(trim($_POST["txt_Password"])) != 0)
    $s_Password = trim($_POST["txt_Password"]);

$b_Remember = true;
$s_Remtember = " checked='true' ";
if(isset($_POST["chk_Remember"]) && isset($_POST["btn_Submit"]))
{
    $b_Remember = true;
    $s_Remember = " checked='true' ";
}
if(!isset($_POST["chk_Remember"]) && isset($_POST["btn_Submit"]))
{
    $b_Remember = false;
    $s_Remember = "";
}

/*
 * event submit
 */
$b_Validation = true;

if(isset($_POST["btn_Submit"]))
{
    if(strlen($s_Username) == 0)
    {
        $s_ErrorMessage .= "Please field Username<br/>";
        $b_Validation = false;
    }
    if(strlen($s_Password) == 0)
    {
        $s_ErrorMessage .= "Please field Password<br/>";
        $b_Validation = false;
    }

    if(strlen($s_Username) != 0 && strlen($s_Password) != 0 && !$c_Employee->bool_Check_EmployeeLogin($s_Username, $s_Password))
    {
        $s_ErrorMessage .= "Access Denied<br/>";
        $b_Validation = false;
    }

    /*
     * Validation true
     */

    if($b_Validation)
    {
        $s_ValueID = $c_Employee->string_Get_EmployeeID($s_Username, $s_Password);
        if(!$b_Remember)
        {
            setcookie("cookie_AkunPerpus", $s_ValueID, time()+3600);
        }
        if($b_Remember)
        {
            setcookie("cookie_AkunPerpus", $s_ValueID, time()+3600*24*5);
        }

        echo "<script>swal('Berhasil!', 'You clicked the button!', 'success');
                window.location.href='employee.php';
            </script>";

    }
}

?>
<!-- form lama
<div class="Form" style="padding: 20px; margin-left: 40%; margin-top: 30px;">
<form action="" method="post" enctype="multipart/form-data" name="form_Manage">
<div class="RowCenter">
<img src="Images/Global/Account.png"  style="width: 50px; height: 50px;" />
</div>
<div class="Row">
<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
</div>
<div class="Row">
<input type="text" name="txt_Username" value="<?=$s_Username?>" class="TextBox" placeholder="Username" />
</div>
<div class="Row">
<input type="password" name="txt_Password" value="<?=$s_Password?>" class="TextBox" placeholder="Password" />
</div>
<div class="Row" >
<input type="checkbox" class="CheckBox" name="chk_Remember" value="<?=$b_Remember?>" />
<span>Please keep login</span>
</div>
<div class="Row">
<input type="submit" name="btn_Submit" value="Login" class="ButtonSubmit"  />
<span>&nbsp;</span>
<input type="reset" value="Reset" class="ButtonReset" />
</div>
</form>
</div> -->

<div class="Row">
     <div class="col-xs-12 col-md-4 col-md-offset-4" style="margin-top: ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="Images/Global/Account.png"  style="width: 50px; height: 50px; margin-left: 40%;" />
            </div>
            <div class="panel-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="txt_Username" value="<?=$s_Username?>" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" value="<?=$s_Password?>" name="txt_Password">
                    </div>
                    <div class="form-group" >
                        <input type="checkbox" class="checkBox" name="chk_Remember" value="<?=$b_Remember?>" />
                        <span style="font-weight: bold;">Please keep login</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="btn_Submit"><span class="fa fa-send"></span> login</button>
                        <button class="btn btn-danger" type="reset">batal</button>
                    </div>
                </form>
            </div>
            <div class="panel-bottom">
                <div class="alert alert-danger" style="text-align: center;">
                <span style="font-size: 15px; ">
                    <?=$s_ErrorMessage?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
ob_flush();
?>
