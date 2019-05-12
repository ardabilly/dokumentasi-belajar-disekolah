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

$s_ClassID = "";

$b_Check = false;
if(isset($_GET["action"]) && $_GET["action"] === "Delete" && isset($_GET["id"]) && $_GET["id"] !== "")
{
    $s_ClassID = $_GET["id"];
    $b_Check = $c_Class->bool_Delete_Class($s_ClassID);
    
    if(!$b_Check)
        echo "<script>alert('Can not delete this data');</script>";

    echo "<script>window.location.href='lesson.php';</script>";
}

?>

<?php
ob_flush();
?>