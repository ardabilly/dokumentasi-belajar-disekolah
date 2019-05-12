<html>
    <head>
        <title>Boolean</title>
    </head>
    <body>
        <?php
            $numw=5;
            $numq=3;
            if($numw !=$numq)
                echo "Hai";
            else if($numw>$numq)
                echo "Hello";
            
            $numw="Hai";
            $numq="hai";
            if($numw ==$numq)
                echo " Hello";
            else 
                echo " Hoo";
               
            
        ?>
    </body>
</html>