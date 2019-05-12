<html>
    <head>
        <title>Read News</title>
        
        <link rel="stylesheet" type="text/css" href="BodyTop.css" />
        <link rel="stylesheet" type="text/css" href="BodyCenter.css" />
    </head>
    <body>
        
        <?php
        include_once './BodyTop.php';
        ?>
        
        <div class="BodyCenter">

            <?php
            $s_NewsID = $_GET["id"];
            /*
             * mengambil ID dari paremeter
             * dengan GET
             */
            $s_Title = "";
            $s_NewsValue = "";
            $s_DatePosting = "";
            $s_Writer = "";
            
            include_once './DatabaseString.php';
            $s_Query = " select NewsID, Title, NewsValue, DatePosting, Writer from News_Data where NewsID = '$s_NewsID' ";
            //echo "<span style='clear:both; float:left;'>$s_Query</span>";
            $Query = mysqli_query($conn,$s_Query);

            if($Query)
            {
                while ($DataRow = mysqli_fetch_array($Query))
                {
                    $s_Title = $DataRow[1];
                    $s_NewsValue = $DataRow[2];
                    $s_DatePosting = $DataRow[3];
                    $s_Writer = $DataRow[4];
                }
                mysqli_free_result($Query);
            }
            mysqli_close($conn);
            
            /*
             * cara membuat enter
             */
            
            $array_NewsValue = explode(chr(13), $s_NewsValue);
            /*
             * pecah $s_NewsValue menjadi array
             * dibagi dengan pemisah enter (char(13))
             */

            if (count($array_NewsValue) > 0)
            {
                $array_NewsValue = " ";
                for ($var = 0; $var < count($array_NewsValue); $var++)
                    $s_NewsValue .= $array_NewsValue[$var] . "<br/>";
            }
            
            /*
             * cara mendapatkan gambar
             */
            
            $s_Image = "";

            $array_Extension = array("jpg","png","bmp","jpeg","gif");
            for($var1 = 0; $var1 < count($array_Extension); $var1++)
            {
                $s_FileName = "images/".$s_NewsID .".".$array_Extension[$var1];
                if(file_exists($s_FileName))
                {
                    $s_Image = $s_FileName;
                    break;
                }
            }
            if(strlen($s_Image)!=0)
            {
                $s_Image = "<img src='$s_Image' />";
            }

            
            ?>
            
            <div class="NewsData">
                <span class="TitleNews"><?=$s_Title?></span>
                <span class="AddNote"><?= date("l, F d, Y h:i:s",  strtotime($s_DatePosting))?>, by <?=$s_Writer?></span>
                <?=$s_Image?>
                <p><?=$s_NewsValue?></p>
            </div>
            
            <style>
                .NewsData
                {
                    clear: both; float: left;
                    width: 100%;
                    
                    margin-top: 50px;
                }
                .NewsData .TitleNews
                {
                    clear: both; float: left;
                    font-size: 30px;
                    
                    font-family: cursive;
                }
                .NewsData .AddNote
                {
                    clear: both; float: left;
                    font-size: 12px;
                }
                .NewsData img
                {
                    clear: both; float: left;
                    width: 500px;
                    margin-top: 10px;
                }
                .NewsData p
                {
                    clear: both; float: left;
                    font-size: 18px;
                    
                    margin-top: 20px;
                }
            </style>
            
            <div class="Form" style="margin-top: 20px;">
                <div class="Row">
                    <input type="button" class="ButtonSubmit" onclick="window.location.href='FormUpdateNews.php?id=<?=$s_NewsID?>';" value="Update" />
                    <span>&nbsp;</span>
                    <a class="ButtonReset" href="DeleteNews.php?id=<?=$s_NewsID?>" onclick="return confirm('Are you sure want to delete this data');" >Delete</a>
                    <span>&nbsp;</span>
                </div>
            </div>
            
        </div>
        
    </body>
</html>
