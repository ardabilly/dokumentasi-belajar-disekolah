<?php
ob_start();

//==============================================================
// Class Management
//==============================================================

include_once 'Class_JadwalHarian.php';
$c_JadwalHarian = new Class_JadwalHarian();
$s_IndexDay = $_GET["i"];
$s_IndexArray = $_GET["ia"];

?>


<?php
        
$array_DailyData = $c_JadwalHarian->array_Get_FileData();

$s_DailyActivitiy = $array_DailyData[$s_IndexDay];
$array_DailyActivitiy = explode(";", $s_DailyActivitiy);
/*
 * pemisahan data menggunakan 
 * simbol titik koma ( ; )
 */

?>
<div class="GalleryDaily">
    <?php
    
    $string_DailyActivitiy = "";
    for($var = 0; $var < count($array_DailyActivitiy) - 1; $var++)
    {
        $s_DailyActivitiyDetail = $array_DailyActivitiy[$var];
        if($var !== intval($s_IndexArray))
            $string_DailyActivitiy .= $s_DailyActivitiyDetail . ";";
    }
    
    $array_DailyData[$s_IndexDay] = $string_DailyActivitiy;
    
    $c_JadwalHarian->bool_Set_FileData($array_DailyData);
    echo "<script>window.location.href='edit.php?i=$s_IndexDay';</script>";
    ?>
</div>
        

<?php
ob_flush();
?>