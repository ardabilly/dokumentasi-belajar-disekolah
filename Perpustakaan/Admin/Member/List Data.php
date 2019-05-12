<?php
ob_start();

///----
/// Class manage
///----

include_once'../App Code/Class_Member.php';
$c_Member = new Class_Member();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//----
// Variable
//----

$s_Search = "";
if(isset($_GET["txt_Search"]) && strlen(trim($_GET["txt_Search"])) !=0)
	$s_Search = trim($_GET["txt_Search"]);

$array_List = $c_Member->array_Get_AllMemberID($s_Search);
?>
<div class="InfoDataCount">Found <?=count($array_List)?> data</div>
<table class="DataTable">
	<tr class="tHead">
		<td>No</td>
		<td></td>
		<td>Member ID</td>
		<td>Name</td>
		<td>Gender</td>
	</tr>
	<?php
		for ($var=0; $var <count($array_List) ; $var++) 
		{
			$s_MemberID = $array_List[$var];
			$array_DataMember = $c_Member->array_Get_DataMember($s_MemberID);
	?>
	<tr class="tBody">
		<td class="c_Center"><?=$var + 1?></td>
		<td class="c_Center"><a href="memberprofile.php?id=<?=$s_MemberID?>"></a></td>
		<td class="c_Left"><?=$s_MemberID?></td>
		<td class="c_Left"><?=$array_DataMember[1]?></td>
		<td class="c_Left"><?=$array_DataMember[2]?></td>
	</tr>
	<?php } ?>
</table>

<style type="text/css">
	.InfoDataCount
	{
		clear: both; float: left;
		font-size: 20px;
		color: #ffffff;

		margin-bottom: 10px;
	}
	.DataTable
	{
		clear: both; float: left;
	}
</style>

<?php ob_flush(); ?>