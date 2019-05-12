<?php
ob_start();

//==============================================================
// Class Management
//==============================================================

include_once 'Class_JadwalHarian.php';
$c_JadwalHarian = new Class_JadwalHarian();

//==============================================================
// Variable
//==============================================================

$s_IndexDay = $_GET["i"];
$s_ErrorMessage = "";
$s_IndexArray = "";

$s_DateTimeNow = $c_JadwalHarian->string_Set_DateTimeNow();
$dt_DateTimeNow = strtotime($s_DateTimeNow);
$s_DateNow = explode(" ", $s_DateTimeNow)[0];

$array_DailyData = $c_JadwalHarian->array_Get_FileData();
$s_DailyActivitiy = $array_DailyData[$s_IndexDay];
$array_DailyActivitiy = explode(";", $s_DailyActivitiy);


$s_ActivityName = "";
if(isset($_POST["txt_ActivityName"]) && strlen(trim($_POST["txt_ActivityName"])) != 0)
    $s_ActivityName = trim($_POST["txt_ActivityName"]);

$s_StartTime = "";
if(isset($_POST["txt_StartTime"]) && strlen(trim($_POST["txt_StartTime"])) != 0)
    $s_StartTime = trim($_POST["txt_StartTime"]);

$s_EndTime = "";
if(isset($_POST["txt_EndTime"]) && strlen(trim($_POST["txt_EndTime"])) != 0)
    $s_EndTime = trim($_POST["txt_EndTime"]);

/*
 * event submit
 */

$b_Validation = true;
$b_Update = false;
if(isset($_POST["btn_Submit"]))
{
    /*
     * Check system
     */
    if(isset($_GET["ia"]) && isset($_GET["a"]) && isset($_GET["st"]) && isset($_GET["et"]))
    {
        $b_Update = true;
        $s_IndexArray = $_GET["ia"];
        /*
         * apakah melakukan update
         */
    }

    /*
     * validasi activity name
     */
    if(strlen($s_ActivityName) == 0)
    {
        $s_ErrorMessage .= "Please field activity name<br/>";
        $b_Validation = false;
    }

    /*
     * validasi time
     */

    $s_DateStartTime = $s_DateNow . " " . $s_StartTime;
    $s_DateEndTime = $s_DateNow . " " . $s_EndTime;

    $dt_DateStartTime = strtotime($s_DateStartTime);
    $dt_DateEndTime = strtotime($s_DateEndTime);

    if(strlen($s_StartTime) == 0)
    {
        $s_ErrorMessage .= "Please field start time<br/>";
        $b_Validation = false;
    }
    else if(!$c_JadwalHarian->bool_Check_ValidateDate($s_DateStartTime))
    {
        $s_ErrorMessage .= "Start time invalid<br/>";
        $b_Validation = false;
    }

    if(strlen($s_EndTime) == 0)
    {
        $s_ErrorMessage .= "Please field end time<br/>";
        $b_Validation = false;
    }
    else if(!$c_JadwalHarian->bool_Check_ValidateDate($s_DateEndTime))
    {
        $s_ErrorMessage .= "Start time invalid<br/>";
        $b_Validation = false;
    }


    for($var = 0; $var < count($array_DailyActivitiy) - 1; $var++)
    {
        $s_DailyActivitiyDetail = $array_DailyActivitiy[$var];
        $array_DailyActivitiyDetail = explode("~", $s_DailyActivitiyDetail);
        //====================================
        $s_TimeActivity = $array_DailyActivitiyDetail[0];
        //====================================
        $array_TimeActivity = explode("-", $s_TimeActivity);
        //====================================
        //====================================
        $s_TimeActivity1 = $array_TimeActivity[0];
        $s_TimeActivity2 = $array_TimeActivity[1];
        //====================================
        $s_DateTimeActivity1 = $s_DateNow . " " . $s_TimeActivity1;
        $s_DateTimeActivity2 = $s_DateNow . " " . $s_TimeActivity2;
        //====================================
        $dt_DateTimeActivity1 = strtotime($s_DateTimeActivity1);
        $dt_DateTimeActivity2 = strtotime($s_DateTimeActivity2);

        if($b_Update && intval($s_IndexArray) !== $var && ($dt_DateTimeActivity1 <= $dt_DateStartTime && $dt_DateStartTime <= $dt_DateTimeActivity2) )
        {
            /*
             * jika mengubah yang tidak sesuai dengan
             * indexing array activitas
             * Time Activity 1 kurang dari Start Time
             * dan 
             * Start Time kurang dari Time Activity 2
             */
            $s_ErrorMessage .= "Start time can not used, because have activity<br/>";
            $b_Validation = false;
        }
        if($b_Update && intval($s_IndexArray) !== $var && ($dt_DateTimeActivity1 <= $dt_DateEndTime && $dt_DateEndTime <= $dt_DateTimeActivity2) )
        {
            /*
             * jika mengubah yang tidak sesuai dengan
             * indexing array activitas
             * Time Activity 1 kurang dari End Time
             * dan 
             * End Time kurang dari Time Activity 2
             */
            $s_ErrorMessage .= "End time can not used, because have activity<br/>";
            $b_Validation = false;
        }

    }

    if($b_Validation)
    {
        $string_DailyActivitiy = "";
        for($var = 0; $var < count($array_DailyActivitiy) - 1; $var++)
        {
            $s_DailyActivitiyDetail = $array_DailyActivitiy[$var];
            $array_DailyActivitiyDetail = explode("~", $s_DailyActivitiyDetail);
            
            if($b_Update)
            {
                if($s_IndexArray == $var)
                {
                    /*
                     * jika index nya sama
                     * maka activitas yang diedit
                     * ditambahkan kedalam string
                     */
                    $string_DailyActivitiy .=  "$s_StartTime-$s_EndTime~$s_ActivityName;";
                }
                else
                {
                    $string_DailyActivitiy .= $s_DailyActivitiyDetail . ";";
                }
            }
            else if(!$b_Update)
            {
                if($var == 0)
                {
                    $string_DailyActivitiy .= "$s_StartTime-$s_EndTime~$s_ActivityName;";
                }

                $string_DailyActivitiy .= $s_DailyActivitiyDetail . ";";
            }
        }
        
        //echo "<span style='clear:both; float:left;'>". $string_DailyActivitiy. "</span>";
        
        
        $array_DailyActivitiy_Temp = explode(";", $string_DailyActivitiy);
        sort($array_DailyActivitiy_Temp);
        $string_DailyActivitiy = "";
        for($var = 0; $var < count($array_DailyActivitiy_Temp); $var++)
        {
            if(strlen($array_DailyActivitiy_Temp[$var]) != 0)
                $string_DailyActivitiy .= $array_DailyActivitiy_Temp[$var] . ";";
        }

        $array_DailyData[$s_IndexDay] = $string_DailyActivitiy;
        $c_JadwalHarian->bool_Set_FileData($array_DailyData);
        echo "<script>window.location.href='edit.php?i=$s_IndexDay';</script>";
    }

}

