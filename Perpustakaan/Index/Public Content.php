<?php
ob_start();

include_once 'App Code/Class_News.php';
$c_News = new Class_News();

include_once 'App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

include_once 'App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once 'App Code/Class_Book.php';
$c_Book = new Class_Book();

include_once 'App Code/Class_Comment.php';
$c_Comment = new Class_Comment();

//====================================
// Variable
//====================================

$s_Search = "";
if(isset($_GET["txt_Search"]) && strlen(trim($_GET["txt_Search"])) != 0)
    $s_Search = trim($_GET["txt_Search"]);
/*
 * txt_Search diambil dari body top.php
 */

$array_ListNews = $c_News->array_Get_AllNewsID($s_Search);
$array_ListBook = $c_Book->array_Get_AllBookID_ByDate($s_Search);
$array_ListComment = $c_Comment->array_Get_AllCommentID($s_Search);
?>

<div class="Left">
<div class="NewsPlace animated slideInLeft">
<div class="TitleContent">
<span id="q1">The</span>
<span id="q2">News</span>
</div>
<div class="GalleryNews">

<?php
            for($var = 0; $var < count($array_ListNews); $var++)
            {
                $s_NewsID = $array_ListNews[$var];
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
</div>
</div>
<div class="Right">
<div class="BookPlace">
<div class="TitleContent">
<span id="q1">New</span>
<span id="q2">Book</span>
</div>
<div class="GalleryBook">
<?php
            for($var = 0; $var < count($array_ListBook); $var++)
            {
                $s_BookID = $array_ListBook[$var];
                $array_Data = $c_Book->array_Get_AllDataBook($s_BookID);

                ?>
<a class="Data" href="bookprofile.php?id=<?=$s_BookID?>">
<img src="<?=$c_Book->string_Set_ImageBook($s_BookID, "")?>" style="padding-top: 10px;"/>
<div class="Arrow"></div>
<span class="Name"><?=$array_Data[1]?></span>
</a>
<?php
            }
            ?>
</div>
</div>
<div class="CommentPlace  animated slideInRight">
<div class="TitleContent">
<span id="q1">The</span>
<span id="q2">Comment</span>
</div>
<div class="GalleryComment">
<?php
            for($var = 0; $var < count($array_ListComment); $var++)
            {
                $s_CommentID = $array_ListComment[$var];
                $array_Data = $c_Comment->array_Get_DataComment($s_CommentID);

                $s_Name = $array_Data[1];
                $s_CommentValue = $array_Data[2];
                $s_CommentDate = $array_Data[3];
                $s_CommentDate = date("l, F d, Y", strtotime($s_CommentDate));
                $s_PhoneNumber = $array_Data[4];
                $s_Email = $array_Data[5];

                ?>
<div class="Data">
<div class="Name"><?=$s_Name?></div>
<div class="Date"><?=$s_CommentDate?></div>
<p><?=$s_CommentValue?></p>
</div>
<?php
            }
            ?>
</div>
</div>
</div>
<style>
    .Left
    {
        float: left;
        width: 48%;
    }
    .Right
    {
        float: right;
        width: 48%;
    }

    /*
    NewsPlace
    */

    .NewsPlace
    {
        clear: both; float: left;
        width: 94%;
        padding: 3%;

        background-color: #3a3a3a;
        color:#ffffff;

        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }
    .NewsPlace .GalleryNews
    {
        clear: both; float: left;
        width: 100%;
    }
    .NewsPlace .GalleryNews .Data
    {
        clear: both; float: left;
        width: 100%;

        padding-bottom: 20px;
        margin-bottom: 10px;
        border-bottom-style: dotted;
        border-bottom-width: 2px;
        border-bottom-color: #ffffff;
    }
    .NewsPlace .GalleryNews .Data .Title
    {
        clear: both; float: left;
        width: 100%;
        font-size: 20px;
        margin-bottom: 3px;
    }
    .NewsPlace .GalleryNews .Data .AddData
    {
        clear: both; float: left;
        width: 100%;
        font-size: 12px;
        color:#0088c7;

        margin-bottom: 10px;
    }
    .NewsPlace .GalleryNews .Data p
    {
        clear: both; float: left;
        width: 100%;
        font-size: 14px;
    }
    .NewsPlace .GalleryNews .Data p a
    {
        color: #0088c7;
        text-decoration: none;
    }
    .NewsPlace .GalleryNews .Data p a:hover
    {
        text-decoration: underline;
    }

    /*
    Book Place
    */
    .BookPlace
    {
        clear: both; float: left;
        width: 100%;
        margin-bottom: 50px;
    }
    .BookPlace .GalleryBook
    {
        clear: both; float: left;
        width: 100%;
    }
    .BookPlace .GalleryBook .Data
    {
        float: left;
        margin-right: 15px;
        margin-bottom: 15px;
        padding: 5px;
        border: 2px dotted #ffffff;
    }
    .BookPlace .GalleryBook .Data img
    {
        float: left;
        width: 90px; height: 110px;
        background-color: #ffffff;
    }
    .BookPlace .GalleryBook .Data .Arrow
    {
        clear: both; float:left;
        position: absolute;
        opacity: 0;

        margin-top: 110px;

        border-bottom: 20px solid #0088c7; 
        border-right: 20px solid transparent; 
        border-top: 0px solid  transparent; 
    }
    .BookPlace .GalleryBook .Data .Name
    {
        clear: both; float:left;
        position: absolute;
        opacity: 0;

        padding: 3px;
        font-size: 15px;
        background-color: #0088c7;

        text-decoration: none;
        color:#ffffff;

        margin-left: -90px;
        margin-top: 130px;
    }
    .BookPlace .GalleryBook .Data:hover .Arrow
    {
        opacity: 1;
        -webkit-transition: 0.5s;
        -moz-transition: 0.5s;
        transition: 0.5s;
    }
    .BookPlace .GalleryBook .Data:hover .Name
    {
        opacity: 1;
        -webkit-transition: 0.5s;
        -moz-transition: 0.5s;
        transition: 0.5s;
    }

    .CommentPlace
    {
        clear: both; float: left;
        width: 94%;
        padding: 3%;

        background-color: #3a3a3a;
        color:#ffffff;

        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }
    .CommentPlace .GalleryComment
    {
        clear: both; float: left;
        width: 100%;
    }
    .CommentPlace .GalleryComment .Data
    {
        clear: both; float: left;
        width: 100%;
        margin-bottom: 10px;
    }
    .CommentPlace .GalleryComment .Name
    {
        float: left;
        font-size: 14px;
        margin-bottom: 8px;

        margin-right: 10px;
    }
    .CommentPlace .GalleryComment .Date
    {
        float: left;
        font-size: 14px;

        color: #1adb00;
    }
    .CommentPlace .GalleryComment p
    {
        clear: both; float: left;
        width: 100%;
        padding-left: 1%;
        font-size: 15px;
        border-left: 2px solid #1adb00;
    }
</style>

<?php
ob_flush();
?>
