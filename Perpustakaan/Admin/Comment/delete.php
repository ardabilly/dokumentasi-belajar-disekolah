<?php
ob_start();

//====================================
// Class Management
//====================================

include_once '../App Code/Class_Comment.php';
$c_Comment = new Class_Comment();

include_once '../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//====================================
// Check
//====================================


if(isset($_GET["action"]) && $_GET["action"] === "Delete" && isset($_GET["id"]) && strlen(trim($_GET["id"])) != 0)
{
    $s_CommentID = $_GET["id"];

    $b_Check = $c_Comment->bool_Delete_CommentData($s_CommentID);
    if($b_Check)
    {
        echo $c_Variable->string_Set_RedirectPage("comment.php");
    }
    else
    {
        echo $c_Variable->string_Set_MessageBox("Can't delete this data");
        echo $c_Variable->string_Set_RedirectPage("comment.php");
    }

}

ob_flush();
?>
