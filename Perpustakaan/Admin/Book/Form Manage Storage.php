<?php
ob_start();

//=======
// CLASS MANAGEMENT
//=======

include_once'../App Code/Class_Book.php';
$c_Book = new Class_Book();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//Check

if (!isset($_GET["id"]) || (isset($_GET["id"]) && strlen(trim($_GET["id"])) == 0)) 
{
	echo $c_Variable->string_Set_RedirectPage("book.php");
}
if (isset($_GET["id"]) && strlen(trim($_GET["id"])) != 0 && !$c_Book->bool_Check_BookID(trim($_GET["id"]))) 
{
	echo $c_Variable->string_Set_MessageBox("This book data, not found. Can't Continue Update");
	echo $c_Variable->string_Set_RedirectPage("book.php");
}

//====
// Variable
//====

$s_ErrorMessage="";

$s_BookID = $_GET["id"];

$s_Floor = "";
if (isset($_POST["cb_Floor"]) &&  strlen(trim($_POST["cb_Floor"])) != 0) 
	$s_Floor = trim($_POST["cb_Floor"]);
if (strlen($s_Floor) == 0 && isset($_POST["txt_Floor"]))
	$s_Floor = trim($_POST["txt_Floor"]);

$s_Corridor = "";
if(isset($_POST["cb_Corridor"]) && strlen(trim($_POST["cb_Corridor"])) != 0)
	$s_Corridor = trim($_POST["cb_Corridor"]);
if(strlen($s_Corridor) == 0 && isset($_POST["txt_Corridor"]))
	$s_Corridor = trim($_POST["txt_Corridor"]);

$s_Rack = "";
if(isset($_POST["cb_Rack"]) && strlen(trim($_POST["cb_Rack"])) != 0)
	$s_Rack = trim($_POST["cb_Rack"]);
if(strlen($s_Rack) == 00 && isset($_POST["txt_Rack"]))
	$s_Rack = trim($_POST["txt_Rack"]);

$s_Level = "";
if(isset($_POST["txt_Level"]) && strlen(trim($_POST["txt_Level"])) != 0)
	$s_Level = trim($_POST["txt_Level"]);

// event submit

$b_Validation = true;
if(isset($_POST["btn_Submit"]))
{
	/*
     * Validasi book floor, corridor, rack
     */

	if (strlen($s_Floor) == 0) {
		
		$s_ErrorMessage .= "Select one floor, if that no option please type in the TextBox<br/>";
		$b_Validation = false;
	}
	if (strlen($s_Corridor) == 0) {
		
		$s_ErrorMessage .= "Select one Corridor , if that no option please type in the TextBox<br/>";
		$b_Validation =false;
	}
	if (strlen($s_Rack) == 0) {
		
		$s_ErrorMessage .= "Select one Corridor , if that no option please type in the TextBox<br/>";
		$b_Validation = false;
	}

	/*
     * Fines per day
     */

	if (strlen($s_Level) == 0) {
		
		$s_ErrorMessage .= "Please field level of rack<br/>";
		$b_Validation = false;
	}
	if (strlen($s_Level) !=0 && !$c_Variable->bool_Validation_Numeric($s_Level)) 
	{
		$s_ErrorMessage .= "Level of rack invalid";
		$b_Validation = false;
	}
	if (strlen($s_Level) !=0 && !$c_Variable->bool_Validation_Numeric($s_Level) && $s_Level <00)
	{
		$s_ErrorMessage .= "Level of rack can not minus <br/>";
		$b_Validation = false;	
	}

	/*
     * Validasi true, My SQL Bridge
     */

	if ($b_Validation) 
	{
		$b_Check =  $c_Book->bool_Update_BookStorage($s_BookID, $s_Floor, $s_Corridor, $s_Rack, $s_Level);
		if ($b_Check) {
			
			echo $c_Variable->string_Set_RedirectPage("bookprofile.php?id=$s_BookID");
		}
		else
			$s_ErrorMessage .= "Can not Update this data";
	}
}


/*
 * data loaded page
 * data awal atau
 * data asli dari database
 */

