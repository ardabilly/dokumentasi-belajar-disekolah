<?php
ob_start();
class Class_Comment
{
    /*
     * Comment Data
     */
    function string_Set_CommentID()
    {
        $q = 0;

        include 'DatabaseString.php';

        $s_Query = " select CommentID from Comment_Data order by CommentID desc limit 1 ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q = str_replace("\'", "'", $DataRow[0]);//Column CommentID
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Comment -> string_Set_CommentID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        $q++;//increment by one
        return $q;
    }
    function bool_Check_CommentID($s_CommentID)
    {
        $q = false;

        $s_CommentID = addslashes($s_CommentID);

        include 'DatabaseString.php';

        $s_Query = " Select *from Comment_Data where CommentID =  '$s_CommentID' ";
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
            . "Class_Comment -> bool_Check_CommentID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }


    function bool_Insert_CommentData($s_CommentID, $s_Name, $s_CommentValue, $s_PhoneNumber, $s_Email)
    {
        $q = false;

        $s_CommentID = addslashes($s_CommentID);
        $s_Name = addslashes($s_Name);
        $s_CommentValue = addslashes($s_CommentValue);
        $s_PhoneNumber = addslashes($s_PhoneNumber);
        $s_Email = addslashes($s_Email);

        include 'DatabaseString.php';

        $s_Query = " INSERT INTO Comment_Data "
                . " Values ( '$s_CommentID', '$s_Name', '$s_CommentValue', CURRENT_TIMESTAMP(), '$s_PhoneNumber', '$s_Email' )  ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Comment -> bool_Insert_CommentData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Delete_CommentData($s_CommentID)
    {
        $q = false;

        $s_CommentID = addslashes($s_CommentID);
        include 'DatabaseString.php';

        $s_Query = " Delete from Comment_Data "
                . " where CommentID = '$s_CommentID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Comment -> bool_Delete_CommentData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function array_Get_AllCommentID($s_Search)
    {
        $q = array();
        $i_Index = 0;

        $s_Search = addslashes($s_Search);

        include 'DatabaseString.php';

        $s_Query = " SELECT CommentID "
                . " From Comment_Data "
                . " where Name like '%$s_Search%' or CommentValue like '%$s_Search%' or CommentDate like '%$s_Search%' "
                . " order by CommentDate desc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index] = str_replace("\'", "'", $DataRow[0]);//CommentID
                $i_Index++;
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Comment -> array_Get_AllCommentID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function array_Get_DataComment($s_CommentID)
    {
        $q = array("", "", "", "", "", "");

        $s_CommentID = addslashes($s_CommentID);

        include 'DatabaseString.php';

        $s_Query = " SELECT CommentID, Name, CommentValue, CommentDate, PhoneNumber, Email "
                . " From Comment_Data "
                . " where CommentID = '$s_CommentID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[0] = str_replace("\'", "'", $DataRow[0]);//CommentID
                $q[1] = str_replace("\'", "'", $DataRow[1]);//Name
                $q[2] = str_replace("\'", "'", $DataRow[2]);//CommentValue
                $q[3] = str_replace("\'", "'", $DataRow[3]);//CommentDate
                $q[4] = str_replace("\'", "'", $DataRow[4]);//Phone Number
                $q[5] = str_replace("\'", "'", $DataRow[5]);//Email
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Comment -> array_Get_DataComment<br/>"
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
