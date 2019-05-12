<html>
    <head>
        <title>Jadwal Harian</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php

        include_once './Class_JadwalHarian.php';
        $c_JadwalHarian = new Class_JadwalHarian();
        
        $array_DailyActivitiy = $c_JadwalHarian->array_Get_FileData();
        $array_DayName = $c_JadwalHarian->array_Set_DayName();
        
        $s_DateTimeNow = $c_JadwalHarian->string_Set_DateTimeNow();
        $dt_DateTimeNow = strtotime($s_DateTimeNow);
        $s_DateNow = explode(" ", $s_DateTimeNow)[0];
        $s_DayNameNow = date("l", $dt_DateTimeNow);
        
        ?>
        <div class="GalleryDaily">
        <?php
        
        for($var = 0; $var < count($array_DailyActivitiy); $var++)
        {
            $s_DayName = $array_DayName[$var];
            $s_DailyActivitiy = $array_DailyActivitiy[$var];
            $array_DailyActivitiyDetail = explode(";", $s_DailyActivitiy);
            /*
             * pada saat pembuatan data
             * pemisah antara kegiatan adalah 
             * simbol titik koma ( ; )
             */

            /*
             * pisahkan sesuai dengan hari
             */
            
            /*
             * design memunculkan sesuai dengan hari
             */
            $s_Style = "";
            if(isset($_GET["view"]) && $_GET["view"] === "Today" && $s_DayNameNow === $s_DayName)
            {
                $s_Style = " style='background-color:#006ec3;' ";
            }

            ?>
            <div class="Data">
                <div class="DayName" <?=$s_Style?> ><?=$array_DayName[$var]?></div>
                <?php
                /*
                 * kenapa dikurang satu?
                 * karena pada saat pembuatan terdapat titik koma ( ; )
                 * diakhir
                 */
                for($var1 = 0; $var1 < count($array_DailyActivitiyDetail) - 1; $var1++)
                {
                    $s_DailyActivitiyDetail = $array_DailyActivitiyDetail[$var1];
                    $array_ActivityDetail = explode("~", $s_DailyActivitiyDetail);
                    
                    $s_ActivityTime = $array_ActivityDetail[0];
                    $s_ActivityName = $array_ActivityDetail[1];

                    //====================================
                    $array_ActivityTime = explode("-", $s_ActivityTime);
                    /*
                     * pemisahan antara kedua waktu
                     * menggunakan simbol strip ( - )
                     */
                    $s_ActivityTime1 = $array_ActivityTime[0];
                    $s_ActivityTime2 = $array_ActivityTime[1];

                    /*
                     * memberika initial date
                     * sesuai dengan tanggal sekarang
                     * tetapi waktunya disesuaikan dengan
                     * time activity
                     */

                    $s_DateTimeActivity1 = $s_DateNow . " " . $s_ActivityTime1;
                    $s_DateTimeActivity2 = $s_DateNow . " " . $s_ActivityTime2;

                    $dt_DateTimeActivity1 = strtotime($s_DateTimeActivity1);
                    $dt_DateTimeActivity2 = strtotime($s_DateTimeActivity2);
                    /*
                     * design memunculkan sesuai dengan hari
                     */

                    $s_Style = "";
                    if(isset($_GET["view"]) && $_GET["view"] === "Today" && $s_DayNameNow === $s_DayName)
                    {
                        $s_Style = " style='background-color:#ffffff; color:#000000; padding:4px; border:1px solid #000000;' ";
                    }

                    /*
                     * design memunculkan sesuai jam sekarang
                     */

                    if(isset($_GET["view"]) && $_GET["view"] === "Now")
                    {
                        if($dt_DateTimeActivity1 <= $dt_DateTimeNow && $dt_DateTimeNow <= $dt_DateTimeActivity2)
                        {
                            /*
                             * jika waktu activity awal
                             * kurang dari sama dengan waktu sekarang
                             * dan
                             * waktu sekarang 
                             * kurang dari sama dengan waktu
                             * activity yang kedua
                             */
                            $s_Style = " style='background-color:#ffffff; color:#000000; padding:4px; border:1px solid #000000;' ";
                        }
                    }

                    
                    
                    ?>
                    <div class="Daily" <?=$s_Style?> >
                        <?=$s_ActivityName?>
                        <br/>
                        <?=  substr($s_ActivityTime1, 0, 5)?> - <?=  substr($s_ActivityTime2, 0, 5)?>
                    </div>
                    <?php
                }
                ?>
                <a href="edit.php?i=<?=$var?>">edit</a>
            </div>            
            <?php
        }
        ?>
        </div>
        <div class="Form">
            <input type="button" class="Button" value="Default" onclick="window.location.href='index.php';" />
            <!-- Tidak memunculkan apa - apa -->
            
            <input type="button" class="Button" value="Today" onclick="window.location.href='index.php?view=Today';" />
            <!-- Memunculkan sesuai dengan hari -->
            
            <input type="button" class="Button" value="Now" onclick="window.location.href='index.php?view=Now';" />
            <!-- Memunculkan sesuai jam -->
        </div>

    </body>
</html>
