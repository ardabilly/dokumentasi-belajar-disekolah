<?php 
ob_start();

//======
//Class management
//======

include_once'../App Code/Class_Book.php';
$c_Book = new Class_Book();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

$s_Search ="";
if (isset($_GET["txt_Search"]) && strlen(trim($_GET["txt_Search"])) !=0) 
	$s_Search = trim($_GET["txt_Search"]);
/*
 * txt_Search diambil dari body top.php
 */
	$array_List = $c_Book->array_Get_AllBookID_ByName($s_Search);
 ?> 

 <div class="InfoDataCount">Found <?=count($array_List)?> data</div>
 <table class="DataTable">
 	<tr class="tHead">
 		<td>No</td>
 		<td>Name</td>
 		<td>Writer</td>
 		<td>Publisher</td>
 		<td>Numer Of Page</td>
 		<td>Price</td>
 		<td>Count</td>
 	</tr>
 	<?php
 		for ($var=0; $var <count($array_List) ; $var++) { 
 			
 			$s_BookID = $array_List[$var];
 			$array_Data = $c_Book->array_Get_AllDataBook($s_BookID);
 	?>
 	<tr class="tBody">
 		<td class="c_Center"><?=$var+1?></td>
 		<td class="c_Center"><a href="bookprofile.php?id=<?=$s_BookID?>">View</a></td>
 		<td class="c_left"><?=$array_Data[1]?></td>
 		<td class="c_left"><?=$array_Data[2]?></td>
 		<td class="c_left"><?=$array_Data[3]?></td>
 		<td class="c_left"><?=$array_Data[4]?></td>
 		<td class="c_left"><?=$array_Data[5]?></td>
 		<td class="c_left"><?=$array_Data[6]?></td>
 		<td class="c_left"><?=$array_Data[7]?></td>
 		<td class="c_left"><?=$array_Data[8]?></td>
 		<td class="c_left">Rp. <?=$array_Data[11]?>,-</td>
 		<td class="c_Center"><?=$array_Data[12] + $array_Data[13] + $array_Data[13]?></td>
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
 		color: #ffffff;

 		margin-bottom: 10px;
 	}
 </style>

 <?php
 ob_flush();
 ?>