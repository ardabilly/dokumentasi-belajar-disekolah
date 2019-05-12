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

$s_FullName = "";
if(isset($_POST["txt_FullName"]) && strlen(trim($_POST["txt_FullName"])) != 0)
    $s_FullName = trim($_POST["txt_FullName"]);

$s_NickName = "";
if(isset($_POST["txt_NickName"]) && strlen(trim($_POST["txt_NickName"])) != 0)
    $s_NickName = trim($_POST["txt_NickName"]);

$s_Gender = "";
if(isset($_POST["rd_Gender"]) && strlen(trim($_POST["rd_Gender"])) != 0)
    $s_Gender = trim($_POST["rd_Gender"]);

$s_Religion = "";
if(isset($_POST["cb_Religion"]) && strlen(trim($_POST["cb_Religion"])) != 0)
    $s_Religion = trim($_POST["cb_Religion"]);

$s_PlaceOfBirth = "";
if(isset($_POST["txt_PlaceOfBirth"]) && strlen(trim($_POST["txt_PlaceOfBirth"])) != 0)
    $s_PlaceOfBirth = trim($_POST["txt_PlaceOfBirth"]);

$s_DateOfBirth = "";
if(isset($_POST["txt_DateOfBirth"]) && strlen(trim($_POST["txt_DateOfBirth"])) != 0)
    $s_DateOfBirth = trim($_POST["txt_DateOfBirth"]);

$s_PhoneNumber = "";
if(isset($_POST["txt_PhoneNumber"]) && strlen(trim($_POST["txt_PhoneNumber"])) != 0)
    $s_PhoneNumber = trim($_POST["txt_PhoneNumber"]);

$s_Email = "";
if(isset($_POST["txt_Email"]) && strlen(trim($_POST["txt_Email"])) != 0)
    $s_Email = trim($_POST["txt_Email"]);

$s_Address = "";
if(isset($_POST["txt_Address"]) && strlen(trim($_POST["txt_Address"])) != 0)
    $s_Address = trim($_POST["txt_Address"]);

$s_Image = "";

//==========================================
// Event Submit
//==========================================

$b_Validation = true;

