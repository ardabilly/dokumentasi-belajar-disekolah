<?php
ob_start();

//---------
// Class Management
//---------

include_once'../App Code/Class_Member.php';
$c_Member = new Class_Member();

include_once'../App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();


//
// VARIABLE
// 

$s_Search = "";
if(isset($_GET["txt_Search"]) && strlen(trim($_GET["txt_Search"])) !=0)
	$s_Search = trim($_GET["txt_Search"]);

$array_List = $c_Member->array_Get_AllBorrowID($s_Search);
?>

<div class="InfoDataCount">Found <?=count($array_List)?> data</div>

<div class="Form" style="clear: none; float: left; background-color: transparent; padding: 0; margin-left: 10px;">
	<input type="button" class="ButtonInsert" onclick="window.location.href='memberborrowinsert.php'" value="Insert Data Borrow" name="">
</div>

<table class="DataTable">
	<tr class="tHead">
		<td>No</td>
		<td></td>
		<td>Name</td>
		<td>Borrow Date</td>
		<td>Return Date</td>
		<td>Servicer</td>
	</tr>
	<?php
    	for($var = 0; $var < count($array_List); $var++)
    	{
        	$s_BorrowID = $array_List[$var];
	        $array_DataBorrow = $c_Member->array_Get_DataBorrow($s_BorrowID);

	        $s_MemberName = $c_Member->array_Get_DataMember($array_DataBorrow[1])[1];
	        $s_ServicerName = $c_Employee->array_Get_DataEmployee($array_DataBorrow[2])[1];

        ?>
	<tr class="tBody">
		<td class="c_Center"><?=$var + 1?></td>
		<td class="c_Center"><a href="memberborrowdetail.php?id=<?=$s_BorrowID?>">view</a></td>
		<td class="c_Left"><?=$s_MemberName?></td>
		<td class="c_Left"><?=date("l, F d, Y", strtotime($array_DataBorrow[3]))?></td>
		<td class="c_Left"><?=date("l, F d, Y", strtotime($array_DataBorrow[4]))?></td>
		<td class="c_Left"><?=$s_ServicerName?></td>
	</tr>
	<?php
    	}
    	?>
</table>

<style type="text/css">
	.InfoDataCount
	{
		clear: both; float: left;
   		font-size: 20px; 
	    color:#ffffff;

	    margin-bottom: 10px;
	}
</style>
<?php ob_flush(); ?>