<?php
ob_start();

//=================
// Class Management
//=================

include_once'../App Code/Class_Book.php';
$c_Book = new Class_Book();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//=================
// Variable
//=================

$s_ErrorMessage = "";

$s_BookID = $c_Book->string_Set_BookID();

$s_BookName = "";
if(isset($_POST["txt_BookName"]) && strlen(trim($_POST["txt_BookName"])) != 0)
	$s_BookName = trim($_POST["txt_BookName"]);

$s_BookType = "";
if(isset($_POST["cb_BookType"]) && strlen(trim($_POST["cb_BookType"])) != 0)
	$s_BookType = trim($_POST["cb_BookType"]);
if(strlen($s_BookType) == 0 && isset($_POST["txt_BookType"]))
	$s_BookType = trim($_POST["txt_BookType"]);

$s_Loaned = "false";//string not bool
$b_Loaned = "";
if(isset($_POST["chk_Loaned"]))
{
	$s_Loaned = "true";
	$b_Loaned = "checked = 'true'";
}

$s_FinesPerDay = "0";
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

$s_NumberOfGood = "0";
if(isset($_POST["txt_NumberOfGood"]) && strlen(trim($_POST["txt_NumberOfGood"])) != 0)
    $s_NumberOfGood = trim($_POST["txt_NumberOfGood"]);

$s_NumberOfBroken = "0";
if(isset($_POST["txt_NumberOfBroken"]) && strlen(trim($_POST["txt_NumberOfBroken"])) != 0)
    $s_NumberOfBroken = trim($_POST["txt_NumberOfBroken"]);

$s_NumberOfMissing = "0";
if(isset($_POST["txt_NumberOfMissing"]) && strlen(trim($_POST["txt_NumberOfMissing"])) != 0)
    $s_NumberOfMissing = trim($_POST["txt_NumberOfMissing"]);

//==============
// Event Submit
//==============

