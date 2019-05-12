<html>
    <head>
        <title>Form Get</title>
    </head>

    <body>
        <?php
            $s_Username="";
            $s_Password="";
            $s_Hobbies="";
            $s_Gender="";
            $s_Address="";
            if(isset($_GET["submit"]))
            {
            $s_Username=$_GET["txt_User"];
            $s_Password=$_GET["txt_Pass"];
            $s_Hobbies=$_GET["cb_Hobbies"];
            $s_Gender=$_GET["rd_Gender"];
            $s_Address=$_GET["txt_Address"];
            echo " Hello " .$s_Username." Hobbie kamu ".$s_Hobbies ." jenis Kelamin " .$s_Gender ;
            }
             //isset memeriksa code/variable/cookie/dll
             //apakah kode terrsebut ada / tidak ada
        ?>
        <form action="" method="Get" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Username </td>
                <td><input type="text" name="txt_User" value="<?=$s_Username?>" placeholder="Write your UserName "/></br></td>
        </tr>

        <tr>
            <td>Password </td>
                <td><input type="Password" name="txt_Pass" placeholder="Write your Password"/></br></td>
        </tr>
        <tr>
            <td>Hobbies</td>
            <td>
                <select name="cb_Hobbies">
                    <?Php
                        $array_Pilihan=array("--Option--","Renang","Bola","Basket","Belajar","Berisik");
                        for($var=0; $var<count($array_Pilihan);$var++)
                        {
                            $selected="";
                            if($array_Pilihan[$var]===$s_Hobbies)
                                $selected='selected';
                            echo "<option value='".$array_Pilihan[$var]."' ".$selected.">".$array_Pilihan[$var]."</option>";

                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><legend>Gender</legend></td>
            <td>
                <fieldset>
                <?php
                    $array_Pilihan=array("Male","Female");
                    for($var=0; $var<count($array_Pilihan);$var++)
                    {
                        $s_Selected="";
                        if($array_Pilihan[$var]===$s_Gender)
                        $s_Selected="Checked";
                        echo "<input type='radio' name='rd_Gender' ".$s_Selected." value='".$array_Pilihan[$var]."'  />".$array_Pilihan[$var];
                    }
                 ?>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td>
                <textarea name="txt_Address"><?=$s_Address?></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="file" name="file_data"/>
            </td>
        </tr>
        <tr>
            <td>
            <input type="submit" value="Submit" name='submit'/>
            </td>
        </tr>
            </table>
        </form>

    </body>
</html>
