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
                                            <a href="#" class="mm-active">
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
                                            <a href="?hal=soal">
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
                                    <div>Data siswa
                                    <div class="page-title-subheading">Jumlah siswa : <?php echo $jumlah_siswa ?></div>
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
                                <div class="card-header">Data Siswa
                                    <div class="btn-actions-pane-right">
                                        <!-- Button modal-->
                                        <button class="b border-0 btn-transition btn btn-outline-primary btn-lg pe-7s-add-user" type="button" data-toggle="modal" data-target="#insertmuridmodal"></button>
                                    </div>
                                </div>
                            <div class="table-responsive">
                                <div class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <div class="col-md-12">
                                        <table class="mb-0 table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>Nisn</th>
                                                    <th>Nama</th>
                                                    <th>Kelas</th>
                                                    <th>Alamat</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result_table_siswa)) { ?>
                                                <tr>
                                                    <td><?php echo $no1 += 1 ?></td>
                                                    <td><?php echo $row['nisn'] ?></td>
                                                    <td><?php echo $row['nama'] ?></td>
                                                    <td><?php echo $row['nama_kelas'] ?></td>
                                                    <td><?php echo $row['alamat'] ?></td>
                                                    <td><a href="delete.php?id_sis=<?php echo $row['id'] ?>" class="border-0 btn-transition btn btn-outline-danger" onclick="return confirm('Apakah anda yakin ?')">hapus</a>
                                                        <a href="?hal=update_siswa&id_sis=<?php echo $row['id'] ?>" class="border-0 btn-transition btn btn-outline-success">update</a>
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
                                    <?php if ($halaktif1 > 1): ?>
                                        <li class="page-item"><a class="page-link" aria-label="Previous" href="beranda.php?hal=siswa&page=<?php echo $halaktif1-1; ?>"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                                    <?php endif ?>

                                    <?php for ($i=1; $i <= $jmlhalaman1 ; $i++) { 
                                            if ( $i == $halaktif1) { ?>
                                                <li class="page-item active"><a class="page-link" href="beranda.php?hal=siswa&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                    <?php } else { ?>
                                                <li class="page-item"><a class="page-link" href="beranda.php?hal=siswa&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                    <?php } 
                                    } ?>

                                    <?php if ($halaktif1 < $jmlhalaman1): ?>
                                            <li class="page-item"><a class="page-link" aria-label="Next" href="beranda.php?hal=siswa&page=<?php echo $halaktif1 + 1; ?>"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                                    <?php endif ?>
                                </ul>
                            </div>
                                        </div>
                        </div>
                        </div>

<script type="text/javascript" src="js/script.js"></script>
