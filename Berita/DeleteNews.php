<?php


/*
 * News ID digunakan sebagai primary key database
 * keberadaannya tidak perlu diketahui client
 * tetapi perlu diketahui oleh developer.
 * News ID diambil dari parameter url ID
 * dan akan menhapus berdasarkan News ID
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

if(!$b_Check_NewsID)
{
    echo "<script>alert('ID tidak ada, tidak bisa menghapus data ini');</script>";
    echo "<script>window.location.href='index.php';</script>";
    /*
     * jika id nya tidak ada
     * maka akan dipaksa ke halamana index
     */
}
else if($b_Check_NewsID)
{
    $s_Query = " Delete from News_Data where NewsID = '$s_NewsID' ";
    //echo "<span style='clear:both; float:left;'>$s_Query</span>";
    $Query = mysqli_query($conn,$s_Query);
    mysqli_close($conn);
    if($Query)
    {
        /* menghapus data image */
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
        
    }
    
    
    echo "<script>alert('Data telah dihapus');</script>";
    echo "<script>window.location.href='index.php';</script>";
    
}
?> 
