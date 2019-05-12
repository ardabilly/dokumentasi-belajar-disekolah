<?php
ob_start();

//==========
//Class Management
//==========

include_once'../App Code/Class_Book.php';
$c_Book = new Class_Book();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

// =========== VARIABLE ================//

$s_BookID = $_GET["id"];
$array_DataBook = $c_Book->array_Get_AllDataBook($s_BookID);
$array_DataBookStorage = $c_Book->array_Get_AllDataBookStorage($s_BookID);

?>
<div class="BookData">
	<div class="NameDetail">
		<span class="Name"><?=$array_DataBook[1]?></span>
		<span class="DateCome"> <?=Date("l, F d, Y", strtotime($array_DataBook[5]))?> </span>
		<span class="Writer">writer <?=$array_DataBook[6]?></span>
	</div>

	<img src="<?=$c_Book->string_Set_ImageBook($s_BookID,"../")?>" class="CoverImage" />
	<div class="DataDetail">
		<div class="Data">
			<span class="Lable">Book Type</span>
			<span><?=$array_DataBook[2]?></span>
		</div>
		<div class="Data">
			<span class="Lable"> Fines Per Day</span>
			<span>Rp. <?=$array_DataBook[3]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Loaned</span>
			<span><?=$array_DataBook[4]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Publisher</span>
			<span><?=$array_DataBook[7]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Number Of Page</span>
			<span><?=$array_DataBook[8]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Donation</span>
			<span><?=$array_DataBook[10]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Price</span>
			<span>Rp. <?=$array_DataBook[11]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Number Of</span>
			<span>----------------------</span>
		</div>
		<div class="Data">
			<span class="Lable">Good</span>
			<span><?=$array_DataBook[12]?> Book</span>
		</div>
		<div class="Data">
			<span class="Lable">Broken</span>
			<span><?=$array_DataBook[13]?> Book</span>
		</div>
		<div class="Data">
			<span class="Lable">Missing</span>
			<span><?=$array_DataBook[14]?> Book</span>
		</div>
		<div class="Data">
			<span class="Lable">Loaned</span>
			<span><?=$array_DataBook[15]?> Book</span>
		</div>
	</div>
	<div class="DataDetail" style="margin-left: 30px;">
		<div class="Data">
			<span class="Lable">Book Storage</span>
			<span></span>
		</div>
		<div class="Data">
			<span class="Lable">Floor</span>
			<span><?=$array_DataBookStorage[1]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Corridor</span>
			<span><?=$array_DataBookStorage[2]?></span>
		</div>
		<div class="Data">
			<span class="Lable"> Rack </span>
			<span><?=$array_DataBookStorage[3]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Level of rack</span>
			<span><?=$array_DataBookStorage[4]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Count of book</span>
			<span><?=$array_DataBook[12] + $array_DataBook[13] + $array_DataBook[14] + $array_DataBook[15]?></span>
		</div>
	</div>
	<p class="Synopsis">
		Synopsis
		<br/><br/>
		<?=$array_DataBook[9]?>
	</p>
</div>

<div class="Form" style="background-color: transparent; padding: 0; margin-top: 20px;">
	<input type="button" value="Gallery" class="ButtonInsert" onclick="window.location.href='book.php';" name="">
	<span>&nbsp;&nbsp;</span>
	<input type="button" value="Update Data" class="ButtonSubmit" onclick="window.location.href='bookupdate.php?id=<?=$s_BookID?>'">
	<span>&nbsp;&nbsp;</span>
	<input type="button" value="Edit Storage" class="ButtonSubmit" onclick="window.location.href='bookstorageupdate.php?id=<?=$s_BookID?>'">
	<span>&nbsp;&nbsp;</span>
	<a href="bookprofile.php?action=Delete&id=<?=$s_BookID?>" class="ButtonDelete" onclick="return confirm('Are you sure want to delete this data?');" style="text-decoration: none;">Delete</a>
</div>

<style type="text/css">
	.BookData
	{
		clear: both; float: left;
	}
	.BookData .NameDetail
	{
		clear: both; float: left;
		width: 100%;
		padding-left: 10px;
		border-left: 2px solid #0073bc;
		margin-bottom: 20px;
	}
	.BookData .NameDetail .Name
	{
		clear: both; float: left;
		width: 100%;

		font-size: 15px;
		color: #ffffff;
	}
	.BookData .NameDetail .DateCome
	{
		clear: both; float: left;
		font-size: 14px;
		color: #0073bc;
		margin-right: 5px;
	}
	.BookData .NameDetail .Writer
	{
		float: left;
		font-size: 14px;
		color: #ffffff;
	}
	.BookData .CoverImage
	{
		clear: both; float: left;
		width: 200px;
		height: 250px;

		background-color: #ffffff;
		padding: 10px;
		border:2px dotted #0025e3;
	}
	.BookData .DataDetail
	{
		float: left;
		margin-left: 10px;
	}
	.BookData .DataDetail .Data
	{
		clear: both; float: left;
		width: 100%;
		margin-bottom: 8px;
	}
	.BookData .DataDetail span
	{
		float: left;
		color: #ffffff;
		font-size: 16px;
	}
	.BookData .DataDetail .Data .Lable
	{
		width: 150px;
	}
	.BookData .Synopsis
	{
		clear: both; float: left;
		margin-top: 10px;

		font-size: 16px;
		text-align: justify;
		color: #ffffff;
	}
</style>
<?php
ob_flush();
?>