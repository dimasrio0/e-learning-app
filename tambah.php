<?php 
	include 'koneksi.php';
if (isset($_POST['tambah_guru'])) {
	$id_mapel = $_POST['id_mapel'];
	$angka = "12345678901234567890";
	$nip = substr(str_shuffle($angka),0,10);
	$nama = strtoupper($_POST['nama']);
	$jk = $_POST['jenis_kelamin'];

	$result_query = mysqli_query($koneksi, "INSERT into tb_guru values (null, '$id_mapel' ,'$nip', '$nama', '$jk')");
	if ($result_query) {
		?><script type="text/javascript">alert("Berhasil Tambah Data Guru !"); window.location.href = "beranda.php?hal=guru"</script><?php
	} else {
		?><script type="text/javascript">alert("NIP Telah Terdaftar !"); window.history.back();</script><?php
	}
	
} elseif (isset($_POST['tambah_siswa'])) {
	$nisn = substr(str_shuffle("12345678901234567890"),0,10);
	$nama = strtoupper($_POST['nama_siswa']);
	$kelas = $_POST['kelas'];
	$jk = $_POST['jk_siswa'];
	$alamat = $_POST['alamat'];

	$result_query = mysqli_query($koneksi, "INSERT into tb_siswa values (null, '$nisn' ,'$nama', '$kelas', '$jk' , '$alamat')");
	if ($result_query) {
		?><script type="text/javascript">alert("Berhasil Tambah Data Siswa !"); window.location.href = "beranda.php?hal=siswa"</script><?php
	} else {
		?><script type="text/javascript">alert("NISN Telah Terdaftar !"); window.history.back();</script><?php
	}

} elseif (isset($_POST['tambah_mapel'])) {
	$nama =strtoupper($_POST['nama_mapel']);

	$result_query = mysqli_query($koneksi, "INSERT into tb_mapel values (null, '$nama')");
	if ($result_query) {
		?><script type="text/javascript">alert("Berhasil Tambah Data Mapel !"); window.history.back();</script><?php
	} else {
		echo "Gagal Input Data ! ";
	}
} elseif (isset($_POST['tambah_jurusan'])) {
	$nama = strtoupper($_POST['nama_jurusan']);

	$result_query = mysqli_query($koneksi, "INSERT into tb_jurusan values (null, '$nama')");
	if ($result_query) {
		?><script type="text/javascript">alert("Berhasil Tambah Data Jurusan !"); window.history.back();</script><?php
	} else {
		echo "Gagal Input Data ! ";
	}
} elseif (isset($_POST['tambah_soal'])) {
	$pelajaran = $_POST['pelajaran'];
	$pertanyaan = $_POST['pertanyaan'];
	$tingkat = $_POST['ting'];
	$a = $_POST['A'];
	$b = $_POST['B'];
	$c = $_POST['C'];
	$d = $_POST['D'];
	$e = $_POST['E'];
	$jawaban = $_POST['jawaban'];

	$result_query = mysqli_query($koneksi, "INSERT into tb_soal values(null, '$pelajaran', '$tingkat', '$pertanyaan', '$a', '$b', '$c', '$d', '$e', '$jawaban' )");
	if ($result_query) {
		?><script type="text/javascript">alert("Berhasil Tambah Data Soal !"); window.location.href = "beranda.php?hal=det_soal&id_mapel=<?php echo $pelajaran ?>"</script><?php
	} else {
		echo "Gagal Input Data ! ";
	}
} elseif (isset($_POST['tambah_ujian'])) {
	$mapel = $_POST['id_mapel9'];
	$tingkat = $_POST['tingkat'];
	
	$query = mysqli_query($koneksi, "SELECT * from tb_ujian WHERE id_mapel = '$mapel' AND Tingkat = '$tingkat'");
	$cek = mysqli_num_rows($query);
	
	if ($cek > 0) {
		?><script type="text/javascript">alert("Ujian Telah Terdaftar!");window.location.href = "beranda.php?hal=ujian";</script><?php
	} else {
		date_default_timezone_set('asia/jakarta');
		$date = date("y-m-d G:i:s");
		$mapel = $_POST['id_mapel9'];
		$tgl_mulai = $_POST['tgl_mulai'];
		$tgl_selesai = $_POST['tgl_selesai'];
		
			if (strtotime($date) < strtotime($tgl_mulai)) {
				$status = "belum mulai";
			} elseif (strtotime($date) >= strtotime($tgl_mulai) && strtotime($date) <= strtotime($tgl_selesai)) {
				$status = "mulai";
			} else {
				$status = "selesai";
			}

		$tingkat = $_POST['tingkat'];
		$menit = $_POST['waktu1'];
		$waktu = $menit * 60 ;
		$kar = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		$shuffle = substr(str_shuffle($kar),0,5);

		$result_query = mysqli_query($koneksi, "INSERT into tb_ujian values(null, '$mapel', '$tingkat', '$tgl_mulai', '$tgl_selesai', '$waktu' ,'$status','$shuffle' )");

		if ($result_query) {
			?><script type="text/javascript">alert("Berhasil Tambah Data Ujian !");window.location.href = "beranda.php?hal=ujian";</script><?php
		} else {
			echo "Gagal Input Data ! ";
		}
	}
} else {
	header("Location: beranda.php");
}


 ?>