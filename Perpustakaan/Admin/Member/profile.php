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
// Check Availablity
//====================================

if(!isset($_GET["id"]) || (isset($_GET["id"]) && strlen(trim($_GET["id"])) == 0 ))
{
    echo $c_Variable->string_Set_RedirectPage("member.php");
}
if(isset($_GET["id"]) && !$c_Member->bool_Check_MemberID($_GET["id"]) )
{
    echo $c_Variable->string_Set_MessageBox("This data not found");
    echo $c_Variable->string_Set_RedirectPage("member.php");
}

//====================================
// Variable
//====================================

$s_MemberID = $_GET["id"];
$array_DataMember = $c_Member->array_Get_DataMember($s_MemberID);



?>

<div class="MemberData">
<div class="DataDetail">
<div class="Data">
<span class="Lable">Member ID</span>
<span><?=$s_MemberID?></span>
</div>
<div class="Data">
<span class="Lable">Full name</span>
<span><?=$array_DataMember[1]?></span>
</div>
<div class="Data">
<span class="Lable">Gender</span>
<span><?=$array_DataMember[2]?></span>
</div>
<div class="Data">
<span class="Lable">Religion</span>
<span><?=$array_DataMember[3]?></span>
</div>
<div class="Data">
<span class="Lable">Place and date of birth</span>
<span><?=$array_DataMember[4]?>, <?= date("l, F d, Y", strtotime($array_DataMember[5])) ?></span>
</div>
<div class="Data">
<span class="Lable">Phone number</span>
<span><?=$array_DataMember[6]?></span>
</div>
<div class="Data">
<span class="Lable">Email</span>
<span><?=$array_DataMember[7]?></span>
</div>
<div class="Data">
<span class="Lable">Address</span>
<span><?=$array_DataMember[8]?></span>
</div>
</div>
</div>

<div class="Form" style="background-color: transparent; padding: 0; margin-top: 20px;">
<input type="button" value="Gallery" class="ButtonInsert" onclick="window.location.href='member.php';" />
<span>&nbsp;</span>
<input type="button" value="Update Data" class="ButtonSubmit" onclick="window.location.href='memberupdate.php?id=<?=$s_MemberID?>';" />
<span>&nbsp;</span>
<a href="memberprofile.php?action=Delete&id=<?=$s_MemberID?>" class="ButtonDelete" onclick="return confirm('Are you sure want to delete this data?');">Delete</a>
</div>

<style>
.MemberData
{
    clear: both; float: left;
    width: 100%;
}
.MemberData .DataDetail
{
    float: left;
}
.MemberData .DataDetail .Data
{
    clear: both; float: left;
    margin-bottom: 8px;
}
.MemberData .DataDetail .Data span
{
    float: left;
    font-size: 14px;
    color:#ffffff;
}
.MemberData .DataDetail .Data .Lable
{ width: 150px; }
</style>

<?php
ob_flush();
?>
