<?php
ob_start();

//======
//Class Management
//======

include_once'../App Code/Class_Book.php';
$c_Book = new Class_Book();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//========
//Check
//=======

if (!isset($_GET["id"]) || (isset($_GET["id"]) && strlen(trim($_GET["id"])) == 0)) 
{
		echo $c_Variable->string_Set_RedirectPage("book.php");
}
if (isset($_GET["id"]) && strlen(trim($_GET["id"])) != 0 && !$c_Book->bool_Check_BookID(trim($_GET["id"]))) 
{
	echo $c_Variable->string_Set_MessageBox("This book data , not found . Can't continoue update");
	echo $c_Variable->string_Set_RedirectPage("book.php");
}

//======= Variable //========

$s_ErrorMessage = "";

$s_BookID = $_GET["id"];

$s_BookName = "";
if (isset($_POST["txt_BookName"]) && strlen(trim($_POST["txt_BookName"])) != 0)
	$s_BookName = trim($_POST["txt_BookName"]);

$s_BookType = "";
if(isset($_POST["cb_BookType"]) && strlen(trim($_POST["cb_BookType"])) != 0)
	$s_BookType = trim($_POST["cb_BookType"]);
if(isset($s_BookType) == 0 && isset($_POST["txt_BookType"]))
	$s_BookType = trim($_POST["txt_BookType"]);

$s_Loaned = "true";
$b_Loaned = "";
if (isset($_POST["chk_Loaned"])) {
	
	$s_Loaned = "true";
	$b_Loaned = " Checked='true'";
}

$s_FinesPerDay = "";
if(isset($_POST["txt_FinesPerDay"]) && strlen(trim($_POST["txt_FinesPerDay"])) != 0)
    $s_FinesPerDay = trim($_POST["txt_FinesPerDay"]);

$s_ComeDate = "";
if(isset($_POST["txt_ComeDate"]) && strlen(trim($_POST["txt_ComeDate"])) != 0)
    $s_ComeDate = trim($_POST["txt_ComeDate"]);

$s_Writer = "";
if(isset($_POST["txt_Writer"]) && strlen(trim($_POST["txt_Writer"])) != 0)
    $s_Writer = trim($_POST["txt_Writer"]);

$s_Publisher = "";
if(isset($_POST["cb_Publisher"]) && strlen(trim($_POST["cb_Publisher"])) != 0)
    $s_Publisher = trim($_POST["cb_Publisher"]);
if(strlen($s_Publisher) == 0 && isset($_POST["txt_Publisher"]))
    $s_Publisher = trim($_POST["txt_Publisher"]);

$s_NumberOfPage = "";
if(isset($_POST["txt_NumberOfPage"]) && strlen(trim($_POST["txt_NumberOfPage"])) != 0)
    $s_NumberOfPage = trim($_POST["txt_NumberOfPage"]);

$s_Synopsis = "";
if(isset($_POST["txt_Synopsis"]) && strlen(trim($_POST["txt_Synopsis"])) != 0)
    $s_Synopsis = trim($_POST["txt_Synopsis"]);

$s_Donation = "";
if(isset($_POST["rd_Donation"]) && strlen(trim($_POST["rd_Donation"])) != 0)
    $s_Donation = trim($_POST["rd_Donation"]);

$s_Price = "";
if(isset($_POST["txt_Price"]) && strlen(trim($_POST["txt_Price"])) != 0)
    $s_Price = trim($_POST["txt_Price"]);

$s_NumberOfGood = "";
if(isset($_POST["txt_NumberOfGood"]) && strlen(trim($_POST["txt_NumberOfGood"])) != 0)
    $s_NumberOfGood = trim($_POST["txt_NumberOfGood"]);

$s_NumberOfBroken = "";
if(isset($_POST["txt_NumberOfBroken"]) && strlen(trim($_POST["txt_NumberOfBroken"])) != 0)
    $s_NumberOfBroken = trim($_POST["txt_NumberOfBroken"]);

$s_NumberOfMissing = "";
if(isset($_POST["txt_NumberOfMissing"]) && strlen(trim($_POST["txt_NumberOfMissing"])) != 0)
    $s_NumberOfMissing = trim($_POST["txt_NumberOfMissing"]);

/////////// event submit //////////

$b_Validation = true;

