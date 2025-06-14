<?php 
include 'header.php';
?>

<style>
    .bs-acc {
        margin: 20px;
    }
    .manual-step {
        margin-bottom: 30px;
    }
    .svg-container {
        max-width: 800px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-top: 15px;
        padding: 15px;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .svg-container svg {
        width: 100%;
        height: auto;
    }
</style>

<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid #ff8680"><b>Manual Aplikasi</b></h2>
    <div class="bs-acc">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color:#000;">
                    <div class="panel-heading" style="background-color: #eee;">
                        <h4 class="panel-title">
                            Cara Registrasi di Unesa Cake & Bakery
                        </h4>
                    </div>
                </a>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <!-- Langkah 1 -->
                        <div class="manual-step">
                            <b>Langkah 1:</b> Klik menu <i>"Register"</i> di pojok kanan atas halaman utama.
                            <div class="svg-container">
                                <svg viewBox="0 0 800 100" role="img" aria-labelledby="title-step1">
                                    <title id="title-step1">Ilustrasi Menu Register</title>
                                    <!-- Navbar Background -->
                                    <rect width="100%" height="60" fill="url(#navGradient)"></rect>
                                    
                                    <!-- Navbar Content -->
                                    <g font-family="Arial" font-size="14">
                                        <!-- Logo -->
                                        <rect x="20" y="15" width="120" height="30" rx="4" fill="#fff"/>
                                        <text x="30" y="35" fill="#333" font-weight="bold">UNESA BAKERY</text>
                                        
                                        <!-- Menu Items -->
                                        <g fill="#666">
                                            <text x="180" y="35">Home</text>
                                            <text x="250" y="35">Produk</text>
                                            <text x="330" y="35">Tentang Kami</text>
                                        </g>
                                        
                                        <!-- Register Button -->
                                        <g transform="translate(650, 15)">
                                            <rect width="130" height="30" rx="15" fill="#fff" stroke="#007bff" stroke-width="1.5"/>
                                            <text x="65" y="20" text-anchor="middle" fill="#007bff" font-weight="bold">REGISTER</text>
                                        </g>
                                    </g>
                                    
                                    <defs>
                                        <linearGradient id="navGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#f8f9fa"/>
                                            <stop offset="100%" stop-color="#e9ecef"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                        </div>

                        <!-- Langkah 2 -->
                        <div class="manual-step">
                            <b>Langkah 2:</b> Isi formulir registrasi dengan lengkap
                            <div class="svg-container">
                                <svg viewBox="0 0 800 450" role="img" aria-labelledby="title-step2">
                                    <title id="title-step2">Ilustrasi Form Registrasi</title>
                                    <!-- Form Container -->
                                    <rect x="50" y="30" width="700" height="390" rx="8" fill="#f8f9fa"/>
                                    
                                    <!-- Form Title -->
                                    <text x="100" y="70" font-family="Arial" font-size="20" font-weight="bold">Form Registrasi</text>
                                    
                                    <!-- Form Fields -->
                                    <g font-family="Arial" font-size="14" fill="#495057">
                                        <!-- Nama Lengkap -->
                                        <text x="100" y="110">Nama Lengkap:</text>
                                        <rect x="100" y="120" width="600" height="35" rx="4" fill="#fff" stroke="#ced4da"/>
                                        
                                        <!-- Email -->
                                        <text x="100" y="185">Alamat Email:</text>
                                        <rect x="100" y="195" width="600" height="35" rx="4" fill="#fff" stroke="#ced4da"/>
                                        
                                        <!-- Password -->
                                        <text x="100" y="260">Password:</text>
                                        <rect x="100" y="270" width="600" height="35" rx="4" fill="#fff" stroke="#ced4da"/>
                                        <rect x="670" y="275" width="20" height="25" fill="#e9ecef" rx="4"/>
                                        
                                        <!-- Alamat -->
                                        <text x="100" y="335">Alamat:</text>
                                        <rect x="100" y="345" width="600" height="70" rx="4" fill="#fff" stroke="#ced4da"/>
                                    </g>
                                </svg>
                            </div>
                        </div>

                        <!-- Langkah 3 -->
                        <div class="manual-step">
                            <b>Langkah 3:</b> Klik tombol <b>Daftar</b>
                            <div class="svg-container">
                                <svg viewBox="0 0 800 100" role="img" aria-labelledby="title-step3">
                                    <title id="title-step3">Ilustrasi Tombol Daftar</title>
                                    <!-- Button Container -->
                                    <rect x="300" y="20" width="200" height="50" rx="25" fill="#28a745"/>
                                    <text x="400" y="52" font-family="Arial" font-size="16" fill="#fff" text-anchor="middle" font-weight="bold">
                                        DAFTAR SEKARANG
                                    </text>
                                    
                                    <!-- Hover Effect -->
                                    <rect x="300" y="20" width="200" height="50" rx="25" fill="#000" opacity="0" style="transition: opacity 0.3s">
                                        <title>Klik untuk mendaftar</title>
                                    </rect>
                                </svg>
                            </div>
                        </div>

                        <!-- Langkah 4 -->
                        <div class="manual-step">
                            <b>Langkah 4:</b> Notifikasi Registrasi Berhasil
                            <div class="svg-container">
                                <svg viewBox="0 0 800 120" role="img" aria-labelledby="title-step4">
                                    <title id="title-step4">Notifikasi Sukses</title>
                                    <!-- Success Box -->
                                    <rect width="100%" height="100%" rx="8" fill="#d4edda" stroke="#c3e6cb" stroke-width="2"/>
                                    
                                    <!-- Check Icon -->
                                    <path d="M50 60 L70 80 L110 40" fill="none" stroke="#28a745" stroke-width="6" stroke-linecap="round"/>
                                    
                                    <!-- Success Text -->
                                    <text x="140" y="65" font-family="Arial" font-size="18" fill="#155724">
                                        Registrasi Berhasil! Silahkan 
                                        <tspan x="140" y="90">login menggunakan akun Anda</tspan>
                                    </text>
                                </svg>
                            </div>
                        </div>

                        <p><b>Catatan:</b> 
                            <ul>
                                <li>Gunakan password kombinasi huruf dan angka</li>
                                <li>Pastikan email yang digunakan aktif</li>
                                <li>Kolom alamat akan digunakan untuk pengiriman produk</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include 'footer.php';
?>