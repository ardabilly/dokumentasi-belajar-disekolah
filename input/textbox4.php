<html>
    <head>
        <title>Text box 4</title>
    </head>
    <body>
        <?php
        $s_Name1 = "";
        if(isset($_GET["txt_Name1"]))
            $s_Name1 = $_GET["txt_Name1"];
        
        $s_Name2 = "";
        if(isset($_GET["txt_Name2"]))
            $s_Name2 = $_GET["txt_Name2"];
        
        $s_Name3 = "";
        if(isset($_GET["txt_Name3"]))
            $s_Name3 = $_GET["txt_Name3"];
        
        $s_Name4 = "";
        if(isset($_GET["txt_Name4"]))
            $s_Name4 = $_GET["txt_Name4"];
        
        echo "Hai 1 - " . $s_Name1 . "<br/>";
        echo "Hai 2 - " . $s_Name2 . "<br/>";
        echo "Hai 3 - " . $s_Name3 . "<br/>";
        echo "Hai 4 - " . $s_Name4 . "<br/>";
        ?>
        
        <form action="" method="get" enctype="multipart/form-data" name="form_Manage">
            Nama 1 <input type="text" name="txt_Name1" value="" /><br/>
            Nama 2 <input type="text" name="txt_Name2" /><br/>
            Nama 3 <input type="text" name="txt_Name3" /><br/>
            Nama 4 <input type="text" name="txt_Name4" /><br/>
            <br/>
            <input type="submit" name="btn_Submit" value="Submit" />
        </form>
    </body>
</html>