if (!isset($_POST["btn_Submit"])) 
{	
	$array_DataBookStorage = $c_Book->array_Get_AllDataBookStorage($s_BookID);

	$s_Floor = $array_DataBookStorage[1];
	$s_Corridor = $array_DataBookStorage[2];
	$s_Rack = $array_DataBookStorage[3];
	$s_Level = $array_DataBookStorage[4];
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
 			<span class="TitleMessage">Form Book Storage</span>
 		</div>

 		<div class="Row">
 			<span class="ErrorMessage"><?=$s_ErrorMessage?></span>
 		</div>

 		<div class="Row">
 			<span class="Lable">Floor</span>
 			<select name="cb_Floor" class="TextBox">
 				<option value=""> --Option-- </option>
 				<?php

 					$array_AllID = $c_Book->array_Get_AllFloor_FromBookDataStorage();


 					for ($var=0; $var <count($array_AllID) ; $var++) { 
 						
 						$s_ValueID = $array_AllID[$var];

 						$s_Selected ="";
 						if ($s_ValueID === $s_Floor) {
 							
 							$s_Selected = "selected";
 						}

 						?>
 				<option value="<?=$s_ValueID?>"><?=$s_Selected?><?=$s_ValueID?></option>
 				<?php

 					}

 				?>
 			</select>
 			<span>&nbsp;if that no option, please type here&nbsp;</span>
 			<input type="text" name="txt_Floor" value="<?=$s_Floor?>" placeholder="Add floor" class="TextBox"/>
 			<br/>
 			<span>if new typing, please select --option-- for add new</span>
 		</div>

 		<div class="Row">
 			<span class="Lable">Corridor</span>
 			<select name="cb_Corridor" class="TextBox">
 				<option value=""> --Option-- </option>
 				<?php

 					$array_AllID = $c_Book->array_Get_AllCorridor_FromBookDataStorage();

 					for ($var=0; $var <count($array_AllID) ; $var++) { 
 						
 						$s_ValueID = $array_AllID[$var];

 						$s_Selected ="";
 						if ($s_ValueID === $s_Corridor) {
 							
 							$s_Selected = "selected";
 						}

 						?>
 				<option value="<?=$s_ValueID?>"><?=$s_Selected?><?=$s_ValueID?></option>
 				<?php

 					}

 				?>
 			</select>
 			<span>&nbsp;if that no option, please type here&nbsp;</span>
 			<input type="text" name="txt_Corridor" value="<?=$s_Corridor?>" placeholder="Add Corridor" class="TextBox"/>
 			<br/>
 			<span>if new typing, please select --option-- for add new</span>
 		</div>

 		<div class="Row">
 			<span class="Lable">Rack</span>
 			<select name="cb_Rack" class="TextBox">
 				<option value=""> --Option-- </option>
 				<?php

 					$array_AllID = $c_Book->array_Get_AllRack_FromBookDataStorage();

 					for ($var=0; $var <count($array_AllID) ; $var++) { 
 						
 						$s_ValueID = $array_AllID[$var];

 						$s_Selected ="";
 						if ($s_ValueID === $s_Rack) {
 							
 							$s_Selected = "selected";
 						}

 						?>
 				<option value="<?=$s_ValueID?>"><?=$s_Selected?><?=$s_ValueID?></option>
 				<?php

 					}

 				?>
 			</select>
 			<span>&nbsp;if that no option, please type here&nbsp;</span>
 			<input type="text" name="txt_Rack" value="<?=$s_Rack?>" placeholder="Add rack" class="TextBox"/>
 			<br/>
 			<span>if new typing, please select --option-- for add new</span>
 		</div>

 		<div class="Row">
 			<span class="Lable">Level of rack</span>
 			<input type="text" name="txt_Level" value="<?=$s_Level?>" class="TextBox" placeholder="[numeric]"/>
 		</div>

 		<div class="Row">
 			<input type="submit" name="btn_Submit" value="Submit" class="ButtonSubmit"/>
 			<span>&nbsp;</span>
 			<input type="reset" name="" class="ButtonReset"> 
 			<span>&nbsp;</span>
 			<input type="button" value="Back" class="ButtonBack" onclick="window.history.back();" name=""/>
 		</div>
 	</form>
 </div>

 <?php
 ob_flush();
 ?>