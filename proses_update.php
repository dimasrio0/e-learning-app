<?php 
include 'koneksi.php';
if (isset($_POST['ubah_guru'])) {
	$id = $_POST['id_guru'];
	$nama = strtoupper($_POST['NAMA']);
	$id_mapel = $_POST['MAPEL'];
	$jk = $_POST['JK'];

	$result = mysqli_query($koneksi, "UPDATE tb_guru set id_mapel = '$id_mapel', nama = '$nama', jk = '$jk' where id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("DATA Berhasil Diupdate");window.location.href = "beranda.php?hal=guru";</script><?php
	} else {
		?><script type="text/javascript">alert("Data Gagal Diupdate");window.history.back();</script><?php
	}
} elseif (isset($_POST['ubah_siswa'])) {
	$id = $_POST['id_siswa'];
	$nama = strtoupper($_POST['nama_siswa']);
	$kelas = $_POST['kelas'];
	$jk = $_POST['jk_siswa'];
	$alamat = $_POST['alamat'];

	$result = mysqli_query($koneksi, "UPDATE tb_siswa SET nama = '$nama' , id_kelas = '$kelas' , jk = '$jk' , alamat = '$alamat' WHERE id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("DATA Berhasil Diupdate");window.location.href = "beranda.php?hal=siswa";</script><?php
	} else {
		?><script type="text/javascript">alert("Data Gagal Diupdate");window.history.back();</script><?php
	}
} elseif (isset($_POST['ubah_mapel'])) {
	$id = $_POST['id_mapel'];
	$nama = $_POST['nama_mapel'];

	$result = mysqli_query($koneksi, "UPDATE tb_mapel set nama = '$nama' where id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("DATA Berhasil Diupdate");window.location.href = "beranda.php?hal=mapel";</script><?php
	} else {
		?><script type="text/javascript">alert("Data Gagal Diupdate");window.history.back();</script><?php
	}
} elseif (isset($_POST['ubah_jurusan'])) {
	$id = $_POST['id_jurusan'];
	$nama = $_POST['nama_jurusan'];

	$result = mysqli_query($koneksi, "UPDATE tb_jurusan set nama = '$nama' where id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("DATA Berhasil Diupdate");window.location.href = "beranda.php?hal=jurusan";</script><?php
	} else {
		?><script type="text/javascript">alert("Data Gagal Diupdate");window.history.back();</script><?php
	}
} elseif (isset($_POST['ubah_soal'])) {
	$id = $_POST['id_soal'];
	$pertanyaan = $_POST['pertanyaan'];
	$ting = $_POST['ting'];
	$a= $_POST['A'];
	$b= $_POST['B'];
	$c= $_POST['C'];
	$d= $_POST['D'];
	$e= $_POST['E'];
	$kunjaw = $_POST['kunjaw'];

	$result = mysqli_query($koneksi, "UPDATE tb_soal set pertanyaan = '$pertanyaan', Tingkat = '$ting' , jawaban_A = '$a', jawaban_B = '$b', jawaban_C = '$c', jawaban_D = '$d' , jawaban_E = '$e', kunci_jawaban = '$kunjaw' where id = '$id' ");

	if ($result) {
		?><script type="text/javascript">alert("DATA Berhasil Diupdate");window.location.href = "beranda.php?id_mapel=<?php echo $_POST['id_mpl'] ?>&hal=det_soal";</script><?php
	} else {
		?><script type="text/javascript">alert("Data Gagal Diupdate");window.history.back();</script><?php
	}
	
} else {
	?><script type="text/javascript">alert("Gaada Apa Apa ko:)");window.history.back();</script><?php
}



 ?>