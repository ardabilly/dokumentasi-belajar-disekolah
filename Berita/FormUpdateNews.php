<?php
$s_ErrorMessage = "";

$s_TitleNews = "";
if(isset($_POST["txt_TitleNews"]) && strlen(trim($_POST["txt_TitleNews"])) != 0)
{
    $s_TitleNews = trim($_POST["txt_TitleNews"]);
    /*
     * untuk mendapatkan data dari object html
     * yang ber name txt_TitleNews
     */
}

$s_Writer = "";
if(isset($_POST["txt_Writer"]) && strlen(trim($_POST["txt_Writer"])) != 0)
{
    $s_Writer = trim($_POST["txt_Writer"]);
    /*
     * untuk mendapatkan data dari object html
     * yang ber name txt_Writer
     */
}

$s_NewsValue = "";
if(isset($_POST["txt_NewsValue"]) && strlen(trim($_POST["txt_NewsValue"])) != 0)
{
    $s_NewsValue = trim($_POST["txt_NewsValue"]);
    /*
     * untuk mendapatkan data dari object html
     * yang ber name txt_NewsValue
     */
}

$s_DatePosting ="";
if (isset($_POST["txt_DatePosting"]) && strlen(trim($_POST["txt_DatePosting"])) !=0) 
{
  $s_DatePosting = trim($_POST["txt_DatePosting"]);
}


/*
 * News ID digunakan sebagai primary key database
 * keberadaannya tidak perlu diketahui client
 * tetapi perlu diketahui oleh developer.
 * News ID diambil dari parameter url ID
 */

$s_NewsID = "";
$b_Check_NewsID = false;

if(isset($_GET["id"]) && strlen(trim($_GET["id"])) != 0)
    $s_NewsID = trim($_GET["id"]);

if(strlen($s_NewsID)==0)
{
    /*
     * jika news id ga ada
     * maka tidak bisa melakukan update
     * bisa lakukan pembalikan
     */
    echo "<script>window.location.href='index.php';</script>";
}

include_once './DatabaseString.php';
$s_Query = " select *from News_Data where NewsID = '$s_NewsID' ";
//echo "<span style='clear:both; float:left;'>$s_Query</span>";
$Query = mysqli_query($conn,$s_Query);

if($Query)
{
    $b_Check_NewsID = true;
    mysqli_free_result($Query);
}


/*
 * variable image
 */

$s_Image = "";

if(!isset($_POST["btn_Submit"]) && $b_Check_NewsID)
{
    /*
     * jika data tidak disubmit
     * artinya pada saat data d load.
     */
    
    $s_Query = " select NewsID, Title, NewsValue, DatePosting, Writer from News_Data where NewsID = '$s_NewsID' ";
    //echo "<span style='clear:both; float:left;'>$s_Query</span>";
    $Query = mysqli_query($conn,$s_Query);

    if($Query)
    {
        while ($DataRow = mysqli_fetch_array($Query))
        {
            $s_TitleNews = $DataRow[1];
            $s_NewsValue = $DataRow[2];
            $s_DatePosting = $DataRow[3];
            $s_Writer = $DataRow[4];
        }
        mysqli_free_result($Query);
    }
}

/*
 * pada button submit di click
 */


