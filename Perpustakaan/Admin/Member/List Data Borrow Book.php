<?php
ob_start();

//Class Manage

include_once'../App Code/Class_Member.php';
$c_Member = new Class_Member();

include_once'../App Code/Class_Book.php';
$c_Book = new Class_Book();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

// check

if(!isset($_GET["id"]) || (isset($_GET["id"]) && !$c_Member->bool_Check_BorrowID($_GET["id"])) )
{
	echo $c_Variable->string_Set_RedirectPage("memberborrow.php");
}

// variable

$s_BorrowID = $_GET["id"];
$array_DataBorrow = $c_Member->array_Get_DataBorrow($s_BorrowID);
$array_List = $c_Member->array_Get_BorrowBookData($s_BorrowID);

?>

<div class="Form" style="clear:none; float: left; background-color: transparent; padding: 0; margin-top: 10px;">
	<input type="button" value="Add Book" class="ButtonInsert" onclick="window.location.href='memberborrowbookinsert.php?id=<?=$s_BorrowID?>';" name="">
	<span>&nbsp;&nbsp;</span>
	<input type="button" value="Return Book" class="ButtonSubmit" onclick="window.location.href='memberborrowbookreturn.php?id=<?=$s_BorrowID?>';" name="">
</div>

<table class="DataTable" style="margin-top: 20px;">
	<tr class="tHead">
		<td>No</td>
		<td>BookName</td>
		<td>Qty</td>
		<td>Fines Per Day</td>
		<td>Fines Price</td>
		<td>Status</td>
		<td>Return Date</td>
		<td>Good Return</td>
		<td>Broken Return</td>
		<td>Missing Return</td>
		<td>Fines</td>
	</tr>
	<?php
	for ($var=0; $var <count($array_List) ; $var++) 
	{ 
	?>
	<tr class="tBody">
		<td class="c_Center"><?=$var+1?></td>
		<td class="c_Left"><?=$array_List[$var][1]?></td>
		<td class="c_Center"><?=$array_List[$var][2]?></td>
		<td class="c_Right"><?=$array_List[$var][3]?>,-</td>
		<td class="c_Right"><?=$array_List[$var][4]?>,-</td>
		<td class="c_Left"><?=$array_List[$var][5]?></td>
		<?php
			if($array_List[$var][5] !== "Borrow")
			{
				?>	
		<td class="c_Left"><?=date("F d, Y", strtotime($array_List[$var][6]))?></td>
				<?php
			}
			else
			{
				?>
		<td class="c_Left"></td>
				<?php
			}
		?>
		<td class="c_Center"><?=$array_List[$var][7]?></td>
		<td class="c_Center"><?=$array_List[$var][8]?></td>
		<td class="c_Center"><?=$array_List[$var][9]?></td>
		<?php
			if($array_List[$var][5] !== "Borrow")
			{
				$s_FinesPerBook = "0";

				$dt_ReturnDateTime = strtotime($array_List[$var][6]);
				$dt_ReturnDateTime_Must = strtotime($array_DataBorrow[4]);
				if ($dt_ReturnDateTime > $dt_ReturnDateTime_Must)
				{
					$d_TimeSpan = $dt_ReturnDateTime - $dt_ReturnDateTime_Must;/*
                     * waktu pengembalian buku dikurang waktu pengembalian seharusnya
                     */
                    $d_TimeSpan = $d_TimeSpan /(3600*24);
                    /*
                     * pembagian berdasarkan hari
                     */

                    $s_FinesPerBook += ($array_List[$var][3] * $array_List[$var][7] * $d_TimeSpan );
				}

				$s_FinesPerBook += ($array_List[$var][4] * $array_List[$var][8]) + ($array_List[$var][4] * $array_List[$var][9]);

				?>

		<td class="c_Right">Rp.<?=$s_FinesPerBook?>,-</td>
		<?php
			}
			else
			{
				?>
		<td class="c_Left"></td>
		<?php
			}
				?>
	</tr>
	<?php
	}
	?>
</table>


<?php
ob_flush();
?>
