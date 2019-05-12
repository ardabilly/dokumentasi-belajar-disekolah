<?php
ob_start();

//=========================================
// Class Management
//=========================================

include_once 'App Code/Class_People.php';
$c_People = new Class_People();

include_once 'App Code/Class_Object.php';
$c_Object = new Class_Object();

//==========================================
// Variable
//==========================================

$s_ErrorMessage = "";
$s_PeopleID = $_COOKIE["cookie_Akun"];

$s_OldPassword = "";
if(isset($_POST["txt_OldPassword"]) && strlen(trim($_POST["txt_OldPassword"])) != 0)
    $s_OldPassword = trim($_POST["txt_OldPassword"]);

$s_NewPassword = "";
if(isset($_POST["txt_NewPassword"]) && strlen(trim($_POST["txt_NewPassword"])) != 0)
    $s_NewPassword = trim($_POST["txt_NewPassword"]);

$s_VerifyPassword = "";
if(isset($_POST["txt_VerifyPassword"]) && strlen(trim($_POST["txt_VerifyPassword"])) != 0)
    $s_VerifyPassword = trim($_POST["txt_VerifyPassword"]);

//==========================================
// Event Submit
//==========================================

$b_Validation = true;

if(isset($_POST["btn_Submit"]))
{
    /*
     * Validasi Old Password
     */
    
    if(strlen($s_OldPassword) == 0)
    {
        $s_ErrorMessage .= "Please field old password<br/>";
        $b_Validation = false;
    }
    else if(!$c_People->bool_Check_PeopleLogin_ByPassword($s_PeopleID, $s_OldPassword))
    {
        $s_ErrorMessage .= "Old password invalid<br/>";
        $b_Validation = false;
    }
    
    /*
     * Validasi New Password
     */
    
    if(strlen($s_NewPassword) == 0)
    {
        $s_ErrorMessage .= "Please field New password<br/>";
        $b_Validation = false;
    }
    else if(strlen($s_NewPassword) < 6)
    {
        $s_ErrorMessage .= "New password min 6 character<br/>";
        $b_Validation = false;
    }
    
    /*
     * Verify New Password
     */
    
    if(strlen($s_VerifyPassword) == 0)
    {
        $s_ErrorMessage .= "Please field verify password<br/>";
        $b_Validation = false;
    }
    else if($s_NewPassword !== $s_VerifyPassword)
    {
        $s_ErrorMessage .= "Verify password not match<br/>";
        $b_Validation = false;
    }
    
    /*
     * Validation True
     */
    
    if($b_Validation)
    {
        $b_Check = $c_People->bool_Update_PeopleLogin_Password($s_PeopleID, $s_NewPassword);
        if($b_Check)
        {
            echo $c_Object->string_Set_MessageBox("Password updated");
            echo "<script>window.location.href='index.php'</script>";
            /*
             * jika data berhasil dimasukkan
             * maka akan berpindah halaman
             */
        }
        else
        {
            $s_ErrorMessage = "Can not manage this data";
        }
    }
}

?>

<div class="Form">
    <style>
        .Form .Lable
        {
            width: 150px;
        }
    </style>
    <form action="" method="post" enctype="multipart/form-data" name="form_Manage">
        <div class="Row">
            <span class="TitleName">Change Password</span>
        </div>
        <div class="Row">
            <span class="ErrorMessage"><?=$s_ErrorMessage?></span>
        </div>
        
        
        <div class="Row">
            <span class="Lable">Old Password</span>
            <input type="password" name="txt_OldPassword" class="TextBox" value="<?=$s_OldPassword?>" />
        </div>
        
        <div class="Row">
            <span class="Lable">New Password</span>
            <input type="password" name="txt_NewPassword" class="TextBox" value="<?=$s_NewPassword?>" />
        </div>
        
        <div class="Row">
            <span class="Lable">Verify Password</span>
            <input type="password" name="txt_VerifyPassword" class="TextBox" value="<?=$s_VerifyPassword?>" />
        </div>
        
        <div class="Row">
            <input type="submit" name="btn_Submit" value="Submit" class="ButtonSubmit" />
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
