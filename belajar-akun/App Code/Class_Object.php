<?php
ob_start();

class Class_Object 
{
    function array_AllGender() 
    {
        /*
         * Data Pilihan Gender
         */
        $q = array("Male", "Female");
        return $q;
    }
    
    function array_AllReligion() 
    {
        /*
         * Data Pilihan Religion
         */
        $q = array("Islam", "Khatolik", "Protestan", "Hindu", "Budha", "Konghucu", "Atheis");
        return $q;
    }
    
    function bool_Check_ValidateDate($date, $format = 'Y-m-d H:i:s')
    {
        /*
         * validasi input tanggal
         */
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    
    function double_Get_Age($s_DateValue)
    {
        /*
         * untuk menghitung umur tahun
         */
        $dt_1 = strtotime($s_DateValue);
        $dt_2 = strtotime(date("y-m-d H:i:s"));

        //$dt_1 = new DateTime(date("y-m-d H:i:s", $dt_1));
        //$dt_2 = new DateTime(date("y-m-d H:i:s", $dt_2));

        $Year1 = doubleval(date("Y", $dt_1));
        $Year2 = doubleval(date("Y", $dt_2));

        $Calc = $Year2 - $Year1;
        
        $Month1 = doubleval(date("m",$dt_1));
        $Month2 = doubleval(date("m",$dt_2));
        
        $Day1 = doubleval(date("d",$dt_1));
        $Day2 = doubleval(date("d",$dt_2));
        
        if($Month2 < $Month1)
            $Calc--;
        if($Month2 == $Month1 && $Day2 < $Day1)
            $Calc--;
        
        return $Calc;
    }
    
    function bool_Validation_HumanName($Value)
    {
        /*
         * validasi nama manusia
         */
        $q = true;
        $vn = array("1","2","3","4","5","6","7","8","9","0",
                              "`","~","!","@","#","$","%","^","&","*","(",")","_","+","=","[","]","{","}",
                       ";",":","\"","/","<",">","?","\\","|");

        for ($var = 0; $var < count($vn); $var++)
        {
            $b_Check = false;
            $b_Check = strpos($Value, $vn[$var]);
            
            if ($b_Check)
            {
                $q = false;
                break;
            }
        }

        return $q;
    }
    function bool_Validation_Numeric($Value)
    {
        /*
         * validasi nama numeric
         */
        $q = true;

        $vn = array("q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m",
                    "Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M",
                    "`","~","!","@","#","$","%","^","&","*","(",")","-","_","+","=","[","]","{","}",
                    ";",":","\"","'",",","/","<",">","?","\\","|");

        for ($var = 0; $var < count($vn); $var++)
        {
            $b_Check = false;
            $b_Check = strpos($Value, $vn[$var]);
            
            if ($b_Check)
            {
                
                $q = false;
                break;
            }
        }

        return $q;
    }
    function bool_Validation_PhoneNumber($Value)
    {
        /*
         * validasi phone number
         */
        $s_Regex_PhoneNumber = "/^[0]+[1-9]+[0-9]{6,20}$/";
        return preg_match($s_Regex_PhoneNumber, $Value);
    }
    
    function bool_Validation_Email($Value)
    {
        /*
         * validasi email
         */
        $s_Regex_Email = "/^([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$/";
        return preg_match($s_Regex_Email, $Value);
    }
    
    function string_Set_MessageBox($s_Value)
    {
        return "<script>alert('$s_Value');</script>";
    }
    function string_Set_RedirectPage($s_Page)
    {
        return "<script>window.location.href='$s_Page';</script>";
    }
}

ob_flush();
?>