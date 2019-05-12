<?php
ob_start();

//==============================================================
// Class Management
//==============================================================

include_once 'Class_JadwalHarian.php';
$c_JadwalHarian = new Class_JadwalHarian();

$array_DayName = $c_JadwalHarian->array_Set_DayName();

$s_IndexDay = $_GET["i"];
$s_DayName = $array_DayName[$s_IndexDay];
/*
 * Mengambil nama sesuai dengan index
 */
?>

<div class="TitleContent">
    <div class="Arrow"></div>
    <span><?=$s_DayName?></span>                
</div>

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
    for($var = 0; $var < count($array_DailyActivitiy) - 1; $var++)
    {
        $s_DailyActivitiyDetail = $array_DailyActivitiy[$var];
        $array_DailyActivitiyDetail = explode("~", $s_DailyActivitiyDetail);
        /*
         * pemisahan menggunakan
         * simbol ( ~ ), pada nama kegiatan
         * dan waktu kegiatan
         */

        $s_NameActivity = $array_DailyActivitiyDetail[1];
        $s_TimeActivity = $array_DailyActivitiyDetail[0];

        //====================================
        $array_TimeActivity = explode("-", $s_TimeActivity);
        /*
         * pemisahan antara kedua waktu
         * menggunakan simbol strip ( - )
         */
        $s_TimeActivity1 = $array_TimeActivity[0];
        $s_TimeActivity2 = $array_TimeActivity[1];

        ?>
        <div class="Data1">
            <?=$var+1?>
            <a href="edit.php?i=<?=$s_IndexDay?>&ia=<?=$var?>&a=<?=$s_NameActivity?>&st=<?=$s_TimeActivity1?>&et=<?=$s_TimeActivity2?>">edit</a>
            <a href="delete.php?i=<?=$s_IndexDay?>&ia=<?=$var?>" onclick="return confirm('Are you sure want to delete');">delete</a>
            <br/>
            <?=$s_NameActivity?>
            <br/>
            <?=  substr($s_TimeActivity1, 0, 5) ?> - <?=substr($s_TimeActivity2, 0, 5) ?>
            <!-- substring digunakan untuk mengambil jam dan menit saja -->
        </div>
        <?php
    }
    ?>
</div>
        

<?php
ob_flush();
?>