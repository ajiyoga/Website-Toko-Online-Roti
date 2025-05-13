<?php
// Pastikan header dikirim sebelum output HTML
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Koneksi hosting
$servername = "sql307.infinityfree.com";
$username = "if0_38798937";
$password = "ha1sjkrz";
$dbname = "if0_38798937_dbpw192_18410100054";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

$result = mysqli_query($conn, "SELECT * FROM produksi WHERE terima = 1 AND tanggal BETWEEN '$date1' AND '$date2'");

$no = 1;
$totalQty = 0;
$totalNominal = 0;
?>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Tanggal</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Sub Total</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { 
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
        <td colspan="6"><b>Total Jumlah Terjual = <?= $totalQty; ?> | Total Pendapatan = Rp <?= number_format($totalNominal, 0, ',', '.'); ?></b></td>
    </tr>
</table>
