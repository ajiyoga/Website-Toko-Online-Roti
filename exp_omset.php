<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Omset.xls");
header("Pragma: no-cache");
header("Expires: 0");

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
$total = 0;
?>

<table border="1">
    <tr>
        <th>No</th>
        <th>Invoice</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>Tanggal</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['invoice']; ?></td>
        <td><?= $row['nama_produk']; ?></td>
        <td><?= number_format($row['harga']); ?></td>
        <td><?= $row['qty']; ?></td>
        <td><?= number_format($row['harga'] * $row['qty']); ?></td>
        <td><?= $row['tanggal']; ?></td>
    </tr>
    <?php $total += $row['harga'] * $row['qty']; } ?>
    <tr>
        <td colspan="7"><b>Total Pendapatan Kotor = <?= number_format($total); ?></b></td>
    </tr>
</table>
