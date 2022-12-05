<h2>Detail Pembelian</h2>
<?php 
$ambil= $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
	ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
	WHERE pembelian.id_pembelian = '$_GET[id]'");
$detail = $ambil-> fetch_assoc();

$detail_id_pembelian = $detail["id_pembelian"];
$ambil_detail_pembayaran = $koneksi->query("SELECT * FROM `pembayaran` WHERE `id_pembelian` = '$detail_id_pembelian'");
$detail_pembayaran = $ambil_detail_pembayaran-> fetch_assoc();

?>


<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
<p>
	<?php echo $detail['telphone_pelanggan']; ?><br>
	<?php echo $detail['email_pelanggan']; ?>
</p>
<p>
	Tanggal         : <?php echo $detail['tanggal_pembelian'];?><br>
	total pembelian : <?php echo $detail['total_pembelian']; ?>
</p>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pembeli</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>total Harga</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN pembelian on pembelian_produk.id_pembelian= pembelian.id_pembelian WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_pembeli']; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['harga']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				<?php echo $pecah['harga']*$pecah['jumlah']; ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
<h3>Bukti Pembayaran</h3>
<img src="<?php echo "../bukti_pembayaran/" . $detail_pembayaran["bukti"];?>" height="500px">