<?php
ob_start();

//====================================
// Class Management
//====================================

include_once 'App Code/Class_Book.php';
$c_Book = new Class_Book();

include_once 'App Code/Class_Variable.php';
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

$array_List = $c_Book->array_Get_AllBookID_ByName($s_Search);
?>

<div class="InfoDataCount">Found <?=count($array_List)?> data</div>
<div class="GalleryBook">
<?php
    for($var = 0; $var < count($array_List); $var++)
    {
        $s_BookID = $array_List[$var];
        $array_Data = $c_Book->array_Get_AllDataBook($s_BookID);

        ?>
<a class="Data" href="bookprofile.php?id=<?=$s_BookID?>">
<img src="<?=$c_Book->string_Set_ImageBook($s_BookID, "")?>" />
<span><?=$array_Data[1]?></span>
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
.GalleryBook
{
    clear: both; float: left;
    width: 100%;
}
.GalleryBook .Data
{
    float: left;
    margin-right: 10px;
    margin-bottom: 10px;
    text-decoration: none;

    padding: 10px; 
    border: 2px dotted #ffffff;
    width: 10%;
}
.GalleryBook .Data:hover
{
    border-style: solid;
    border-color: gold;
}
.GalleryBook .Data img
{
    clear: both; float: left;
    width: 100px;
    height: 130px;

    background-color: #ffffff;
}
.GalleryBook .Data span
{
    clear: both; float: left;
    font-size: 14px;
    margin-top: 5px;
    color:#ffffff;
}
.GalleryBook .Data:hover span
{
    color:gold;
}
</style>


<?php
ob_flush();
?>
