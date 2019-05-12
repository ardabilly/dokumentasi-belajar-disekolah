<?php
ob_start();

//==============================================================================
// Class Management
//==============================================================================

include_once './App Code/Class_Class.php';
$c_Class = new Class_Class();

include_once './App Code/Class_Student.php';
$c_Student = new Class_Student();

//==============================================================================
// Variable
//==============================================================================

$s_ClassID = $_GET("id");
$array_Data = $c_Class->array_Get_DataClass($s_ClassID);
$array_List = $c_Class->array_Get_AllStudentID($s_ClassID);
?>

<div class="ClassData">
    <div class="TitleClass">
        <img src="Images/Icon/Logo 3.png" />
        <br/>
        <?=$arrayData[1]?>
    </div>
    <p>
        <?=$array_Data[4]?>
    </p>
</div>

<style>
    .ClassData
    {
        clear: both; float: left;
        width: 100%;
    }
    .ClassData .TitleClass
    {
        clear: both; float: left;
        width: 100%;
        text-align: center;
        font-size: 20px;
        
        font-family: cursive;
    }
    .ClassData .TitleClass img
    {
        width: 50px; height: 50px;
    }
    .ClassData p
    {
        clear: both; float: left;
        font-size: 12px;
        
        margin-top: 20px;
        margin-bottom: 50px;
    }
</style>


<div class="StudentGallery">
    <?php
    for($var = 0; $var < count($array_List); $var++)
    {
        $s_StudentID = $arrayList[$var];
        $array_Data = $c_Student->array_Get_DataStudent($s_StudentID)
        
        ?>
        <a href="student.php?id=<?=$s_StudentID?>&view=Profile" target="_blank" class="Data">
            <img src="<?=$c_Student-string_Get_URLPhoto($s_StudentID)?>" />
            <br/>
            <span><?=$array_Data[0]?><br/><?=$array_Data[4]?></span>
        </a>
        <?php
    }
    ?>
</div>

<style>
    .StudentGallery
    {
        clear: both; float: left;
        width: 100%;
    }
    .StudentGallery .Data
    {
        float: left;
        width: 120px;
        height: 170px;
        padding: 5px;
        
        text-decoration: none;
        color:#ffffff;
        
        margin-bottom: 10px;
        margin-right: 10px;
        
        text-align: center;
        
    }
    .StudentGallery .Data img
    {
        width: 100px;
        height: 100px;
        
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
        
        background-color: #ffffff;
        border: 5px solid #ffffff;
    }
    .StudentGallery .Data span
    {
        font-size: 13px;
    }
    .StudentGallery .Data:hover img
    {
        border-color: #006fbd;
    }
</style>

<?php
ob_flush();
?>