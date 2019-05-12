
<?php
  // membuat query max untuk kode barang
  include_once("dbcon.php");
  $carikode = mysqli_query($db,"select * from tbl_barang");
  $count = mysqli_num_rows($carikode);
  $hasilkode = $count+1;
 ?>
