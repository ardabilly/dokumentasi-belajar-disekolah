<?php
ob_start();
class Class_Member
{
    /*
     * Member Data
     */

    function string_Set_MemberID()
    {
        $q = "";

        $q = $this->string_Get_LastMemberID();
        $q = intval($q);
        /*
         * Column MemberID
         * bentuknnya adalah varchar
         * kita rubah menjadi integer
         * pakai code intvar()
         */

        for($var = 0; $var < 2; $var++)
        {
            /*
             * kita melakukan perulangan untuk
             * mencheck MemberID saat membuat
             * MemberID
             */

            $q++;//increment by one
            $q = str_pad($q, 10, "0", STR_PAD_LEFT);
            /*
             * str_pad()
             * Param 1 : dari param
             * Param 2 : jumlah character yang dibutuhkan
             * Param 3 : character untuk mengisi kekosongan
             * Param 4 : disi sebelah mana
             */

            if($this->bool_Check_MemberID($q))
            {
                $var--;
                /*
                 * jika member id ini sudah ada
                 * maka ulang perulangan 
                 * dengan cara decrement var
                 */
            }
            else 
            {
                break;
                /*
                 * jika member id belum ada
                 * maka akan stop perulangan
                 * dan mengambalikan member id
                 * yang dibuat
                 */
            }    
        }

        return $q;
    }

