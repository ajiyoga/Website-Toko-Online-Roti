<?php 
include 'header.php';
$date = date('Y-m-d');
if(isset($_POST['submit'])){
	$date1 = $_POST['date1'] ?? $date;
    $date2 = $_POST['date2'] ?? $date;

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
		.table th, .table td {
			font-size: 12px;
			padding: 8px;
		}
		.form-control {
			width: 100%;
			margin-bottom: 10px;
		}
		.btn {
			width: 100%;  /* Membuat tombol memenuhi lebar layar */
			margin-bottom: 10px;
		}
		.bg-success, .bg-danger {
			font-size: 14px;
		}
	}
</style>

<div class="container">
	<h2 style="width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Laporan Profit</b></h2>
	<div class="row print">
		<div class="col-md-9">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<table>
					<tr>
						<td><input type="date" name="date1" class="form-control" value="<?= $date; ?>"></td>
						<td>&nbsp; - &nbsp;</td>
						<td><input type="date" name="date2" class="form-control" value="<?= $date; ?>"></td>
						<td> &nbsp;</td>
						<td><input type="submit" name="submit" class="btn btn-primary" value="Tampilkan"></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="col-md-3">
			<form action="exp_profit.php" method="POST">
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
				<th>Invoice</th>
				<th>Nama Produk</th>
				<th>Harga</th>
				<th>Qty</th>
				<th>Subtotal</th>
				<th>Tanggal</th>
			</tr>
			<?php 
			if(isset($_POST['submit'])){
				$result = mysqli_query($conn, "SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
				$no=1;
				$total = 0;
				while ($row = mysqli_fetch_assoc($result)) {
					?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= $row['invoice']; ?></td>
						<td><?= $row['nama_produk']; ?></td>
						<td><?=  number_format($row['harga']); ?></td>
						<td><?= $row['qty']; ?></td>
						<td><?= number_format($row['harga']*$row['qty']); ?></td>
						<td><?= $row['tanggal']; ?></td>
					</tr>
					<?php 
                    
					$total += $row['harga']*$row['qty'];
					$no++;
				}
				?>
				<tr>
					<td colspan="7" class="text-right"><b>Total Pendapatan Kotor = <?= number_format($total); ?></b></td>
				</tr>
			</table>
            
			<hr>
			
				<?php 
				}
				?>
			</table>
		</div>
	</div>

	<br><br><br><br><br>
</div>

<?php 
include 'footer.php';
?>