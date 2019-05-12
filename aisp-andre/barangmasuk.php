<?php 
include_once("class/class_barang.php");
$var = new class_barang();
?>

<a href="?page=inputbarangmasuk" class="btn btn-primary">Input Barang Masuk</a> 
<div class="page-header">
	<h3><b>Data Barang Masuk</b></h3>
</div>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr class="th">
					<th>NO</th>
					<!-- <th>ID MSKBARANG</th> -->
					<th>KODE</th>
					<th>NAMA</th>
					<th>SPEK</th>
					<th>LOK.BARANG</th>
					<th>KATEGORI</th>
					<th>JML.MASUK</th>
					<th>KONDISI</th>
					<th>JENIS BARANG</th>
					<th>SUMBER DANA</th>
					<th>TGL MASUK</th>
					<th>SUPPLIER</th>
					<th>KET</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no =1;
					foreach($var->lihat_barangmasuk() as $baris){
					?>
						<tr class="td">
							<td><?php echo $no++; ?></td>
							<!-- <td><?php echo $baris['id_masukbarang']; ?></td> -->
							<td><?php echo $baris['kode_barang']; ?></td>
							<td><?php echo $baris['nama_barang']; ?></td>
							<td><?php echo $baris['spesifikasi']; ?></td>
							<td><?php echo $baris['lokasi_barang']; ?></td>
							<td><?php echo $baris['kategori']; ?></td>
							<td><?php echo $baris['jumlah_masuk']; ?></td>
							<td><?php echo $baris['kondisi']; ?></td>
							<td><?php echo $baris['jenis_brg']; ?></td>
							<td><?php echo $baris['sumber_dana']; ?></td>
							<td><?php echo date('d/F/Y',strtotime($baris['tgl_masuk'])) ?></td>
							<td><?php echo $baris['nama_supplier']; ?></td>
							<td><?php echo $baris['keterangan']; ?></td>
						</tr>
					<?php
					}
				?>
			</tbody>
		</table>
	</div>
<a onclick="window.history.back()" class="btn btn-danger"><< Kembali</a>
 <p></