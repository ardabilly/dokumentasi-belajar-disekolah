<?php
ob_start();

class Class_People 
{
    /*
     * People Data
     */
    
    function string_Set_PeopleID()
    {
        $q = 0;
        
        include 'DatabaseString.php';
 
        $s_Query = " select PeopleID from People_Data order by PeopleID desc limit 1 ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q = str_replace("\'", "'", $DataRow[0]);//Column PeopleID
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> string_Set_PeopleID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        $q++;//increment by one
        return $q;
    }
    
    function bool_Insert_PeopleData($s_PeopleID, $s_FullName)
    {
        $q = false;
        
        $s_PeopleID = addslashes($s_PeopleID);
        $s_FullName = addslashes($s_FullName);
        
        include 'DatabaseString.php';
 
        $s_Query = " Insert into People_Data values ('$s_PeopleID', '$s_FullName', '', '', '', '', CURRENT_TIMESTAMP(), '', '', '') ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> bool_Insert_DataPeople<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        return $q;
    }
    function bool_Update_PeopleData($s_PeopleID, $s_FullName, $s_NickName, $s_Gender, $s_Religion, $s_PlaceOfBirth, $s_DateOfBirth, $s_PhoneNumber, $s_Email, $s_Address)
    {
        $q = false;
        
        $s_PeopleID = addslashes($s_PeopleID);
        $s_FullName = addslashes($s_FullName);
        $s_NickName = addslashes($s_NickName);
        $s_Gender = addslashes($s_Gender);
        $s_Religion = addslashes($s_Religion);
        $s_PlaceOfBirth = addslashes($s_PlaceOfBirth);
        $s_DateOfBirth = addslashes($s_DateOfBirth);
        $s_PhoneNumber = addslashes($s_PhoneNumber);
        $s_Email = addslashes($s_Email);
        $s_Address = addslashes($s_Address);
        
        
        include 'DatabaseString.php';
 
        $s_Query = " Update People_Data "
                . " set FullName = '$s_FullName', NickName = '$s_NickName', Gender = '$s_Gender', Religion = '$s_Religion', "
                . "     PlaceOfBirth = '$s_PlaceOfBirth', DateOfBirth = '$s_DateOfBirth', "
                . "     PhoneNumber = '$s_PhoneNumber', Email = '$s_Email', Address = '$s_Address' "
                . " where PeopleID = '$s_PeopleID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> bool_Update_PeopleData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        return $q;
    }
    
    function string_Set_PeopleImage($s_PeopleID)
    {
        $q = "";
        
        $s_Image = "images/icon/user.png";
        /*
         * default image
         */

        $array_Extension = array("jpg","png","bmp","jpeg","gif");
        for($var1 = 0; $var1 < count($array_Extension); $var1++)
        {
            /*
             * mencari gambar yang sesuai dengan people id
             */
            $s_FileName = "images/user/" . $s_PeopleID . ".".$array_Extension[$var1];
            if(file_exists($s_FileName))
            {
                $s_Image = $s_FileName;
                break;
            }
        }
        $q = $s_Image;
        
        return $q;
    }
    
    function array_Get_DataPeople($s_PeopleID)
    {
        $q = array("", "", "", "", "", "", "", "", "", "");
        /*
         * Membuat data array sesuai
         * jumlah data yang ada pada data.
         * Ini membuat 10 index array.
         * Karena yang digunukana ada 10 column
         */
        
        $s_PeopleID = addslashes($s_PeopleID);
        
        include 'DatabaseString.php';
 
        $s_Query = " SELECT PeopleID, FullName, NickName, Gender, Religion, PlaceOfBirth, DateOfBirth, PhoneNumber, Email, Address "
                . " FROM People_Data "
                . " where PeopleID = '$s_PeopleID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[0] = str_replace("\'", "'", $DataRow[0]);//Column PeopleID
                $q[1] = str_replace("\'", "'", $DataRow[1]);//Column FullName
                $q[2] = str_replace("\'", "'", $DataRow[2]);//Column NickName
                $q[3] = str_replace("\'", "'", $DataRow[3]);//Column Gender
                $q[4] = str_replace("\'", "'", $DataRow[4]);//Column Religion
                $q[5] = str_replace("\'", "'", $DataRow[5]);//Column PlaceOfBirth
                $q[6] = str_replace("\'", "'", $DataRow[6]);//Column DateOfBirth
                $q[7] = str_replace("\'", "'", $DataRow[7]);//Column PhoneNumber
                $q[8] = str_replace("\'", "'", $DataRow[8]);//Column Email
                $q[9] = str_replace("\'", "'", $DataRow[9]);//Column Address
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> array_Get_DataPeople<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        return $q;
    }
    
