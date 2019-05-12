<?php
ob_start();
?>

<?php

//=============================================
// Class Management
//=============================================
include_once './App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

?>
<div class="BodyTop">
<ul class="MainMenu">
<li>
<a href="index.php">Home</a>
</li>
<li>
<a href="news.php">News</a>
</li>
<li>
<a href="book.php">Book</a>
</li>
<li>
<a href="Comment.php">Comment</a>
</li>
<li>
<a href="employee.php">Employee</a>
</li>
</ul>
<div class="FormSearch">
<form action="" method="get" enctype="multipart/form-data" name="form_Manage">
<input type="text" name="txt_Search" value="" class="Text" placeholder="Search"  style="padding: 5px;" />
<input type="submit" name="btn_Submit" value="&#8594;" class="Button" style="width: 30px; height: 31px;" />
</form>
</div>
</div>

<div class="BodyTop1">
<div class="ProjectName animated slideInDown"><?=$c_Variable->string_Get_ProjectName()?></div>
<div class="Address animated slideInDown"><?=$c_Variable->string_Set_SystemName(0)?></div>
</div>


<?php
ob_flush();
?>
