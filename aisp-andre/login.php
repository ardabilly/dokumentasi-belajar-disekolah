<?php 

	include_once("class/class_login.php"); $var = new Class_Login();
	if(isset($_SESSION["username"]))
	{
		header("Location:index.php");
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
	</head>
	<style type="text/css">
	label{
		color: #333;
	}
	input,select,textarea{
	  	border:0 !important;
	  	border-bottom: 2px solid #333 !important
	  }
	.navbar{
		box-shadow: 0px 3px 5px gray;padding-top: 30px; padding-bottom:40px; padding-right:20px; padding-left:20px;background-color: #333;border-radius: 0; border:0;
		border-bottom: 5px solid #286090
	  }
	</style>

	<body>
		<nav class="navbar navbar-default navbar-top">
		  <div class="container-fluid ">
		    <div class="navbar-header">
		      <a href="#" class="navbar-brand" style="color: #fff; letter-spacing: 5px; font-size: 22px">
		        <b>APLIKASI INVENTORY BARANG</b><br>
		        <span style="font-size: 15px;">ujikompetensi 2017/2018</span>
		      </a>
		    </div>
		  </div>
		</nav>
		<div class="container">
			<div class="col-sm-6 col-sm-offset-3" style="margin-top:8%;">
					<!-- <h1 class="text-center">Login Inventory</h1> -->
				
					<?php
						if(isset($_POST["submit"]))
						{
							$username = $_POST["username"];
							$password = $_POST["password"];
							
							if($var->login($username,$password))
							{
								session_start();
								$_SESSION["username"] = $username;
								header("Location:index.php");
							}
							else
							{
								echo "<div class='alert alert-danger'><b>Gagal!</b> Username atau Password Salah.</div>";
							}
							
						}
					?>
					<div class="panel panel-default" style="box-shadow: 0px 3px 5px gray">
						<div class="panel-heading" style="border-bottom: 5px solid #286090;padding: 10px 30px;background-color: #333; color: #fff; letter-spacing: 4px; text-align: center;"><h3>Login</h3></div>
						<div class="panel-body" style="padding: 50px 30px">
							<form role="form" method="post" action="">
								<div class="form-group">
									<label> Username </label>
									<input type="text" name='username' class="form-control" required autofocus>
								</div>
								<div class="form-group" style="margin-top:7%">
									<label> Password </label>
									<input type="password" name='password' class="form-control" required>
								</div>
								<p>&nbsp;</p>
									<input type="submit" name="submit" value="Login" class="btn btn-info btn-md" style="width:100px; height: 40px; background-color: #333; color: #fff;"/>
									<input type="reset" name="reset" value="Clear" class="btn btn-info btn-md" style="width:100px; height: 40px; background-color: #286090; color: #fff"/>
							</form>
						</div>	
					</div>
			</div>
		</div>
	</body>
</html>