<?php
ob_start();

//====================================
// Class Management
//====================================

include_once '../App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once '../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//====================================
// Variable
//====================================

$s_Search = "";
if(isset($_GET["txt_Search"]) && strlen(trim($_GET["txt_Search"])) != 0)
    $s_Search = trim($_GET["txt_Search"]);
/*
 * txt_Search diambil dari body top.php
 */

$array_List = $c_Employee->array_Get_AllEmployeeID($s_Search);

?>

<div class="InfoDataCount">Found <?=count($array_List)?> data</div>
<div class="GalleryEmployee">
<?php
    for($var = 0; $var < count($array_List); $var++)
    {
        $s_EmployeeID = $array_List[$var];
        $array_Data = $c_Employee->array_Get_DataEmployee($s_EmployeeID);

        ?>
<a class="Data" href="employeeprofile.php?id=<?=$s_EmployeeID?>">
<img src="<?=$c_Employee->string_Set_ImageEmployee($s_EmployeeID, "../")?>" />
<span>
<?=$s_EmployeeID?>
<br/>
<?=$array_Data[1]?>
</span>
</a>
<?php
    }
    ?>
</div>

<style>
.InfoDataCount
{
    clear: both; float: left;
    font-size: 20px; 
    color:#ffffff;

    margin-bottom: 10px;
}
.GalleryEmployee
{
    clear: both; float: left;
    width: 100%;
}
.GalleryEmployee .Data
{
    float: left;
    margin-right: 10px;
    margin-bottom: 10px;
    text-decoration: none;

    padding: 10px;
    border-bottom: 2px solid #ffffff;
    width: 150px;
}
.GalleryEmployee .Data:hover
{
    border-color: #0046ae;
}
.GalleryEmployee .Data img
{
    clear: both; float: left;
    width: 100px;
    height: 100px;
    margin-left: 25px;

    border: 2px solid #ffffff;

    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;

    background-color: #ffffff;
}
.GalleryEmployee .Data:hover img
{
    border-color: #0046ae;
}
.GalleryEmployee .Data span
{
    clear: both; float: left;
    width: 150px;
    text-align: center;
    font-size: 14px;
    margin-top: 5px;
    color:#ffffff;
}
/style>


<?php
ob_flush();
?>