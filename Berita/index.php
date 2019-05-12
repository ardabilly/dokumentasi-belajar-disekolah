<?php
$s_Search = "";
if(isset($_GET["txt_Search"]))
    $s_Search = $_GET["txt_Search"];


?>
<html>
    <head>
        <title>News</title>
        
        <link rel="stylesheet" type="text/css" href="BodyTop.css" />
        <link rel="stylesheet" type="text/css" href="BodyCenter.css" />
    </head>
    <body>
        
        <?php
        include_once './BodyTop.php';
        ?>
        
        <div class="BodyCenter">
            <div class="GalleryNews">
                <?php
                include_once './DatabaseString.php';
                $s_Query = " select NewsID from News_Data where Title like '%$s_Search%' or NewsValue like '%$s_Search%' or Writer like '%$s_Search%' order by NewsID desc ";
                //echo "<span style='clear:both; float:left;'>$s_Query</span>";
                $Query = mysqli_query($conn,$s_Query);

                if($Query)
                {
                    while ($DataRow = mysqli_fetch_array($Query))
                    {
                        $s_NewsID = $DataRow[0];
                        $s_Title = "";
                        $s_NewsValue = "";
                        $s_DatePosting = "";
                        $s_Writer = "";
                        
                        $s_Query2 = " select NewsID, Title, NewsValue, DatePosting, Writer from News_Data where NewsID = '$s_NewsID' ";
                        //echo "<span style='clear:both; float:left;'>$s_Query</span>";
                        $Query2 = mysqli_query($conn,$s_Query2);
                        if($Query2)
                        {
                            while ($DataRow2 = mysqli_fetch_array($Query2))
                            {
                                $s_Title = $DataRow2[1];
                                $s_NewsValue = $DataRow2[2];
                                $s_DatePosting = $DataRow2[3];
                                $s_Writer = $DataRow2[4];
                            }
                        }
                        
                        ?>
                        <a href="readnews.php?id=<?=$s_NewsID?>" class="Data">
                            <span class="TitleNews"><?=$s_Title?></span>
                            <span class="Date"><?= date("l, F d, Y h:i:s",  strtotime($s_DatePosting))?></span>
                            <span class="Writer">, Writer <?=$s_Writer?></span>
                        </a>
                        <?php
                        
                        
                    }
                    mysqli_free_result($Query);
                }
                ?>
                
            </div>
            <style>
                .GalleryNews
                {
                    clear: both; float: left;
                    width: 100%;
                    
                    margin-top: 50px;
                }
                .GalleryNews .Data
                {
                    float: left;
                    margin-right: 10px;
                    padding: 5px;
                    margin-bottom: 10px;
                    text-decoration: none;
                    color:#000000;
                    background-color: #ffffff;
                }
                .GalleryNews .Data .TitleNews
                {
                    clear: both; float: left;
                    font-size: 20px;
                }
                .GalleryNews .Data .Date
                {
                    clear: both; float: left;
                    font-size: 13px;
                    
                    font-family: cursive;
                }
                .GalleryNews .Data .Writer
                {
                    float: left;
                    font-size: 13px;
                    
                    font-family: monospace;
                }
                .GalleryNews a
                {
                    clear: both; float: left;
                }
            </style>
            
        </div>
        
    </body>
</html>
