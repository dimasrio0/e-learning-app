<?php 
session_start();
include '../koneksi.php';

$user = $_SESSION['siswa'];
$now = mysqli_query($koneksi, "SET @now=now()");

$data_siswa = mysqli_query($koneksi, "SELECT tb_siswa.id, tb_siswa.nisn, tb_siswa.nama, tb_siswa.id_kelas ,tb_kelas.tingkat AS keber,
			  concat (tb_kelas.tingkat , ' - ' , tb_jurusan.nama, ' - ', tb_kelas.Kelas) AS nama_kelas, tb_siswa.alamat
			  FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id INNER JOIN tb_jurusan 
			  ON tb_kelas.id_jurusan = tb_jurusan.id WHERE tb_siswa.id = '".$_SESSION['id']."' ");

    $pecah = mysqli_fetch_assoc($data_siswa);

$result_table_ujian = mysqli_query($koneksi, " SELECT tb_ujian.id, tb_ujian.id_mapel,tb_ujian.tingkat, tb_mapel.nama, tb_ujian.tgl_mulai,CASE
                                               WHEN @now < tgl_mulai THEN 'belum mulai'
                                               WHEN @now >= tgl_mulai && @now <= tgl_selesai THEN 'mulai'
                                               ELSE 'selesai' END AS status,
                                               tb_ujian.tgl_selesai, tb_ujian.waktu, tb_ujian.token
                                               FROM tb_ujian INNER JOIN tb_mapel ON 
                                               tb_ujian.id_mapel = tb_mapel.id WHERE Tingkat = '".$pecah['keber']."' ");
    $no=0;

	date_default_timezone_set("asia/jakarta");
	$date = date("y-m-d H:i:s");
    $tanggal = date("y-m-d");
    $jam = date("H:i:s");

$query = mysqli_query($koneksi, "SELECT * FROM tb_ujian");

while ($row = mysqli_fetch_assoc($query)) {
	if (strtotime($date) < strtotime($row['tgl_mulai'])) {
		mysqli_query($koneksi, "UPDATE tb_ujian set status = 'belum mulai' where id = '".$row['id']."' ");
	} elseif(strtotime($date) >= strtotime($row['tgl_mulai']) && strtotime($date) <= strtotime($row['tgl_selesai'])) {
		mysqli_query($koneksi, "UPDATE tb_ujian set status = 'mulai' where id = '".$row['id']."' ");
	} else{
		mysqli_query($koneksi, "UPDATE tb_ujian set status = 'selesai' where id = '".$row['id']."' ");
	}
}
?>
<div class="ket">
<img id="calendar" src="gambar/icon-calendar.png"> : <?php echo $tanggal ?>
<img id="jam" src="gambar/icon-jam.png"> : <?php echo $jam ?> <br><br>
</div>
<table class="table table-striped">
    <thead>
        <th>NO</th>
        <th>Mapel</th>
        <th>Tingkat</th>
        <th>Status Ujian</th>
        <th>Keikutsertaan</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result_table_ujian)) { ?>
        <?php $query_ikutujian = mysqli_query($koneksi, "SELECT * from tb_ikutujian where id_ujian = '".$row['id']."' AND id_siswa = '".$pecah['id']."' ");
              $data_ikut = mysqli_num_rows($query_ikutujian);
         ?>
            <tr>
                <td><?php echo $no+=1; ?></td>
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['tingkat'] ?></td>
                <td>
                    <?php if ($row['status'] == "belum mulai"): ?>
                        <a href="#" class="btn btn-danger btn-sm"><?php echo $row['status'] ?></a>
                </td>
                <?php if ($data_ikut == 0): ?>
                    <td><button class="btn btn-danger btn-sm">Belum Ikut</button></td>
                <?php elseif($data_ikut > 0): ?>
                    <td><button class="btn btn-success btn-sm">Telah Ikut</button></td>
                <?php endif ?>
                <td></td>
                    <?php elseif ($row['status'] == "mulai"): ?>
                        <a href="#" class="btn btn-success btn-sm">Mulai</a>
                </td>

                <?php if ($data_ikut == 0): ?>
                    <td><button class="btn btn-danger btn-sm">Belum Ikut</button></td>
                    <td><a href="./det_ujian.php?id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Kerjakan</a></td>
                <?php elseif($data_ikut > 0): ?>
                    <td><button class="btn btn-success btn-sm">Telah Ikut</button></td>
                    <td></td>
                <?php endif ?>
                    <?php else: ?>
                            <a href="#" class="btn btn-secondary btn-sm"><?php echo $row['status'] ?></a>
                </td>
                <?php if ($data_ikut == 0): ?>
                    <td><button class="btn btn-danger btn-sm">Belum Ikut</button></td>
                <?php elseif($data_ikut > 0): ?>
                    <td><button class="btn btn-success btn-sm">Telah Ikut</button></td>
                <?php endif ?>
                <td></td>
                    <?php endif ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
