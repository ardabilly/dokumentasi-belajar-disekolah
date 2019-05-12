<?php
ob_start();

// class manage

include_once'../App Code/Class_Member.php';
$c_Member = new Class_Member();

include_once'../App Code/Class_Book.php';
$c_Book = new Class_Book();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

// Variable 

$s_ErrorMessage = "";

$s_BorrowID = $_GET["id"];

$s_BookID = "";
if(isset($_POST["txt_BookID"]) && strlen(trim($_POST["txt_BookID"])) !=0)
	$s_BookID = trim($_POST["txt_BookID"]);
$s_Quantity = "";
if(isset($_POST["txt_Quantity"]) && strlen(trim($_POST["txt_Quantity"])) !=0)
	$s_Quantity = trim($_POST["txt_Quantity"]);

$array_DataBook = $c_Book->array_Get_AllDataBook($s_BookID);
$array_DataBorrow = $c_Member->array_Get_DataBorrow($s_BorrowID);
$s_FinesPerDay = $array_DataBook[3];
$s_FinesPrice = $array_DataBook[11];
$s_QuantityData = $array_DataBook[12];
$s_Loaned = $array_DataBook[4];
$s_ReturnDate = $array_DataBorrow[4];

// event cancle 

if(isset($_GET["action"]) && $_GET["action"] === "Delete")
{
	$c_Member->bool_Delete_BorrowBookData($_GET["id"],$_GET["id2"]);
	echo $c_Variable->string_Set_RedirectPage("memberborrowbookinsert.php?id".$_GET["id"]);
}

// event submit

$b_Validation = true;
if(isset($_POST["btn_Submit"]))
{
	if (strlen($s_BookID) == 0) 
	{
		$s_ErrorMessage .= "Please field book id <br/>";
		$b_Validation = false;
	}
	else if(!$c_Book->bool_Check_BookID($s_BookID))
	{
		$s_ErrorMessage .= "Book id invalid<br/>";
		$b_Validation = false;
	}

	// Quantity
	if (strlen($s_Quantity) == 0) 
	{
		$s_ErrorMessage .= "Please field Quantity<br/>";
		$b_Validation = false;
	}
	if (strlen($s_Quantity) != 0 && !$c_Variable->bool_Validation_Numeric($s_Quantity)) 
	{
		$s_ErrorMessage .="Quantity invalid<br/>";
		$b_Validation = false;
	}
	if (strlen($s_Quantity) != 0 && $c_Variable->bool_Validation_Numeric($s_Quantity) && $s_Quantity < 1) 
	{
		$s_ErrorMessage .= "Number page can't to borrowed<br/>";
		$b_Validation =false;
	}

	// :Loaned

	if ($array_DataBook[4] !== "ture") 
	{
		$s_ErrorMessage .= "this book can't to borrowed <br>/";
		$b_Validation = false;
	}
	// Quantity compare 
	if(intval($s_Quantity) > intval($s_QuantityData))
	{
		$s_ErrorMessage .="Count of book no enough<br/>";
		$b_Validation = false;
	}
	     // * Validasi true, My SQL Bridge
	if($b_Validation)
	{
		$b_Check = $c_Member->bool_Insert_BorrowBookData($s_BorrowID,$s_BookID,$s_Quantity,$s_FinesPerDay,$s_FinesPrice,$s_ReturnDate);
		if ($b_Check) 
		{
			$c_Book->bool_Manage_BookLoaned($s_BookID, $s_Quantity);
			echo $c_Variable->string_Set_RedirectPage("memberborrowbookinsert.php?id=$s_BorrowID");
		}
		else
			$s_ErrorMessage = "Can not insert this data";
	}
}

?>
<div class="GalleryBook">
	<?php
	$array_List = $c_Member->array_Get_BorrowBookData($s_BorrowID);
	for ($var=0; $var <count($array_List) ; $var++) 
	{ 
		$s_BookID1 = $array_List[$var][0];
		$s_BookName1 = $array_List[$var][1];
		$s_Quantity1 = $array_List[$var][2];
	?>
	<div class="Data">
		<?=$s_Quantity1?> - <?=$s_BookName1?>,
		<a href="memberborrowbookinsert.php?id=<?=$s_BorrowID?>&id2=<?=$s_BookID1?>&action=Cancel">Cancel</a>
	</div>
	<?php
		if(isset($_GET["action"]) && $_GET["action"] === "Cancel" && $s_BookID1 === $_GET["id2"])
		{
			$c_Book->bool_Manage_BookReturned($s_BookID1,$s_Quantity1, "NumberOfGood");
			$c_Member->bool_Delete_BorrowBookData($_GET["id"],$_GET["id2"]);
			echo $c_Variable->string_Set_RedirectPage("memberborrowbookinsert.php?id=".$_GET["id"]);
		}
	}

	?>
</div>
<style type="text/css">
	.GalleryBook
	{
		clear: both; float: left;
		width: 100%;

		margin-top: 20px;
		margin-bottom: 20px;
	}
	.GalleryBook .Data
	{
		float: left;
		margin-right: 10px;
		margin-bottom: 10px;

		color: #ffffff;
		border-bottom: 2px solid #0073bc;
	}
	.GalleryBook .Data a
	{
		text-decoration: none;
		color: #0073bc;
	}
	.GalleryBook .Data a:hover
	{
		color: red;
	}
</style>

<div class="Form">
	<style type="text/css">
		.Form .Lable
		{
			width: 140px;
		}
	</style>
	<form method="post" enctype="multipart/form-data" class="form-Manage">
		<div class="Row">
			<span class="TitleMessage"> Form Inserted Book </span>
		</div>
		<div class="Row">
			<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
		</div>

		<div class="Row">
			<span class="Lable">BookID</span>
			<input type="text" name="txt_BookID" class="TextBox" value="<?=$s_BookID?>">
		</div>

		<div class="Row">
			<span class="Lable">Quantity</span>
			<input type="text" placeholder="numeric" name="txt_Quantity" class="TextBox" value="<?=$s_Quantity?>">
		</div>

		<div class="Row">
			<input type="submit" name="btn_Submit" value="Submit" class="ButtonSubmit"/>
			<span>&nbsp;</span>
			<input type="reset" name="" class="ButtonReset">
			<span>&nbsp;</span>
			<input type="button" value="Done" class="ButtonInsert" onclick="window.locarion.href='memberborrowdetail.php?id=<?=$s_BorrowID?>';" name="">
		</div>
	</form>
</div>

<?php
ob_flush();
?>