    function string_Get_LastMemberID()
    {
        $q = 0;

        include 'DatabaseString.php';

        $s_Query = " select MemberID from Member_Data order by MemberID desc limit 1 ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q = str_replace("\'", "'", $DataRow[0]);//Column MemberID
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> string_Set_MemberID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);
        return $q;
    }
    function bool_Check_MemberID($s_MemberID)
    {
        $q = false;

        $s_MemberID = addslashes($s_MemberID);

        include 'DatabaseString.php';

        $s_Query = " Select *from Member_Data where MemberID =  '$s_MemberID' ";
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
            . "Class_Member -> bool_Check_MemberID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function bool_Insert_MemberData($s_MemberID, $s_FullName, $s_Gender, $s_Religion, $s_PlaceOfBirth, $s_DateOfBirth, $s_PhoneNumber, $s_Email, $s_Address)
    {
        $q = false;

        $s_MemberID = addslashes($s_MemberID);
        $s_FullName = addslashes($s_FullName);
        $s_Gender = addslashes($s_Gender);
        $s_Religion = addslashes($s_Religion);
        $s_PlaceOfBirth = addslashes($s_PlaceOfBirth);
        $s_DateOfBirth = addslashes($s_DateOfBirth);
        $s_PhoneNumber = addslashes($s_PhoneNumber);
        $s_Email = addslashes($s_Email);
        $s_Address = addslashes($s_Address);

        include 'DatabaseString.php';

        $s_Query = " INSERT INTO Member_Data "
                . " Values ( '$s_MemberID', '$s_FullName', '$s_Gender', '$s_Religion', '$s_PlaceOfBirth', '$s_DateOfBirth', '$s_PhoneNumber', '$s_Email', '$s_Address' )  ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> bool_Insert_MemberData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Update_MemberData($s_MemberID, $s_FullName, $s_Gender, $s_Religion, $s_PlaceOfBirth, $s_DateOfBirth, $s_PhoneNumber, $s_Email, $s_Address)
    {
        $q = false;

        $s_MemberID = addslashes($s_MemberID);
        $s_FullName = addslashes($s_FullName);
        $s_Gender = addslashes($s_Gender);
        $s_Religion = addslashes($s_Religion);
        $s_PlaceOfBirth = addslashes($s_PlaceOfBirth);
        $s_DateOfBirth = addslashes($s_DateOfBirth);
        $s_PhoneNumber = addslashes($s_PhoneNumber);
        $s_Email = addslashes($s_Email);
        $s_Address = addslashes($s_Address);

        include 'DatabaseString.php';

        $s_Query = " Update Member_Data "
                . " set FullName = '$s_FullName', Gender = '$s_Gender', Religion = '$s_Religion', "
                . "     PlaceOfBirth = '$s_PlaceOfBirth', DateOfBirth = '$s_DateOfBirth', PhoneNumber = '$s_PhoneNumber', Email = '$s_Email', Address = '$s_Address' "
                . " where MemberID = '$s_MemberID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> bool_Update_MemberData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Delete_MemberData($s_MemberID)
    {
        $q = false;

        $s_MemberID = addslashes($s_MemberID);

        include 'DatabaseString.php';

        $s_Query = " Delete from Member_Data "
                . " where MemberID = '$s_MemberID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> bool_Delete_MemberData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function array_Get_DataMember($s_MemberID)
    {
        $q = array("", "", "", "", "", "", "", "", "");

        $s_MemberID = addslashes($s_MemberID);

        include 'DatabaseString.php';

        $s_Query = " SELECT MemberID, FullName, Gender, Religion, PlaceOfBirth, DateOfBirth, PhoneNumber, Email, Address "
                . " FROM Member_Data "
                . " where MemberID = '$s_MemberID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[0] = str_replace("\'", "'", $DataRow[0]);//MemberID
                $q[1] = str_replace("\'", "'", $DataRow[1]);//FullName
                $q[2] = str_replace("\'", "'", $DataRow[2]);//Gender
                $q[3] = str_replace("\'", "'", $DataRow[3]);//Religion
                $q[4] = str_replace("\'", "'", $DataRow[4]);//PlaceOfBirth
                $q[5] = str_replace("\'", "'", $DataRow[5]);//DateOfBirth
                $q[6] = str_replace("\'", "'", $DataRow[6]);//PhoneNumber
                $q[7] = str_replace("\'", "'", $DataRow[7]);//Email
                $q[8] = str_replace("\'", "'", $DataRow[8]);//Address
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Emplyee -> array_Get_DataMember<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function array_Get_AllMemberID($s_Search)
    {
        $q = array();
        $i_Index = 0;

        $s_Search = addslashes($s_Search);

        include 'DatabaseString.php';

        $s_Query = " SELECT MemberID "
                . " From Member_Data "
                . " where (MemberID like '%$s_Search%' or FullName like '%$s_Search%' or Gender like '%$s_Search%' or Religion like '%$s_Search%' or "
                . "         PlaceOfBirth like '%$s_Search%' or DateOfBirth like '%$s_Search%' or PhoneNumber like '%$s_Search%' or Email like '%$s_Search%' or "
                . "         Address like '%$s_Search%' ) "
                . " order by FullName asc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index] = str_replace("\'", "'", $DataRow[0]);//MemberID
                $i_Index++;
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> array_Get_AllMemberID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    /*
     * Member Borrrow
     */

    function string_Set_BorrowID()
    {
        $q = 0;

        include 'DatabaseString.php';

        $s_Query = " select BorrowID from Member_Borrow order by BorrowID desc limit 1 ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q = str_replace("\'", "'", $DataRow[0]);//Column BorrowID
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Borrow -> string_Set_BorrowID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        $q++;//increment by one
        return $q;
    }
    function bool_Check_BorrowID($s_BorrowID)
    {
        $q = false;

        $s_BorrowID = addslashes($s_BorrowID);

        include 'DatabaseString.php';

        $s_Query = " Select *from Member_Borrow where BorrowID =  '$s_BorrowID' ";
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
            . "Class_Member -> bool_Check_BorrowID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function array_Get_AllBorrowID($s_Search)
    {
        $q = array();
        $i_Index = 0;

        $s_Search = addslashes($s_Search);

        include 'DatabaseString.php';

        $s_Query = " SELECT BorrowID "
                . " From Member_Borrow a join Member_Data b on a.MemberID = b.MemberID "
                . "     Join Employee_Data c on a.EmployeeID = c.EmployeeID "
                . " where b.FullName like '%$s_Search%' or c.FullName like '%$s_Search%' or "
                . "     a.BorrowDate like '%$s_Search%' or a.ReturnDate like '%$s_Search%'  "
                . " order by a.BorrowDate desc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index] = str_replace("\'", "'", $DataRow[0]);//MemberID
                $i_Index++;
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> array_Get_AllBorrowID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function array_Get_DataBorrow($s_BorrowID)
    {
        $q = array("", "", "", "", "");

        $s_BorrowID = addslashes($s_BorrowID);

        include 'DatabaseString.php';

        $s_Query = " SELECT BorrowID, MemberID, EmployeeID, BorrowDate, ReturnDate FROM Member_Borrow "
                . " where BorrowID = '$s_BorrowID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[0] = str_replace("\'", "'", $DataRow[0]);//BorrowID
                $q[1] = str_replace("\'", "'", $DataRow[1]);//MemberID
                $q[2] = str_replace("\'", "'", $DataRow[2]);//EmployeeID
                $q[3] = str_replace("\'", "'", $DataRow[3]);//BorrowDate
                $q[4] = str_replace("\'", "'", $DataRow[4]);//ReturnDate
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Emplyee -> array_Get_DataBorrow<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function bool_Insert_BorrowData($s_BorrowID, $s_MemberID, $s_EmployeeID, $s_BorrowDate, $s_ReturnDate)
    {
        $q = false;

        $s_BorrowID = addslashes($s_BorrowID);
        $s_MemberID = addslashes($s_MemberID);
        $s_EmployeeID = addslashes($s_EmployeeID);
        $s_BorrowDate = addslashes($s_BorrowDate);
        $s_ReturnDate = addslashes($s_ReturnDate);

        include 'DatabaseString.php';

        $s_Query = " INSERT INTO Member_Borrow "
                . " Values ( '$s_BorrowID', '$s_MemberID', '$s_EmployeeID', '$s_BorrowDate', '$s_ReturnDate' )  ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> bool_Insert_BorrowData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Update_BorrowData($s_BorrowID, $s_MemberID, $s_EmployeeID, $s_BorrowDate, $s_ReturnDate)
    {
        $q = false;

        $s_BorrowID = addslashes($s_BorrowID);
        $s_MemberID = addslashes($s_MemberID);
        $s_EmployeeID = addslashes($s_EmployeeID);
        $s_BorrowDate = addslashes($s_BorrowDate);
        $s_ReturnDate = addslashes($s_ReturnDate);

        include 'DatabaseString.php';

        $s_Query = " Update Member_Borrow "
                . " set MemberID = '$s_MemberID', EmployeeID = '$s_EmployeeID', BorrowDate = '$s_BorrowDate', ReturnDate = '$s_ReturnDate' "
                . " where BorrowID = '$s_BorrowID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> bool_Update_BorrowData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Delete_BorrowData($s_BorrowID)
    {
        $q = false;

        $s_BorrowID = addslashes($s_BorrowID);

        include 'DatabaseString.php';

        $s_Query = " Delete from Member_Borrow "
                . " where BorrowID = '$s_BorrowID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> bool_Delete_BorrowData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    /*
     * Book Borrrow 
     */

    function bool_Insert_BorrowBookData($s_BorrowID, $s_BookID, $s_Quantity, $s_FinesPerDay, $s_FinesPrice, $s_ReturnDate)
    {
        $q = false;

        $s_BorrowID = addslashes($s_BorrowID);
        $s_BookID = addslashes($s_BookID);
        $s_Quantity = addslashes($s_Quantity);
        $s_FinesPerDay = addslashes($s_FinesPerDay);
        $s_FinesPrice = addslashes($s_FinesPrice);
        $s_ReturnDate = addslashes($s_ReturnDate);

        include 'DatabaseString.php';

        $s_Query = "INSERT INTO Book_Borrow Values ( '$s_BorrowID', '$s_BookID', '$s_Quantity', '$s_FinesPerDay', '$s_FinesPrice', 'Borrow', '$s_ReturnDate', '0', '0', '0' ) ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> bool_Insert_BorrowBookData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Delete_BorrowBookData($s_BorrowID, $s_BookID)
    {
        $q = false;

        $s_BorrowID = addslashes($s_BorrowID);
        $s_BookID = addslashes($s_BookID);

        include 'DatabaseString.php';

        $s_Query = "Delete from Book_Borrow "
                . " where BorrowID = '$s_BorrowID' and BookID = '$s_BookID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> bool_Insert_BorrowBookData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Update_BorrowBookData($s_BorrowID, $s_BookID, $s_ReturnDate, $s_Status, $s_GoodReturn, $s_BrokenReturn, $s_MissingReturn)
    {
        $q = false;

        $s_BorrowID = addslashes($s_BorrowID);
        $s_BookID = addslashes($s_BookID);
        $s_ReturnDate = addslashes($s_ReturnDate);
        $s_Status = addslashes($s_Status);
        $s_GoodReturn = addslashes($s_GoodReturn);
        $s_BrokenReturn = addslashes($s_BrokenReturn);
        $s_MissingReturn = addslashes($s_MissingReturn);

        include 'DatabaseString.php';

        $s_Query = "Update Book_Borrow "
                . " set ReturnDate = '$s_ReturnDate', Status = '$s_Status', GoodReturn = '$s_GoodReturn', BrokenReturn = '$s_BrokenReturn', MissingReturn = '$s_MissingReturn' "
                . " where BorrowID = '$s_BorrowID' and BookID = '$s_BookID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Member -> bool_Insert_BorrowBookData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function array_Get_BorrowBookData($s_BorrowID)
    {
        $q = array();
        $i_Index = 0;
        $s_BorrowID = addslashes($s_BorrowID);

        include 'DatabaseString.php';

        $s_Query = " SELECT a.BookID, b.Name, a.Quantity, a.FinesPerDay, a.FinesPrice, a.Status, a.ReturnDate, GoodReturn, BrokenReturn, MissingReturn FROM Book_Borrow"
                . " a join Book_Data b on a.BookID = b.BookID "
                . " where BorrowID = '$s_BorrowID' "
                . " order by b.Name asc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index][0] = str_replace("\'", "'", $DataRow[0]);//BookID
                $q[$i_Index][1] = str_replace("\'", "'", $DataRow[1]);//Name
                $q[$i_Index][2] = str_replace("\'", "'", $DataRow[2]);//Quantity
                $q[$i_Index][3] = str_replace("\'", "'", $DataRow[3]);//FinesPerDay
                $q[$i_Index][4] = str_replace("\'", "'", $DataRow[4]);//FinesPrice
                $q[$i_Index][5] = str_replace("\'", "'", $DataRow[5]);//Status
                $q[$i_Index][6] = str_replace("\'", "'", $DataRow[6]);//ReturnDate
                $q[$i_Index][7] = str_replace("\'", "'", $DataRow[7]);//GoodReturn
                $q[$i_Index][8] = str_replace("\'", "'", $DataRow[8]);//BrokenReturn
                $q[$i_Index][9] = str_replace("\'", "'", $DataRow[9]);//MissingReturn

                $i_Index++;
                /*
                 * created multi dimension array
                 */
            }

        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Emplyee -> array_Get_BorrowBookData<br/>"
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
