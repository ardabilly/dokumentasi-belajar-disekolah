<?php
ob_start();

//===
// Class Management
//===

include_once'../App Code/Class_News.php';
$c_News = new Class_News();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//=========
// Check
//=========

if (!isset($_GET["id"]) || (isset($_GET["id"]) && strlen(trim($_GET["id"])) == 0)) 
{
	echo $c_Variable->string_Set_RedirectPage("book.php");
}
if(isset($_GET["id"]) && strlen(trim($_GET["id"])) !=0 && !$c_News->bool_Check_NewsID(trim($_GET["id"])))
{
	echo $c_Variable->string_Set_MessageBox("This news data, not found. Can't continue update");
	echo $c_Variable->string_Set_RedirectPage("book.php");
}

//=======
// Variable
//=======

$s_ErrorMessage="";

$s_NewsID = $_GET["id"];

$s_NewsTitle = "";
if(isset($_POST["txt_NewsTitle"]) && strlen(trim($_POST["txt_NewsTitle"])) !=0)
	$s_NewsTitle = trim($_POST["txt_NewsTitle"]);

$s_NewsValue = "";
if(isset($_POST["txt_NewsValue"]) && strlen(trim($_POST["txt_NewsValue"])) !=0)
	$s_NewsValue = trim($_POST["txt_NewsValue"]);

$s_EmployeeID = $_COOKIE["cookie_AkunPerpus"];

/*
 * event submit
 */

$b_Validation = true;
if (isset($_POST["btn_Submit"])) {
	
	if(strlen($s_NewsTitle) == 0)
    {
        $s_ErrorMessage .= "Please field news title<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NewsValue) == 0)
    {
        $s_ErrorMessage .= "Please field news value<br/>";
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
        $b_Check = $c_News->bool_Update_NewsData($s_NewsID, $s_NewsTitle, $s_NewsValue, $s_EmployeeID);
        if($b_Check)
        {
            if(is_uploaded_file($_FILES["file_Data"]["tmp_name"]))
            {
                $c_News->bool_Delete_ImageNews($s_NewsID, "../");
                //naik satu folder

                $s_Image = "Images/News/".$s_NewsID.".". pathinfo($_FILES["file_Data"]["name"], PATHINFO_EXTENSION);

                $fileTmpLoc = $_FILES['file_Data']['tmp_name'];
                $pathAndName = "../" . $s_Image;//naik satu folder
                $moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
            }

            echo $c_Variable->string_Set_RedirectPage("newsread.php?id=$s_NewsID");
        }
        else
            $s_ErrorMessage = "Can not update this data";
    }
}

/*
 * data loaded page
 * data awal atau
 * data asli dari database
 */

if(!isset($_POST["btn_Submit"]))
{
    $array_DataNews = $c_News->array_Get_DataNews($s_NewsID);
    $s_NewsTitle = $array_DataNews[2];
    $s_NewsValue = $array_DataNews[3];
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
<span class="TitleMessage">Form Update News</span>
</div>
<div class="Row">
<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
</div>
<div class="Row">
<span class="Lable">Title</span>
<input type="text" name="txt_NewsTitle" value="<?=$s_NewsTitle?>" class="TextBox" />
</div>

<div class="Row">
<span class="Lable">News Value</span>
<textarea name="txt_NewsValue" class="TextBox_Large"><?=$s_NewsValue?></textarea>
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