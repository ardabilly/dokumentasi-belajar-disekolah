<?php
    echo date("Y ");//tahun
    echo date("m ");//bulan angka
    echo date("d ");//hari angka
    echo date("H ");//jam
    echo date("i ");//menit
    echo date("s ");//detik
    echo date("l ");//nama hari
    echo date("M ");//nama bulan di singkat
    echo date("F ");//nama bulan full
    echo date("A ");//Am/Pm
    
    echo date("H:i:s A ")."<br/>";
    
    echo date("l, ");
    echo date("F, ");
    echo date("d, ");
    echo date("Y  ");
    echo date("H:i:s A ")."<br/>";
    
    $day = date("D");
    switch ($day)
    {
        case 'Sun': $hari = "Minggu"; break;
        case 'Mon': $hari = "Senin"; break;
        case 'Tue': $hari = "Selasa"; break;
        case 'Wed': $hari = "Rabu"; break;
        case 'Thu': $hari = "Kamis"; break;
        case 'Fri': $hari = "Jum'at"; break;
        case 'Sat': $hari = "Sabtu"; break;
        default   : $hari = "Kiamat";         
    }
    $mon = date ("M");
    switch ($mon)
     {
        case 'Jan': $bulan = "januari"; break;
        case 'Feb': $bulan = "Febwari"; break;
        case 'Mar': $bulan = "Maret"; break;
        case 'Apr': $bulan = "April"; break;
        case 'May': $bulan = "Mei"; break;
        case 'Jun': $bulan = "juni"; break;
        case 'Jul': $bulan = "Juli"; break;
        case 'Aug': $bulan = "Agustus"; break;
        case 'Sep': $bulan = "September"; break;
        case 'Oct': $bulan = "Oktober"; break;
        case 'Nov': $bulan = "November"; break;
        case 'Dec': $bulan = "Desember"; break;
        default   : $bulan = "Kiamat";
    }
    echo "$hari, $bulan ";
    echo date("d, Y H:i:s A ")."<br/>";
    
    $inputDate ="1923-04-11 00:00:00";
    $inputDate =strtotime($inputDate);
    echo date("l, F d, Y H:i:s A",$inputDate);
    
?>
