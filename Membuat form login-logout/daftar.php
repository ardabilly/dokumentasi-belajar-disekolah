<?php
session_start();
    if(isset($_SESSION['username']))
    {
        header("location:index.php");
    }
?>
<title> Form pendaftaran</title>
<div align="center">
    <form action="prosesdaftar.php" method="post">
        <table>
            <tbody>
                <tr>
                    <td colspan="2" align="center"><h1>Daftar Baru</h1></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password"></td>
                </tr>
                <tr>
                    <td colspan="2" align='right'><input type="submit" value="Daftar"> <input type='reset' value="batal"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">Sudah punya akun?<a href="login.php"><b>Login</b></a></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>