<?php
ob_start();

//=============================================
// Class Management
//=============================================

include_once './App Code/Class_People.php';
$c_People = new Class_People();

//=============================================
// Variable
//=============================================

$s_PeopleID = "";
$array_Data = array("");
if(isset($_COOKIE["cookie_Akun"]))
{
    $s_PeopleID = $_COOKIE["cookie_Akun"];
    $array_Data = $c_People->array_Get_DataPeople($s_PeopleID);
}

?>

<div class="BodyTop">
    <div class="Line"></div>
    <div class="MainMenu">
        <?php
        if(isset($_COOKIE["cookie_Akun"]))
        {
            ?>
                <a href="index.php?action=signout">Sign out</a>
                <a href="edit.php">Edit</a>
                <a href="profile.php">Profile</a>
                <a href="change.php?view=ChangeUsername">Username</a>
                <a href="change.php?view=ChangePassword">Password</a>
            <?php
        }
        ?>
        <a href="index.php">Home</a>                
    </div>
    <div class="TitleContent">
        Belajar Akun
        <?php
        if(isset($_COOKIE["cookie_Akun"]))
        {
            ?>
            <br/>
            <img src="<?=$c_People->string_Set_PeopleImage($s_PeopleID)?>" />
            <br/>
            <center style='font-family: monospace;'><?=$array_Data[1]?></center>
            <?php
        }
        ?>
    </div>
</div>

<?php
ob_flush();
?>