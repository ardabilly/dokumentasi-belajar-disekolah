<?php
session_start();
if(isset($_SESSION['username']))
{
    header("location:index.php");
}
    require_once("koneksi.php");
?>
<title>Form Login</title>
<div align="center">
    <form action="proseslogin.php" method="post">
        <h1>Masuk</h1>
        <table>
            <tbody>
                <tr>
                    <td>Username</td><td>:<input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td><td>:<input type="text" name="password"></td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <input type="submit" value="Login" > <input type="reset" value="Batal">
                    </td>
                </tr>
                <tr>
                    <td class="2" align="center">Belum punya akun? <a href="daftar.php"><b>Daftar</b></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>