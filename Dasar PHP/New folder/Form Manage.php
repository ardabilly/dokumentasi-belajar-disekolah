<?php
ob_start();

//==============================================================================
// Class Management
//==============================================================================

include_once './App Code/Class_Class.php';
$c_Class = new Class_Class();

//==============================================================================
// Variable
//==============================================================================
$ErrorMessage = "";
$s_ClassID = $c_Class->string_Set_ClassID();

$s_ClassName = "";
if(isset($_POST["txt_ClassName"]) && strlen(trim($_POST["txt_ClassName"])) != 0)
    $s_ClassName = trim($_POST["txt_ClassName"]);

$s_SemesterLevel = "";
if(isset($_POST["txt_SemesterLevel"]) && strlen(trim($_POST["txt_SemesterLevel"])) != 0)
    $s_SemesterLevel = trim($_POST["txt_SemesterLevel"]);

$s_Status = "";
if(isset($_POST["rd_Status"]) && strlen(trim($_POST["rd_Status"])) != 0)
    $s_Status = trim($_POST["rd_Status"]);

$s_Description = "";
if(isset($_POST["txt_Description"]) && strlen(trim($_POST["txt_Description"])) != 0)
    $s_Description = trim($_POST["txt_Description"]);

//==============================================================================
// Submit
//==============================================================================

$b_Validation = true;
$b_ActionUpdate = false;

if(isset($_POST["btn_Submit"]))
{
    if($_GET["action"] === "Update" && isset($_GET["id"]))
    {
        $s_ClassID = trim($_GET["id"]);
        $b_ActionUpdate = true;
    }
    
    if(strlen($s_ClassName) == 0)
    {
        $ErrorMessage .= "Please field lesson name<br/>";
        $b_Validation = FALSE;
    }
    if(!$b_ActionUpdate && strlen($s_ClassName) != 0 && $c_Class->bool_Check_ClassName($s_ClassName))
    {
        $ErrorMessage .= "Class name has already exist<br/>";
        $b_Validation = FALSE;
    }
    if($b_ActionUpdate && strlen($s_ClassName) != 0 && $c_Class->bool_Check_ClassName1($s_ClassID, $s_ClassName))
    {
        $ErrorMessage .= "Class name has already exist<br/>";
        $b_Validation = FALSE;
    }
    
    if(strlen($s_SemesterLevel) == 0)
    {
        $ErrorMessage .= "Please field semester level<br/>";
        $b_Validation = FALSE;
    }
    if(strlen($s_Status) == 0)
    {
        $ErrorMessage .= "Select one status<br/>";
        $b_Validation = FALSE;
    }
    
    if($b_Validation)
    {
        $b_Check = false;
        if(!$b_ActionUpdate)
            $b_Check = $c_Class->bool_Insert_Class($s_ClassID, $s_ClassName, $s_SemesterLevel, $s_Status, $s_Description);
        else if ($b_ActionUpdate) 
            $b_Check = $c_Class->bool_Update_Class ($s_ClassID, $s_ClassName, $s_SemesterLevel, $s_Status, $s_Description);
        
        if(!$b_Check)
            $ErrorMessage = "Can not manage this data";
        else if($b_Check)
            echo "<script>window.location.href='lesson.php';</script>";
            
    }
}

if($_GET["action"] === "Update" && isset($_GET["id"]) && $_GET["id"] !== "" && !isset($_POST["btn_Submit"]))
{
    $array_Data = $c_Class->array_Get_DataClass($_GET["id"]);
    
    $s_ClassName = $array_Data[1];
    $s_SemesterLevel = $array_Data[2];
    $s_Status = $array_Data[3];
    $s_Description = $array_Data[4];
}

?>

<div class="Form">
    <form action="" method="POST" enctype="multipart/form-data" name="form-Manage">
        <div class="Row">
            <span class="ErrorMessage"><?=$ErrorMessage?></span>
        </div>
        <div class="Row">
            <span class="Lable">Class</span>
            <input type="text" name="txt_ClassName" class="Textbox" value="<?=$s_ClassName?>" />
        </div>
        
        <div class="Row">
            <span class="Lable">Semester Level</span>
            <input type="text" name="txt_SemesterLevel" class="Textbox" value="<?=$s_SemesterLevel?>" />
        </div>
        
        <div class="Row">
            <span class="Lable">Status</span>
            <?php
                $array_List = array("Active", "Unactive");
                
                for($var = 0; $var < count($array_List); $var++)
                {
                    $s_Selected = "";
                    if($s_Status == $array_List[$var])
                        $s_Selected  = "checked";
                    
                    ?>
                    <div class='Selection'>
                        <input type='radio' name='rd_Status' value='<?=$array_List[$var]?>' class='RadioButton' id='rd_Status_<?=$array_List[$var]?>' <?=$s_Selected?> />
                        <span onclick='radio_Checked("rd_Status_<?=$array_List[$var]?>")'>&nbsp;<?=$array_List[$var]?></span>
                    </div>
                    <span>&nbsp;&nbsp;&nbsp;</span>
                    <?php
                    
                }
            ?>
        </div>
        
        <div class="Row">
            <span class="Lable">Description</span>
            <textarea name="txt_Description" class="Textbox_Large"><?=$s_Description?></textarea>
        </div>
        
        <div class="Row">
            <input type="submit" name="btn_Submit" value="Submit" class="ButtonSubmit" />
            <span>&nbsp;&nbsp;</span>
            <input type="reset" value="Reset" class="ButtonReset" />
            <span>&nbsp;&nbsp;</span>
            <input type="button" value="Back" class="ButtonBack" onclick="window.history.back()" />
        </div>
            
    </form>
</div>

<style>
    .Form .Lable
    { width: 120px; }
</style>

<?php
ob_flush();
?>