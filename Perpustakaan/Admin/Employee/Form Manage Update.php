<?php 
ob_start();

// CLASS MANAGE

include_once'../App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

// CHECK

if (!isset($_GET["id"]) || (isset($_GET["id"]) && strlen(trim($_GET["id"])) == 0 )) 
{
	echo $c_Variable->string_Set_RedirectPage("employee.php");
}
if(isset($_GET["id"]) && strlen(trim($_GET["id"])) != 0 && !$c_Employee->bool_Check_EmployeeID(trim($_GET["id"])))
{
	echo $c_Variable->string_Set_MessageBox("This employee data not found. Can't continue update");
	echo $c_Variable->string_Set_RedirectPage("employee.php");
}

// VARIABLE

$s_ErrorMessage="";
$s_EmployeeID = $_GET["id"];

$s_EmployeeID_New = "";
if (isset($_POST["txt_EmployeeID"]) && strlen(trim($_POST["txt_EmployeeID"])) != 0 )
{
	$s_EmployeeID_New = trim($_POST["txt_EmployeeID"]);
}
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


// EVENT SUBMIT

$b_Validation=true;

if (isset($_POST["btn_Submit"]))
{
	// Validasi EmployeeID
	if (strlen($s_EmployeeID_New) == 0) {
		$s_ErrorMessage .= "Please field employeeID <br>";
		$b_Validation = false;
	}
	elseif (!$c_Employee->bool_Check_EmployeeID1($s_EmployeeID,$s_EmployeeID_New)) {
		$s_ErrorMessage .= "This EmployeeID was exist<br>";
		$b_Validation = false;
	}

	// Validasi FullName

	if (strlen($s_FullName) == 0) {
		
		$s_ErrorMessage .= "Please field FullName <br>";
		$b_Validation = false;
	}
	elseif (!$c_Variable->bool_Validation_HumanName($s_FullName)) {
		
		$s_ErrorMessage .= "FullName invalid <br>";
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

    // Validasi Image

    if (is_uploaded_file($_FILES['file_Data']['tmp_name'])) 
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

    	if (!in_array($_FILES['file_Data']['type'], $acceptable) && (!empty($_FILES['file_Data']['type']))) 
    	{
    		$s_ErrorMessage .= "The file for image is inncorect , Please use only gif,png or jpg! <br>";
    		$b_Validation = false;
    	}

    	// memeriksa size image
    	$d_Size = $_FILES["file_Data"]["tmp_name"];
    	$d_Size = doubleval($d_Size);

    	if ($d_Size > (40*1024*1024)) 
    	{
    		$s_ErrorMessage .= "Your file more 40mb, can not allowed<br>";
    		$b_Validation = false;
    	}
    }

    	/*
     * Validasi true, My SQL Bridge
     */
    if($b_Validation)
    {
        $b_Check = $c_Employee->bool_Update_EmployeeData($s_EmployeeID, $s_EmployeeID_New, $s_FullName, $s_Gender, $s_Religion, $s_PlaceOfBirth, $s_DateOfBirth, $s_PhoneNumber, $s_Email, $s_Address);
        if($b_Check)
        {
            if(is_uploaded_file($_FILES["file_Data"]["tmp_name"]))
            {
                $c_Employee->bool_Delete_ImageEmployee($s_EmployeeID, "../");

                $s_Image = "Images/User/".$s_EmployeeID_New.".". pathinfo($_FILES["file_Data"]["name"], PATHINFO_EXTENSION);

                $fileTmpLoc = $_FILES['file_Data']['tmp_name'];
                $pathAndName = "../" . $s_Image;//naik satu folder
                $moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
            }
            if(!is_uploaded_file($_FILES["file_Data"]["tmp_name"]))
            {
                /*
                 * jika tidak mengupload gambar
                 * tetapi akan berubah nama nya
                 * jika employee id nya diganti
                 */
                $s_Image = $c_Employee->string_Set_ImageEmployee($s_EmployeeID, "../");
                $s_ImageName = explode("/", $s_Image)[count(explode("/", $s_Image)) - 1];
                $s_Extension = explode(".", $s_ImageName)[count(explode(".", $s_ImageName)) - 1];
                $s_ImageNew = str_replace($s_ImageName, $s_EmployeeID_New, $s_Image) . "." . $s_Extension;

                rename($s_Image, $s_ImageNew);
            }


            echo $c_Variable->string_Set_RedirectPage("employeeprofile.php?id=$s_EmployeeID_New");
        }
        else
            $s_ErrorMessage = "Can not update this data";
    }
}

if(!isset($_POST["btn_Submit"]))
{
    $array_DataEmployee = $c_Employee->array_Get_DataEmployee($_GET["id"]);
    $s_EmployeeID_New = $s_EmployeeID;

    $s_FullName = $array_DataEmployee[1];
    $s_Gender = $array_DataEmployee[2];
    $s_Religion = $array_DataEmployee[3];
    $s_PlaceOfBirth = $array_DataEmployee[4];
    $s_DateOfBirth = explode(" ", $array_DataEmployee[5])[0];
    $s_PhoneNumber = $array_DataEmployee[6];
    $s_Email = $array_DataEmployee[7];
    $s_Address = $array_DataEmployee[8];
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
<span class="TitleMessage">Form Edit Data Employee</span>
</div>
<div class="Row">
<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
</div>
<div class="Row">
<span class="Lable">Employee ID</span>
<input type="text" name="txt_EmployeeID" value="<?=$s_EmployeeID_New?>" class="TextBox" />
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