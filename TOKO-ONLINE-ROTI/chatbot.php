<?php
include 'koneksi/koneksi.php';

$message = strtolower(trim($_POST['message']));
$response = "Maaf, saya tidak mengerti pertanyaan Anda.";

// Pastikan koneksi OK
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Jawaban statis untuk produk yang tersedia saat ini
$produk_tersedia = "Produk yang tersedia saat ini adalah Kue Roti Sobek, Kue Maryam, Kue Tart Coklat.";

// Deteksi kata kunci dengan regex agar lebih fleksibel
if (preg_match('/^(hallo|halo|hai|helo)$/', $message)) {
    $response = "Hai juga! Apa yang bisa kami bantu?";
} elseif (preg_match('/produk|daftar produk|menu/', $message)) {

    // Jika kalimat menanyakan secara spesifik produk yang tersedia
    if (preg_match('/apa (produk )?yang tersedia|produk apa/', $message)) {
        $response = $produk_tersedia;
    } else {
        // Ambil dari database sebagai fallback
        $result = mysqli_query($conn, "SELECT nama_produk, harga FROM produk LIMIT 5");
        if ($result && mysqli_num_rows($result) > 0) {
            $response = "Berikut beberapa produk kami:<br>";
            while ($row = mysqli_fetch_assoc($result)) {
                $response .= "- " . htmlspecialchars($row['nama_produk']) . " (Rp" . number_format($row['harga']) . ")<br>";
            }
        } else {
            $response = "Maaf, produk tidak tersedia saat ini.";
        }
    }

} elseif (preg_match('/jam|buka|operasional|waktu buka/', $message)) {
    $response = "Kami buka setiap hari Pukul 08.00 - 20.00.";
} elseif (preg_match('/alamat|lokasi|dimana/', $message)) {
    $response = "Toko kami berlokasi di Jl. Ketintang, Ketintang, Kec.Gayungan, Surabaya, Jawa Timur";
} elseif (preg_match('/metode pembayaran|cara bayar|pembayaran apa/', $message)) {
    $response = "Metode pembayaran yang kami terima adalah transfer bank BCA, BNI, BRI, QRIS, serta e-wallet Dana, OVO, GoPay, dan COD (Cash on Delivery).";
} elseif (preg_match('/whatsapp|nomor whatsapp|wa|hubungi kami|kontak/', $message)) {
    $response = "Nomor WhatsApp admin kami adalah 085855094087. Silakan hubungi kapan saja.";
} elseif (preg_match('/(alur|cara|langkah).*(pesan|pemesanan|order)/', $message)) {
    $response = "Berikut alur pemesanan di Unesa Cake & Bakery:<br><br>" .
                "1. Klik menu <b>Register</b> untuk mendaftar akun.<br>" .
                "2. Login menggunakan akun Anda.<br>" .
                "3. Pilih produk yang diinginkan dan klik <b>Tambah ke Keranjang</b>.<br>" .
                "4. Masuk ke halaman <b>Keranjang</b> dan lanjutkan ke <b>Checkout</b>.<br>" .
                "5. Isi data pengiriman dan pilih metode pembayaran.<br>" .
                "6. Klik tombol <b>Pesan Sekarang</b> untuk menyelesaikan pesanan.<br>" .
                "7. Admin akan menghubungi Anda melalui WhatsApp untuk konfirmasi.";
}

echo $response;
?>
