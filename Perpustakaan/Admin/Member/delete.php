<?php
ob_start();

//====================================
// Class Management
//====================================

include_once '../App Code/Class_Member.php';
$c_Member = new Class_Member();

include_once '../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//====================================
// Check
//====================================


if(isset($_GET["action"]) && $_GET["action"] === "Delete" && isset($_GET["id"]) && strlen(trim($_GET["id"])) != 0)
{
    $s_BookID = $_GET["id"];

    $b_Check = $c_Member->bool_Delete_MemberData($s_MemberID);
    if($b_Check)
    {
        echo $c_Variable->string_Set_RedirectPage("member.php");
    }
    else
    {
        echo $c_Variable->string_Set_MessageBox("Can't delete this data");
        echo $c_Variable->string_Set_RedirectPage("memberprofile.php?id=$s_MemberID");
    }

}

ob_flush();
?>
