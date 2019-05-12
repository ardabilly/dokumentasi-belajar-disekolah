<?php 
include_once("class/class_barang.php");
$var = new class_barang();

 ?>

<a href="?page=barangbaru" class="btn btn-primary">Input Barang Baru</a>


<div class="page-header">
	<h3><b>Data Barang</b></h3>
</div>
	<div class="table-responsive">
		<table class="table table-hovered table-bordered table-striped">
			<thead>
				<tr class="th">
					<th>NO</th>
					<th>KODE BARANG</th>
					<th>NAMA</th>
					<th>SPESIFIKASI</th>
					<th>LOK.BARANG</th>
					<th>KATEGORI</th>
					<th>STOK</th>
					<th>KONDISI</th>
					<th>J.BARANG</th>
					<th>SUMBER DANA</th>
					<th colspan="2">AKSI</th>
				</tr>
			</thead>

			<tbody>
				<?php 
					$no =1;
					foreach($var->lihat() as $baris){
					?>
						<tr class="td">
							<td><?php echo $no++; ?></td>
							<td><?php echo $baris['kode_barang']; ?></td>
							<td><?php echo $baris['nama_barang']; ?></td>
							<td><?php echo $baris['spesifikasi']; ?></td>
							<td><?php echo $baris['lokasi_barang']; ?></td>
							<td><?php echo $baris['kategori']; ?></td>
							<td><?php echo $baris['jumlah_brg']; ?></td>
							<td><?php echo $baris['kondisi']; ?></td>
							<td><?php echo $baris['jenis_brg']; ?></td>
							<td><?php echo $baris['sumber_dana']; ?></td>
							<td><a href="index.php?page=editbarang&amp;kode_barang=<?=$baris['kode_barang'];?>">Edit</a></td>
							<td><a href="proses_barang.php?aksi=hapusbarang&amp;kode_barang=<?=$baris['kode_barang'];?>" onclick="return confirm('Apakah Anda Yakin Hapus barang?')">Hapus</a></td>
						</tr>
					<?php
					}
				?>
			</tbody>
		</table>
	</div>
<a onclick="window.history.back()" class="btn btn-danger"><< Kembali</a>
</div>