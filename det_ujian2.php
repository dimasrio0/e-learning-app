<?php

if (isset($_GET['id_ujian'])) {

    $result = mysqli_query($koneksi, "
    SELECT tb_nilai.id, tb_ujian.id AS idujian, concat(tb_mapel.nama , ' / ' , tb_ujian.Tingkat)AS namaujian ,
    tb_siswa.id AS idsiswa, tb_siswa.nama, concat(tb_kelas.tingkat, ' - ' , tb_jurusan.nama , ' - ' , tb_kelas.Kelas  ) AS kelassiswa,
    tb_nilai.total_soal, tb_nilai.total_jawaban_benar,
    tb_nilai.total_jawaban_salah, tb_nilai.nilai 
    FROM tb_nilai INNER JOIN tb_ujian ON tb_nilai.id_ujian = tb_ujian.id
    INNER JOIN tb_siswa ON tb_nilai.id_siswa = tb_siswa.id 
    INNER JOIN tb_mapel ON tb_ujian.id_mapel = tb_mapel.id 
    INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id
    INNER JOIN tb_jurusan ON tb_kelas.id_jurusan = tb_jurusan.id where tb_ujian.id = '" . $_GET['id_ujian'] . "' ORDER BY tb_nilai.nilai");

    $r = mysqli_query($koneksi, "SELECT concat(tb_mapel.nama , ' / ' , tb_ujian.Tingkat)AS namaujian FROM tb_ujian INNER JOIN tb_mapel ON tb_ujian.id_mapel = tb_mapel.id WHERE tb_ujian.id = '" . $_GET['id_ujian'] . "' ");
    $namaujian = mysqli_fetch_assoc($r);

    $jmlperhalaman20 = 7;
    $jmldata20 = mysqli_num_rows($result);;
    $jmlhalaman20 = ceil($jmldata20 / $jmlperhalaman20);
    $halaktif20 = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start20 = ($jmlperhalaman20 * $halaktif20) - $jmlperhalaman20;

    $result_table = mysqli_query($koneksi, "
    SELECT tb_nilai.id, tb_ujian.id AS idujian, concat(tb_mapel.nama , ' / ' , tb_ujian.Tingkat)AS namaujian ,
    tb_siswa.id AS idsiswa, tb_siswa.nama, concat(tb_kelas.tingkat, ' - ' , tb_jurusan.nama , ' - ' , tb_kelas.Kelas  ) AS kelassiswa,
    tb_nilai.total_soal, tb_nilai.total_jawaban_benar,
    tb_nilai.total_jawaban_salah, tb_nilai.nilai 
    FROM tb_nilai INNER JOIN tb_ujian ON tb_nilai.id_ujian = tb_ujian.id
    INNER JOIN tb_siswa ON tb_nilai.id_siswa = tb_siswa.id 
    INNER JOIN tb_mapel ON tb_ujian.id_mapel = tb_mapel.id 
    INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id
    INNER JOIN tb_jurusan ON tb_kelas.id_jurusan = tb_jurusan.id where tb_ujian.id = '" . $_GET['id_ujian'] . "' ORDER BY tb_nilai.nilai DESC LIMIT $start20, $jmlperhalaman20 ");
    $no9 = 0;
?>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Beranda</li>
                <li>
                    <a href="beranda.php">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Beranda
                    </a>
                </li>
                <li class="app-sidebar__heading">Menu</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-menu"></i>
                        Menu
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="?hal=guru">
                                <i class="metismenu-icon"></i>
                                Guru
                            </a>
                        </li>
                        <li>
                            <a href="beranda.php?hal=siswa">
                                <i class="metismenu-icon"></i>
                                Siswa
                            </a>
                        </li>
                        <li>
                            <a href="?hal=mapel">
                                <i class="metismenu-icon"></i>
                                Mapel
                            </a>
                        </li>
                        <li>
                            <a href="?hal=jurusan">
                                <i class="metismenu-icon"></i>
                                Jurusan
                            </a>
                        </li>
                        <li>
                            <a href="?hal=soal">
                                <i class="metismenu-icon"></i>
                                Soal
                            </a>
                        </li>
                        <li>
                            <a href="?hal=ujian">
                                <i class="metismenu-icon">
                                </i>ujian
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="app-sidebar__heading">Nilai</li>
                <li class="mm-active">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-graph"></i>
                        Nilai
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul class="mm-show">
                        <li>
                            <a href="?hal=nilai">
                                <i class="metismenu-icon"></i>
                                Nilai-siswa
                            </a>
                        </li>
                        <li>
                            <a href="?hal=nilai_ujian" class="mm-active">
                                <i class="metismenu-icon"></i>
                                Nilai-Ujian
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    </div>
    <div class="app-main__outer">
        <div class="app-page-title mt-0 ml-0 mr-0">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-amy-crisp"></i>
                    </div>
                    <div>Hasil ujian
                        <div class="page-title-subheading"><?= $namaujian['namaujian'] ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="search-wrapper ml-4">
            <div class="input-holder ml-4">
                <form method="post">
                    <input class="search-input ml-4" type="text" placeholder="Ketik untuk mencari" name="keyword">
                </form>
                <button class="search-icon ml-4" type="submit"><span></span></button>
            </div>
            <button class="close ml-4"></button>
        </div>
        <div class="card-body ml-4 mr-4">
            <div class="tab-content">
                <div class="main-card mb-3 card">
                    <div class="card-header">Data Nilai
                        <div class="btn-actions-pane-right">
                            <button class="border-0 btn-transition btn btn-outline-primary">Cetak Data</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <div class="col-md-12">
                                <table class="mb-0 table table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>MAPEL UJIAN / TINGKAT</th>
                                            <th>NAMA SISWA</th>
                                            <th>KELAS</th>
                                            <th>JML SOAL</th>
                                            <th>BENAR</th>
                                            <th>SALAH</th>
                                            <th>NILAI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result_table)) { ?>
                                            <tr>
                                                <td><?php echo $no9 += 1 ?></td>
                                                <td><?php echo $row['namaujian'] ?></td>
                                                <td><?php echo $row['nama'] ?></td>
                                                <td><?php echo $row['kelassiswa'] ?></td>
                                                <td><?php echo $row['total_soal'] ?></td>
                                                <td><?php echo $row['total_jawaban_benar'] ?></td>
                                                <td><?php echo $row['total_jawaban_salah'] ?></td>
                                                <?php if ($row['nilai'] < 60) : ?>
                                                    <td><button class="btn btn-danger btn-sm"><?php echo $row['nilai'] ?></button></td>
                                                <?php elseif ($row['nilai'] >= 60 && $row['nilai'] < 75) : ?>
                                                    <td><button class="btn btn-warning btn-sm"><?php echo $row['nilai'] ?></button></td>
                                                <?php else : ?>
                                                    <td><button class="btn btn-success btn-sm"><?php echo $row['nilai'] ?></button></td>
                                                <?php endif ?>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="d-block text-center card-footer">
                        <!-- PAGINATION-->
                        <ul class="pagination mt-2">
                            <?php if ($halaktif20 > 1) : ?>
                                <li class="page-item"><a class="page-link" aria-label="Previous" href="beranda.php?hal=det_ujian2&id_ujian=<?= $_GET['id_ujian'] ?>&page=<?php echo $halaktif20 - 1; ?>"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                            <?php endif ?>

                            <?php for ($i = 1; $i <= $jmlhalaman20; $i++) {
                                if ($i == $halaktif20) { ?>
                                    <li class="page-item active"><a class="page-link" href="beranda.php?hal=det_ujian2&id_ujian=<?= $_GET['id_ujian'] ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php } else { ?>
                                    <li class="page-item"><a class="page-link" href="beranda.php?hal=det_ujian2&id_ujian=<?= $_GET['id_ujian'] ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php }
                            } ?>

                            <?php if ($halaktif20 < $jmlhalaman20) : ?>
                                <li class="page-item"><a class="page-link" aria-label="Next" href="beranda.php?hal=det_ujian2&id_ujian=<?= $_GET['id_ujian'] ?>&page=<?php echo $halaktif20 + 1; ?>"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    <?php
} else {
    ?><script type="text/javascript">
            window.history.back();
        </script><?php
                }

                    ?>