$b_Validation = true ;
if (isset($_POST["btn_Submit"])) 
{
	//========
	// Validasi book name, publisher , syopsis, donation
	//========

	if (strlen($s_BookName) == 0) {
		
		$s_ErrorMessage .= "Please field Book Name <br/>";
		$b_Validation = false;
	}
	if (strlen($s_BookType) == 0) {
		
		$s_ErrorMessage .= "Select one book type , if that no option please type in the textbox<br/>";
		$b_Validation = false;
	}
	if (strlen($s_Publisher) == 0) {
		
		$s_ErrorMessage .= "Select one publisher, that no option please type in the textbox<br/>";
		$b_Validation = false;
	}
	if (strlen($s_Synopsis) == 0) {
		
		$s_ErrorMessage .= "Please field synopsis <br/>";
		$b_Validation = false; 
	}
	if (strlen($s_Donation) == 0) {
		
		$s_ErrorMessage .= "Select one Donation <br/>";
		$b_Validation = false;
	}

	//====== Fines Per Day ========//

	if (strlen($s_FinesPerDay) == 0) {
		
		$s_ErrorMessage .= "Please field Fines Per Day<br/>";
		$b_Validation = false;
	}
	if (strlen($s_FinesPerDay) !=0 && !$c_Variable->bool_Validation_Numeric($s_FinesPerDay)) {
		
		$s_ErrorMessage .= "Fines per day invalid <br/>";
		$b_Validation = false;
	}
	if (strlen($s_FinesPerDay) != 0 && $c_Variable->bool_Validation_Numeric($s_FinesPerDay) && $s_FinesPerDay < 0) {
		
		$s_ErrorMessage .= "Fines per day can not minus<br/>";
		$b_Validation = false;
	}
	if ($s_Loaned === "true" && $s_FinesPerDay === "0") {
		
		$s_ErrorMessage .= "Fines Per Day mus have<br/>";
		$b_Validation = false;
	}

	//======== COME DATE ===========//

	if (strlen($s_ComeDate) == 0) {
		
		$s_ErrorMessage .= "Please field Come Date<br/>";
		$b_Validation = false;
	}
	if (strlen($s_ComeDate) != 0 && $c_Variable->bool_Check_ValidateDate($s_ComeDate. " 00:00:00 ")) {
		
		$s_ErrorMessage .= "Come Date invalid <br/>";
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

    //========= VALIDASI IMAGE ==========//

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

    	if (!in_array($_FILES['file_Data']['type'], $acceptable) && (!empty($_FILES['file_Data']['type']))) {
    		
    		$s_ErrorMessage .= "the file for image is inncorect . Please use only gif,png,or jpg!<br/>";
    		$b_Validation = false;
    	}
    	//memeriksa size
    	$d_Size = $_FILES['file_Data']['tmp_name'];
    	$d_Size = doubleval($d_Size);

    	if ($d_Size > (40*1024*1024)) {
    		$s_ErrorMessage .= "Your file more 40mb, can not allowed <br/>";
    		$b_Validation =false;
    	}
    }

    ///=========== Validasi True ==================//

    if ($b_Validation) {
    	
    	$b_Check = $c_Book->bool_Insert_BookData($s_BookID,$s_BookName,$s_BookType,$s_FinesPerDay,$s_Loaned, $s_ComeDate, $s_Writer, $s_Publisher, $s_NumberOfPage, $s_Synopsis, $s_Donation, $s_Price, $s_NumberOfGood, $s_NumberOfBroken, $s_NumberOfMissing);
    	if ($b_Check) {
    		if (is_uploaded_file($_FILES['file_Data']['tmp_name'])) {
    			$s_Image = "Images/Book/".$s_BookID.".".pathinfo($_FILES['file_Data']['name'],PATHINFO_EXTENSION);
    			$fileTmpLoc = $_FILES['file_Data']['tmp_name'];
    			$pathAndName = "../".$s_Image;//naik satu folder
    			$moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
    		}
    		$c_Book->bool_Insert_BookStorage($s_BookID,"1","Office Check","Table officer","0");
    		/*
             * by default, akan tersimpan pada table Book Storage
             * dengan data yang sudah ditetapkan
             */

    		echo $c_Variable->string_Set_RedirectPage("bookprofile.php?id=$s_BookID");
    	}
    	else
    		$s_ErrorMessage .= "Can not insert data";
    }
}
?>



