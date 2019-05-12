<?php
ob_start();

//==
//class manage
//

include_once'App Code/Class_Comment.php';
$c_Comment = new Class_Comment();

include_once'App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//variable

$s_Search = "";
if(isset($_GET["txt_Search"]) && strlen(trim($_GET["txt_Search"])) !=0)
	$s_Search = trim($_GET["txt_Search"]);

$array_List = $c_Comment->array_Get_AllCommentID($s_Search);
?>
<div class="InfoDataCount">Found <?=count($array_List)?> data</div>

<div class="Form" style="clear: none; float: left; background-color: transparent; padding:0; margin-left: 10px;">
	<input type="button" value="Add Comment" class="btn btn-primary" onclick="window.location.href='commentinsert.php';" name=""/>
</div>

<div class="GalleryComment animated slideInLeft">
	<?php 
		for ($var=0; $var <count($array_List) ; $var++) 
		{ 
			
			$s_CommentID = $array_List[$var];
			$array_Data = $c_Comment->array_Get_DataComment($s_CommentID);

			$s_Name = $array_Data[1];
	        $s_CommentValue = $array_Data[2];
	        $s_CommentDate = $array_Data[3];
	        $s_CommentDate = date("l, F d, Y", strtotime($s_CommentDate));
	        $s_PhoneNumber = $array_Data[4];
	        $s_Email = $array_Data[5];

	    ?>

	    <div class="Data">
	    	<div class="Name"><?=$s_Name?></div>
	    	<div class="Date"><?=$s_CommentDate?></div>
	    	<p><?=$s_CommentValue?></p>
	    </div>
	    <?php } ?>
</div>

<style type="text/css">
	.InfoDataCount
	{
		clear: both; float: left;
		font-size: 20px;
		color: #ffffff;
		margin-bottom: 10px;
		margin-left: 15px;
	}
	.GalleryComment
	{
		clear: both; float: left;
		width: 94%;
		padding: 3px;

		background-color: #3a3a3a;
		color: #ffffff;

		margin-left: 15px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		border-radius:5px;
	}
	.GalleryComment .Data
	{
		clear: both; float: left;
		width: 100%;
		margin-bottom: 10px;
	}
	.GalleryComment .Name
	{
		float: left;
		font-size: 14px;
		margin-bottom: 8px;

		margin-right: 10px;
	}
	.GalleryComment .Date
	{
		float: left;
		font-size: 14px;
		color: #1adb00;
	}
	.GalleryComment p
	{
		clear: both; float: left;
		width: 98%;
		padding-left: 1%;
		font-size: 15px;

		border-left: 2px solid #1adb00;
	}
</style>
<?php
ob_flush();
?>
