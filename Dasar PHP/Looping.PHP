<html>
    <head>
        <title>vav</title>
    </head>
    <body bgcolor='hotblue'>
    <?php
        for($var = 1900; $var < 2200;$var++)
        {
            $kabisat = ($var %4==0) ? "Kabisat" : "Biasa";
            
            $ya = ($var %2==0) ? "Genap" : "Ganjil";
            
            echo "tahun <b style='color:#b9b9b9;'>$var</b> adalah tahun <b style='color:red;'>$kabisat</b> dan bilangan <b style='color:blue'><i>$ya</i></b> </br></br> ";
        }
        //Tahun $var adalah,tahun <Kabisat,Biasa> dan bilangan <genap/ganjil> 1900-2200
    ?>
        
    </body> 
</html>