    /*
     * People Login
     */
    
    function bool_Check_Username($s_Username, $s_PeopleID)
    {
        $q = false;
        
        $s_Username = addslashes($s_Username);
        $s_PeopleID = addslashes($s_PeopleID);
        
        include 'DatabaseString.php';
 
        $s_Query = " Select *from People_Login where Usernames =  '$s_Username' and PeopleID != '$s_PeopleID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $DataRow = mysqli_fetch_array($Query);
            if($DataRow > 0)
                $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> bool_Check_Username<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        return $q;
    }
    function bool_Insert_PeopleLogin($s_PeopleID, $s_Username, $s_Password)
    {
        $q = false;
        
        $s_PeopleID = addslashes($s_PeopleID);
        $s_Username = addslashes($s_Username);
        
        $s_Password = base64_encode(md5($s_Password, true));
        /*
         * untuk merubah password
         * menjadi string yang tidak diketahui
         * bentuk karakteristik dari si pengguna
         */
        $s_Password = addslashes($s_Password);
        
        include 'DatabaseString.php';
 
        $s_Query = " Insert into People_Login values ('$s_PeopleID', '$s_Username', '$s_Password') ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> bool_Insert_PeopleLogin<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        return $q;
    }
    
    function bool_Check_PeopleLogin($s_Username, $s_Password)
    {
        $q = false;
        
        $s_Username = addslashes($s_Username);        
        $s_Password = base64_encode(md5($s_Password, true));
        $s_Password = addslashes($s_Password);
        
        include 'DatabaseString.php';
 
        $s_Query = " Select *from People_Login where Usernames =  '$s_Username' and Passwords = '$s_Password' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $DataRow = mysqli_fetch_array($Query);
            if($DataRow > 0)
                $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> bool_Check_PeopleLogin<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        return $q;
    }
    function bool_Check_PeopleLogin_ByPassword($s_PeopleID, $s_Password)
    {
        $q = false;
        
        $s_PeopleID = addslashes($s_PeopleID);
        $s_Password = base64_encode(md5($s_Password, true));
        $s_Password = addslashes($s_Password);
        
        include 'DatabaseString.php';
 
        $s_Query = " Select *from People_Login where Passwords = '$s_Password' and PeopleID = '$s_PeopleID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $DataRow = mysqli_fetch_array($Query);
            if($DataRow > 0)
                $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> bool_Check_PeopleLogin_ByPassword<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        return $q;
    }
    function string_Get_PeopleID($s_Username, $s_Password)
    {
        $q = "";
        
        $s_Username = addslashes($s_Username);        
        $s_Password = base64_encode(md5($s_Password, true));
        $s_Password = addslashes($s_Password);
        
        include 'DatabaseString.php';
 
        $s_Query = " Select PeopleID from People_Login where Usernames =  '$s_Username' and Passwords = '$s_Password' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q = str_replace("\'", "'", $DataRow[0]);//Column PeopleID
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> string_Get_PeopleID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        return $q;
    }
    
    function bool_Update_PeopleLogin_Username($s_PeopleID, $s_Username)
    {
        $q = false;
        
        $s_PeopleID = addslashes($s_PeopleID);
        $s_Username = addslashes($s_Username);
        
        
        include 'DatabaseString.php';
 
        $s_Query = " Update People_Login "
                . " set Usernames = '$s_Username' "
                . " where PeopleID = '$s_PeopleID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> bool_Update_PeopleLogin_Username<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        return $q;
    }
    function bool_Update_PeopleLogin_Password($s_PeopleID, $s_Password)
    {
        $q = false;
        
        $s_PeopleID = addslashes($s_PeopleID);
        $s_Password = base64_encode(md5($s_Password, true));
        $s_Password = addslashes($s_Password);
        
        
        include 'DatabaseString.php';
 
        $s_Query = " Update People_Login "
                . " set Passwords = '$s_Password' "
                . " where PeopleID = '$s_PeopleID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_People -> bool_Update_PeopleLogin_Password<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }
        
        mysqli_close($conn);
        
        return $q;
    }
}

ob_flush();
?>
