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
                                        <a href="#" class="mm-active">
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
                                    <div>Data Jurusan
                                        <div class="page-title-subheading">Jumlah Jurusan : <?php echo $jumlah_jurusan ?></div>
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
                                    <div class="card-header">Data Jurusan
                                        <div class="btn-actions-pane-right">
                                            <!-- Button modal-->
                                            <button class="b border-0 btn-transition btn btn-outline-primary btn-lg pe-7s-plus" type="button" data-toggle="modal" data-target="#insertjurusanmodal"></button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <div class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <div class="col-md-12">
                                                <table class="mb-0 table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>NO</th>
                                                            <th>Nama Jurusan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($row = mysqli_fetch_assoc($result_table_jurusan)) { ?>
                                                            <tr>
                                                                <td><?php echo $no3 += 1 ?></td>
                                                                <td><?php echo $row['nama'] ?></td>
                                                                <td><a href="delete.php?id_jur=<?php echo $row['id'] ?>" onclick="return confirm('Apakah Anda Yakin ?')" class="border-0 btn-transition btn btn-outline-danger">Hapus</a>
                                                                    <a href="?hal=update_jurusan&id_jur=<?php echo $row['id'] ?>" class="border-0 btn-transition btn btn-outline-success">Update</a>
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
                                            <?php if ($halaktif3 > 1) : ?>
                                                <li class="page-item"><a class="page-link" aria-label="Previous" href="beranda.php?hal=jurusan&page=<?php echo $halaktif3 - 1; ?>"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                                            <?php endif ?>

                                            <?php for ($i = 1; $i <= $jmlhalaman3; $i++) {
                                                if ($i == $halaktif3) { ?>
                                                    <li class="page-item active"><a class="page-link" href="beranda.php?hal=jurusan&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                                <?php } else { ?>
                                                    <li class="page-item"><a class="page-link" href="beranda.php?hal=jurusan&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                            <?php }
                                            } ?>

                                            <?php if ($halaktif3 < $jmlhalaman3) : ?>
                                                <li class="page-item"><a class="page-link" aria-label="Next" href="beranda.php?hal=jurusan&page=<?php echo $halaktif3 + 1; ?>"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>