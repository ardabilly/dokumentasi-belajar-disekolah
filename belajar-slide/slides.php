<html>
    <head>
        <title>Rubah Background</title>
    
    <script>
        var array_Name = ["gambar1.jpg","gambar2.jpg","gambar3.jpg"];
        var i_Index = 0;
        
       function set_ChangeBackground()
       {
           //alert("url('" +array_Name[i_Index]+"')");
           document.getElementById("BodyTag").style.backgroundImage = "url('" +array_Name[i_Index]+"')";
           i_Index++;
           if(i_Index == array_Name.length)
               i_Index = 0;
       }
       var load = self.setInterval("set_ChangeBackground()",1000);
    </script>
    </head>
    
        <body id="BodyTag" style="width: 50%;">
        
        </body>
</html>