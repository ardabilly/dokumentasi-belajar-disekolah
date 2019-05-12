<?php

if(!isset($_GET["i"]))
{
    echo "<script>window.location.href='index.php';</script>";
    /*
     * jika tidak ada parameter i
     * maka akan dipaksa ke index.php
     */
}
else if(isset ($_GET["i"]) && !($_GET["i"] >= 0 && $_GET["i"] <= 6) )
{
    echo "<script>window.location.href='index.php';</script>";
    /*
     * jika ada parameter i
     * tetapi i atau index tidak
     * lebih dari sama dengan 0
     * dan kurang dari sama dengan 6
     * maka akan dipaksa ke index.php
     */
}
?>
<html>
    <head>
        <title>Edit Jadwal Harian</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php
        include_once './edit1.php';
        include_once './edit2.php';
        ?>
        
    </body>
</html>