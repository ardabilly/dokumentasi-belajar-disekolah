<!DOCTYPE html>
<html>
<head>
	<title>jadwal</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
<?php

$array_pelajaran = array(
    array("Monday", "Upacara 07:00:00-07:30:00,Matematika 07:30:00-08:50:00,B.Inggris 08:50:00-10:10:00 2,Istirahat 10:10:00-10:30:00,Produktif 10:30:00-11:50:00,Istirahat 11:50:00-12:45:00,Produktif 12:45:00-15:25:00"),
    array("Tuesday", "Ngaji 07:00:00-07:30:00,Produktif 07:30:00-10:10:00,Istirahat 10:10:00-10:30:00,Kimia 10:30:00-11:50:00,Istirahat 11:50:00-12:45:00,PKN 12:45:00-14:00:00,B.Inggris 14:00:00-15:25:00"),
    array("Wednesday", "Ngaji 07:00:00-07:30:00,Produktif 07:30:00-10:10:00,Istirahat 10:10:00-10:30:00,Penjaskes 10:30:00-11:50:00,Istirahat 11:50:00-12:45:00,KKPI 12:45:00-14:00:00,Sbk 14:00:00-15:25:00"),
    array("Thursday", "Ngaji 07:00:00-07:30:00,B.Indonesia 07:30:00-08:50:00,Fisika 08:50:00-10:10:00,Istirahat 10:10:00-10:30:00,Mtk 10:30:00-11:50:00,Istirahat 11:50:00-12:45:00,Ips 12:45:00-14:00:00"),
    array("Friday", "Agama 07:00:00-08:30:00,Plh 08:30:00-10:10:00,Istirahat 10:10:00-10:30:00,Kwh 10:30:00-11:25:00"),
);

echo "<div class='Jadwal_Pelajaran'>";
for($x = 0; $x < count($array_pelajaran); $x++)
{
    $data_day = $array_pelajaran[$x][0];
    $day  = date("l");
    $date_now = date("Y-m-d");
    $s_DateTimeNow = date("Y-m-d H:i:s");
    $dt_DateTimeNow = strtotime($s_DateTimeNow) + (5 * 3600);
    
    $s_Jadwal = $array_pelajaran[$x][1];
    $array_Jadwal = explode(",", $s_Jadwal);
    
    echo "<div class='day'>";
    
    $BackgroundColor = "";
    if($data_day === $day && isset($_GET["view"]) && $_GET["view"]==="Today")
        $BackgroundColor = "style='background-color:red;'";
    
    echo "<div class='name' ".$BackgroundColor." >".$data_day."</div>";
    
    for($y = 0; $y < count($array_Jadwal); $y++)
    {
        $s_Pelajaran = $array_Jadwal[$y];
        $array_Pelajaran = explode(" ", $s_Pelajaran);
        
        $array_Waktu = explode("-", $array_Pelajaran[1]);
        
        $BackgroundColor = "";
        if($data_day === $day  && isset($_GET["view"]) && $_GET["view"]==="Today")
            $BackgroundColor = "style='background-color:green; color:#fff;'";
        
        if($data_day === $day  && isset($_GET["view"]) && $_GET["view"]==="Now")
        {
            $s_Datetime_Start = $date_now . " " . $array_Waktu[0];
            $s_Datetime_End = $date_now . " " . $array_Waktu[1];
            $dt_Datetime_Start = strtotime($s_Datetime_Start);
            $dt_Datetime_End = strtotime($s_Datetime_End);
            
            if($dt_Datetime_Start < $dt_DateTimeNow && $dt_DateTimeNow < $dt_Datetime_End)
                $BackgroundColor = "style='background-color:green; color:#fff; ; '";
        }
            
        
        echo "<div class='Pelajaran' ".$BackgroundColor.">";
        echo "<span class='Nama'>".$array_Pelajaran[0]."</span>";
        echo "<span class='Waktu'>".  substr($array_Waktu[0], 0, 5)." - " . substr($array_Waktu[1], 0, 5) . "</span>";
        echo "</div>";
    }
    echo "</div>";
    
}
echo "</div>";

?>
<input type="button" onclick="window.location.href='coba.php?view=Now'" value="Jadwal Sekarang"/>
<input type="button" onclick="window.location.href='coba.php?view=Today'" value="Jadwal Hari Ini"/><br/>

<?php
    $day = date("D");
        switch ($day) {
            case 'Sun': $hari = "Minggu ";
                break;
            case 'Mon': $hari = "Senin";
                break;
            case 'Tue': $hari = "Selasa";
                break;
            case 'Wed': $hari = "Rabu";
                break;
            case 'Thu': $hari = "Kamis";
                break;
            case 'Fri': $hari = "Jumat";
                break;
            case 'Sat': $hari = "Sabtu";
                break;
            default: $hari = "Kiamat";
                break;
}    
    echo "Hari : ".$hari;
    echo date(" , d-M-Y");

?>
</body>
</html>