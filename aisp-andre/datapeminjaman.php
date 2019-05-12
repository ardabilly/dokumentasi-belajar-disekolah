<?php 
include_once("class/class_barang.php");
$var = new class_barang();


 ?>


<a href="?page=inputpeminjaman" class="btn btn-primary">Input Peminjaman</a>

<div class="page-header">
	<h3><b>Data Peminjaman</b></h3>
</div>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr class="th">
				<th>NO</th>
				<th>NO PINJAM</th>
				<th>TANGGAL PINJAM</th>
				<th>KODE BARANG</th>
				<th>NAMA BARANG</th>
				<th>JUMLAH PINJAM</th>
				<th>NAMA PEMINJAM</th>
				<th>TANGGAL KEMBALI</th>
				<th>KETERANGAN</th>
				<th colspan="2">PILIHAN</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no='1';
				foreach ($var->lihat_barangpinjaman() as $baris){
				?>
					<tr class="text-center">
						<td><?php echo $no++; ?></td>
						<td><?php echo $baris['nomor_pinjam']; ?></td>
						<td><?php echo date('d/F/Y',strtotime($baris['tgl_pinjam'])); ?></td>
						<td><?php echo $baris['kode_barang']; ?></td>
						<td><?php echo $baris['nama_barang']; ?></td>
						<td><?php echo $baris['jumlah_pinjam']; ?></td>
						<td><?php echo $baris['peminjam']; ?></td>
						<td><?php echo date('d/F/Y',strtotime($baris['tgl_kembali'])); ?></td>
						<td><?php echo $baris['keterangan']; ?></td>
						<?php if($baris["keterangan"] == "Telah dikembalikan"){?>
						<td colspan="2"><a href="proses_barang.php?aksi=hapus_pinjambarang&nopinjam=<?=$baris['nomor_pinjam']?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">Hapus</a></td>
						<?php }else{ ?>
						<td width="120">
							<form action="proses_barang.php?aksi=kembalibarang" method="post">
								<select style="font-size: 10px" name="tstatus" id="tstatus" class="form-control" required>
								<option selected="selected">-- Pilih --</option>
								<option value="Telah dikembalikan">Telah dikembalikan</option>
								</select>
						</td>
						<td>

								<label for="tnopinjam"></label>
								<input name="tnopinjam" type="text" id="tnopinjam" value="<?php echo $baris['nomor_pinjam']; ?>"  hidden="hidden"/>
								<input style="border-bottom:none !important; background: #286090; color: #fff" type="submit" value="proses" class="btn btn-default" name="submit" />
							</form>
						</td>
						<?php } ?>
						
					</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>