<html>
    <head>
        <title>Dynamic Text Box</title>
    </head>
    <body>
        <?php
        

        $i_Count = 10;
        /*
         * jumlah pembuatan object
         */
        
        for($var = 0; $var < $i_Count; $var++)
        {
            $s_Name = "";
            
            $object_Name = "txt_Name".$var;
            /*
             * name object nya, diikuti index nya
             */
            
            if(isset($_POST[$object_Name]))
                $s_Name = $_POST[$object_Name];
            
            echo "Hai ".($var+1)." - " . $s_Name . "<br/>";
        }

        ?>
        
        <form action="" method="post" enctype="multipart/form-data" name="form_Manage">
            <?php
            for($var = 0; $var < $i_Count; $var++)
            {
                ?>
                Nama <?=$var+1?> : <input type="text" name="txt_Name<?=$var?>" /><br/>
                <?php
            }
            ?>
            <br/>
            <input type="submit" name="btn_Submit" value="Submit" />
        </form>
    </body>
</html>
