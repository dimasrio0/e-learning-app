<?php 
session_start();

if (isset($_POST['beres']) || $_SESSION['menit'] || $_SESSION['detik']) {
	include 'koneksi.php';
	$result = mysqli_query($koneksi, "SELECT * FROM tb_soal where id_mapel = '".$_SESSION['mapel']."' and Tingkat = '".$_SESSION['tingkat']."' ");

	$jumlah_soal = $_POST['jml_soal'];
	$i = 0;
	$benar = 0;
	$salah = 0;
	$nilai = 0;

	while ($row = mysqli_fetch_assoc($result)) {
		$i++;
		if (isset($_SESSION["soke$i"])) {
			if ($_POST["no$i"] == $row['kunci_jawaban'] || $_SESSION["soke$i"]["jawaban"] == $row['kunci_jawaban']) {
				$benar +=1;
				$salah = $salah;
			}else{
				$benar = $benar;
				$salah +=1;
			}
		}else{
			if ($_POST["no$i"] == $row['kunci_jawaban']) {
				$benar +=1;
				$salah = $salah;
			}else{
				$benar = $benar;
				$salah +=1;
			}
		}
		
		unset($_SESSION["soke$i"]);
	}

	$nilai = ($benar * 10 ) / ($jumlah_soal / 10) ;
	mysqli_query($koneksi, "INSERT INTO tb_nilai values(null, '".$_SESSION['ujian']."', '".$_SESSION['id']."', '$jumlah_soal', '$benar', '$salah', '$nilai') ");
	unset($_SESSION['mapel']);
	unset($_SESSION['tingkat']);
	unset($_SESSION['ujian']);
	unset($_SESSION['menit']);
	unset($_SESSION['detik']);
	header("Location: beranda.php");
}else{
	header("Location: beranda.php");
}

?>