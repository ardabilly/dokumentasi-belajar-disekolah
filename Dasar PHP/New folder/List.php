<?php
ob_start();

//==============================================================================
// Class Management
//==============================================================================

include_once './App Code/Class_Class.php';
$c_Class = new Class_Class();

//==============================================================================
// Variable
//==============================================================================


$s_Search = "";
if(isset($_GET["txt_Search"]) && strlen(trim($_GET["txt_Search"])) != 0)
    $s_Search = trim($_GET["txt_Search"]);

$array_List = $c_Class->array_Get_AllClassID($s_Search);

?>

<table class="DataTable">
    <tr class="tHead">
        <td>No</td>
        <td>Class</td>
        <td>Semester Level</td>
        <td>Status</td>
        <td></td>
    </tr>
    <?php
    for($var = 0; $var < count($array_List); $var++)
    {
        $s_ClassID = $array_List[$var];
        $array_Data = $c_Class->array_Get_DataClass($s_ClassID);
        
        
        ?>
        <tr class="tBody">
            <td class="c_Center"  ><?=$var+1?></td>
            <td class="c_Left"    ><?=$array_Data[1]?></td>
            <td class="c_Center"  ><?=$array_Data[2]?></td>
            <td class="c_Left"    ><?=$array_Data[3]?></td>
            <td class="c_Manage"  >
                <a href="class.php?id=<?=$s_ClassID?>&view=Profile" id="View">
                    <img src="Images/Icon/View 01.png"/>
                </a>
                <a href="class.php?id=<?=$s_ClassID?>&action=Update" id="Edit">
                    <img src="Images/Icon/Edit 01.png"/>
                </a>
                <a href="class.php?id=<?=$s_ClassID?>&action=Delete" id="Delete" onclick="return confirm('Are you sure you want to delete this data?');" >
                    <img src="Images/Icon/Delete 01.png"/>
                </a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<?php
ob_flush();
?>