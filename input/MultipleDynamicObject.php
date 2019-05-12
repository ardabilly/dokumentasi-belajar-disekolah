<html>
    <head>
        <title>Dynamic Text Box</title>
    </head>
    <body>
        <?php
        
        $i_Count = 10;
        $array_Gender = array("Male","Female");
        $array_Absensi = array("Hadir", "Sakit", "Alpha", "Izin",);
        $array_telat =array(" tapi telat");
        /*
         * jumlah pembuatan object
         */
        
        for($var = 0; $var < $i_Count; $var++)
        {
            $s_Name = "";
            
            $object_Name = "txt_Name".$var;
            $object_Name = str_replace(".", "_", $object_Name);
            $object_Name = str_replace(" ", "_", $object_Name);
            /*
             * name object nya, diikuti index nya
             */
            

            if(isset($_POST[$object_Name]))
                $s_Name = $_POST[$object_Name];

             $s_Gender = "";

            $object_Gender = "rd_Gender".$var;
            $object_Gender = str_replace(".", "_", $object_Gender);
            $object_Gender = str_replace(" ", "_", $object_Gender);
            /*
             * name object nya, diikuti index nya
             */

            if (isset($_POST[$object_Gender])) 
                $s_Gender = $_POST[$object_Gender];
            
            $s_Absensi = "";
            $object_Absensi = "rd_Absensi".$var;
            $object_Absensi = str_replace(".", "_", $object_Absensi);
            $object_Absensi = str_replace(" ", "_", $object_Absensi);
            /*
             * name object nya, diikuti index nya
             */
            if(isset($_POST[$object_Absensi]))
                $s_Absensi = $_POST[$object_Absensi];

            $s_telat = "";
            $object_telat = "ck_telat".$var;
            $object_telat = str_replace(".", "_", $object_telat);
            $object_telat = str_replace(" ", "_", $object_telat);
            /*
             * name object nya, diikuti index nya
             */
            if(isset($_POST[$object_telat]))
                $s_telat = $_POST[$object_telat];
            

            
            echo "Hai ".($var+1)." - " . $s_Name. ", $s_Absensi". "Gender " . $s_Gender. " , ".$s_telat."<br/>";
        }

        ?>
        
        <form action="" method="post" enctype="multipart/form-data" name="form_Manage">
            <?php
            for($var = 0; $var < $i_Count; $var++)
            {
                ?>
                Nama <?=$var+1?> : <input type="text" name="txt_Name<?=$var?>" />
                absensi
                <?php
                for($var1 = 0; $var1 < count($array_Absensi); $var1++)
                {
                    $s_Value = $array_Absensi[$var1];
                    ?>
                    <input type="radio" name="rd_Absensi<?=$var?>" value="<?=$s_Value?>" /><?=$s_Value?>
                    <?php
                }
                for ($i=0; $i <count($array_Gender) ; $i++) 
                {
                    $s_Value3 = $array_Gender[$i];
                    ?>
                    <input type="radio" name="rd_Gender<?=$var?>" value="<?=$s_Value3?>" /><?=$s_Value3?>
                    <?php
                }
                
                for($var2 = 0; $var2 < count($array_telat); $var2++)
                {
                    $s_Value2 = $array_telat[$var2];
                    ?>
                    <input type="checkbox" name="ck_telat<?=$var2?>" value="<?=$s_Value2?>" />telat
                    <?php
                }
                ?>
                <br/>
                <?php
            }
            ?>
            <br/>
            <input type="submit" name="btn_Submit" value="Submit" />
        </form>
    </body>
</html>