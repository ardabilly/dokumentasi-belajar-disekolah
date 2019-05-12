<?php
ob_start();

//====================================
// Class Management
//====================================

include_once 'App Code/Class_News.php';
$c_News = new Class_News();

include_once 'App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once 'App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

//====================================
// Variable
//====================================

$s_NewsID = $_GET["id"];
$array_DataNews = $c_News->array_Get_DataNews($s_NewsID);
$s_Writer = $array_DataNews[4];
$s_Writer = $c_Employee->array_Get_DataEmployee($s_Writer)[1];

$s_ImageLocation = $c_News->string_Set_ImageNews($s_NewsID, "");
?>

<div class="NewsData">
<div class="NameDetail">
<span class="Name"><?=$array_DataNews[2]?></span>
<span class="DateCome"><?= date("l, F d, Y H:i", strtotime($array_DataNews[1]))?></span>
<span class="Writer">writer <?= $s_Writer?></span>
</div>

<?php
    if(strlen($s_ImageLocation) != 0)
    {
        ?>
<img src="<?=$s_ImageLocation?>" class="CoverImage" />
<?php
    }
    ?>


<p class="NewsValue">
<?=$array_DataNews[3]?>
</p>

<div class="btns">
<button class="btn btn-primary"  onclick="window.location.href='news.php';" >Gallery News</button>
</div>
</div>

<style>
.NewsData
{
    clear: both; float: left;
    width: 100%;
    margin-left: 20px;
}
.NewsData .NameDetail
{
    clear: both; float: left;
    width: 100%;
    padding-left: 10px;
    border-left: 2px solid #0073bc;
    margin-bottom: 20px;
}
.NewsData .NameDetail .Name
{
    clear: both; float: left;
    width: 100%;

    font-size: 25px;
    color:#ffffff;
}
.NewsData .NameDetail .DateCome
{
    clear: both; float: left;    
    font-size: 14px;
    color:#0073bc;
    margin-right: 5px;
}
.NewsData .NameDetail .Writer
{
    float: left;    
    font-size: 14px;
    color:#ffffff;
}

.NewsData .CoverImage
{
    clear: both; float: left;
    width: 400px;

    background-color: #ffffff;
    padding: 10px;
    border: 2px dotted #0025e3;
}
.NewsData .NewsValue
{
    clear: both; float: left;
    margin-top: -17%;
    margin-left: 30%;
    font-size: 16px;
    text-align: justify;
    color:#ffffff;
    width: 60%;
}
.btns
{
    float: left; clear: both;
    margin-top: 10px;
}
</style>

<?php
ob_flush();
?>