$s_TitleForm = "Add Activity";
if(!isset($_POST["btn_Submit"]) && isset($_GET["a"]) && isset($_GET["st"]) && isset($_GET["et"]))
{
    /*
     * jika tidak disubmit
     * ada parameter get
     * a, st dan et
     */

    $s_ActivityName = $_GET["a"];
    $s_StartTime = $_GET["st"];
    $s_EndTime = $_GET["et"];
}
if(isset($_GET["a"]) && isset($_GET["st"]) && isset($_GET["et"]))
    $s_TitleForm = "Edit Activity";

?>

<div class="Form">
    <form action="" method="post" enctype="multipart/form-data" name="form_Manage">
        <span><?=$s_TitleForm?></span>
        <div style="clear: both; float: left;"></div>
        <span style="color:red"><?=$s_ErrorMessage?></span>
        <div style="clear: both; float: left;"></div>
        <input type="text" class="TextBox" placeholder="Activity Name" name="txt_ActivityName" value="<?=$s_ActivityName?>" />
        <span>&nbsp;,&nbsp;</span>
        <input type="text" class="TextBox" placeholder="Start Time [hh:mm:ss]" name="txt_StartTime" value="<?=$s_StartTime?>" />
        <span>&nbsp;-&nbsp;</span>
        <input type="text" class="TextBox" placeholder="Edt Time [hh:mm:ss]" name="txt_EndTime" value="<?=$s_EndTime?>" />
        <span>&nbsp;&nbsp;</span>
        <div style="clear: both; float: left; height: 8px; "></div>
        <div style="clear: both; float: left;"></div>
        <input type="submit" class="Button" value="Submit" name="btn_Submit" />
        <input type="reset" class="Button" value="Reset"  />
        <input type="button" class="Button" value="Clear" onclick="window.location.href='edit.php?i=<?=$s_IndexDay?>';"  />
        <input type="button" class="Button" value="Back" onclick="window.location.href='index.php';"  />
    </form>
</div>

      

<?php
ob_flush();
?>