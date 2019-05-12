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

$s_BookID = $_GET["id"];
$array_DataBook = $c_Book->array_Get_AllDataBook($s_BookID);
$array_DataBookStorage = $c_Book->array_Get_AllDataBookStorage($s_BookID);


?>

<div class="BookData">
<div class="NameDetail" >
<span class="Name"><?=$array_DataBook[1]?></span>
<span class="DateCome"><?= date("l, F d, Y", strtotime($array_DataBook[5]))?></span>
<span class="Writer">writer <?= $array_DataBook[6]?></span>
</div>

<img src="<?=$c_Book->string_Set_ImageBook($s_BookID, "")?>" class="CoverImage" />
<div class="DataDetail">
<div class="Data">
<span class="Lable">Book type</span>
<span><?=$array_DataBook[2]?></span>
</div>
<div class="Data">
<span class="Lable">Loaned</span>
<span><?=$array_DataBook[4]?></span>
</div>
<div class="Data">
<span class="Lable">Publisher</span>
<span><?=$array_DataBook[7]?></span>
</div>
<div class="Data">
<span class="Lable">Number of page</span>
<span><?=$array_DataBook[8]?></span>
</div>
</div>
<div class="DataDetail" style="margin-left: 30px;">
<div class="Data">
<span class="Lable">Book Storage</span>
<span></span>
</div>
<div class="Data">
<span class="Lable">Floor</span>
<span><?=$array_DataBookStorage[1]?></span>
</div>
<div class="Data">
<span class="Lable">Corridor</span>
<span><?=$array_DataBookStorage[2]?></span>
</div>
<div class="Data">
<span class="Lable">Rack</span>
<span><?=$array_DataBookStorage[3]?></span>
</div>
<div class="Data">
<span class="Lable">Level of rack</span>
<span><?=$array_DataBookStorage[4]?></span>
</div>
</div>
<p class="Synopsis">
        Synopsis
<br/><br/>
<?=$array_DataBook[9]?>
</p>
</div>

<style>
.BookData
{
    clear: both; float: left;
    width: 100%;
    margin-left: 20px;
}
.BookData .NameDetail
{
    clear: both; float: left;
    width: 100%;
    padding-left: 10px;
    border-left: 2px solid #0073bc;
    margin-bottom: 20px;
}
.BookData .NameDetail .Name
{
    clear: both; float: left;
    width: 100%;

    font-size: 25px;
    color:#ffffff;
}
.BookData .NameDetail .DateCome
{
    clear: both; float: left;    
    font-size: 14px;
    color:#0073bc;
    margin-right: 5px;
}
.BookData .NameDetail .Writer
{
    float: left;    
    font-size: 14px;
    color:#ffffff;
}

.BookData .CoverImage
{
    clear: both; float: left;
    width: 200px;
    height: 250px;

    background-color: #ffffff;
    padding: 10px;
    border: 2px dotted #0025e3;
}
.BookData .DataDetail
{
    float: left;
    margin-left: 10px;
    border-bottom: 2px solid #ff;
    
}
.BookData .DataDetail .Data
{
    clear: both; float: left;
    width: 100%;
    margin-bottom: 8px;
}
.BookData .DataDetail .Data span
{
    float: left;
    color:#ffffff;
    font-size: 16px;
}
.BookData .DataDetail .Data .Lable
{
    width: 150px;
}
.BookData .Synopsis
{
    clear: both; float: left;
    margin-top: 10px;

    font-size: 16px;
    text-align: justify;
    color:#ffffff;
}
</style>

<?php
ob_flush();
?>
