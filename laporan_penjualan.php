<?php 
include 'header.php';
$date = date('Y-m-d');

$date1 = '';
$date2 = '';

if(isset($_POST['submit'])){
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
}
?>
<style type="text/css">
	@media print{
		.print{
			display: none;
		}
	}
	@media (max-width: 767px) {
		.container {
			padding: 10px;
		}
		.table-responsive {
			overflow-x: auto;
		}
		.form-control {
			width: 100%;
			margin-bottom: 10px;
		}
		.btn {
			width: 100%;
			margin-bottom: 10px;
		}
		.table th, .table td {
			padding: 8px;
		}
		.table-striped th, .table-striped td {
			font-size: 12px;
		}
		.table-striped {
			font-size: 14px;
		}
		.bg-success, .bg-primary, .bg-default {
			width: 100%;
		}
	}
</style>

<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Laporan Penjualan</b></h2>
	<div class="row print">
		<div class="col-md-9">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<table>
					<tr>
						<td><input type="date" name="date1" class="form-control" value="<?= $date1 ?: $date; ?>"></td>
						<td>&nbsp; - &nbsp;</td>
						<td><input type="date" name="date2" class="form-control" value="<?= $date2 ?: $date; ?>"></td>
						<td> &nbsp;</td>
						<td><input type="submit" name="submit" class="btn btn-primary" value="Tampilkan"></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="col-md-3">
			<form action="exp_penjualan.php" method="POST">
				<table>
					<tr>
						<td><input type="hidden" name="date1" class="form-control" value="<?= $date1; ?>"></td>
						<td><input type="hidden" name="date2" class="form-control" value="<?= $date2; ?>"></td>
						<td><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save-file"></i> Export to Excel</button></td>
						<td> &nbsp;</td>
						<td><a href="" onclick="window.print()" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Cetak</a></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<br><br>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Tanggal</th>
				<th>Qty</th>
				<th>Harga</th>
				<th>Sub Total</th>
			</tr>
			<?php 
			if(isset($_POST['submit'])){
				$conn = new mysqli("sql307.infinityfree.com", "if0_38798937", "ha1sjkrz", "if0_38798937_dbpw192_18410100054");
				if ($conn->connect_error) {
					die("Koneksi gagal: " . $conn->connect_error);
				}
				$result = mysqli_query($conn, "SELECT * FROM produksi WHERE terima = 1 AND tanggal BETWEEN '$date1' AND '$date2'");

				$no = 1;
				$totalQty = 0;
				$totalNominal = 0;

				while ($row = mysqli_fetch_assoc($result)) {
					$harga = $row['harga'];
					$qty = $row['qty'];
					$subTotal = $qty * $harga;
					$totalQty += $qty;
					$totalNominal += $subTotal;
			?>
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $row['nama_produk']; ?></td>
				<td><?= $row['tanggal']; ?></td>
				<td><?= $qty; ?></td>
				<td><?= number_format($harga, 0, ',', '.'); ?></td>
				<td><?= number_format($subTotal, 0, ',', '.'); ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td colspan="6" class="text-right"><b>Total Jumlah Terjual = <?= $totalQty; ?> | Total Pendapatan = Rp <?= number_format($totalNominal, 0, ',', '.'); ?></b></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>
<br><br><br><br><br>
<?php include 'footer.php'; ?>
