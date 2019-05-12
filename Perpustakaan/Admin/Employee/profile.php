<?php
ob_start();

// CLASS MANAGEMENT

include_once'../App Code/Class_Employee.php';
$c_Employee = new Class_Employee();

include_once'../App Code/Class_Variable.php';
$c_Variable = new Class_Variable();

// Check Availablity

if (!isset($_GET["id"]) || (isset($_GET["id"]) && strlen(trim($_GET["id"])) == 0 )) 
{
	echo $c_Variable->string_Set_RedirectPage("employee.php");
}
if (isset($_GET["id"]) && !$c_Employee->bool_Check_EmployeeID($_GET["id"]) ) 
{
	echo $c_Variable->string_Set_MessageBox("This data not found");
	echo$c_Variable->string_Set_RedirectPage("employee.php");
}

// VARIABLE

$s_EmployeeID = $_GET["id"];
$array_DataEmployee = $c_Employee->array_Get_DataEmployee($s_EmployeeID);

?>

<div class="EmployeeData" >
	<img src="<?=$c_Employee->string_Set_ImageEmployee($s_EmployeeID, "../")?>" class="Photo" />
	<div class="DataDetail">
		<div class="Data">
			<span class="Lable">Employee ID</span>
			<span><?=$s_EmployeeID?></span>
		</div>
		<div class="Data">
			<span class="Lable">Full name</span>
			<span><?=$array_DataEmployee[1]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Gender</span>
			<span><?=$array_DataEmployee[2]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Religion</span>
			<span><?=$array_DataEmployee[3]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Place and date of birth</span>
			<span><?=$array_DataEmployee[4]?>, <?= date("l, F d, Y", strtotime($array_DataEmployee[5])) ?></span>
		</div>
		<div class="Data">
			<span class="Lable">Phone number</span>
			<span><?=$array_DataEmployee[6]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Email</span>
			<span><?=$array_DataEmployee[7]?></span>
		</div>
		<div class="Data">
			<span class="Lable">Address</span>
			<span><?=$array_DataEmployee[8]?></span>
		</div>
	</div>
</div>

<div class="Form" style="background-color:transparent ; padding: 0; margin-top: 20px;">
	<input type="button" name="" value="Gallery" class="ButtonInsert" onclick="window.location.href='employee.php';">
	<span>&nbsp;</span>
	<input type="button" value="Update Data" name="" class="ButtonSubmit" onclick="window.location.href='employeeupdate.php?id=<?=$s_EmployeeID?>';" />
	<span>&nbsp;</span>
	<a href="employeeprofile.php?action=Delete&id=<?=$s_EmployeeID?>" class="ButtonDelete" onclick="return confirm('Are you sure want to delete this data?');" style='text-decoration: none;'>Delete</a>
</div>
<style>
.EmployeeData
{
    clear: both; float: left;
    width: 100%;
}
.EmployeeData .Photo
{
    float: left;
    width: 200px; height: 250px;
    background-color: #ffffff;
    border: 2px solid #0046ae;

    margin-right: 10px;
}
.EmployeeData .DataDetail
{
    float: left;
}
.EmployeeData .DataDetail .Data
{
    clear: both; float: left;
    margin-bottom: 8px;
}
.EmployeeData .DataDetail .Data span
{
    float: left;
    font-size: 14px;
    color:#ffffff;
}
.EmployeeData .DataDetail .Data .Lable
{ width: 150px; }

</style>

<?php
ob_flush();
?>
