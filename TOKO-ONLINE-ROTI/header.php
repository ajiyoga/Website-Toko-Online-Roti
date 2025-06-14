<?php 
session_start();
include 'koneksi/koneksi.php';
if(isset($_SESSION['kd_cs'])){

	$kode_cs = $_SESSION['kd_cs'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Unesa-Cake Backery</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
	<script  src="js/jquery.js"></script>
	<script  src="js/bootstrap.min.js"></script>


</head>
<body>
	<div class="container-fluid">
		<div class="row top">
			<center>
				<div class="col-md-4" style="padding: 3px;">
					<span> <i class="glyphicon glyphicon-earphone"></i> +6285855094087</span>
				</div>


				<div class="col-md-4"  style="padding: 3px;">
					<span><i class="glyphicon glyphicon-envelope"></i> unesa-cakebakery@gmail.com</span>
				</div>


				<div class="col-md-4"  style="padding: 3px;">
					<span>unesa-cake bakery Indonesia</span>
				</div>
			</center>
		</div>
	</div>

	<nav class="navbar navbar-default" style="padding: 5px;">
		<div class="container">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#" style="color:rgb(0, 0, 0)"><b>UNESA-CAKE BAKERY</b></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Home</a></li>
					<li><a href="produk.php">Produk</a></li>
					<li><a href="about.php">Tentang Kami</a></li>
					<li><a href="manual.php">Manual Aplikasi</a></li>
					<?php 
					if(isset($_SESSION['kd_cs'])){
					$kode_cs = $_SESSION['kd_cs'];
					$cek = mysqli_query($conn, "SELECT kode_produk from keranjang where kode_customer = '$kode_cs' ");
					$value = mysqli_num_rows($cek);

						?>
						<li><a href="keranjang.php"><i class="glyphicon glyphicon-shopping-cart"></i> <b>[ <?= $value ?> ]</b></a></li>

						<?php 
					}else{
						echo "
						<li><a href='keranjang.php'><i class='glyphicon glyphicon-shopping-cart'></i> [0]</a></li>

						";
					}
					if(!isset($_SESSION['user'])){
						?>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Akun <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="user_login.php">login</a></li>
								<li><a href="register.php">Register</a></li>
							</ul>
						</li>
						<?php 
					}else{
						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?= $_SESSION['user']; ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="proses/logout.php">Log Out</a></li>
							</ul>
						</li>

						<?php 
					}
					?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<!-- Chatbot UI -->
<style>
  #chatbot-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 320px;
    max-height: 500px;
    background: white;
    border: 1px solid #ccc;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    z-index: 9999;
    display: none;
    flex-direction: column;
  }

  #chatbot-header {
    background: #337ab7;
    color: white;
    padding: 10px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    font-weight: bold;
  }

  #chatbot-messages {
    padding: 10px;
    overflow-y: auto;
    height: 300px;
    font-size: 14px;
  }

  .chatbot-message {
    margin-bottom: 10px;
  }

  .chatbot-user {
    text-align: right;
    color: #337ab7;
  }

  .chatbot-bot {
    text-align: left;
    color: #444;
  }

  #chatbot-input-container {
    display: flex;
    padding: 10px;
  }

  #chatbot-input {
    flex: 1;
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }

  #chatbot-send {
    margin-left: 5px;
    padding: 6px 12px;
    background: #337ab7;
    color: white;
    border: none;
    border-radius: 6px;
  }

  #chatbot-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #337ab7;
    color: white;
    border-radius: 50%;
    width: 55px;
    height: 55px;
    text-align: center;
    line-height: 55px;
    font-size: 24px;
    cursor: pointer;
    z-index: 9999;
  }
</style>

<div id="chatbot-toggle">💬</div>

<div id="chatbot-container">
  <div id="chatbot-header">Selamat Datang Di Unesa Cake Bakery</div>
  <div id="chatbot-messages"></div>
  <div id="chatbot-input-container">
    <input type="text" id="chatbot-input" placeholder="Tanyakan sesuatu...">
    <button id="chatbot-send">Kirim</button>
  </div>
</div>

<script>
  $('#chatbot-toggle').click(function () {
    $('#chatbot-container').toggle();
  });

  $('#chatbot-send').click(function () {
    sendMessage();
  });

  $('#chatbot-input').keypress(function(e){
    if (e.which == 13) sendMessage();
  });

  function sendMessage() {
    var message = $('#chatbot-input').val();
    if (message.trim() === '') return;

    $('#chatbot-messages').append('<div class="chatbot-message chatbot-user">' + message + '</div>');
    $('#chatbot-input').val('');

    $.post('chatbot.php', {message: message}, function(response) {
      $('#chatbot-messages').append('<div class="chatbot-message chatbot-bot">' + response + '</div>');
      $('#chatbot-messages').scrollTop($('#chatbot-messages')[0].scrollHeight);
    });
  }
</script>
