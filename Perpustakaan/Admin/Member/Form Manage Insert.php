<?php
ob_start();

//----
// Class management
//----

include_once'../App Code/Class_Member.php';
$c_Member = new Class_Member();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();


//-------
// Variable
//-------

$s_ErrorMessage = "";

$s_MemberID = $c_Member->string_Set_MemberID();

$s_FullName = "";
if(isset($_POST["txt_FullName"]) && strlen(trim($_POST["txt_FullName"])) !=0)
	$s_FullName = trim($_POST["txt_FullName"]);

$s_Gender = "";
if(isset($_POST["rd_Gender"]) && strlen(trim($_POST["rd_Gender"])) !=0)
	$s_Gender = trim($_POST["rd_Gender"]);

$s_Religion = "";
if(isset($_POST["cb_Religion"]) && strlen(trim($_POST["cb_Religion"])) !=0)
	$s_Religion = trim($_POST["cb_Religion"]);

$s_PlaceOfBirth = "";
if(isset($_POST["txt_PlaceOfBirth"]) && strlen(trim($_POST["txt_PlaceOfBirth"])) !=0)
	$s_PlaceOfBirth = trim($_POST["txt_PlaceOfBirth"]);

$s_DateOfBirth = "";
if(isset($_POST["txt_DateOfBirth"]) && strlen(trim($_POST["txt_DateOfBirth"])) !=0)
	$s_DateOfBirth = trim($_POST["txt_DateOfBirth"]);

$s_PhoneNumber = "";
if(isset($_POST["txt_PhoneNumber"]) && strlen(trim($_POST["txt_PhoneNumber"])) !=0)
	$s_PhoneNumber = trim($_POST["txt_PhoneNumber"]);

$s_Email = "";
if(isset($_POST["txt_Email"]) && strlen(trim($_POST["txt_Email"])) !=0)
	$s_Email = trim($_POST["txt_Email"]);

$s_Address = "";
if(isset($_POST["txt_Address"]) && strlen(trim($_POST["txt_Address"])) !=0)
	$s_Address = trim($_POST["txt_Address"]);

// event submit

$b_Validation = true;
if (isset($_POST["btn_Submit"])) 
{
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

    if(strlen($s_DateOfBirth) != 0 && $c_Variable->bool_Check_ValidateDate($s_DateOfBirth . " 00:00:00") && $c_Variable->double_Get_Age($s_DateOfBirth . " 00:00:00") < 10)
    {
        $s_ErrorMessage .= "Min age 10 year old<br/>";
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
     * Validasi true, My SQL Bridge
     */
    if($b_Validation)
    {
        $b_Check = $c_Member->bool_Insert_MemberData($s_MemberID, $s_FullName, $s_Gender, $s_Religion, $s_PlaceOfBirth, $s_DateOfBirth, $s_PhoneNumber, $s_Email, $s_Address);
        if($b_Check)
        {
            echo $c_Variable->string_Set_RedirectPage("memberprofile.php?id=$s_MemberID");
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
<span class="TitleMessage">Form Add Member</span>
</div>
<div class="Row">
<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
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