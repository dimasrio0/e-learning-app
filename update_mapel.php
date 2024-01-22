<?php

if (isset($_GET['id_mapel'])) {
	$id = $_GET['id_mapel'];
	$result = mysqli_query($koneksi, "SELECT * FROM tb_mapel where id = '$id' ");

	$row = mysqli_fetch_assoc($result);

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
                                            <a href="beranda.php?hal=siswa">
                                                <i class="metismenu-icon"></i>
                                                Siswa
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?hal=mapel"  class="mm-active">
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
                                        <i class="pe-7s-pen text-success"></i>
                                </div>
                            	<div>Data <?php echo $row['nama'] ?>
                                    <div class="page-title-subheading">Ubah data Mapel</div>
                            	</div>
                            </div>
                        </div>
                    </div>

					<div class="main-card mb-3 card ml-4 mt-0 mr-4">
                                    <div class="card-body mt-2"><h4 class="card-title">Ubah</h4>
                                        <form method="post" action="proses_update.php">
                                        	<input type="hidden" name="id_mapel" value="<?php echo $id ?>">
                                        	 <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="NO">NO</label>
                                                <div class="col-sm-10"><input name="NO" class="form-control" id="NO" type="number" required autocomplete="off" placeholder="Masukan NO" disabled="" value="<?php echo $row['id'] ?>"></div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Nama Mapel">Nama Mapel</label>
                                                <div class="col-sm-10"><input name="nama_mapel" class="form-control" id="Nama_Mapel" type="text" required autocomplete="off" placeholder="Masukan Nama_Mapel" value="<?php echo $row['nama'] ?>"></div>
                                            </div>
                                            <div class="position-relative row mt-5 mb-5">
                                                <div class="col-sm-10 offset-sm-2">
                                                    <button class="btn btn-success" type="submit" name="ubah_mapel">Simpan</button>
                                                    <a href="beranda.php?hal=mapel" class="btn btn-danger">Batal</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                </div>
<?php } else{
    ?><script type="text/javascript">window.history.back();</script><?php
} ?>
