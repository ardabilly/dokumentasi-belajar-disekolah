<?php 
	ob_start();
	class Class_Employee
	{
		// EMPLOYEE DATA
		function bool_Check_EmployeeID($s_EmployeeID)
		{
			$q = false;

			$s_EmployeeID = addslashes($s_EmployeeID);

			include"DatabaseString.php";

			$s_Query = " select *from Employee_Data where EmployeeID = '$s_EmployeeID' ";
			$Query = mysqli_query($conn,$s_Query);

			if ($Query) {
			 	
			 	$DataRow = mysqli_fetch_array($Query);
			 	if ($DataRow > 0)
				 	$q= true;

			 } 
			elseif (!$Query) {
				
				echo "<span style='clear:both; float:left;'>"
				."Class_Employee->bool_Check_EmployeeID<br/>"
				.$conn->error."<br/>"
				.$s_Query."<br/>"
				."</span>";
			}

			mysqli_close($conn);
			return $q;
		}

		function bool_Check_EmployeeID1($s_EmployeeID,$s_EmployeeID_New)
		{
			$q = false;

			$s_EmployeeID = addslashes($s_EmployeeID);
			$s_EmployeeID_New = addslashes($s_EmployeeID_New);

			include "DatabaseString.php";

			$s_Query = " select *from Employee_Data where EmployeeID !='$s_EmployeeID' and EmployeeID != '$s_EmployeeID_New' ";
			$Query = mysqli_query($conn,$s_Query);

			if ($Query) {
				
				$DataRow = mysqli_fetch_array($Query);
				if ($DataRow > 0)
					$q = true;
			}
			elseif (!$Query) {
				
				echo "<span style='clear:both; float:left;'>"
				."Class_Employee->bool_Check_EmployeeID1<br/>"
				.$conn->error."<br/>"
				.$s_Query."<br/>"
				."</span>";
			}

			mysqli_close($conn);
			return $q;
		}
		
		function array_Get_DataEmployee($s_EmployeeID)
		{
			$q = array("","","","","","","","","");

			$s_EmployeeID = addslashes($s_EmployeeID);

			include"DatabaseString.php";

			$s_Query = " SELECT EmployeeID, FullName, Gender, Religion, PlaceOfBirth, DateOfBirth, PhoneNumber, Email, Address "
			." FROM Employee_Data "
			." where EmployeeID = '$s_EmployeeID' ";

			$Query = mysqli_query($conn,$s_Query);

			if ($Query) {

				while($DataRow = mysqli_fetch_array($Query))
				{
					$q[0] = str_replace("\'","'", $DataRow[0]);//EMPLOYEEID
					$q[1] = str_replace("\'","'", $DataRow[1]);//Fullname
					$q[2] = str_replace("\'","'", $DataRow[2]);//Gender
					$q[3] = str_replace("\'","'", $DataRow[3]);//Religion
					$q[4] = str_replace("\'","'", $DataRow[4]);//PlaceOfBirth
					$q[5] = str_replace("\'","'", $DataRow[5]);//DateOfBirth
					$q[6] = str_replace("\'","'", $DataRow[6]);//PhoneNumber
					$q[7] = str_replace("\'","'", $DataRow[7]);//Email
					$q[8] = str_replace("\'","'", $DataRow[8]);//Address
				}
			}
			elseif (!$Query) {
				
	         echo "<span style='clear:both;float:left;'>"
            . "Class_Emplyee -> array_Get_DataEmployee<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";

			}

			mysqli_close($conn);
			return $q;
		}

		function array_Get_AllEmployeeID($s_Search)
		{
			$q = array();
			$i_Index = 0;

			$s_Search = addslashes($s_Search);

			include"DatabaseString.php";

			$s_Query = " SELECT EmployeeID "
			." FROM Employee_Data "
			." where EmployeeID != '--------' and (EmployeeID like '%$s_Search%' or FullName like '%$s_Search%' or Gender like '%$s_Search%' or Religion like '%$s_Search%' or ". " PlaceOfBirth like '%$s_Search%' or DateOfBirth like '%$s_Search%' or "
			." Address like '%$s_Search%' )"
			." order by FullName asc ";
			//echo $s_Query;

			$Query = mysqli_query($conn,$s_Query);

			if ($Query) {
				
				while ($DataRow = mysqli_fetch_array($Query)) 
				{
					$q[$i_Index] = str_replace("\'","'",$DataRow[0]);//mployeeID
					//echo "<script>alert('" .str_replace("\'","'",$DataRow[0]) ."');</script>";
					$i_Index++;
				}
			}
			elseif (!$Query) {

			echo "<span style='clear:both;float:left;'>"
            . "Class_Employee -> array_Get_AllEmployeeID<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";

			}

			mysqli_close($conn);
			return $q;

		}
		function bool_Insert_EmployeeData($s_EmployeeID, $s_FullName, $s_Gender, $s_Religion, $s_PlaceOfBirth, $s_DateOfBirth, $s_PhoneNumber, $s_Email, $s_Address)
		{
			$q = false;

			$s_EmployeeID = addslashes($s_EmployeeID);
			$s_FullName = addslashes($s_FullName);
			$s_Gender = addslashes($s_Gender);
			$s_Religion = addslashes($s_Religion);
			$s_PlaceOfBirth = addslashes($s_PlaceOfBirth);
			$s_DateOfBirth = addslashes($s_DateOfBirth);
			$s_PhoneNumber = addslashes($s_PhoneNumber);
			$s_Email = addslashes($s_Email);
			$s_Address =addslashes($s_Address);

			include"DatabaseString.php";

			$s_Query = " INSERT INTO Employee_Data "
			." values('$s_EmployeeID', '$s_FullName', '$s_Gender', '$s_Religion', '$s_PlaceOfBirth', '$s_DateOfBirth', '$s_PhoneNumber', '$s_Email', '$s_Address') ";
			$Query = mysqli_query($conn,$s_Query);

			if ($Query) {
				
				$q =true;
			}
			elseif (!$Query) {
				

            echo "<span style='clear:both;float:left;'>"
            . "Class_Employee->bool_Insert_EmployeeData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";

			}

			mysqli_close($conn);
			return $q;
		}
		function bool_Update_EmployeeData($s_EmployeeID, $s_EmployeeID_New, $s_FullName, $s_Gender, $s_Religion, $s_PlaceOfBirth, $s_DateOfBirth, $s_PhoneNumber, $s_Email, $s_Address)
	    {
	        $q = false;

	        $s_EmployeeID = addslashes($s_EmployeeID);
	        $s_EmployeeID_New = addslashes($s_EmployeeID_New);
	        $s_FullName = addslashes($s_FullName);
	        $s_Gender = addslashes($s_Gender);
	        $s_Religion = addslashes($s_Religion);
	        $s_PlaceOfBirth = addslashes($s_PlaceOfBirth);
	        $s_DateOfBirth = addslashes($s_DateOfBirth);
	        $s_PhoneNumber = addslashes($s_PhoneNumber);
	        $s_Email = addslashes($s_Email);
	        $s_Address = addslashes($s_Address);

	        include 'DatabaseString.php';

	        $s_Query = " Update Employee_Data "
	                . " set EmployeeID = '$s_EmployeeID_New', FullName = '$s_FullName', Gender = '$s_Gender', Religion = '$s_Religion', "
	                . "     PlaceOfBirth = '$s_PlaceOfBirth', DateOfBirth = '$s_DateOfBirth', PhoneNumber = '$s_PhoneNumber', Email = '$s_Email', Address = '$s_Address' "
	                . " where EmployeeID = '$s_EmployeeID' ";
	        $Query = mysqli_query($conn,$s_Query);

	        if($Query)
	        {
	            $q = TRUE;
	        }
	        else if(!$Query)
	        {
	            echo "<span style='clear:both;float:left;'>"
	            . "Class_Employee -> bool_Update_EmployeeData<br/>"
	            . $conn->error ."<br/>"
	            . $s_Query ."<br/>"
	            . "</span>";
	        }

	        mysqli_close($conn);

	        return $q;
	    }
	    function bool_Delete_EmployeeData($s_EmployeeID)
	    {
	    	$q = false;

	    	$s_EmployeeID = addslashes($s_EmployeeID);

	    	include"DatabaseString.php";

	    	$s_Query = " Delete from Employee_Data "
	    	."where EmployeeID = '$s_EmployeeID' ";
	    	$Query=mysqli_query($conn,$s_Query);

	    	//echo $s_Query;

	    	if ($Query) {

	    		$q =true;
	    	}
	    	elseif (!$Query) {
	    	 echo "<span style='clear:both;float:left;'>"
            . "Class_Employee -> bool_Delete_EmployeeData<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";

	    	}

	    	mysqli_close($conn);
	    	return $q;
	    }
	    function string_Set_ImageEmployee($s_EmployeeID,$s_PathFolder)
	    {
	    	$q = "";

	    	$s_Image = $s_PathFolder . "Images/Global/user.png";

	    	// DEFAULT IMAGE

	    	$array_Extension = array("jpg","png","bmp","jpeg","gif");
	    	for ($var1=0; $var1 <count($array_Extension) ; $var1++) 
	    	{ 
	    		// Mencari gambar
	    		$s_FileName = $s_PathFolder . "Images/User/". $s_EmployeeID . "." . $array_Extension[$var1];
	    		//echo $s_FileName ."<br/>";
	    		if (file_exists($s_FileName)) 
	    		{
	    			$s_Image = $s_FileName;
	    			break;
	    		}
	    	}

	    	$q = $s_Image ;

	    	return $q;
	    }

	    function bool_Delete_ImageEmployee($s_EmployeeID,$s_PathFolder)
	    {
	    	$q = false ;

	    	$s_Image = "";

	    	$array_Extension = array("jpg","png","bmp","jpeg","gif");
	    	for ($var1=0; $var1 <count($array_Extension) ; $var1++) { 
	    		
	    		// Mencari gambar sesuai id BookID

	    		$s_FileName = $s_PathFolder . "Images/User" . $s_EmployeeID . "." . $array_Extension[$var1];
	    		if (file_exists($s_FileName)) {
	    			
	    			$s_Image = $s_FileName ;
	    			unlink($s_Image);
	    			$q=true;
	    			break;
	    		}
 	    	}
 	    	return $q;
	    }
    // EMPLOYEE LOGIN
//
		function bool_Check_EmployeeLogin($s_Username, $s_Password)
		{
			$q = false;

			$s_Username = addslashes($s_Username);
			$s_Password = base64_encode(md5($s_Password, true));
			$s_Password = addslashes($s_Password);

			include"DatabaseString.php";

			$s_Query = " SELECT *from Employee_Login where Usernames = '$s_Username' and Passwords = '$s_Password' ";
			$Query = mysqli_query($conn,$s_Query);

			if ($Query) {
				
				$DataRow = mysqli_fetch_array($Query);
				if($DataRow > 0)
					$q = true ;
			}
			elseif (!$Query) {
	         echo "<span style='clear:both;float:left;'>"
            . "Class_Employee -> bool_Check_EmployeeLogin<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";

			}
			mysqli_close($conn);

			return $q;
		} 

		function bool_Check_EmployeeUsername($s_EmployeeID,$s_Username)
		{
			$q = false;

			$s_EmployeeID = addslashes($s_EmployeeID);
			$s_Username = addslashes($s_Username);

			include"DatabaseString.php";

			$s_Query = " select *from Employee_Login where EmployeeID != '$s_EmployeeID' and Usernames = '$s_Username' ";
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
	            . "Class_Employee -> bool_Check_EmployeeUsername<br/>"
	            . $conn->error ."<br/>"
	            . $s_Query ."<br/>"
	            . "</span>";
	        }

        mysqli_close($conn);

        return $q;

		}

		function bool_Check_EmployeeLogin_Password($s_EmployeeID, $s_Password)
		{
	        $q = false;

	        $s_EmployeeID = addslashes($s_EmployeeID); 
	        $s_Password = base64_encode(md5($s_Password, true));
	        $s_Password = addslashes($s_Password);

	        include 'DatabaseString.php';

	        $s_Query = " Select *from Employee_Login where EmployeeID = '$s_EmployeeID' and Passwords = '$s_Password' ";
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
	            . "Class_Employee -> bool_Check_EmployeeLogin_Password<br/>"
	            . $conn->error ."<br/>"
	            . $s_Query ."<br/>"
	            . "</span>";
	        }

	        mysqli_close($conn);

	        return $q;

	    }
	     function string_Get_EmployeeID($s_Username, $s_Password)
	    {
	        $q = "";

	        $s_Username = addslashes($s_Username);        
	        $s_Password = base64_encode(md5($s_Password, true));
	        $s_Password = addslashes($s_Password);

	        include 'DatabaseString.php';

	        $s_Query = " Select EmployeeID from Employee_Login where Usernames =  '$s_Username' and Passwords = '$s_Password' ";
	        $Query = mysqli_query($conn,$s_Query);

	        if($Query)
	        {
	            while ($DataRow = mysqli_fetch_array($Query))
	            {
	                $q = str_replace("\'", "'", $DataRow[0]);//Column EmployeeID
	            }
	        }
	        else if(!$Query)
	        {
	            echo "<span style='clear:both;float:left;'>"
	            . "Class_Employee -> bool_Check_EmployeeLogin<br/>"
	            . $conn->error ."<br/>"
	            . $s_Query ."<br/>"
	            . "</span>";
	        }

	        mysqli_close($conn);

	        return $q;
	    }

	    function bool_Insert_EmployeeLogin($s_EmployeeID, $s_Username, $s_Password)
	    {
	    	$q = false;

	    	$s_EmployeeID = addslashes($s_EmployeeID);
	    	$s_Username = addslashes($s_Username);
	    	$s_Password = base64_encode(md5($s_Password, true));
	    	$s_Password = addslashes($s_Password);

	    	include"DatabaseString.php";

	    	$s_Query = " INSERT INTO Employee_Login "
	    	." Valuse('$s_EmployeeID','$s_Username','$s_Password' ) ";
	    	$Query = mysqli_query($conn,$s_Query);
	    	if($Query)
        {
            $q = TRUE;
        }
        else if(!$Query)
        {
            echo "<span style='clear:both;float:left;'>"
            . "Class_Employee -> bool_Insert_EmployeeLogin<br/>"
            . $conn->error ."<br/>"
            . $s_Query ."<br/>"
            . "</span>";
        }

        mysqli_close($conn);

        return $q;

	    }

	   	function bool_Update_EmployeeLogin_Username($s_EmployeeID, $s_Username)
	    {
	        $q = false;

	        $s_EmployeeID = addslashes($s_EmployeeID);
	        $s_Username = addslashes($s_Username);

	        include 'DatabaseString.php';

	        $s_Query = " Update Employee_Login "
	                . " set Usernames = '$s_Username' "
	                . " where EmployeeID = '$s_EmployeeID' ";
	        $Query = mysqli_query($conn,$s_Query);

	        if($Query)
	        {
	            $q = TRUE;
	        }
	        else if(!$Query)
	        {
	            echo "<span style='clear:both;float:left;'>"
	            . "Class_Employee -> bool_Update_EmployeeLogin_Username<br/>"
	            . $conn->error ."<br/>"
	            . $s_Query ."<br/>"
	            . "</span>";
	        }

	        mysqli_close($conn);

	        return $q;
	    }
	    function bool_Update_EmployeeLogin_Password($s_EmployeeID, $s_Password)
	    {
	        $q = false;

	        $s_EmployeeID = addslashes($s_EmployeeID);
	        $s_Password = base64_encode(md5($s_Password, true));
	        $s_Password = addslashes($s_Password);

	        include 'DatabaseString.php';

	        $s_Query = " Update Employee_Login "
	                . " set Passwords = '$s_Password' "
	                . " where EmployeeID = '$s_EmployeeID' ";
	        $Query = mysqli_query($conn,$s_Query);

	        if($Query)
	        {
	            $q = TRUE;
	        }
	        else if(!$Query)
	        {
	            echo "<span style='clear:both;float:left;'>"
	            . "Class_Employee -> bool_Insert_EmployeeLogin<br/>"
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