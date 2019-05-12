<?php

function sensor($teks) { 
     $sensoran = "anjing,bangsat,pler,tai";
     $pisah = explode(",", $sensoran);
     $tot = count($pisah);
     for ($i=0; $i < $tot; $i++) {
          $teks = eregi_replace($pisah[$i], "*SENSOR*", $teks);
     }
     return $teks;
}
echo sensor("anjing , bangsat, pler, tai");

?>