if(isset($_POST["btn_Submit"]))
{
    /*
     * Validasi Nama
     */
    
    if(strlen($s_FullName) == 0)
    {
        $s_ErrorMessage .= "Please field full name<br/>";
        $b_Validation = false;
    }
    else if(!$c_Object->bool_Validation_HumanName($s_FullName))
    {
        $s_ErrorMessage .= "Full name invalid, please do not use numeric or symbol<br/>";
        $b_Validation = false;
    }
    
    if(strlen($s_NickName) == 0)
    {
        $s_ErrorMessage .= "Please field nick name<br/>";
        $b_Validation = false;
    }
    else if(!$c_Object->bool_Validation_HumanName($s_NickName))
    {
        $s_ErrorMessage .= "Nick name invalid, please do not use numeric or symbol<br/>";
        $b_Validation = false;
    }
    
    /*
     * Validasi Gender and Religion
     */
    
    if(strlen($s_Gender) == 0)
    {
        $s_ErrorMessage .= "Select one gender<br/>";
        $b_Validation = false;
    }
    
    if(strlen($s_Religion) == 0)
    {
        $s_ErrorMessage .= "Select one religion<br/>";
        $b_Validation = false;
    }
    
    /*
     * validasi Place and Date Of Birth
     */
    
    if(strlen($s_PlaceOfBirth) == 0)
    {
        $s_ErrorMessage .= "Please field place of birth<br/>";
        $b_Validation = false;
    }
    
    if(strlen($s_DateOfBirth) == 0)
    {
        $s_ErrorMessage .= "Please field date of birth<br/>";
        $b_Validation = false;
    }
    
    if(strlen($s_DateOfBirth) != 0 && !$c_Object->bool_Check_ValidateDate($s_DateOfBirth . " 00:00:00"))
    {
        $s_ErrorMessage .= "Date of birth invalid, format [yyyy-mm-dd]<br/>";
        $b_Validation = false;
    }
    
    if(strlen($s_DateOfBirth) != 0 && $c_Object->bool_Check_ValidateDate($s_DateOfBirth . " 00:00:00"))
    {
        $d_Age = $c_Object->double_Get_Age($s_DateOfBirth . "00:00:00");
        
        if($d_Age < 4)
        {
            $s_ErrorMessage .= "Min age 4 year old<br/>";
            $b_Validation = false;
        }
    }
    
    /*
     * Validasi Contact
     */
    
    if(strlen($s_PhoneNumber) != 0 && !$c_Object->bool_Validation_PhoneNumber($s_PhoneNumber))
    {
        $s_ErrorMessage .= "Phone number invalid<br/>";
        $b_Validation = false;
    }
    if(strlen($s_Email) != 0 && !$c_Object->bool_Validation_Email($s_Email))
    {
        $s_ErrorMessage .= "Email invalid<br/>";
        $b_Validation = false;
    }
    if(strlen($s_Address) == 0 )
    {
        $s_ErrorMessage .= "Please field address<br/>";
        $b_Validation = false;
    }
    
    /*
     * Validasi Image
     */
    
    if(is_uploaded_file($_FILES["file_Data"]["tmp_name"]))
    {
        $acceptable = array(
            'image/jpeg',
            'image/jpg',
            'image/gif',
            'image/png'
            );

        /*
         * akan menvalidasi apakah file yang dimasukkan
         * image atau bukan
         */
        
        if(!in_array($_FILES['file_Data']['type'], $acceptable) && (!empty($_FILES["file_Data"]["type"])))
        {
            $s_ErrorMessage .= "The file for image is incorrect. Please use only gif, png or jpg!<br/>";
            $b_Validation = FALSE;
        }
    
        //memeriksa size image
        $d_Size = $_FILES["file_Data"]["tmp_name"];
        $d_Size = doubleval($d_Size);

        if($d_Size > (40 * 1024 * 1024))
        {
            $s_ErrorMessage .= "Your file more 40 mb, can not allowed<br/>";
            $b_Validation = FALSE;
        }
    }
    
    /*
     * Validation True
     */
    
    if($b_Validation)
    {
        $b_Check = $c_People->bool_Update_PeopleData($s_PeopleID, $s_FullName, $s_NickName, $s_Gender, $s_Religion, $s_PlaceOfBirth, $s_DateOfBirth, $s_PhoneNumber, $s_Email, $s_Address);
        if($b_Check)
        {
            if(is_uploaded_file($_FILES["file_Data"]["tmp_name"]))
            {
                /*
                 * memindahkan file image ke server
                 * mengganti nama file image sesuia
                 * dengan news id
                 */
                $s_Image = "Images/user/".$s_PeopleID.".". pathinfo($_FILES["file_Data"]["name"], PATHINFO_EXTENSION);
                
                $fileTmpLoc = $_FILES['file_Data']['tmp_name'];
                $pathAndName = "" . $s_Image;
                $moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
            }
            
            echo "<script>window.location.href='profile.php'</script>";
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


if(!isset($_POST["btn_Submit"]))
{
    /*
     * Memberikan data awal
     * pada event load
     */
    $array_Data = $c_People->array_Get_DataPeople($s_PeopleID);
    $s_FullName = $array_Data[1];
    $s_NickName = $array_Data[2];
    $s_Gender = $array_Data[3];
    $s_Religion = $array_Data[4];
    $s_PlaceOfBirth = $array_Data[5];
    $s_DateOfBirth = explode(" ", $array_Data[6])[0];
    $s_PhoneNumber = $array_Data[7];
    $s_Email = $array_Data[8];
    $s_Address = $array_Data[9];
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
            <span class="TitleName">Edit Data</span>
        </div>
        <div class="Row">
            <span class="ErrorMessage"><?=$s_ErrorMessage?></span>
        </div>
        <div class="Row">
            <span class="Lable">Name</span>
            <input type="text" name="txt_FullName" class="TextBox" value="<?=$s_FullName?>" placeholder="Full Name" />
            <span>&nbsp;</span>
            <input type="text" name="txt_NickName" class="TextBox" value="<?=$s_NickName?>" placeholder="Nick Name" />
        </div>
        
        <div class="Row">
            <span class="Lable">Gender</span>
            <?php
            
            $array_AllID = $c_Object->array_AllGender();
            
            for($var = 0; $var < count($array_AllID); $var++)
            {
                $s_ValueID = $array_AllID[$var];
                
                $s_Selected = "";
                if($s_ValueID === $s_Gender)
                {
                    $s_Selected = "checked";
                    /*
                     * jika pilihan radio sudah dipilih
                     * maka attribute default pada html nya
                     * checked
                     */
                }
                
                ?>
                <input type="radio" name="rd_Gender" value="<?=$s_ValueID?>" <?=$s_Selected?> /> <?=$s_ValueID?> &nbsp;&nbsp;
                <?php
            }
            
            ?>
        </div>
        
        <div class="Row">
            <span class="Lable">Religion</span>
            <select name="cb_Religion" class="TextBox">
                <option value="" >- Option -</option>
                <?php

                $array_AllID = $c_Object->array_AllReligion();

                for($var = 0; $var < count($array_AllID); $var++)
                {
                    $s_ValueID = $array_AllID[$var];

                    $s_Selected = "";
                    if($s_ValueID === $s_Religion)
                    {
                        $s_Selected = "selected";
                        /*
                         * jika pilihan radio sudah dipilih
                         * maka attribute default pada html nya
                         * selected
                         */
                    }

                    ?>
                    <option value="<?=$s_ValueID?>" <?=$s_Selected?> ><?=$s_ValueID?></option>
                    <?php
                }

                ?>
            </select>
        </div>
        
        <div class="Row">
            <span class="Lable">Place and Date Of Birth</span>
            <input type="text" name="txt_PlaceOfBirth" class="TextBox" value="<?=$s_PlaceOfBirth?>" placeholder="Place of birth" />
            <span>&nbsp;</span>
            <input type="text" name="txt_DateOfBirth" class="TextBox" value="<?=$s_DateOfBirth?>" placeholder="[yyyy-mm-dd] Date of birth" />
        </div>
        
        <div class="Row">
            <span class="Lable">Contact</span>
            <input type="text" name="txt_PhoneNumber" class="TextBox" value="<?=$s_PhoneNumber?>" placeholder="Phone Number" />
            <span>&nbsp;and&nbsp;</span>
            <input type="text" name="txt_Email" class="TextBox" value="<?=$s_Email?>" placeholder="Email" />
        </div>
        
        <div class="Row">
            <span class="Lable">Address</span>
            <textarea name="txt_Address" class="TextBox_Large" ><?=$s_Address?></textarea>
        </div>
        
        <div class="Row">
            <span class="Lable">Photo</span>
            <span><input type="file" name="file_Data" /></span>
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