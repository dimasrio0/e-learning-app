<?php 
include 'koneksi.php';
if (isset($_GET['id_guru'])) {
	
	$id = $_GET['id_guru'];
	$result = mysqli_query($koneksi, "DELETE FROM tb_guru where id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("Berhasil Hapus Data !"); window.location.href = "beranda.php?hal=guru";</script><?php
	} else {
		?><script type="text/javascript">alert("Gagal Hapus Data !"); window.history.back();</script><?php
	}
	
} elseif (isset($_GET['id_sis'])) {
	$id = $_GET['id_sis'];
	$result = mysqli_query($koneksi, "DELETE FROM tb_siswa where id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("Berhasil Hapus Data !"); window.history.back();</script><?php
	} else {
		?><script type="text/javascript">alert("Gagal Hapus Data !"); window.history.back();</script><?php
	}
} elseif (isset($_GET['id_mapel'])) {
	$id = $_GET['id_mapel'];
	$result = mysqli_query($koneksi, "DELETE FROM tb_mapel where id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("Berhasil Hapus Data !"); window.history.back();</script><?php
	} else {
		?><script type="text/javascript">alert("Gagal Hapus Data !"); window.history.back();</script><?php
	}
} elseif (isset($_GET['id_jur'])) {
	$id = $_GET['id_jur'];
	$result = mysqli_query($koneksi, "DELETE FROM tb_jurusan where id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("Berhasil Hapus Data !"); window.history.back();</script><?php
	} else {
		?><script type="text/javascript">alert("Gagal Hapus Data !"); window.history.back();</script><?php
	}
} elseif (isset($_GET['id_soal'])) {
	$id = $_GET['id_soal'];
	$result = mysqli_query($koneksi, "DELETE FROM tb_soal where id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("Berhasil Hapus Data !"); window.history.back();</script><?php
	} else {
		?><script type="text/javascript">alert("Gagal Hapus Data !"); window.history.back();</script><?php
	}
} elseif (isset($_GET['id_ujian'])) {
	$id = $_GET['id_ujian'];
	$result = mysqli_query($koneksi, "DELETE FROM tb_ujian where id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("Berhasil Hapus Data !"); window.history.back();</script><?php
	} else {
		?><script type="text/javascript">alert("Gagal Hapus Data !"); window.history.back();</script><?php
	}
} else{
	header("Location: beranda.php");
}


?>