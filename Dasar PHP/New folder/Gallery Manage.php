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

$s_Search = "";
if(isset($_GET["txt_Search"]) && strlen(trim($_GET["txt_Search"])) != 0)
    $s_Search = trim($_GET["txt_Search"]);

$s_InfoPage = $c_Class->array_Get_AllClassID($s_Search);
$s_InfoPage = "Found " . count($s_InfoPage) . " data";

?>

<div class="Form">
    <form action="" method="GET" >
        <div class="Row">
            <span>Search&nbsp;</span>
            <input type="text" class="Textbox" name="txt_Search" />
            <span>&nbsp;</span>
            <input type="submit" class="ButtonSubmit" name="btn_Search" value="Search" />
            <span>&nbsp;</span>
            <input type="button" class="ButtonInsert" value="Insert New Class" onclick="window.location.href='lesson.php?action=Insert';" />
        </div>
        
        <div class="Row">
            <span><?=$s_InfoPage?></span>
        </div>
    </form>
</div>


<?php
ob_flush();
?>