if (isset($_POST["btn_Submit"])) 
{
	/*
     * Validasi book name, book type, publisher, synopsis, donation
     */

    if(strlen($s_BookName) == 0)
    {
        $s_ErrorMessage .= "Please field book name<br/>";
        $b_Validation = false;
    }

    if(strlen($s_BookType) == 0)
    {
        $s_ErrorMessage .= "Select one book type, if that no option please type in the textbox<br/>";
        $b_Validation = false;
    }

    if(strlen($s_Publisher) == 0)
    {
        $s_ErrorMessage .= "Select one publisher, if that no option please type in the textbox<br/>";
        $b_Validation = false;
    }

    if(strlen($s_Synopsis) == 0)
    {
        $s_ErrorMessage .= "Please field synopsis<br/>";
        $b_Validation = false;
    }

    if(strlen($s_Donation) == 0)
    {
        $s_ErrorMessage .= "Select one donation<br/>";
        $b_Validation = false;
    }

    /*
     * Fines per day
     */

    if(strlen($s_FinesPerDay) == 0)
    {
        $s_ErrorMessage .= "Please field fines per day<br/>";
        $b_Validation = false;
    }

    if(strlen($s_FinesPerDay) != 0 && !$c_Variable->bool_Validation_Numeric($s_FinesPerDay))
    {
        $s_ErrorMessage .= "Fines per day invalid<br/>";
        $b_Validation = false;
    }

    if(strlen($s_FinesPerDay) != 0 && $c_Variable->bool_Validation_Numeric($s_FinesPerDay) && $s_FinesPerDay < 0)
    {
        $s_ErrorMessage .= "Fines per day can not minus<br/>";
        $b_Validation = false;
    }

    if($s_Loaned === "true" && $s_FinesPerDay === "0")
    {
        $s_ErrorMessage .= "Fines per day must have<br/>";
        $b_Validation = false;
    }

    /*
     * Come date
     */

    if(strlen($s_ComeDate) == 0)
    {
        $s_ErrorMessage .= "Please field come date<br/>";
        $b_Validation = false;
    }
    if(strlen($s_ComeDate) != 0 && !$c_Variable->bool_Check_ValidateDate($s_ComeDate . " 00:00:00"))
    {
        $s_ErrorMessage .= "Come date invalid<br/>";
        $b_Validation = false;
    }

    /*
     * Number of page
     */

    if(strlen($s_NumberOfPage) == 0)
    {
        $s_ErrorMessage .= "Please field number of page<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NumberOfPage) != 0 && !$c_Variable->bool_Validation_Numeric($s_NumberOfPage))
    {
        $s_ErrorMessage .= "Number of page invalid<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NumberOfPage) != 0 && $c_Variable->bool_Validation_Numeric($s_NumberOfPage) && $s_NumberOfPage < 0)
    {
        $s_ErrorMessage .= "Number of page can not minus<br/>";
        $b_Validation = false;
    }

    /*
     * Price
     */

    if(strlen($s_Price) == 0)
    {
        $s_ErrorMessage .= "Please field Price<br/>";
        $b_Validation = false;
    }

    if(strlen($s_Price) != 0 && !$c_Variable->bool_Validation_Numeric($s_Price))
    {
        $s_ErrorMessage .= "Price invalid<br/>";
        $b_Validation = false;
    }

    if(strlen($s_Price) != 0 && $c_Variable->bool_Validation_Numeric($s_Price) && $s_Price < 0)
    {
        $s_ErrorMessage .= "Price can not minus<br/>";
        $b_Validation = false;
    }

    /*
     * Number of good, broken, missing
     */

    if(strlen($s_NumberOfGood) == 0)
    {
        $s_ErrorMessage .= "Number of good field Price<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NumberOfGood) != 0 && !$c_Variable->bool_Validation_Numeric($s_NumberOfGood))
    {
        $s_ErrorMessage .= "Number of good invalid<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NumberOfGood) != 0 && $c_Variable->bool_Validation_Numeric($s_NumberOfGood) && $s_NumberOfGood < 0)
    {
        $s_ErrorMessage .= "Number of good can not minus<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NumberOfBroken) == 0)
    {
        $s_ErrorMessage .= "Number of Broken field Price<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NumberOfBroken) != 0 && !$c_Variable->bool_Validation_Numeric($s_NumberOfBroken))
    {
        $s_ErrorMessage .= "Number of Broken invalid<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NumberOfBroken) != 0 && $c_Variable->bool_Validation_Numeric($s_NumberOfBroken) && $s_NumberOfBroken < 0)
    {
        $s_ErrorMessage .= "Number of Broken can not minus<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NumberOfMissing) == 0)
    {
        $s_ErrorMessage .= "Number of Missing field Price<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NumberOfMissing) != 0 && !$c_Variable->bool_Validation_Numeric($s_NumberOfMissing))
    {
        $s_ErrorMessage .= "Number of Missing invalid<br/>";
        $b_Validation = false;
    }

    if(strlen($s_NumberOfMissing) != 0 && $c_Variable->bool_Validation_Numeric($s_NumberOfMissing) && $s_NumberOfMissing < 0)
    {
        $s_ErrorMessage .= "Number of Missing can not minus<br/>";
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
        $b_Check = $c_Book->bool_Update_BookData($s_BookID, $s_BookName, $s_BookType, $s_FinesPerDay, $s_Loaned, $s_ComeDate, $s_Writer, $s_Publisher, $s_NumberOfPage, $s_Synopsis, $s_Donation, $s_Price, $s_NumberOfGood, $s_NumberOfBroken, $s_NumberOfMissing);
        if($b_Check)
        {
            if(is_uploaded_file($_FILES["file_Data"]["tmp_name"]))
            {
                $c_Book->bool_Delete_ImageBook($s_BookID, "../");
                //naik satu folder

                $s_Image = "Images/Book/".$s_BookID.".". pathinfo($_FILES["file_Data"]["name"], PATHINFO_EXTENSION);

                $fileTmpLoc = $_FILES['file_Data']['tmp_name'];
                $pathAndName = "../" . $s_Image;//naik satu folder
                $moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
            }

            echo $c_Variable->string_Set_RedirectPage("bookprofile.php?id=$s_BookID");
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

if (!isset($_POST["btn_Submit"])) {
	$array_DataBook = $c_Book->array_Get_AllDataBook($s_BookID);
	$s_BookName = $array_DataBook[1];
	$s_BookType = $array_DataBook[2];

	$s_Loaned = $array_DataBook[4];
	$b_Loaned = "";
	if ($s_Loaned == "true")
		$b_Loaned = "Checked='true'";

	$s_FinesPerDay = $array_DataBook[3];
    $s_ComeDate = explode(" ", $array_DataBook[5])[0];
    $s_Writer = $array_DataBook[6];
    $s_Publisher = $array_DataBook[7];
    $s_NumberOfPage = $array_DataBook[8];
    $s_Synopsis = $array_DataBook[9];
    $s_Donation = $array_DataBook[10];
    $s_Price = $array_DataBook[11];

    $s_NumberOfGood = $array_DataBook[12];
    $s_NumberOfBroken = $array_DataBook[13];
    $s_NumberOfMissing = $array_DataBook[14];

}

?>

<div class="Form">
	<style type="text/css">
		.Form .Lable
		{
			width: 140px;
		}
	</style>
	<form action="" method="post" enctype="multipart/form-data" name="form-manage">
		<div class="Row">
			<span class="TitleMessage">Form Update Book</span>
		</div>
		<div class="Row">
			<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
		</div>
		<div class="Row">
			<span class="Lable">Book Name</span>
			<input type="text" name="txt_BookName" value="<?=$s_BookName?>" class="TextBox"/>
		</div>
		<div class="Row">
			<span class="Lable">Book Type</span>
			<select class="TextBox" name="cb_BookType">
				<option value="">--OPTION--</option>
				<?php
					$array_AllID = $c_Book->array_Get_AllBookType_FromBookData();

					for ($var=0; $var <count($array_AllID) ; $var++) 
					{ 
						$s_ValueID = $array_AllID[$var];

						$s_Selected = "";
						if ($s_ValueID === $s_BookType) {
							$s_Selected = "selected";
						}
				 ?>
				 <option value="<?=$s_ValueID?>" <?=$s_Selected?>><?=$s_ValueID?></option>
				 <?php

				 	}

				  ?>
			</select>
			<span>&nbsp;if that no option, please type here&nbsp;</span>
			<input type="text" name="txt_BookType" value="<?=$s_BookType?>" placeholder="New Book Type"/>
			<br/>
			<span>if new typing, please select - option - for add new </span>
		</div>
		<div class="Row">
			<span class="Lable">Loaned</span>
			<input type="checkbox" class="CheckBox" name="chk_Loaned" <!-- --> />
			<span class="">Borrow</span>
		</div>
		<div class="Row">
			<span class="Lable">Fines Per Day</span>
			<input type="text" name="txt_FinesPerDay" value="<?=$s_FinesPerDay?>" class="TextBox" placeholder="Money format[numeric]"/>
		</div>
		<div class="Row">
			<span class="Lable">Come Date</span>
			<input type="text" name="txt_ComeDate" value="<?=$s_ComeDate?>" class="TextBox" placeholder="[yyyy-mm-dd]"/>
		</div>
		<div class="Row">
			<span class="Lable">Writer</span>
			<input type="text" name="txt_Writer" value="<?=$s_Writer?>" class="TextBox">
		</div>
		<div class="Row">
			<span class="Lable">Publisher</span>
			<Select name="cb_Publisher" class="TextBox">
				<option value="">-- Option --</option>
				<?php
					$array_AllID = $c_Book->array_Get_Publisher_FromBookData();

					for ($var=0; $var <count($array_AllID) ; $var++) { 
						$s_ValueID = $array_AllID[$var];

                    $s_Selected = "";
                    if($s_ValueID === $s_Publisher)
                    {
                        $s_Selected = "selected";
                    }

                    ?>
					<option value="<?=$s_ValueID?>" <?=$s_Selected?>><?=$s_ValueID?></option>
					<?php
                }

                ?>
			</select>
			<span>&nbsp;If that no option, please type here&nbsp;</span>
			<input type="text" name="txt_Publisher" value="<?=$s_Publisher?>" placeholder="New Publisher" class="TextBox" />
			<br/>
			<span>If new typing, please select - option - for add new</span>
		</div>
		<div class="Row">
			<span class="Lable">Number of page</span>
			<input type="text" name="txt_NumberOfPage" value="<?=$s_NumberOfPage?>" class="TextBox"/>
		</div>
		<div class="Row">
			<span class="Lable">Synopsis</span>
			<textarea class="TextBox_Large" name="txt_Synopsis" ><?=$s_Synopsis?></textarea>
		</div>
		<div class="Row">
			<span class="Lable">Donation</span>
		<?php

            $array_AllID = array("true","false");
            for($var = 0; $var < count($array_AllID); $var++)
            {
                $s_ValueID = $array_AllID[$var];

                $s_Selected = "";
                if($s_ValueID === $s_Donation)
                {
                    $s_Selected = "checked";
                }

                ?>
		<input type="radio" name="rd_Donation" value="<?=$s_ValueID?>" <?=$s_Selected?> /><?=$s_ValueID?>&nbsp;&nbsp;
		<?php
            }
        
         	?>

		</div>
		<div class="Row">
			<span class="Lable">Price</span>
			<input type="text" name="txt_Price" value="<?=$s_Price?>" class="TextBox" placeholder="Money format[numeric]"/>
		</div>
		<div class="Row">
			<span class="Lable">Image</span>
			<input type="file" name="file_Data" class="TextBox"/>
		</div>
		<div class="Row">
			<span class="Lable">Number of</span>
			<span>Good&nbsp;</span><input type="text" name="txt_NumberOfGood" value="<?=$s_NumberOfPage?>" class="TextBox" placeholder="[numeric]"/>
			<span>, Broken&nbsp;</span><input type="text" name="txt_NumberOfBroken" value="<?=$s_NumberOfBroken?>" class="TextBox" placeholder="[numeric]" />
			<span>, Missing&nbsp;</span><input type="text" name="txt_NumberOfMissing" value="<?=$s_NumberOfMissing?>" class="TextBox" placeholder="[numeric]" />
		</div>
		<div class="Row">
			<input type="submit" name="btn_Submit" value="Submit" class="ButtonSubmit"/>
			<span>&nbsp;&nbsp;</span>
			<input type="reset" name="" value="Reset" class="ButtonReset">
			<span>&nbsp;&nbsp;</span>
			<input type="button" name="" value="Back" class="ButtonBack" onclick="window.history.back();">
		</div>
	</form>
</div>

<?php
ob_flush();
?>