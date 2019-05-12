<?php
ob_start();
class Class_News
{
    /*
     * News Data
     */
    function string_Set_NewsID()
    {
        $q = 0;

        include 'DatabaseString.php';

        $s_Query = " select NewsID from News_Data order by NewsID desc limit 1 ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q = str_replace("\'", "'", $DataRow[0]);//Column NewsID
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_News -> string_Set_NewsID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        $q++;//increment by one
        return $q;
    }
    function bool_Check_NewsID($s_NewsID)
    {
        $q = false;

        $s_NewsID = addslashes($s_NewsID);

        include 'DatabaseString.php';

        $s_Query = " Select *from News_Data where NewsID =  '$s_NewsID' ";
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
            . "Class_News -> bool_Check_NewsID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }


    function bool_Insert_NewsData($s_NewsID, $s_NewsTitle, $s_NewsValue, $s_EmployeeID)
    {
        $q = false;

        $s_NewsID = addslashes($s_NewsID);
        $s_NewsTitle = addslashes($s_NewsTitle);
        $s_NewsValue = addslashes($s_NewsValue);
        $s_EmployeeID = addslashes($s_EmployeeID);

        include 'DatabaseString.php';

        $s_Query = " INSERT INTO News_Data "
                . " Values ( '$s_NewsID', CURRENT_TIMESTAMP(), '$s_NewsTitle', '$s_NewsValue', '$s_EmployeeID')  ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_News -> bool_Insert_NewsData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Update_NewsData($s_NewsID, $s_NewsTitle, $s_NewsValue, $s_EmployeeID)
    {
        $q = false;

        $s_NewsID = addslashes($s_NewsID);
        $s_NewsTitle = addslashes($s_NewsTitle);
        $s_NewsValue = addslashes($s_NewsValue);
        $s_EmployeeID = addslashes($s_EmployeeID);

        include 'DatabaseString.php';

        $s_Query = " Update News_Data "
                . " Set NewsTitle = '$s_NewsTitle', NewsValue ='$s_NewsValue', EmployeeID = '$s_EmployeeID' "
                . " where NewsID = '$s_NewsID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_News -> bool_Update_NewsData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function bool_Delete_NewsData($s_NewsID)
    {
        $q = false;

        $s_NewsID = addslashes($s_NewsID);
        include 'DatabaseString.php';

        $s_Query = " Delete from News_Data "
                . " where NewsID = '$s_NewsID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_News -> bool_Delete_NewsData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }

    function array_Get_AllNewsID($s_Search)
    {
        $q = array();
        $i_Index = 0;

        $s_Search = addslashes($s_Search);

        include 'DatabaseString.php';

        $s_Query = " SELECT NewsID "
                . " From News_Data "
                . " where NewsTitle like '%$s_Search%' or NewsValue like '%$s_Search%' or DatePosting like '%$s_Search%' or EmployeeID like '%$s_Search%' "
                . " order by DatePosting desc ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[$i_Index] = str_replace("\'", "'", $DataRow[0]);//NewsID
                $i_Index++;
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_News -> array_Get_AllNewsID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function array_Get_DataNews($s_NewsID)
    {
        $q = array("", "", "", "", "");

        $s_NewsID = addslashes($s_NewsID);

        include 'DatabaseString.php';

        $s_Query = " SELECT NewsID, DatePosting, NewsTitle, NewsValue, EmployeeID  "
                . " From News_Data "
                . " where NewsID = '$s_NewsID' ";
        $Query = mysqli_query($conn,$s_Query);

        if($Query)
        {
            while ($DataRow = mysqli_fetch_array($Query))
            {
                $q[0] = str_replace("\'", "'", $DataRow[0]);//NewsID
                $q[1] = str_replace("\'", "'", $DataRow[1]);//DatePosting
                $q[2] = str_replace("\'", "'", $DataRow[2]);//NewsTitle
                $q[3] = str_replace("\'", "'", $DataRow[3]);//NewsValue
                $q[4] = str_replace("\'", "'", $DataRow[4]);//EmployeeID
            }
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_News -> array_Get_DataNews<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;
    }
    function string_Set_ImageNews($s_NewsID, $s_PathFolder)
    {
        $q = "";

        $s_Image = "";
        /*
         * default image
         */

        $array_Extension = array("jpg","png","bmp","jpeg","gif");
        for($var1 = 0; $var1 < count($array_Extension); $var1++)
        {
            /*
             * mencari gambar yang sesuai dengan book id
             */
            $s_FileName = $s_PathFolder . "images/news/" . $s_NewsID . ".".$array_Extension[$var1];
            if(file_exists($s_FileName))
            {
                $s_Image = $s_FileName;
                break;
            }
        }
        $q = $s_Image;

        return $q;
    }
    function bool_Delete_ImageNews($s_NewsID, $s_PathFolder)
    {
        $q = false;

        $s_Image = "";

        $array_Extension = array("jpg","png","bmp","jpeg","gif");
        for($var1 = 0; $var1 < count($array_Extension); $var1++)
        {
            /*
             * mencari gambar yang sesuai dengan book id
             */
            $s_FileName = $s_PathFolder . "images/news/" . $s_NewsID . ".".$array_Extension[$var1];
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

}
ob_flush();
?>
    