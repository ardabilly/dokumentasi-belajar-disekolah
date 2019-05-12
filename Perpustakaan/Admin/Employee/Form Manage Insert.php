<?php
ob_start();

//====================================
// Class Management
//====================================

include_once '../App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once '../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//====================================
// Variable
//====================================

$s_ErrorMessage = "";

$s_EmployeeID = "";
if(isset($_POST["txt_EmployeeID"]) && strlen(trim($_POST["txt_EmployeeID"])) != 0)
    $s_EmployeeID = trim($_POST["txt_EmployeeID"]);

$s_FullName = "";
if(isset($_POST["txt_FullName"]) && strlen(trim($_POST["txt_FullName"])) != 0)
    $s_FullName = trim($_POST["txt_FullName"]);

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

/*
 * event submit
 */
$b_Validation = true;

if(isset($_POST["btn_Submit"]))
{
    /*
     * validasi employee id
     */
    if(strlen($s_EmployeeID) == 0)
    {
        $s_ErrorMessage .= "Please field employee id<br/>";
        $b_Validation = false;
    }

    else if($c_Employee->bool_Check_EmployeeID($s_EmployeeID))
    {
        $s_ErrorMessage .= "This employee id was exist<br/>";
        $b_Validation = false;
    }

    /*
     * Validasi full name
     */

    if(strlen($s_FullName) == 0)
    {
        $s_ErrorMessage .= "Please field full name<br/>";
        $b_Validation = false;
    }
    else if(!$c_Variable->bool_Validation_HumanName($s_FullName))
    {
        $s_ErrorMessage .= "Full name invalid<br/>";
        $b_Validation = false;
    }

    /*
     * Validasi Gender, Religion
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
     * validasi place and date of birth
     */

    if(strlen($s_PlaceOfBirth) == 0)
    {
        $s_ErrorMessage .= "Please field Place of birth<br/>";
        $b_Validation = false;
    }

    if(strlen($s_DateOfBirth) == 0)
    {
        $s_ErrorMessage .= "Please field date of birth<br/>";
        $b_Validation = false;
    }

    if(strlen($s_DateOfBirth) != 0 && !$c_Variable->bool_Check_ValidateDate($s_DateOfBirth . " 00:00:00"))
    {
        $s_ErrorMessage .= "Date of birth format invalid<br/>";
        $b_Validation = false;
    }

    if(strlen($s_DateOfBirth) != 0 && $c_Variable->bool_Check_ValidateDate($s_DateOfBirth . " 00:00:00") && $c_Variable->double_Get_Age($s_DateOfBirth . " 00:00:00") < 17)
    {
        $s_ErrorMessage .= "Min age 17 year old<br/>";
        $b_Validation = false;
    }

    /*
     * validasi phone number, email and address
     */

    if(strlen($s_PhoneNumber) == 0)
    {
        $s_ErrorMessage .= "Please field phone number<br/>";
        $b_Validation = false;
    }
    else if(!$c_Variable->bool_Validation_PhoneNumber($s_PhoneNumber))
    {
        $s_ErrorMessage .= "Phone number invalid format<br/>";
        $b_Validation = false;
    }

    if(strlen($s_Email) != 0 && !$c_Variable->bool_Validation_Email($s_Email))
    {
        $s_ErrorMessage .= "Email invalid format<br/>";
        $b_Validation = false;
    }

    if(strlen($s_Address) == 0)
    {
        $s_ErrorMessage .= "Please field address<br/>";
        $b_Validation = false;
    }

    /*
     * Validasi image
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
     * Validasi true, My SQL Bridge
     */
    if($b_Validation)
    {
        $b_Check = $c_Employee->bool_Insert_EmployeeData($s_EmployeeID, $s_FullName, $s_Gender, $s_Religion, $s_PlaceOfBirth, $s_DateOfBirth, $s_PhoneNumber, $s_Email, $s_Address);
        if($b_Check)
        {
            if(is_uploaded_file($_FILES["file_Data"]["tmp_name"]))
            {
                $s_Image = "Images/User/".$s_EmployeeID.".". pathinfo($_FILES["file_Data"]["name"], PATHINFO_EXTENSION);

                $fileTmpLoc = $_FILES['file_Data']['tmp_name'];
                $pathAndName = "../" . $s_Image;//naik satu folder
                $moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
            }
            $c_Employee->bool_Insert_EmployeeLogin($s_EmployeeID, $s_EmployeeID, "123456");
            /*
             * by default, login username akan employeeid
             * dan password akan 123456
             * dengan data yang sudah ditetapkan
             */

            echo $c_Variable->string_Set_RedirectPage("employeeprofile.php?id=$s_EmployeeID");
        }
        else
            $s_ErrorMessage = "Can not insert this data";
    }
}

