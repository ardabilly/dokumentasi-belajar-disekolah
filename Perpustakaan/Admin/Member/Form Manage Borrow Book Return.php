<?php 
ob_start();

//class manage

include_once'../App Code/Class_Member.php';
$c_Member  = new Class_Member();

include_once'../App Code/Class_Book.php';
$c_Book = new Class_Book();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

// variable

$s_ErrorMessage = "";

$s_BorrowID = $_GET["id"];

$array_List = $c_Member->array_Get_BorrowBookData($s_BorrowID);

 ?>

 <div class="Form" style="margin-top: 20px;">
 	<form action="" method="post" enctype="multipart/form-data" name="form-manage">
 		<div class="Row">
 			<span class="TitleMessage">Form Book Return</span>
 		</div>
 		<table class="DataTable">
 			<tr class="tHead">
 				<td>No</td>
 				<td>Book Name</td>
 				<td>Qty</td>
 				<td>Fines Per Day</td>
 				<td>Fines Price</td>
 				<td>Status</td>
 				<td>Return Date</td>
 				<td>Good Return</td>
 				<td>Broken Return</td>
 				<td>Missing Return</td>
 			</tr>
 			<?php
 				for ($var=0; $var <count($array_List) ; $var++) { 
 					$s_BookID = $array_List[$var][0];
 					$object_BookID = str_replace(".","_",$s_BookID);
 					$object_BookID = str_replace(" ","_",$object_BookID);

 					$object_ReturnDate = "txt_ReturnDate_".$object_BookID;
 					$object_GoodReturn = "txt_Good_".$object_BookID;
 					$object_BrokenReturn = "txt_Broken_".$object_BookID;
 					$object_MissingReturn = "txt_Missing_".$object_BookID;

 					$s_ReturnDate = explode(" ", $array_List[$var][6])[0];
 					if(isset($_POST[$object_GoodReturn]) && strlen(trim($_POST[$object_ReturnDate])) != 0)
 						$s_ReturnDate = trim($_POST[$object_ReturnDate]);

	 					$s_GoodReturn = $array_List[$var][7];
	                if(isset($_POST[$object_GoodReturn]) && strlen(trim($_POST[$object_GoodReturn])) != 0)
	                    $s_GoodReturn = trim($_POST[$object_GoodReturn]);

	                $s_BrokenReturn = $array_List[$var][8];
	                if(isset($_POST[$object_BrokenReturn]) && strlen(trim($_POST[$object_BrokenReturn])) != 0)
	                    $s_BrokenReturn = trim($_POST[$object_BrokenReturn]);

	                $s_MissingReturn = $array_List[$var][9];
	                if(isset($_POST[$object_MissingReturn]) && strlen(trim($_POST[$object_MissingReturn])) != 0)
	                    $s_MissingReturn = trim($_POST[$object_MissingReturn]);

	                $s_Status = "Borrow";
	                $s_QuantityData = $array_List[$var][2];

	                $s_ErrorMessage .= "";

	                $b_Validation = true;
	                if(isset($_POST["btn_Submit"]))
	                {
	                	if(!$c_Variable->bool_Check_ValidateDate($s_ReturnDate." 00:00:00"))
	                	{
	                		$s_ErrorMessage .= "Return Date invalid<br/>";
	                		$b_Validation = false;
	                	}
	                	if(!$c_Variable->bool_Validation_Numeric($s_GoodReturn) || ($c_Variable->bool_Validation_Numeric($s_GoodReturn) && $s_BrokenReturn < 0 ))
	                	{
	                		$s_ErrorMessage .= "Good Return invalid<br/>";
	                		$b_Validation = false;
	                	}
	                	if(!$c_Variable->bool_Validation_Numeric($s_BrokenReturn) || ($c_Variable->bool_Validation_Numeric($s_BrokenReturn) && $s_BrokenReturn < 0))
	                	{
	                		$s_ErrorMessage .= "Broken Return invalid<br/>";
	                		$b_Validation = false;
	                	}
	                	if(!$c_Variable->bool_Validation_Numeric($s_MissingReturn) || ($c_Variable->bool_Validation_Numeric($s_MissingReturn) && $s_MissingReturn < 0 ))
	                	{
	                		$s_ErrorMessage .= "Missing Return invalid<br/>";
	                		$b_Validation = false;
	                	}

	                	//=======================

	                	$s_Quantity = $s_GoodReturn + $s_BrokenReturn + $s_MissingReturn;
	                	if($s_Quantity > $s_QuantityData)
	                	{
	                		$s_ErrorMessage .= "Quantity Return invalid<br/>";
	                		$b_Validation = false;
	                	}
	                	if($s_Quantity < $s_QuantityData)
	                	{
	                		$s_ErrorMessage .= "Quantity Return less<br/>";
	                		$b_Validation = false;
	                	}
	                	if($s_Quantity == $s_QuantityData)
	                	{
	                		$s_ErrorMessage .= "Return";
	                		$b_Validation = false;
	                	}

	                	if($b_Validation && $array_List[$var][6] === "Borrow")
	                	{
	                		$b_Check = $c_Member->bool_Update_BorrowBookData($s_BorrowID,$s_BookID,$s_ReturnDate,$s_Status,$s_GoodReturn,$s_BrokenReturn,$s_MissingReturn);
	                		if ($b_Check) {
	                			$c_Book->bool_Manage_BookReturned($s_BookID,$s_GoodReturn, "NumberOfGood");
	                			$c_Book->bool_Manage_BookReturned($s_BookID,$s_BrokenReturn, "NumberOfBroken");
	                			$c_Book->bool_Manage_BookReturned($s_BookID,$s_MissingReturn, "NumberOfMissing");
	                		}
	                	} 
	                }

	                if (strlen($s_ErrorMessage) !=0) {
	                	?>
	                	<tr class="tBody">
	                		<td class="c_Left" colspan="10">
	                			<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
	                		</td>
	                	</tr>
	            <?php

	                }

	             ?>

	             		<tr class="tBody">
	             			<td class="c_Center"><?=$var+1?></td>
	             			<td class="c_Left"><?=$array_List[$var][1]?></td>
	             			<td class="c_Center"><?=$array_List[$var][2]?></td>
	             			<td class="c_Right">Rp.<?=$array_List[$var][3]?>,-</td>
	             			<td class="c_Right">Rp.<?=$array_List[$var][4]?>,-</td>
	             			<td class="c_Left"><?=$array_List[$var][5]?></td>
	             			<td class="c_Left">
	             				<input type="text" name="txt_ReturnDate_<?=$s_BookID?>" value="<?=$s_ReturnDate?>" class="TextBox"/>
	             			</td>
	             			<td class="c_Center">
								<input type="text" name="txt_Good_<?=$s_BookID?>" value="<?=$s_GoodReturn?>" class="TextBox" />
							</td>
							<td class="c_Center">
								<input type="text" name="txt_Broken_<?=$s_BookID?>" value="<?=$s_BrokenReturn?>" class="TextBox" />
							</td>
							<td class="c_Center">
								<input type="text" name="txt_Missing_<?=$s_BookID?>" value="<?=$s_MissingReturn?>" class="TextBox" />
							</td>
	             		</tr>
	        <?php
 				}
 			?>
 		</table>

 		<div class="Row">
 			<input type="submit" value="Submit" name="btn_Submit" class="ButtonSubmit"/>
 			<span>&nbsp;&nbsp;</span>
 			<input type="reset" value="Reset" class="ButtonReset" name="">
 			<span>&nbsp;&nbsp;</span>
 			<input type="button" value="Done" class="ButtonInsert" onclick="window.location.href='memberborrowdetail.php?id=<?=$s_BorrowID?>';" name="">
 		</div>
 	</form>
 </div>

 <?php 
ob_start();
  ?>