<div class="container" style="margin-left: 18%;">
    <div class="col-xs-8 col-sm-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 style="text-align: center;">Form Manage Book</h2>
            </div>
            <div class="panel-body">
                <form class="form-vertikal" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="usr">Book Name</label>
                        <input type="text" name="txt_BookName" class="form-control" value="<?=$s_BookName?>" style="width: 50%;">
                    </div>
                    <div class="form-group">
                        <label for="checkbox">Book Type</label>
                        <select name="cb_BookType" class="form-control" style="width: 50%;">
                            <option value="" >- Option -</option>
                            <?php

                                            $array_AllID = $c_Book->array_Get_AllBookType_FromBookData();

                                            for($var = 0; $var < count($array_AllID); $var++)
                                            {
                                                $s_ValueID = $array_AllID[$var];

                                                $s_Selected = "";
                                                if($s_ValueID === $s_BookType)
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
                        <input type="text" name="txt_BookType" value="<?=$s_BookType?>" placeholder="New Book Type" class="form-control" style="width: 50%;"/>
                        <br/>
                        <span>If new typing, please select - option - for add new</span>
                    </div>
                    <div class="form-group">
                        <label for="checkbox">Loaned</label>
                        <input type="checkbox" name="chk_Loaned" class="checkbox" <?=$b_Loaned?>>
                    </div>
                    <div class="form-group">
                        <label for="usr">Fines Per Day</label>
                        <input type="text" name="txt_FinesPerDay" class="form-control" value="<?=$s_FinesPerDay?>" style="width: 50%;" placeholder="Money format [numeric]">
                    </div>
                    <div class="form-group">
                        <label for="usr">Come Date</label>
                        <input type="text" name="txt_ComeDate" value="<?=$s_ComeDate?>" class="form-control" placeholder="[yyyy-mm-dd]" style="width: 50%;"/>
                        </div>

                    <div class="form-group">
                        <label for="usr">Writer</label>
                        <input type="text" name="txt_Writer" value="<?=$s_Writer?>" class="form-control" style="width: 50%;"/>
                    </div>
                    <div class="form-group">
                        <label for="usr">Publisher</label>
                        <select name="cb_Publisher" class="checkbox">
                        <option value="" >- Option -</option>
                        <?php

                                        $array_AllID = $c_Book->array_Get_Publisher_FromBookData();

                                        for($var = 0; $var < count($array_AllID); $var++)
                                        {
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
                            <input type="text" name="txt_Publisher" value="<?=$s_Publisher?>" placeholder="New Publisher" class="form-control" style="width: 50%;" />
                            <br/>
                            <span>If new typing, please select - option - for add new</span>
                    </div>
                    <div class="form-group">
                        <label for="usr">Number Of Page</label>
                        <input type="text" name="txt_NumberOfPage" value="<?=$s_NumberOfPage?>" class="form-control" style="width: 50%;" />
                    </div>
                    <div class="form-group">
                        <label for="usr">Synopsis</label>
                        <textarea name="txt_Synopsis" class="form-control" id="comment" style="width: 50%;"><?=$s_Synopsis?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="usr">Donation</label><br>
                        <?php

                                    $array_AllID = array("<b>true</b>","<b>false</b>");

                                    for($var = 0; $var < count($array_AllID); $var++)
                                    {
                                        $s_ValueID = $array_AllID[$var];

                                        $s_Selected = "";
                                        if($s_ValueID === $s_Donation)
                                        {
                                            $s_Selected = "checked";
                                        }

                                        ?>
                        <input type="radio" name="rd_Donation" value="<?=$s_ValueID?>" class="checked" <?=$s_Selected?> /><?=$s_ValueID?>&nbsp;&nbsp;
                        <?php
                                    }  
                                ?>
                    </div>
                    <div class="form-group">
                        <label for="usr">Price</label>
                        <input type="text" name="txt_Price" value="<?=$s_Price?>" class="form-control" placeholder="Money format [numeric]" style="width: 50%;"/>
                    </div>
                    <div class="form-group">
                        <label for="usr">Image</label>
                        <input type="file" name="file_Data" class="form-control" style="padding-bottom:6%; width: 45%;" />
                    </div>
                    <div class="form-group">
                    <label for="usr">Number Of</label>
                        <span>Good&nbsp;</span><input type="text" name="txt_NumberOfGood" value="<?=$s_NumberOfGood?>" class="form-control" placeholder="[numeric]" style="width: 20%;"/>
                        <span>, Broken&nbsp;</span><input type="text" name="txt_NumberOfBroken" value="<?=$s_NumberOfBroken?>" class="form-control" placeholder="[numeric]" style="width: 20%;"/>
                        <span>, Missing&nbsp;</span><input type="text" name="txt_NumberOfMissing" value="<?=$s_NumberOfMissing?>" class="form-control" placeholder="[numeric]"  style="width: 20%;"/>
                    </div>

                    <div class="form-group" style="padding-top: 15px;">
                        <input type="submit" name="btn_Submit" class="btn btn-default" value="Submit"/>
                        <span>&nbsp;</span>
                        <input type="reset" value="Reset" class="btn btn-danger" name="">
                        <span>&nbsp;</span>
                        <input type="button" value="Back" class="btn btn-primary" onclick="window.history.back();" name="">
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    span
    {
        color: #000;
        font-weight: bold;
    }
</style>

<?php
ob_flush();
?>