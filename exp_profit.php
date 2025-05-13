<?php
// Pastikan header dikirim sebelum output HTML
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Profit.xls");
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
        <td><?= $no; ?></td>
        <td><?= $row['invoice']; ?></td>
        <td><?= $row['nama_produk']; ?></td>
        <td><?= number_format($row['harga']); ?></td>
        <td><?= $row['qty']; ?></td>
        <td><?= number_format($row['harga'] * $row['qty']); ?></td>
        <td><?= $row['tanggal']; ?></td>
    </tr>
    <?php 
    $total += $row['harga'] * $row['qty'];
    $no++;
    } ?>
    <tr>
        <td colspan="7"><b>Total Pendapatan Kotor = <?= number_format($total); ?></b></td>
    </tr>
</table>

<br><h4><b>Pemotongan dengan Biaya Bahan Baku</b></h4>
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Bahan Baku</th>
        <th>Harga</th>
        <th>Kebutuhan</th>
        <th>Subtotal</th>
    </tr>
    <?php 
    $result = mysqli_query($conn, "SELECT * FROM produksi WHERE terima = 1 AND tanggal BETWEEN '$date1' AND '$date2'");
    $no1 = 1;
    $totalb = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $kd = $row['kode_produk'];
        $bahan = mysqli_query($conn, "SELECT b.kebutuhan as kebutuhan, i.nama as nama, i.harga as harga 
            FROM bom_produk b 
            JOIN inventory i ON b.kode_bk = i.kode_bk 
            WHERE b.kode_produk = '$kd'");
        while ($row1 = mysqli_fetch_assoc($bahan)) {
            ?>
            <tr>
                <td><?= $no1; ?></td>
                <td><?= $row1['nama']; ?></td>
                <td><?= number_format($row1['harga']); ?></td>
                <td><?= $row1['kebutuhan']; ?></td>
                <td><?= number_format($row1['harga'] * $row1['kebutuhan']); ?></td>
            </tr>
            <?php 
            $totalb += $row1['harga'] * $row1['kebutuhan'];
            $no1++;
        }
    }
    ?>
    <tr>
        <td colspan="5"><b>Total Biaya Bahan Baku = <?= number_format($totalb); ?></b></td>
    </tr>
    <tr>
        <td colspan="5" style="color: green;"><b>TOTAL PENDAPATAN BERSIH = <?= number_format($total - $totalb); ?></b></td>
    </tr>
</table>
