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
$s_PeopleID = $c_People->string_Set_PeopleID();

$s_Name = "";
if(isset($_POST["txt_Name"]) && strlen(trim($_POST["txt_Name"])) != 0)
    $s_Name = trim($_POST["txt_Name"]);

$s_Username = "";
if(isset($_POST["txt_Username"]) && strlen(trim($_POST["txt_Username"])) != 0)
    $s_Username = trim($_POST["txt_Username"]);

$s_Password = "";
if(isset($_POST["txt_Password"]) && strlen(trim($_POST["txt_Password"])) != 0)
    $s_Password = trim($_POST["txt_Password"]);

$s_VerifyPassword = "";
if(isset($_POST["txt_VerifyPassword"]) && strlen(trim($_POST["txt_VerifyPassword"])) != 0)
    $s_VerifyPassword = trim($_POST["txt_VerifyPassword"]);

//=================================================
// event submit
//=================================================

$b_Validation = true;

if(isset($_POST["btn_Submit"]))
{
    //Validasi Name
    if(strlen($s_Name) == 0)
    {
        $s_ErrorMessage .= "Please file the name<br/>";
        $b_Validation = false;
    }
    else if(strlen($s_Name) != 0 && !$c_Object->bool_Validation_HumanName($s_Name))
    {
        $s_ErrorMessage .= "The name of human not use numeric or symbol<br/>";
        $b_Validation = false;
    }
    
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
    else if(strlen($s_Password) > 0 && strlen($s_Password) < 6)
    {
        $s_ErrorMessage .= "Password min 6 character<br/>";
        $b_Validation = false;
    }
    
    //Validasi verify password
    if(strlen($s_VerifyPassword) == 0)
    {
        $s_ErrorMessage .= "Please field verify password<br/>";
        $b_Validation = false;
    }
    else if(strlen($s_VerifyPassword) != 0 && $s_Password !== $s_VerifyPassword)
    {
        $s_ErrorMessage .= "Verify password not match<br/>";
        $b_Validation = false;
    }
    
    //Validation True
    if($b_Validation)
    {
        $b_Check = $c_People->bool_Insert_PeopleData($s_PeopleID, $s_Name);
        if($b_Check)
        {
            $c_People->bool_Insert_PeopleLogin($s_PeopleID, $s_Username, $s_Password);
            echo $c_Object->string_Set_MessageBox("Data telah disimpan, silahkan login");
            echo $c_Object->string_Set_RedirectPage("index.php");
        }
        else if(!$b_Check)
        {
            $s_ErrorMessage = "Tidak bisa menyimpan data ini";
        }
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
            <span class="TitleName">Form Sign Up</span>
        </div>
        <div class="Row">
            <span class="ErrorMessage"><?=$s_ErrorMessage?></span>
        </div>
        <div class="Row">
            <span class="Lable">Name</span>
            <input type="text" name="txt_Name" class="TextBox" value="<?=$s_Name?>" />
        </div>
        
        <div class="Row">
            <span class="Lable">Username</span>
            <input type="text" name="txt_Username" class="TextBox" value="<?=$s_Username?>" />
        </div>
        
        <div class="Row">
            <span class="Lable">Password</span>
            <input type="password" name="txt_Password" class="TextBox" value="<?=$s_Password?>" />
        </div>
        
        <div class="Row">
            <span class="Lable">Verify Password</span>
            <input type="password" name="txt_VerifyPassword" class="TextBox" value="<?=$s_VerifyPassword?>" />
        </div>
        
        <div class="Row">
            <input type="submit" name="btn_Submit" value="Sign Up" class="ButtonSubmit" />
            <span>&nbsp;</span>
            <input type="reset" value="Reset" class="ButtonReset" />
            <span>&nbsp;</span>
            <input type="button" value="Back" onclick="window.history.back()" class="ButtonBack" />
        </div>
    </form>
</div>

<?php
ob_flush();
?>