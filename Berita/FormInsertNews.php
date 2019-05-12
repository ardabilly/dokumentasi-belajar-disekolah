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

/*
 * tanggal posting, diambil pada saat memposting
 * atau menyimpan posting, jadi tanggal dan waktu akan
 * disesuaikan dengan database.
 * 
 * Kenapa harus database?
 * karena jika kita menyesuaikan tanggal sesuai dengan 
 * code PHP akan diambil sesuai dengan kompter masing - masing
 * dengan pengambilan UTC.
 * Maka nya waktu akan disesuaikan dengan database.
 */
$s_DatePosting = "";

include_once './DatabaseString.php';
$s_Query = "select CURRENT_TIMESTAMP()";
//echo "<span style='clear:both; float:left;'>$s_Query</span>";
$Query = mysqli_query($conn,$s_Query);

if($Query)
{
    while ($DataRow = mysqli_fetch_array($Query))
    {
        $s_DatePosting = $DataRow[0];
    }
    mysqli_free_result($Query);
}

/*
 * News ID digunakan sebagai primary key database
 * keberadaannya tidak perlu diketahui client
 * tetapi perlu diketahui oleh developer.
 * News ID akan dibuat secara otomatis,
 * News dibuat berdasarkan increment News ID sebelumnya
 */

$s_NewsID = "";

$s_Query = " select NewsID from News_Data order by NewsID desc limit 1 ";
//echo "<span style='clear:both; float:left;'>$s_Query</span>";
$Query = mysqli_query($conn,$s_Query);

if($Query)
{
    while ($DataRow = mysqli_fetch_array($Query))
    {
        $s_NewsID = $DataRow[0];
    }
    mysqli_free_result($Query);
}

/* 
 * setelah data terakhir diambil
 * maka akan di increment kan
 *  */
$s_ErrorMessage .= " NewsID sebelumnya ". $s_NewsID;
$s_NewsID++;
$s_ErrorMessage .= " NewsID baru " . $s_NewsID;
/*
 * variable image
 */

$s_Image = "";

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
        $s_DatePosting = addslashes($s_DatePosting);
        $s_Writer = addslashes($s_Writer);
        
        /*
         * query insert
         */
        $s_Query = " Insert into News_Data values ('$s_NewsID', '$s_TitleNews', '$s_NewsValue', '$s_DatePosting', '$s_Writer') ";
        //echo "<span style='clear:both; float:left;'>$s_Query</span>";
        $Query = mysqli_query($conn,$s_Query);
        mysqli_close($conn);
        if($Query)
        {
            if(is_uploaded_file($_FILES["file_Data"]["tmp_name"]))
            {
                /*
                 * memindahkan file image ke server
                 * mengganti nama file image sesuai
                 * dengan news id
                 */
                $s_Image = "Images/".$s_NewsID.".". pathinfo($_FILES["file_Data"]["name"], PATHINFO_EXTENSION);
                
                $fileTmpLoc = $_FILES['file_Data']['tmp_name'];
                $pathAndName = "" . $s_Image;
                $moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
            }
            
            echo "<script>window.location.href='index.php'</script>";
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
            $s_ErrorMessage = "Can not insert this data";
        }
        
        
    }
}

?>
<html>
    <head>
        <title>Insert News</title>
        
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
                        <span class="TitleName">Form Insert News</span>
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
                        <input type="submit" name="btn_Submit" class="ButtonSubmit" value="Submit" />
                        <span>&nbsp;</span>
                        <input type="reset" class="ButtonReset" value="Reset" />
                    </div>
                    
                </form>
            </div>
            
        </div>
        
    </body>
</html>
