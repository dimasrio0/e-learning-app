<?php
session_start();
if (isset($_GET['id'])) {
	include 'koneksi.php';
	mysqli_query($koneksi, "SET @now=now()");
	$query_siswa = mysqli_query($koneksi, "SELECT tb_siswa.id, tb_siswa.nisn, tb_siswa.nama, tb_siswa.id_kelas ,tb_kelas.tingkat AS keber,
  	            						   concat (tb_kelas.tingkat , ' - ' , tb_jurusan.nama, ' - ', tb_kelas.Kelas) AS nama_kelas, tb_siswa.alamat
    	          						   FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id INNER JOIN tb_jurusan 
        	      						   ON tb_kelas.id_jurusan = tb_jurusan.id WHERE tb_siswa.id = '" . $_SESSION['id'] . "' ");

	$data_siswa = mysqli_fetch_assoc($query_siswa);

	$query_ujian = mysqli_query($koneksi, " SELECT tb_ujian.id, tb_ujian.id_mapel,tb_ujian.tingkat, tb_mapel.nama, 
											tb_ujian.tgl_mulai,CASE
											WHEN @now < tgl_mulai THEN 'belum mulai'
											WHEN @now >= tgl_mulai && @now <= tgl_selesai THEN 'mulai'
											ELSE 'selesai' END AS status,
											tb_ujian.tgl_selesai, tb_ujian.waktu, tb_ujian.token
											FROM tb_ujian INNER JOIN tb_mapel ON 
											tb_ujian.id_mapel = tb_mapel.id WHERE tb_ujian.id = '" . $_GET['id'] . "' 
											&& tb_ujian.Tingkat = '" . $data_siswa['keber'] . "' && tb_ujian.status = 'mulai' ");

	$data_ujian = mysqli_fetch_assoc($query_ujian);

	// JIKA DITEMUKAN DATA UJIAN BERDASARKAN ID 
	if ($data_ujian != null) {
		// JIKA TOKEN SUDAH DIMASUKAN
		if (isset($_POST['token'])) {
			//CEK APAKAH TOKEN SAMA DENGAN TOKEN SISTEM
			if ($data_ujian['token'] == $_POST['token']) {
				// tambah siswa ke table ikut ujian
				mysqli_query($koneksi, "INSERT into tb_ikutujian values(null, '" . $data_ujian['id'] . "', '" . $data_siswa['id'] . "' )");
				$_SESSION['mapel'] = $data_ujian['id_mapel'];
				$_SESSION['tingkat'] = $data_ujian['tingkat'];
				$_SESSION['ujian'] = $data_ujian['id'];
				?><script type="text/javascript">
					alert('TOKEN BENAR\n\nSelamat Mengerjakan:)');
					window.location.href = "halpengerjaan.php"
				</script><?php
						} else {
							?><script type="text/javascript">
								alert('TOKEN Salah');
							</script><?php
						}
		}?>

		<!DOCTYPE html>
		<html>

		<head>
			<title>Siswa - CBT</title>
			<link rel="stylesheet" type="text/css" href="css/siswa.css">
			<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		</head>

		<body style="background-color: rgb(242, 245, 250);">

			<div class="nav">
				<div class="nav-left">
					<h1>SMK TI PEMBANGUNAN</h1>
				</div>
				<div class="nav-right">
					<img src="gambar/icon-siswa.png" id="icon-siswa">
					<a href="logout.php"><img src="gambar/icon-exit.png" id="exit"></a>
					<span>SELAMAT DATANG</span>
					<span><?php echo $data_siswa['nama'] ?></span>
					<span><?php echo $data_siswa['nama_kelas'] ?></span>
					<div style="clear: both;"></div>
					<div class="log opasiti">
						<label>log out</label>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>

			<div class="container">
				<div class="panel-info">
					<table class="table table-bordered mt-10">
						<tr>
							<td width="35%">Nama</td>
							<td width="65%"><?php echo $data_siswa['nama'] ?></td>
						</tr>
						<tr>
							<td width="35%">Kelas</td>
							<td width="65%"><?php echo $data_siswa['nama_kelas'] ?></td>
						</tr>
						<tr>
							<td width="35%">Ujian Tingkat / Mapel </td>
							<td width="65%"><?php echo $data_ujian['tingkat'] ?> / <?php echo $data_ujian['nama'] ?></td>
						</tr>
						<tr>
							<td width="35%">Waktu</td>
							<td width="65%"><?php echo $data_ujian['waktu'] / 60 ?> Menit</td>
						</tr>
						<tr>
							<td width="35%"><label for="token">Token</label></td>
							<form method="post">
								<td width="65%">
									<input id="token" maxlength="5" type="text" name="token" required autocomplete="off" placeholder="ketikan Token .." class="form-control">
								</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<button type="submit" class="btn btn-success btn-sm">Mulai Ujian</button>
								<a href="beranda.php" class="btn btn-danger btn-sm">Kembali</a>
								</form>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<script type="text/javascript" src="js/script.js"></script>
			<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
			<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		</body>

		</html>

	<?php
	}
	// JIKA TIDAK DITEMUKAN 
	else {
	?>

		<!DOCTYPE html>
		<html>

		<head>
			<title>Siswa - CBT</title>
		</head>

		<body>
			<h1>PAGE NOT FOUND !</h1>
		</body>

		</html>
<?php
	}
} else {
	header("Location: beranda.php");
} ?>