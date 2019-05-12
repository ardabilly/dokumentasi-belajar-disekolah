<?php
session_start();
    if(!isset($_SESSION['username']))
    {
        header('location:login.php');
    }
    else
    {
        $username = $_SESSION['username'];
    }
?>
<title> Halaman sukses login </title>
<div align='center'>
    Selamat datang,<b><?php echo $username;?></b>
    <a href="logout.php"><b>Logout</b></a>
</div>
<?php ob_flush(); ?>