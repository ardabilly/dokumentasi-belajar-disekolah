<?php
ob_start();

//=================================================
// Class object
//=================================================

/*
 * buatlah include once pada class object
 * jika mengikuti path seharusnya
 * ../App Code/Class_Object.php
 * naik satu folder, tetapi ini tidak
 * karena file sign up, dipanggil pada file index.php
 * yang berarti sejajar dengan folder App Code
 */
include_once 'App Code/Class_Object.php';
$c_Object = new Class_Object();

include_once 'App Code/Class_People.php';
$c_People = new Class_People();

//=================================================
// Variable Management
//=================================================

$s_ErrorMessage = "";
$s_PeopleID = "";


$s_Username = "";
if(isset($_POST["txt_Username"]) && strlen(trim($_POST["txt_Username"])) != 0)
    $s_Username = trim($_POST["txt_Username"]);

$s_Password = "";
if(isset($_POST["txt_Password"]) && strlen(trim($_POST["txt_Password"])) != 0)
    $s_Password = trim($_POST["txt_Password"]);

$b_Remember = true;
$s_Remember = " checked='true' ";
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

//=================================================
// event submit
//=================================================

$b_Validation = true;

if(isset($_POST["btn_Submit"]))
{
    //Validasi username
    if(strlen($s_Username) == 0)
    {
        $s_ErrorMessage .= "Please field username<br/>";
        $b_Validation = false;
    }
    
    //Validasi password
    if(strlen($s_Password) == 0)
    {
        $s_ErrorMessage .= "Please field password<br/>";
        $b_Validation = false;
    }
    
    if(strlen($s_Username) != 0 && strlen($s_Password) != 0 && !$c_People->bool_Check_PeopleLogin($s_Username, $s_Password))
    {
        $s_ErrorMessage .= "Username or password wrong<br/>";
        $b_Validation = false;
    }
    
    //jika validasi true
    if($b_Validation)
    {
        $s_PeopleID = $c_People->string_Get_PeopleID($s_Username, $s_Password);
        
        if($b_Remember)
        {
            
            setcookie("cookie_Akun", $s_PeopleID, time()+3600*24);
            /*
             * Massa Cookie satu hari
             */
        }
        else if(!$b_Remember)
        {
            setcookie("cookie_Akun", $s_PeopleID, time()+3600);
            /*
             * Massa Cookie satu jam
             */
        }
        
        echo $c_Object->string_Set_RedirectPage("index.php");
    }
}
?>

<div class="Form" style="clear: none; float: left; margin-left: 20px;">
    <style>
        .Form .Lable
        {
            width: 120px;
        }
    </style>
    <form action="" method="post" enctype="multipart/form-data" name="form_Manage">
        <div class="Row">
            <span class="TitleName">Sign In</span>
        </div>
        
        <div class="Row">
            <span class="ErrorMessage"><?=$s_ErrorMessage?></span>
        </div>
        
        <div class="Row">
            <input type="text" name="txt_Username" placeholder="Username" class="TextBox" value="<?=$s_Username?>" />
        </div>


        <div class="Row">
            <input type="password" name="txt_Password" placeholder="Password" class="TextBox" value="<?=$s_Password?>" />
        </div>
        
        <div class="Row" >
            <input type="checkbox" class="CheckBox" name="chk_Remember" value="<?=$b_Remember?>" <?=$s_Remember?> /> 
            <span style="font-family: monospace;">&nbsp;Remember me</span>
        </div>
        
        
        <div class="Row">
            <input type="submit" name="btn_Submit" value="Sign In" class="ButtonSubmit" />
            <span>&nbsp;</span>
            <input type="button" value="Sign Up" onclick="window.location.href='index.php?action=signup';" class="ButtonBack" />
        </div>
    </form>
</div>

<?php
ob_flush();
?>