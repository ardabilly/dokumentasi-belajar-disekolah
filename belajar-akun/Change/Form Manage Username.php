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

$s_Username = "";
if(isset($_POST["txt_Username"]) && strlen(trim($_POST["txt_Username"])) != 0)
    $s_Username = trim($_POST["txt_Username"]);

$s_Password = "";
if(isset($_POST["txt_Password"]) && strlen(trim($_POST["txt_Password"])) != 0)
    $s_Password = trim($_POST["txt_Password"]);

//==========================================
// Event Submit
//==========================================

$b_Validation = true;

if(isset($_POST["btn_Submit"]))
{
    /*
     * Validasi Username
     */
    
    if(strlen($s_Username) == 0)
    {
        $s_ErrorMessage .= "Please field username<br/>";
        $b_Validation = false;
    }
    else if($c_People->bool_Check_Username($s_Username, $s_PeopleID))
    {
        $s_ErrorMessage .= "Username can not used<br/>";
        $b_Validation = false;
    }
    
    
    /*
     * Validasi Password
     */
    
    if(strlen($s_Password) == 0)
    {
        $s_ErrorMessage .= "Please field password<br/>";
        $b_Validation = false;
    }
    
    else if(!$c_People->bool_Check_PeopleLogin_ByPassword($s_PeopleID, $s_Password))
    {
        $s_ErrorMessage .= "Your password wrong<br/>";
        $b_Validation = false;
    }
    
    /*
     * Validation True
     */
    
    if($b_Validation)
    {
        $b_Check = $c_People->bool_Update_PeopleLogin_Username($s_PeopleID, $s_Username);
        if($b_Check)
        {
            echo $c_Object->string_Set_MessageBox("Username updated");
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
            <span class="TitleName">Change Username</span>
        </div>
        <div class="Row">
            <span class="ErrorMessage"><?=$s_ErrorMessage?></span>
        </div>
        <div class="Row">
            <span class="Lable">New Username</span>
            <input type="text" name="txt_Username" class="TextBox" value="<?=$s_Username?>" />
        </div>
        
        <div class="Row">
            <span class="Lable">Password</span>
            <input type="password" name="txt_Password" class="TextBox" value="<?=$s_Password?>" />
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
