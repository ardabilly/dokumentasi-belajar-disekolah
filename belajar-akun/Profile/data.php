<?php
ob_start();

//==========================================
// Class Management
//==========================================

include_once 'App Code/Class_People.php';
$c_People = new Class_People();

//==========================================
// Variable
//==========================================

$s_PeopleID = $_COOKIE["cookie_Akun"];
$array_Data = $c_People->array_Get_DataPeople($s_PeopleID);

?>

<div class="PeopleData">
    <div class="Data">
        <span class="Lable">Full Name</span>
        <span><?=$array_Data[1]?>, Called <?=$array_Data[2]?></span>
    </div>
    <div class="Data">
        <span class="Lable">Gender</span>
        <span><?=$array_Data[3]?></span>
    </div>
    <div class="Data">
        <span class="Lable">Religion</span>
        <span><?=$array_Data[4]?></span>
    </div>
    <div class="Data">
        <span class="Lable">Place and Date of Birth</span>
        <span><?=$array_Data[5]?>, <?=date("l, F d Y ", strtotime($array_Data[6]))?></span>
    </div>
    <div class="Data">
        <span class="Lable">Contact</span>
        <span>Phone number <?=$array_Data[7]?>, Email <?=$array_Data[8]?></span>
    </div>
    <div class="Data">
        <span class="Lable">Address</span>
        <span><?=$array_Data[9]?></span>
    </div>
</div>

<style>
    .PeopleData
    {
        clear: both; float: left;
        margin-top: 20px;
    }
    .PeopleData .Data
    {
        clear: both; float: left;
        margin-bottom: 8px;
    }
    .PeopleData .Data span
    {
        float: left;
        font-size: 13px;
    }
    .PeopleData .Data .Lable
    {
        width: 150px;
        color: #656565;
    }
    
</style>

<?php
ob_flush();
?>
