<nav class="navbar navbar-default navbar-top" style="padding-top: 30px; padding-bottom:40px; padding-right:20px; padding-left:20px;background-color: #333;border-radius: 0; border:0;">
  <div class="container-fluid ">
    <div class="navbar-header">
      <a href="#" class="navbar-brand" style="color: #fff; letter-spacing: 5px; font-size: 22px">
        <b>APLIKASI INVENTORY BARANG</b><br>
        <span style="font-size: 15px;">ujikompetensi 2017/2018</span>
      </a>
    </div>
  </div>
</nav>
<nav class="navbar navbar-defatult navbar-top" style="bottom:3%;background-color: #286090; padding: 0px 5px; border-radius: 0; color: #fff; letter-spacing: 4px; border:0; box-shadow: 0px 3px 5px gray">
 <div class="container-fluid">
   <ul class="nav navbar-nav">
     <li id="home"><a href="index.php">Home</a></li>
     <li class="dropdown" id="barang">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Barang
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="?page=barang">Data Barang</a></li>
          <li id="barangmasuk"><a href="?page=barangmasuk">Barang Masuk</a></li>
          <li><a href="?page=datapeminjaman">Pinjam Barang</a></li>
        </ul>
      </li>
     
     <li id="stok"><a href="?page=stok">Stok</a></li>
     <li id="supplier"><a href="?page=supplier">Supplier</a></li>
     <!-- <li id="setting"><a href="">Setting</a></li> -->
     <li><a href="?signout">Logout</a></li>
   </ul>
 </div>
</nav>

<?php 
  error_reporting(0);

  if($_GET["page"] == "barang")
  {
    ?>
      <script> 
        document.getElementById('barang').style.backgroundColor="#333";
      </script>
    <?php
  }
  elseif($_GET["page"] == "stok")
  {
    ?>
      <script> 
        document.getElementById('stok').style.backgroundColor="#333";
      </script>
    <?php
  }
   elseif($_GET["page"] == "supplier")
  {
    ?>
      <script> 
        document.getElementById('supplier').style.backgroundColor="#333";
      </script>
    <?php
  }

    elseif($_GET["page"] == "barangmasuk")
  {
    ?>
      <script> 
        document.getElementById('barangmasuk').style.backgroundColor="#333";
      </script>
    <?php
  }

  elseif(!isset($_GET["page"]))
  {

    ?>
      <script> 
        document.getElementById('home').style.backgroundColor="#333";
      </script>
    <?php
  }
  
 ?>