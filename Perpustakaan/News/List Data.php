<?php
ob_start();

//----
//Class manage
//----

include_once'App Code/Class_News.php';
$c_News = new Class_News();

include_once'App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

include_once'App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

//------
// Variable
//------

$s_Search ="";
if(isset($_GET["txt_Search"]) && strlen(trim($_GET["txt_Search"])) !=0)
	$s_Search = trim($_GET["txt_Search"]);

$array_List = $c_News->array_Get_AllNewsID($s_Search);
 ?>

 <div class="InfoDataCount  animated bounce">Found <?=count($array_List)?> data</div>
<div class="GalleryNews  animated slideInLeft">
<?php
    for($var = 0; $var < count($array_List); $var++)
    {
        $s_NewsID = $array_List[$var];
        $array_Data = $c_News->array_Get_DataNews($s_NewsID);

        $s_DatePosting = $array_Data[1];
        $s_DatePosting = date("l, F d, Y", strtotime($s_DatePosting));
        $s_Title = $array_Data[2];
        $s_Value = $array_Data[3];
        if(strlen($s_Value) > 300)
        {
            $s_Value = substr($s_Value, 0, 300);
        }

        $s_EmployeeID = $array_Data[4];
        $s_Writer = $c_Employee->array_Get_DataEmployee($s_EmployeeID)[1];

        ?>
<div class="Data">
<div class="Title"><?=$s_Title?></div>
<div class="AddData"><?=$s_DatePosting?> - Writer <?=$s_Writer?></div>
<p>
<?=$s_Value?>
<a href="newsread.php?id=<?=$s_NewsID?>">Read More</a>
</p>
</div>
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
.GalleryNews
{
    clear: both; float: left;
    
    width: 100%;

}
.GalleryNews .Data
{
    clear: both; float: left;
    width: 70%;

    padding-bottom: 20px;
    margin-bottom: 10px;
    border-bottom-style: dotted;
    border-bottom-width: 2px;
    border-bottom-color: #ffffff;
}
.GalleryNews .Data .Title
{
    clear: both; float: left;
    width: 100%;
    font-size: 20px;
    margin-bottom: 3px;

    color:#ffffff;
}
.GalleryNews .Data .AddData
{
    clear: both; float: left;
    width: 100%;
    font-size: 14px;
    color:#0088c7;

    margin-bottom: 10px;
}
.GalleryNews .Data p
{
    clear: both; float: left;
    width: 100%;
    font-size: 15px;
    color: #ffffff;
}
.GalleryNews .Data p a
{
    color: #0088c7;
    text-decoration: none;
}
.GalleryNews .Data p a:hover
{
    text-decoration: underline;
}
</style>


<?php
ob_flush();
?>

