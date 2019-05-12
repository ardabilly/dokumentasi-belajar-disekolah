<?php
ob_start();

//====================================
// Class Management
//====================================

include_once '../App Code/Class_News.php';
$c_News = new Class_News();

include_once '../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//====================================
// Check
//====================================


if(isset($_GET["action"]) && $_GET["action"] === "Delete" && isset($_GET["id"]) && strlen(trim($_GET["id"])) != 0)
{
    $s_NewsID = $_GET["id"];

    $b_Check = $c_News->bool_Delete_NewsData($s_NewsID);
    if($b_Check)
    {
        $c_News->bool_Delete_ImageNews($s_NewsID, "../");
        echo $c_Variable->string_Set_RedirectPage("news.php");
    }
    else
    {
        echo $c_Variable->string_Set_MessageBox("Can't delete this data");
        echo $c_Variable->string_Set_RedirectPage("newsread.php?id=$s_NewsID");
    }

}

ob_flush();
?>

