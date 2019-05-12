<?php
/*
 * jika tidak ada cookie "cookie_Akun"
 * maka akan dipaksa ke halaman index
 */            
if(!isset($_COOKIE["cookie_Akun"]))
{
    echo "<script>window.location.href='index.php';</script>";
}

?>
<html>
    <head>
        <title>Belajar Akun</title>
        <link rel="stylesheet" type="text/css" href="Stylesheet/All.css" />
    </head>
    <body>
        
        <?php
        include_once './BodyTop.php';
        ?>
        
        <div class="BodyCenter">
            <?php
            include_once "./Edit/Form Manage.php";
            ?>            
        </div>
        
    </body>
</html>
