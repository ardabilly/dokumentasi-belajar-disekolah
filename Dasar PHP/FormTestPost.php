<html>
    <head>
        <title>Form Test Post</title>
    </head>
    <body>
                        <?php
        
            $s_Identity="";
            $s_IdentityID1="";
            $s_Name="";
            $s_Name1="";
            $s_Gender="";
            $s_DateOfBirth="";
            $s_Religion="";
            $s_Date="";
            $s_PhoneNumber="";
            $s_Email="";
            $s_Address="";
            $s_Nationality="";
            $s_Photo="";
            $s_Bola="";
            $s_Futsal="";
            $s_Berenang="";
            $s_Menyanyi="";
            
            
            if(isset($_POST["submit"]))
            {
                $s_Identity=$_POST["cb_Identity"];
                $s_IdentityID1=$_POST["txt_IdentityID1"];
                $s_Name=$_POST["txt_Name"];
                $s_Name1=$_POST["txt_Name1"];
                $s_Gender=$_POST["rd_Gender"];
                $s_DateOfBirth=$_POST["txt_City"];
                $s_Religion=$_POST["cb_Religion"];
                $s_Date=$_POST["txt_Date"];
                $s_PhoneNumber=$_POST["txt_PhoneNumber"];
                $s_Email=$_POST["txt_Email"];
                $s_Address=$_POST["txt_Address"];
                $s_Nationality=$_POST["cb_Nationality"];
                $s_Photo=$_POST["file_data"];
                $s_Bola=$_POST["chk_Bola"];
                $s_Futsal=$_POST["chk_Futsal"];
                $s_Berenang=$_POST["chk_Berenang"];
                $s_Menyanyi=$_POST["chk_Menyanyi"];
                
            }
            

                 
        ?>

        <form action="" method="post" enctype="multipart/form-data">
        <table>
        <tr>
            <td>Identity ID</td>
            <td>
                <select name="cb_Identity">
                    <?Php
                        $array_Pilihan=array("--Option--","KTP","Kartu Pelajar","SIM","Paspor","BPJS");
                        for($var=0; $var<count($array_Pilihan);$var++)
                        {
                            $selected="";
                            if($array_Pilihan[$var]===$s_Identity)
                                $selected='selected';
                            echo "<option value='".$array_Pilihan[$var]."' ".$selected.">".$array_Pilihan[$var]."</option>";

                        }
                    ?>
                </select>
                <input type="text" name="txt_IdentityID1" placeholder="Write Your ID!!!" value="<?=$s_IdentityID1?>"/> 
            </td>
        </tr>
        <tr>
            <td>Name</td>
            <td>
                <input type="text" name="txt_Name" placeholder="Full Name!!!" value="<?=$s_Name?>" />
                <input type="text" name="txt_Name1" placeholder="Nick Name!!!" value="<?=$s_Name1?>"/>
            </td>
        </tr>
        <tr>
            <td><legend>Gender</legend></td>
            <td>
                <fieldset style="width:130px;">
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
            <td>Date Of Birth</td>
            <td>
                <input type="text" name="txt_City" placeholder="Your City!!!" value="<?=$s_DateOfBirth?>"/>
                <input type="date" name="txt_Date" value="<?=$s_Date?>"/>
            </td>
        </tr>
        <tr>
            <td>Religion</td>
            <td>
                <select name="cb_Religion">
                    <?Php
                        $array_Pilihan=array("--Option--","Islam","Hindu","Budha","Katolik","Khonguchu");
                        for($var=0; $var<count($array_Pilihan);$var++)
                        {
                            $selected="";
                            if($array_Pilihan[$var]===$s_Religion)
                                $selected='selected';
                            echo "<option value='".$array_Pilihan[$var]."' ".$selected.">".$array_Pilihan[$var]."</option>";

                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>
                <input type="text" name="txt_PhoneNumber" placeholder="Write Phone Number!!!" value="<?=$s_PhoneNumber?>"/>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="text" name="txt_Email" placeholder="Write Email!!!" value="<?=$s_Email?>"/>
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td>
                <textarea name="txt_Address" placeholder="Your Address!!!"><?=$s_Address?></textarea>	
            </td>
        </tr>
        <tr>
            <td>Nationality</td>
            <td>
                <select name="cb_Nationality">
                    <?Php
                        $array_Pilihan=array("--Option--","Indonesia","Korea","Jepang","Malaysia","Singapura");
                        for($var=0; $var<count($array_Pilihan);$var++)
                        {
                            $selected="";
                            if($array_Pilihan[$var]===$s_Nationality)
                                $selected='selected';
                            echo "<option value='".$array_Pilihan[$var]."' ".$selected.">".$array_Pilihan[$var]."</option>";

                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Photo</td>
            <td>
                <input type="file" name="file_data"/>
            </td>
        </tr>
        <tr>
            <td>Hobbies</td>
            <td>
                <?php
                $array_Pilihan=array("Bola");
                for($var=0; $var<count($array_Pilihan);$var++)
                {
                    $s_Selected="";
                    if($array_Pilihan[$var]===$s_Bola)
                    $s_Selected="Checked";
                    echo "<input type='Checkbox' name='chk_Bola' ".$s_Selected." value='".$array_Pilihan[$var]."'  />".$array_Pilihan[$var];
                }
                ?>
                 <?php
                $array_Pilihan=array("Futsal");
                for($var=0; $var<count($array_Pilihan);$var++)
                {
                    $s_Selected="";
                    if($array_Pilihan[$var]===$s_Futsal)
                    $s_Selected="Checked";
                    echo "<input type='Checkbox' name='chk_Futsal' ".$s_Selected." value='".$array_Pilihan[$var]."'  />".$array_Pilihan[$var];
                }
                ?>
                 <?php
                $array_Pilihan=array("Berenang");
                for($var=0; $var<count($array_Pilihan);$var++)
                {
                    $s_Selected="";
                    if($array_Pilihan[$var]===$s_Berenang)
                    $s_Selected="Checked";
                    echo "<input type='Checkbox' name='chk_Berenang' ".$s_Selected." value='".$array_Pilihan[$var]."'  />".$array_Pilihan[$var];
                }
                ?>
                 <?php
                $array_Pilihan=array("Menyanyi");
                for($var=0; $var<count($array_Pilihan);$var++)
                {
                    $s_Selected="";
                    if($array_Pilihan[$var]===$s_Menyanyi)
                    $s_Selected="Checked";
                    echo "<input type='Checkbox' name='chk_Menyanyi' ".$s_Selected." value='".$array_Pilihan[$var]."'  />".$array_Pilihan[$var];
                }
                ?>
            </td>
        </tr>
        <tr>
             <td> 
                <input type="submit" name="submit" value="Submit">
                <input type="reset" name="reset" value="Reset">
             </td>
        </tr>
        </table>
            <?php
                echo " Identity ID  :  " .$s_Identity ." - " .$s_IdentityID1 ."</br>";
                echo " Full Name    :  " .$s_Name ."</br>"; 
                echo " Nick Name :" .$s_Name1 ."</br>";
                echo " Gender :" .$s_Gender ."</br>"; 
                echo " Date Of Birth :" .$s_DateOfBirth ." - " .$s_Date ."</br>";
                echo " Religion :" .$s_Religion ."</br>";
                echo " Phone Number :" .$s_PhoneNumber ."</br>";
                echo " Email :" .$s_Email ."</br>";
                echo " Address :" .$s_Address ."</br>";
                echo " Nationality :" .$s_Nationality ."</br>";
                echo " Hobbies :" .$s_Bola ." ". $s_Futsal ." ". $s_Berenang ." ". $s_Menyanyi ."</br>";
            ?>
            
        </form>
        
    </body>
</html>