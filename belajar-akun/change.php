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
            
            if(isset($_GET["view"]) && $_GET["view"] === "ChangeUsername")
            {
                include_once './Change/Form Manage Username.php';
            }
            if(isset($_GET["view"]) && $_GET["view"] === "ChangePassword")
            {
                include_once './Change/Form Manage Password.php';
            }
            
            ?>
            
            
        </div>
        
    </body>
</html>
