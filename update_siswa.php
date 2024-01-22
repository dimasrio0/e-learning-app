<?php

if (isset($_GET['id_sis'])) {
	$id = $_GET['id_sis'];
	$result = mysqli_query($koneksi, "SELECT tb_siswa.id, tb_siswa.nisn, tb_siswa.nama, tb_siswa.id_kelas, concat (tb_kelas.tingkat , ' - ' , tb_jurusan.nama, ' - ', tb_kelas.Kelas) AS nama_kelas,tb_siswa.jk, tb_siswa.alamat FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id INNER JOIN tb_jurusan ON tb_kelas.id_jurusan = tb_jurusan.id WHERE tb_siswa.id = '$id' ");

	$result_kelas = mysqli_query($koneksi, "SELECT tb_kelas.id, concat(tb_kelas.tingkat , ' - ' , tb_jurusan.nama, ' - ', tb_kelas.Kelas) AS nama_kelas from tb_kelas INNER join tb_jurusan on tb_kelas.id_jurusan = tb_jurusan.id");

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
                                            <a href="beranda.php?hal=siswa"  class="mm-active">
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
                                        <i class="pe-7s-pen text-success"></i>
                                </div>
                            	<div>Data <?php echo $row['nama'] ?>
                                    <div class="page-title-subheading">Ubah data Siswa</div>
                            	</div>
                            </div>
                        </div>
                    </div>

					<div class="main-card mb-3 card ml-4 mt-0 mr-4">
                                    <div class="card-body mt-2"><h4 class="card-title">Ubah</h4>
                                        <form method="post" action="proses_update.php">
                                        	<input type="hidden" name="id_siswa" value="<?php echo $id ?>">
                                        	 <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="NISN">NISN</label>
                                                <div class="col-sm-10"><input name="nisn" disabled class="form-control" id="NISN" type="number" required autocomplete="off" placeholder="Masukan NISN" value="<?php echo $row['nisn'] ?>"></div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Nama">Nama</label>
                                                <div class="col-sm-10"><input name="nama_siswa" class="form-control" id="NAMA" type="text" required autocomplete="off" placeholder="Masukan Nama" value="<?php echo $row['nama'] ?>"></div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Kelas">Kelas</label>
                                                <div class="col-sm-10">
                                                	<select name="kelas" class="form-control" id="Kelas">
                                                		<option disabled>Pilih Kelas</option>
                                                		<option selected value="<?php echo $row['id_kelas'] ?>"><?php echo $row['nama_kelas'] ?></option>
                                                		<?php while ($baris = mysqli_fetch_assoc($result_kelas)) { ?>
                                                            <?php if ($baris['id'] != $row['id_kelas']): ?>
                                                                <option value="<?php echo $baris['id'] ?>"><?php echo $baris['nama_kelas'] ?></option>
                                                            <?php endif ?>
                                                        <?php } ?>
                                                	</select>
                                            	</div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="jk">Jenis kelamin</label>
                                                <div class="col-sm-10">
                                                	<select name="jk_siswa" class="form-control" id="jk">
                                                		<option disabled>Pilih jenis kelamin</option>
                                                		<?php if ($row['jk'] == "pria" ): ?>
                                                			<option selected value="pria">Pria</option>
                                                			<option value="wanita">wanita</option>
                                                		<?php else: ?>
                                                			<option selected value="wanita">wanita</option>
                                                			<option value="pria">pria</option>
                                                		<?php endif ?>

                                                	</select>
                                            	</div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Alamat">Alamat</label>
                                                <div class="col-sm-10">
                                                    <textarea id="Alamat" name="alamat" required autocomplete="off" class="form-control" rows="10" placeholder="Masukan Alamat"><?php echo $row['alamat'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="position-relative row mt-5 mb-5">
                                                <div class="col-sm-10 offset-sm-2">
                                                    <button class="btn btn-success" type="submit" name="ubah_siswa">Simpan</button>
                                                    <a href="beranda.php?hal=siswa" class="btn btn-danger">Batal</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                </div>
<?php } else{
    ?><script type="text/javascript">window.history.back();</script><?php
} ?>
