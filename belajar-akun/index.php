<!--  !-->
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
            
            include_once './Index/Paragraph.php';
            
            /*
             * cara untuk sign out
             */
            if(isset($_GET["action"]) && $_GET["action"] === "signout")
            {
                setcookie("cookie_Akun", " ", time()-3600);
                unset($_COOKIE["cookie_Akun"]);
                echo "<script>window.location.href='index.php';</script>";
            }
            
            if(isset($_GET["action"]) && $_GET["action"] === "signup")
            {
                include_once './Index/SignUp.php';
            }            
            else 
            {
                if(isset($_COOKIE["cookie_Akun"]))
                {}
                else
                {
                    include_once './Index/SignIn.php';
                }            }
            
            ?>
                        
        </div>
        
    </body>
</html>