<?php ob_start(); ?>

<div class="BodyTop">
    <div class="TitleContent">
        <div class="Arrow"></div>
        <span>News</span>                
    </div>
    <div class="MainMenu">
        <a href="index.php">Home</a>
        <a href="FormInsertNews.php">New Post</a>
        <form action="index.php" method="get" enctype="multipart/form-data" name="form_Manage">
            <input type="text" name="txt_Search" class="TextBox"  /> <input type="submit" name="btn_Searh" value="Search" class="Button" />
        </form>
    </div>
</div>

<?php ob_flush(); ?>