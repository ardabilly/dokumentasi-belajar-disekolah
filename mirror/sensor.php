<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"&gt;

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Sensor Kata : tutorlogi</title>

</head>

<?php

// function untuk menyensor kata dari inputan pesan

function sensor($isi_pesan){

$isi_pesan = ereg_replace ("bangsat","sensor", $isi_pesan);

$isi_pesan = ereg_replace ("anjing","sensor", $isi_pesan);

$isi_pesan = ereg_replace ("asu","sensor", $isi_pesan);

$isi_pesan = ereg_replace ("kehed","maafkalimatinidisensorgan", $isi_pesan);

$isi_pesan = ereg_replace ("monyet","tutttttttt", $isi_pesan);

$isi_pesan = ereg_replace ("goblok","isisendiri", $isi_pesan);

return $isi_pesan;

}

?>

<body>

Masukan pesan anda, kata yang akan tersensor (bangsat, anjing, asu, kehed, monyet, goblok) :

<form  name="form1" method="post" action="" enctype="multipart/form-data">

<p>

<textarea name="pesan"  cols="45" rows="5"></textarea>

</p>

<input type="submit" name="button" value="Kirim Pesan" />

</form>

<?php

$sensor_pesan = sensor($_POST["pesan"]);

echo "<p><h2>Pesan ditampilkan dibawah ini : </h2> $sensor_pesan </p>";

?>
</body>

</html>