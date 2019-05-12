<?php
ob_start();

class Class_JadwalHarian 
{
    function bool_Check_ValidateDate($date, $format = 'Y-m-d H:i:s')
    {
        /*
         * validasi input tanggal
         */
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    
    function string_Set_DateTimeNow()
    {
        //UTC + 6 jam
        $s_DateTimeNow = date("Y-m-d H:i:s");
        $dt_DateTimeNow = strtotime($s_DateTimeNow) + (6*3600);
        
        return date("Y-m-d H:i:s", $dt_DateTimeNow);
    }
    
    function array_Set_DayName()
    {
        return array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    }  
    function array_Get_FileData()
    {
        $file_FileName = "Data.txt";
        $array_DailyData = array("", "", "", "", "", "", "");
        /*
         * buatlah array, dengan index 7.
         * sesuai dengan jumlah  hari
         */
        $i_Index = 0;
        /*
         * untuk indexing array
         */
        
        //pengambilan data
        $b_Check = fopen ($file_FileName, "r");
        while ($s_Value = fgets ($b_Check)) 
        {
            $array_DailyData[$i_Index] = $s_Value;
            $i_Index++;
        }
        fclose($b_Check);
        
        return $array_DailyData;
    }
    function bool_Set_FileData($array_Data)
    {
        $file = fopen("Data.txt","w");
        $s_Value = "";
        for($var = 0; $var < count($array_Data); $var++)
        {
            $s_Value1 = $array_Data[$var];
            if(ord(substr($s_Value1, strlen($s_Value1) - 2, 1)) != 13)
            {
                /*
                 * check validate jika character terakhir
                 * bukan ascii 13, maka ditambahkan asci 13
                 * untuk membuat enter
                 */
                $s_Value1 .= chr(13).chr(10);
            }
            
            $s_Value .= $s_Value1;
        }
        fwrite($file, $s_Value);
        fclose($file);
        
        return true;
    }
    
    
}

ob_flush();
?>
