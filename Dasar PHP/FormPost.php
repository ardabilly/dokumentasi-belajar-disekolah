<html>
    <head>
        <title>Form Post</title>
    </head>
    <body>
         <?php
            $s_Username="";
            $s_Password="";
            if(isset($_POST["submit"]))
            {
            $s_Username=$_POST["txt_User"];
            $s_Password=$_POST["txt_pass"]; 
            echo " Hello " .$s_Username;
            }
            
        ?>
        <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
            <td>Username </td>
            <td><input type="text" name="txt_User" value="<?=$s_Username?>" placeholder="Write your UserName "/></br></td>
            </tr>
            
            <tr>
            <td>Password </td>
            <td><input type="Password" name="txt_pass" value="<?=$s_Password?>" placeholder="Write your Password"/></br></td>
            </tr>
            
            <tr>
            <td>Hobbies</td>
            <td>
		<select name="cb_Hobbies">
		<option value=''>--Option--</option>
                <option value='Bola'> Bola </option>
		<option value='Renang'> Renang </option>
		<option value='Basket'> Basket</option>
	</select>
            </td>
            </tr>
        </table>
            <input type="submit" value="submit" name="submit"/>   
        </form>
          
    </body>
</html>