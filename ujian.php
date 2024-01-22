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
                                            <a href="#" class="mm-active">
                                                <i class="metismenu-icon"></i>
                                                Atur Ujian
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
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-note2 icon-gradient bg-amy-crisp"></i>
                                </div>
                                <div>Ujian
                                    <div class="page-title-subheading">Jumlah : <?php echo $jumlah_ujian ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
       
                    <div class="search-wrapper">
                        <div class="input-holder ml-4">
                            <form method="post">
                                <input class="search-input ml-4" type="text" placeholder="Ketik untuk mencari" name="keyword">
                            </form>
                            <button class="search-icon ml-4" type="submit"><span></span></button>
                        </div>
                            <button class="close ml-4"></button>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="main-card mb-3 card">
                                <div class="card-header">Data Ujian
                                    <div class="btn-actions-pane-right">
                                        <!-- Button modal-->
                                        <button class="b border-0 btn-transition btn btn-outline-primary btn-lg pe-7s-plus" type="button" data-toggle="modal" data-target="#insertujianmodal"></button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <div class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <div class="col-md-12">
                                            <table class="mb-0 table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>Mapel</th>
                                                        <th>Tingkat</th>
                                                        <th>tgl_mulai</th>
                                                        <th>tgl_selesai</th>
                                                        <th>waktu</th>
                                                        <th>status</th>
                                                        <th>token</th>
                                                        <th>aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = mysqli_fetch_assoc($result_table_ujian)) { ?>
                                                    <tr>
                                                        <?php $iduj = $row['id_mapel']; ?>
                                                        <td><?php echo $no5+=1 ?></td>
                                                        <td><?php echo $row['nama'] ?></td>
                                                        <td><?php echo $row['tingkat'] ?></td>
                                                        <td><?php echo $row['tgl_mulai'] ?></td>
                                                        <td><?php echo $row['tgl_selesai'] ?></td>
                                                        <td><?php echo $row['waktu']/60 ?> Menit</td>
                                                        <td>
                                                            <?php date_default_timezone_set('asia/jakarta');
                                                                  $date = date("y-m-d G:i:s"); ?>
                                                            <?php if ($row['status'] == "belum mulai"): ?>
                                                                <a href="#" class="btn btn-danger btn-sm"><?php echo $row['status'] ?></a>
                                                                <?php mysqli_query($koneksi ,"UPDATE tb_ujian set status = 'belum mulai' where id = '".$row['id']."' "); ?>
                                                            <?php elseif ($row['status'] == "mulai"): ?>
                                                                <a href="#" class="btn btn-success btn-sm"><?php echo $row['status'] ?></a>
                                                                <?php mysqli_query($koneksi ,"UPDATE tb_ujian set status = 'mulai' where id = '".$row['id']."' "); ?>
                                                            <?php else: ?>
                                                                <a href="#" class="btn btn-secondary btn-sm"><?php echo $row['status'] ?></a>
                                                                <?php mysqli_query($koneksi ,"UPDATE tb_ujian set status = 'selesai' where id = '".$row['id']."' "); ?>
                                                            <?php endif ?>
                                                        </td>
                                                        <td><?php echo $row['token'] ?></td>
                                                        <td>
                                                            <a href="delete.php?id_ujian=<?php echo $row['id']?>" onclick = "return confirm('Apakah Anda Yakin ?')" class="border-0 btn-transition btn btn-outline-danger">Hapus</a>
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
                                        <?php if ($halaktif5 > 1): ?>
                                            <li class="page-item"><a class="page-link" aria-label="Previous" href="beranda.php?hal=ujian&page=<?php echo $halaktif5-1; ?>"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                                        <?php endif ?>

                                        <?php for ($i=1; $i <= $jmlhalaman5 ; $i++) { 
                                                if ( $i == $halaktif5) { ?>
                                                    <li class="page-item active"><a class="page-link" href="beranda.php?hal=guru&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php } else { ?>
                                                    <li class="page-item"><a class="page-link" href="beranda.php?hal=guru&page=<?php echo $i ?>"><?php echo $i ?></a ></li>
                                        <?php } 
                                        } ?>

                                        <?php if ($halaktif5 < $jmlhalaman5): ?>
                                                <li class="page-item"><a class="page-link" aria-label="Next" href="beranda.php?hal=ujian&page=<?php echo $halaktif5 + 1; ?>"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