?>

<div class="Form">
<style>
        .Form .Lable
        {
            width: 140px;
        }
</style>
<form action="" method="post" enctype="multipart/form-data" name="form_Manage">
<div class="Row">
<span class="TitleMessage">Form Add Employee</span>
</div>
<div class="Row">
<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
</div>
<div class="Row">
<span class="Lable">Employee ID</span>
<input type="text" name="txt_EmployeeID" value="<?=$s_EmployeeID?>" class="TextBox" />
</div>

<div class="Row">
<span class="Lable">Full Name</span>
<input type="text" name="txt_FullName" value="<?=$s_FullName?>" class="TextBox" />
</div>

<div class="Row">
<span class="Lable">Gender</span>
<?php

            $array_AllID = $c_Variable->array_AllGender();

            for($var = 0; $var < count($array_AllID); $var++)
            {
                $s_ValueID = $array_AllID[$var];

                $s_Selected = "";
                if($s_ValueID === $s_Gender)
                {
                    $s_Selected = "checked";
                }

                ?>
<input type="radio" name="rd_Gender" value="<?=$s_ValueID?>" <?=$s_Selected?> /><?=$s_ValueID?>&nbsp;&nbsp;
<?php
            }
            ?>
</div>

<div class="Row">
<span class="Lable">Religion</span>
<select name="cb_Religion" class="TextBox">
<option value="" >- Option -</option>
<?php

                $array_AllID = $c_Variable->array_AllReligion();

                for($var = 0; $var < count($array_AllID); $var++)
                {
                    $s_ValueID = $array_AllID[$var];

                    $s_Selected = "";
                    if($s_ValueID === $s_Religion)
                    {
                        $s_Selected = "selected";
                    }

                    ?>
<option value="<?=$s_ValueID?>" <?=$s_Selected?>><?=$s_ValueID?></option>
<?php
                }

                ?>
</select>
</div>

<div class="Row">
<span class="Lable">Date of birth</span>
<input type="text" name="txt_PlaceOfBirth" value="<?=$s_PlaceOfBirth?>" class="TextBox" placeholder="Place of birth" />
<span>,&nbsp;</span>
<input type="text" name="txt_DateOfBirth" value="<?=$s_DateOfBirth?>" class="TextBox" placeholder="Date of birth [yyyy-mm-dd]" />
</div>

<div class="Row">
<span class="Lable">Phone number</span>
<input type="text" name="txt_PhoneNumber" value="<?=$s_PhoneNumber?>" class="TextBox" />
</div>

<div class="Row">
<span class="Lable">Email</span>
<input type="text" name="txt_Email" value="<?=$s_Email?>" class="TextBox" />
</div>

<div class="Row">
<span class="Lable">Address</span>
<textarea name="txt_Address" class="TextBox_Large"><?=$s_Address?></textarea>
</div>


<div class="Row">
<span class="Lable">Image</span>
<input type="file" name="file_Data" class="TextBox" />
</div>

<div class="Row">
<input type="submit" name="btn_Submit" value="Submit" class="ButtonSubmit" />
<span>&nbsp;</span>
<input type="reset" value="Reset" class="ButtonReset" />
<span>&nbsp;</span>
<input type="button" value="Back" class="ButtonBack" onclick="window.history.back();" />
</div>
</form>
</div>


<?php
ob_flush();
?>