$b_Validation = true;
if(isset($_POST["btn_Submit"]))
{
    /*
     * divalidasiin dulu, satu - satu data pemasukkannya
     */
    
    if(strlen($s_TitleNews) == 0)
    {
        /*
         * jika title news kosong
         */
        $s_ErrorMessage .= "Please field title news<br/>";
        $b_Validation = false;
    }
    
    if(strlen($s_Writer) == 0)
    {
        /*
         * jika writer kosong
         */
        $s_ErrorMessage .= "Please field the witer<br/>";
        $b_Validation = false;
    }
    
    if(strlen($s_NewsValue) == 0)
    {
        /*
         * jika news value kosong
         */
        $s_ErrorMessage .= "Please field news value<br/>";
        $b_Validation = false;
    }
    
    if(is_uploaded_file($_FILES["file_Data"]["tmp_name"]))
    {
        $acceptable = array(
            'image/jpeg',
            'image/jpg',
            'image/gif',
            'image/png'
            );

        /*
         * akan menvalidasi apakah file yang dimasukkan
         * image atau bukan
         */
        
        if(!in_array($_FILES['file_Data']['type'], $acceptable) && (!empty($_FILES["file_Data"]["type"])))
        {
            $s_ErrorMessage .= "The file for image is incorrect. Please use only gif, png or jpg!<br/>";
            $b_Validation = FALSE;
        }
    
        //memeriksa size image
        $d_Size = $_FILES["file_Data"]["tmp_name"];
        $d_Size = doubleval($d_Size);

        if($d_Size > (40 * 1024 * 1024))
        {
            $s_ErrorMessage .= "Your file more 40 mb, can not allowed<br/>";
            $b_Validation = FALSE;
        }

    }
    
    if($b_Validation)
    {
        /*
         * jika tidak terjadi kesalahan
         */
        
        /*
         * addslashes
         * untuk mengubah data dalam bentuk string yang
         * diizinkan oleh mysql
         */
        $s_NewsID = addslashes($s_NewsID);
        $s_TitleNews = addslashes($s_TitleNews);
        $s_NewsValue = addslashes($s_NewsValue);
        $s_Writer = addslashes($s_Writer);
        $s_DatePosting = addslashes($s_DatePosting);
        
        /*
         * query update
         */
        $s_Query = " Update News_Data set Title = '$s_TitleNews', NewsValue = '$s_NewsValue', Writer = '$s_Writer', DatePosting = '$s_DatePosting' where NewsID = '$s_NewsID' ";
        //echo "<span style='clear:both; float:left;'>$s_Query</span>";
        $Query = mysqli_query($conn,$s_Query);
        mysqli_close($conn);
        if($Query)
        {
            if(is_uploaded_file($_FILES["file_Data"]["tmp_name"]))
            {
                /*
                 * hapus terlebih dahulu data gambar yang lama
                 */
                $s_ImageLocation = "";

                $array_Extension = array("jpg","png","bmp","jpeg","gif");
                for($var1 = 0; $var1 < count($array_Extension); $var1++)
                {
                    $s_FileName = "images/".$s_NewsID .".".$array_Extension[$var1];
                    if(file_exists($s_FileName))
                    {
                        $s_ImageLocation = $s_FileName;
                        break;
                    }
                }
                
                if(strlen($s_ImageLocation)!=0)
                {
                    unlink($s_ImageLocation);
                    //data dihapus
                }
                /*
                 * memindahkan file image ke server
                 * mengganti nama file image sesuia
                 * dengan news id
                 */
                $s_Image = "Images/".$s_NewsID.".". pathinfo($_FILES["file_Data"]["name"], PATHINFO_EXTENSION);
                
                $fileTmpLoc = $_FILES['file_Data']['tmp_name'];
                $pathAndName = "" . $s_Image;
                $moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
            }
            
            echo "<script>window.location.href='readnews.php?id=$s_NewsID'</script>";
            /*
             * jika data berhasil dimasukkan
             * maka akan berpindah halaman
             */
        }
        else
        {
            /*
             * jika data gagal dimasukkan kedalam database
             */
            $s_ErrorMessage = "Can not update this data";
        }
        
        
    }
}

?>
<html>
    <head>
        <title>Update News</title>
        
        <link rel="stylesheet" type="text/css" href="BodyTop.css" />
        <link rel="stylesheet" type="text/css" href="BodyCenter.css" />
    </head>
    <body>
        
        <?php
        include_once './BodyTop.php';
        ?>
        
        <div class="BodyCenter">
            
            <div class="Form">
                <style>
                    .Form .Lable
                    {
                        width: 130px;
                    }
                </style>
                <form action="" method="post" enctype="multipart/form-data" name="form_Manage">
                    <div class="Row">
                        <span class="TitleName">Form Update News</span>
                    </div>
                    <div class="Row">
                        <span class="ErrorMessage"><?=$s_ErrorMessage?></span>
                    </div>
                    <div class="Row">
                        <span class="Lable">Title News</span>
                        <input type="text" name="txt_TitleNews" class="TextBox" value="<?=$s_TitleNews?>" />
                    </div>

                    <div class="Row">
                        <span class="Lable">Writer</span>
                        <input type="text" name="txt_Writer" class="TextBox" value="<?=$s_Writer?>" />
                    </div>

                    <div class="Row">
                        <span class="Lable">News Value</span>
                        <textarea name="txt_NewsValue" class="TextBox_Large" ><?=$s_NewsValue?></textarea>
                    </div>
                    
                    <div class="Row">
                        <span class="Lable">Image</span>
                        <input type="file" name="file_Data" class="TextBox" />
                    </div>

                    <div class="Row">
                        <span class="Lable">DatePosting</span>
                        <input type="text" name="txt_DatePosting" class="TextBox" value="<?=Date('d-m-Y' , strtotime($s_DatePosting) )?>" />
                    </div>

                    <div class="Row">
                        <input type="submit" name="btn_Submit" class="ButtonSubmit" value="Submit" />
                        <span>&nbsp;</span>
                        <input type="reset" class="ButtonReset" value="Reset" />
                    </div>
                    
                </form>
            </div>
            
        </div>
        
    </body>
</html>
