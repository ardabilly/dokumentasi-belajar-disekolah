<?php 
ob_start();

class Class_Book
{
	function string_Set_BookID()
	{
	 $q = 0;

    include 'DatabaseString.php';

    $s_Query = " select BookID from Book_Data order by BookID desc limit 1 ";
    $Query = mysqli_query($conn,$s_Query);

    if($Query)
    {
        while ($DataRow = mysqli_fetch_array($Query))
        {
            $q = str_replace("\'", "'", $DataRow[0]);//Column BookID
        }
    }
    else if(!$Query)
    {
        echo "<span style='clear:both;float:left;'>"
        . "Class_Book -> string_Set_BookID<br/>"
        . $conn->error ."<br/>"
        . $s_Query ."<br/>"
        . "</span>";
    }

    mysqli_close($conn);

    $q++;//increment by one
    return $q;

	}

	function bool_Check_BookID($s_BookID)
    {
        $q = false;

        $s_BookID = addslashes($s_BookID);

        include 'DatabaseString.php';

        $s_Query = " Select *from Book_Data where BookID =  '$s_BookID' ";
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
            . "Class_Book -> bool_Check_BookID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function array_Get_AllBookType_FromBookData()
    {
    	$q = array();
    	$i_Index = 0;

    	include"DatabaseString.php";

    	$s_Query = " select distinct Types from Book_Data order by Types asc ";
    	$Query = mysqli_query($conn,$s_Query);

    	if ($Query) {
    		while ($DataRow = mysqli_fetch_array($Query))
    		{
    			$q[$i_Index] = str_replace("/'","'",$DataRow[0]);//Types
    			$i_Index++;
    		}
    	}
    	elseif (!$Query) {
		 echo "<span style='clear:both;float:left;'>"
        . "Class_Book -> array_Get_AllBookType_FromBookData<br/>"
        . $conn->error ."<br/>"
        . $s_Query ."<br/>"
        . "</span>";

    	}
    	mysqli_close($conn);

    	return $q;
    }

    function array_Get_Publisher_FromBookData()
    {
        $q = array();
        $i_Index = 0;

        include 'DatabaseString.php';

        $s_Query = " Select distinct Publisher from Book_Data order by Publisher asc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index] = str_replace("\'", "'", $DataRow[0]);//Types
                $i_Index++;
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> array_Get_Publisher_FromBookData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function bool_Insert_BookData($s_BookID, $s_Name, $s_Types, $s_FinesPerDay, $s_Loaned, $s_ComeDate, $s_Writer, $s_Publisher, $s_NumberOfPage, $s_Synopsis, $s_Donation, $s_Price, $s_NumberOfGood, $s_NumberOfBroken, $s_NumberOfMissing)
    {
        $q = false;

        $s_BookID = addslashes($s_BookID);
        $s_Name = addslashes($s_Name);
        $s_Types = addslashes($s_Types);
        $s_FinesPerDay = addslashes($s_FinesPerDay);
        $s_Loaned = addslashes($s_Loaned);
        $s_ComeDate = addslashes($s_ComeDate);
        $s_Writer = addslashes($s_Writer);
        $s_Publisher = addslashes($s_Publisher);
        $s_NumberOfPage = addslashes($s_NumberOfPage);
        $s_Synopsis = addslashes($s_Synopsis);
        $s_Donation = addslashes($s_Donation);
        $s_Price = addslashes($s_Price);
        $s_NumberOfGood = addslashes($s_NumberOfGood);
        $s_NumberOfBroken = addslashes($s_NumberOfBroken);
        $s_NumberOfMissing = addslashes($s_NumberOfMissing);

        include 'DatabaseString.php';

        $s_Query = " INSERT INTO Book_Data "
                . " Values ( '$s_BookID', '$s_Name', '$s_Types', '$s_FinesPerDay', '$s_Loaned', '$s_ComeDate', '$s_Writer', '$s_Publisher', '$s_NumberOfPage', '$s_Synopsis', '$s_Donation', '$s_Price', '$s_NumberOfGood', '$s_NumberOfBroken', '$s_NumberOfMissing', '0')  ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> bool_Insert_DataPeople<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function bool_Update_BookData($s_BookID, $s_Name, $s_Types, $s_FinesPerDay, $s_Loaned, $s_ComeDate, $s_Writer, $s_Publisher, $s_NumberOfPage, $s_Synopsis, $s_Donation, $s_Price, $s_NumberOfGood, $s_NumberOfBroken, $s_NumberOfMissing)
    {
        $q = false;

        $s_BookID = addslashes($s_BookID);
        $s_Name = addslashes($s_Name);
        $s_Types = addslashes($s_Types);
        $s_FinesPerDay = addslashes($s_FinesPerDay);
        $s_Loaned = addslashes($s_Loaned);
        $s_ComeDate = addslashes($s_ComeDate);
        $s_Writer = addslashes($s_Writer);
        $s_Publisher = addslashes($s_Publisher);
        $s_NumberOfPage = addslashes($s_NumberOfPage);
        $s_Synopsis = addslashes($s_Synopsis);
        $s_Donation = addslashes($s_Donation);
        $s_Price = addslashes($s_Price);
        $s_NumberOfGood = addslashes($s_NumberOfGood);
        $s_NumberOfBroken = addslashes($s_NumberOfBroken);
        $s_NumberOfMissing = addslashes($s_NumberOfMissing);

        include 'DatabaseString.php';

        $s_Query = " UPDATE Book_Data "
                . " Set Name = '$s_Name', Types ='$s_Types', FinesPerDay = '$s_FinesPerDay', Loaned = '$s_Loaned', ComeDate ='$s_ComeDate', "
                . "     Writer = '$s_Writer', Publisher = '$s_Publisher', NumberOfPage = '$s_NumberOfPage', Synopsis = '$s_Synopsis',  Donation = '$s_Donation', Price = '$s_Price', "
                . "     NumberOfGood = '$s_NumberOfGood', NumberOfBroken = '$s_NumberOfBroken', NumberOfMissing = '$s_NumberOfMissing'  "
                . " where BookID = '$s_BookID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> bool_Update_DataPeople<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Delete_BookData($s_BookID)
    {
        $q = false;

        $s_BookID = addslashes($s_BookID);
        include 'DatabaseString.php';

        $s_Query = " Delete from Book_Data "
                . " where BookID = '$s_BookID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> bool_Delete_BookData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function array_Get_AllBookID_ByName($s_Search)
    {
        $q = array();
        $i_Index = 0;

        $s_Search = addslashes($s_Search);

        include 'DatabaseString.php';

        $s_Query = " SELECT BookID "
                . " From Book_Data "
                . " where Name like '%$s_Search%' or Types like '%$s_Search%' or convert(FinesPerDay,char) like '%$s_Search%' or Loaned like '%$s_Search%' or ComeDate like '%$s_Search%' or "
                . "         Writer like '%$s_Search%' or Publisher like '%$s_Search%' or Convert(NumberOfPage,char) like '%$s_Search%' or Synopsis like '%$s_Search%' or "
                . "         Donation like '%$s_Search%' or convert(Price,char) like '%$s_Search%' or "
                . "         convert(NumberOfGood,char) like '%$s_Search%' or Convert(NumberOfBroken,char) like '%$s_Search%' or convert(NumberOfMissing,char) like '%$s_Search%' "
                . " order by Name asc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index] = str_replace("\'", "'", $DataRow[0]);//BookID
                $i_Index++;
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> array_Get_AllBookID_ByName<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function array_Get_AllBookID_ByDate($s_Search)
    {
        $q = array();
        $i_Index = 0;

        $s_Search = addslashes($s_Search);

        include 'DatabaseString.php';

        $s_Query = " SELECT BookID "
                . " From Book_Data "
                . " where Name like '%$s_Search%' or Types like '%$s_Search%' or convert(FinesPerDay,char) like '%$s_Search%' or Loaned like '%$s_Search%' or ComeDate like '%$s_Search%' or "
                . "         Writer like '%$s_Search%' or Publisher like '%$s_Search%' or Convert(NumberOfPage,char) like '%$s_Search%' or Synopsis like '%$s_Search%' or "
                . "         Donation like '%$s_Search%' or convert(Price,char) like '%$s_Search%' or "
                . "         convert(NumberOfGood,char) like '%$s_Search%' or Convert(NumberOfBroken,char) like '%$s_Search%' or convert(NumberOfMissing,char) like '%$s_Search%' "
                . " order by ComeDate desc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index] = str_replace("\'", "'", $DataRow[0]);//BookID
                $i_Index++;
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> array_Get_AllBookID_ByDate<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function array_Get_AllDataBook($s_BookID)
    {
        $q = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");

        $s_BookID = addslashes($s_BookID);

        include 'DatabaseString.php';

        $s_Query = " SELECT BookID, Name, Types, FinesPerDay, Loaned, ComeDate, Writer, Publisher, NumberOfPage, Synopsis, Donation, Price, NumberOfGood, NumberOfBroken, NumberOfMissing, CountOfLoaned "
                . " From Book_Data "
                . " where BookID = '$s_BookID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[0] = str_replace("\'", "'", $DataRow[0]);//BookID
                $q[1] = str_replace("\'", "'", $DataRow[1]);//Name
                $q[2] = str_replace("\'", "'", $DataRow[2]);//Types
                $q[3] = str_replace("\'", "'", $DataRow[3]);//FinesPerDay
                $q[4] = str_replace("\'", "'", $DataRow[4]);//Loaned
                $q[5] = str_replace("\'", "'", $DataRow[5]);//ComeDate
                $q[6] = str_replace("\'", "'", $DataRow[6]);//Writer
                $q[7] = str_replace("\'", "'", $DataRow[7]);//Publisher
                $q[8] = str_replace("\'", "'", $DataRow[8]);//NumberOfPage
                $q[9] = str_replace("\'", "'", $DataRow[9]);//Synopsis
                $q[10] = str_replace("\'", "'", $DataRow[10]);//Donation
                $q[11] = str_replace("\'", "'", $DataRow[11]);//Price
                $q[12] = str_replace("\'", "'", $DataRow[12]);//NumberOfGood
                $q[13] = str_replace("\'", "'", $DataRow[13]);//NumberOfBroken
                $q[14] = str_replace("\'", "'", $DataRow[14]);//NumberOfMissing
                $q[15] = str_replace("\'", "'", $DataRow[15]);//CountOfLoaned

            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> array_Get_AllDataBook<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function string_Set_ImageBook($s_BookID, $s_PathFolder)
    {
        $q = "";

        $s_Image = $s_PathFolder . "images/Global/book.png";
        /*
         * default image
         */

        $array_Extension = array("jpg","png","bmp","jpeg","gif");
        for($var1 = 0; $var1 < count($array_Extension); $var1++)
        {
            /*
             * mencari gambar yang sesuai dengan book id
             */
            $s_FileName = $s_PathFolder . "Images/Book/" . $s_BookID . ".".$array_Extension[$var1];
            if(file_exists($s_FileName))
            {
                $s_Image = $s_FileName;
                break;
            }
        }
        $q = $s_Image;

        return $q;
    }
    function bool_Delete_ImageBook($s_BookID, $s_PathFolder)
    {
        $q = false;

        $s_Image = "";

        $array_Extension = array("jpg","png","bmp","jpeg","gif");
        for($var1 = 0; $var1 < count($array_Extension); $var1++)
        {
            /*
             * mencari gambar yang sesuai dengan book id
             */
            $s_FileName = $s_PathFolder . "images/book/" . $s_BookID . ".".$array_Extension[$var1];
            if(file_exists($s_FileName))
            {
                $s_Image = $s_FileName;
                unlink($s_Image);
                $q = true;
                break;
            }
        }

        return $q;
    }

    /*
     * Book Storage
     */

    function bool_Manage_BookReturned($s_BookID, $s_Quantity, $column_Name)
    {
        $array_DataBook = $this->array_Get_AllDataBook($s_BookID);

        $get_Data = "";
        if($column_Name === "NumberOfGood")
            $get_Data = $array_DataBook[12];
        else if($column_Name === "NumberOfBroken")
            $get_Data = $array_DataBook[13];
        else if($column_Name === "NumberOfMissing")
            $get_Data = $array_DataBook[14];


        $s_NumberOfGood = intval($get_Data) + intval($s_Quantity);
        $s_CountOfBook = intval($array_DataBook[15]) - intval($s_Quantity);

        return $this->bool_Update_BookLoaned($s_BookID, $s_NumberOfGood, $s_CountOfBook, $column_Name);
    }
    function bool_Manage_BookLoaned($s_BookID, $s_Quantity)
    {
        $array_DataBook = $this->array_Get_AllDataBook($s_BookID);

        $s_NumberOfGood = intval($array_DataBook[12]) - intval($s_Quantity);
        $s_CountOfLoaned = intval($array_DataBook[15]) + intval($s_Quantity);

        return $this->bool_Update_BookLoaned($s_BookID, $s_NumberOfGood, $s_CountOfLoaned, "NumberOfGood");
    }
    function bool_Update_BookLoaned($s_BookID, $s_NumberOfGood, $s_CountOfBook, $column_Name)
    {
        $q = false;

        $s_BookID = addslashes($s_BookID);
        $s_NumberOfGood = addslashes($s_NumberOfGood);
        $s_CountOfBook = addslashes($s_CountOfBook);

        include 'DatabaseString.php';

        $s_Query = " Update Book_Data "
                . " set CountOfLoaned = '$s_CountOfBook', $column_Name = '$s_NumberOfGood' "
                . " Where BookID = '$s_BookID' ";
        $Query = mysqli_query($conn,$s_Query);


        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> bool_Update_BookLoaned<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function bool_Insert_BookStorage($s_BookID, $s_Floor, $s_Corridor, $s_Rack, $s_Level)
    {
        $q = false;

        $s_BookID = addslashes($s_BookID);
        $s_Floor = addslashes($s_Floor);
        $s_Corridor = addslashes($s_Corridor);
        $s_Rack = addslashes($s_Rack);
        $s_Level = addslashes($s_Level);

        include 'DatabaseString.php';

        $s_Query = " INSERT INTO Book_Storage "
                . " Values ( '$s_BookID', '$s_Floor', '$s_Corridor', '$s_Rack', '$s_Level' )  ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> bool_Insert_BookStorage<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Update_BookStorage($s_BookID, $s_Floor, $s_Corridor, $s_Rack, $s_Level)
    {
        $q = false;

        $s_BookID = addslashes($s_BookID);
        $s_Floor = addslashes($s_Floor);
        $s_Corridor = addslashes($s_Corridor);
        $s_Rack = addslashes($s_Rack);
        $s_Level = addslashes($s_Level);

        include 'DatabaseString.php';

        $s_Query = " Update Book_Storage "
                . " set Floor = '$s_Floor', Corridor = '$s_Corridor', Rack = '$s_Rack', Level = '$s_Level' "
                . " Where BookID = '$s_BookID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> bool_Update_BookStorage<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function array_Get_AllDataBookStorage($s_BookID)
    {
        $q = array("", "", "", "", "");

        $s_BookID = addslashes($s_BookID);

        include 'DatabaseString.php';

        $s_Query = " SELECT BookID, Floor, Corridor, Rack, Level "
                . " From Book_Storage "
                . " where BookID = '$s_BookID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[0] = str_replace("\'", "'", $DataRow[0]);//BookID
                $q[1] = str_replace("\'", "'", $DataRow[1]);//Floor
                $q[2] = str_replace("\'", "'", $DataRow[2]);//Corridor
                $q[3] = str_replace("\'", "'", $DataRow[3]);//Rack
                $q[4] = str_replace("\'", "'", $DataRow[4]);//Level                
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> array_Get_AllDataBookStorage<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function array_Get_AllFloor_FromBookDataStorage()
    {
        $q = array();
        $i_Index = 0;

        include 'DatabaseString.php';

        $s_Query = " Select distinct Floor from Book_Storage order by Floor asc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index] = str_replace("\'", "'", $DataRow[0]);//Types
                $i_Index++;
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> array_Get_AllFloor_FromBookDataStorage<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function array_Get_AllCorridor_FromBookDataStorage()
    {
        $q = array();
        $i_Index = 0;

        include 'DatabaseString.php';

        $s_Query = " Select distinct Corridor from Book_Storage order by Corridor asc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index] = str_replace("\'", "'", $DataRow[0]);//Types
                $i_Index++;
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> array_Get_AllCorridor_FromBookDataStorage<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function array_Get_AllRack_FromBookDataStorage()
    {
        $q = array();
        $i_Index = 0;

        include 'DatabaseString.php';

        $s_Query = " Select distinct Rack from Book_Storage order by Rack asc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index] = str_replace("\'", "'", $DataRow[0]);//Types
                $i_Index++;
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Book -> array_Get_AllRack_FromBookDataStorage<br/>"
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