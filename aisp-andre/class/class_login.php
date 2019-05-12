<?php

class Class_Login
{
	public function login($u,$pass)
	{
		$u = addslashes($u);
        $pass = base64_encode(md5($pass , true));



		include_once("dbcon.php");
		
		$sql = "SELECT username,password FROM tbl_user WHERE username='$u' and password='$pass'";
		$query = mysqli_query($db,$sql);
		$row =mysqli_num_rows($query);
		
		if($row == 1)
		{
			return 1;
		}
		else
		{
			return 0;
		} 	
	}
}

?>