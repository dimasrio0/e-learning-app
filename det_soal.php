<?php

if (isset($_GET['id_mapel'])) {

    $id_mapel = $_GET['id_mapel'];

    $result_table = mysqli_query($koneksi, "SELECT tb_soal.id, tb_mapel.nama AS mapel, tb_soal.pertanyaan, tb_soal.jawaban_A, tb_soal.jawaban_B, tb_soal.jawaban_C, tb_soal.jawaban_D, tb_soal.jawaban_E, tb_soal.kunci_jawaban FROM tb_soal INNER JOIN tb_mapel ON tb_soal.id_mapel = tb_mapel.id WHERE tb_soal.id_mapel = '$id_mapel' ");

    $total = mysqli_num_rows($result_table);

    $nama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama as data FROM tb_mapel WHERE id = '$id_mapel' "));

    //PAGINATION
    $jmlperhalaman4 = 7;
    $jmldata4 = $total;
    $jmlhalaman4 = ceil($jmldata4 / $jmlperhalaman4);
    $halaktif4 = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start4 = ($jmlperhalaman4 * $halaktif4) - $jmlperhalaman4;

    $result_table_soal = mysqli_query($koneksi, "SELECT tb_soal.id, tb_mapel.nama AS mapel,tb_soal.Tingkat ,tb_soal.pertanyaan, tb_soal.jawaban_A, tb_soal.jawaban_B, tb_soal.jawaban_C, tb_soal.jawaban_D, tb_soal.jawaban_E, tb_soal.kunci_jawaban FROM tb_soal INNER JOIN tb_mapel ON tb_soal.id_mapel = tb_mapel.id WHERE tb_soal.id_mapel = '$id_mapel' order by tb_soal.Tingkat limit $start4, $jmlperhalaman4");

    $no = $start4;
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
                <li class="mm-active">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-menu"></i>
                        Menu
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul class="mm-show">
                        <li>
                            <a href="beranda.php?hal=guru">
                                <i class="metismenu-icon"></i>
                                Guru
                            </a>
                        </li>
                        <li>
                            <a href="?hal=siswa">
                                <i class="metismenu-icon"></i>
                                Siswa
                            </a>
                        </li>
                        <li>
                            <a href="?hal=mapel">
                                <i class="metismenu-icon">
                                </i> Mapel
                            </a>
                        </li>
                        <li>
                            <a href="?hal=jurusan">
                                <i class="metismenu-icon">
                                </i>Jurusan
                            </a>
                        </li>
                        <li>
                            <a href="?hal=soal" class="mm-active">
                                <i class="metismenu-icon">
                                </i>Soal
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
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-graph"></i>
                        Nilai
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="?hal=nilai">
                                <i class="metismenu-icon"></i>
                                Nilai-siswa
                            </a>
                        </li>
                        <li>
                            <a href="?hal=nilai_ujian">
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
                    <div>Data Soal <?php echo $nama['data'] ?>
                        <div class="page-title-subheading">Total Soal : <?php echo $total ?></div>
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
                    <div class="card-header">Data Soal
                        <div class="btn-actions-pane-right">
                            <!-- Button modal-->
                            <button class="b border-0 btn-transition btn btn-outline-primary btn-lg pe-7s-plus" type="button" data-toggle="modal" data-target="#insertsoalmodal"></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <div class="col-md-12">
                                <table class="mb-0 table table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>MAPEL</th>
                                            <th>Tingkat</th>
                                            <th>Pertanyaan</th>
                                            <th>Opsi-A</th>
                                            <th>Opsi-B</th>
                                            <th>Opsi-C</th>
                                            <th>Opsi-D</th>
                                            <th>Opsi-E</th>
                                            <th>Kunci-Jawaban</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result_table_soal)) { ?>
                                            <tr>
                                                <td><?php echo $no += 1 ?></td>
                                                <td><?php echo $row['mapel'] ?></td>
                                                <td><?php echo $row['Tingkat'] ?></td>
                                                <td><?php echo $row['pertanyaan'] ?></td>
                                                <td><?php echo $row['jawaban_A'] ?></td>
                                                <td><?php echo $row['jawaban_B'] ?></td>
                                                <td><?php echo $row['jawaban_C'] ?></td>
                                                <td><?php echo $row['jawaban_D'] ?></td>
                                                <td><?php echo $row['jawaban_E'] ?></td>
                                                <td><?php echo $row['kunci_jawaban'] ?></td>
                                                <td><a href="delete.php?id_soal=<?php echo $row['id'] ?>" class="border-0 btn-transition btn btn-outline-danger" onclick="return confirm('Apakah Anda Yakin ?')">hapus</a>
                                                    <a href="?hal=update_soal&no=<?php echo $no ?>&id_mapel=<?php echo $id_mapel ?>&id_soal=<?php echo $row['id'] ?>" class="border-0 btn-transition btn btn-outline-success">update</a>
                                                </td>
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
                            <?php if ($halaktif4 > 1) : ?>
                                <li class="page-item"><a class="page-link" aria-label="Previous" href="beranda.php?hal=det_soal&id_mapel=<?php echo $id_mapel ?>&page=<?php echo $halaktif4 - 1; ?>"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                            <?php endif ?>

                            <?php for ($i = 1; $i <= $jmlhalaman4; $i++) {
                                if ($i == $halaktif4) { ?>
                                    <li class="page-item active"><a class="page-link" href="beranda.php?hal=det_soal&id_mapel=<?php echo $id_mapel ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php } else { ?>
                                    <li class="page-item"><a class="page-link" href="beranda.php?hal=det_soal&id_mapel=<?php echo $id_mapel ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php }
                            } ?>

                            <?php if ($halaktif4 < $jmlhalaman4) : ?>
                                <li class="page-item"><a class="page-link" aria-label="Next" href="beranda.php?hal=det_soal&id_mapel=<?php echo $id_mapel ?>&page=<?php echo $halaktif4 + 1; ?>"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="js/script.js"></script>

    <?php } else {
    ?><script type="text/javascript">
            window.history.back();
        </script><?php
                } ?>