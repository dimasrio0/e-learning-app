<?php

if (isset($_GET['id_guru'])) {
	$id = $_GET['id_guru'];
	$result = mysqli_query($koneksi, "SELECT tb_guru.id ,tb_mapel.id AS id_mapel, concat(tb_guru.id_mapel , ' - ', tb_mapel.nama) AS nama_mapel, tb_guru.nip, tb_guru.							  nama, tb_guru.jk FROM tb_guru INNER JOIN tb_mapel ON 
									  tb_guru.id_mapel = tb_mapel.id WHERE tb_guru.id = '$id'");

	$result_namamapel = mysqli_query($koneksi, "SELECT tb_mapel.id as id, concat(tb_mapel.id, ' - ', tb_mapel.nama)AS id_mapel FROM tb_mapel");

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
                                            <a href="beranda.php?hal=guru" class="mm-active">
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
                                    <div class="page-title-subheading">Ubah data Guru</div>
                            	</div>
                            </div>
                        </div>
                    </div>

					<div class="main-card mb-3 card ml-4 mt-0 mr-4">
                                    <div class="card-body mt-2"><h4 class="card-title">Ubah</h4>
                                        <form method="post" action="proses_update.php">
                                        	<input type="hidden" name="id_guru" value="<?php echo $id ?>">
                                            <input type="hidden" name="NIP" value="<?php echo $row['nip'] ?>">
                                        	 <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="NIP">NIP</label>
                                                <div class="col-sm-10"><input  class="form-control" id="NIP" type="number" disabled value="<?php echo $row['nip'] ?>"></div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Nama">Nama</label>
                                                <div class="col-sm-10"><input name="NAMA" class="form-control" id="NAMA" type="text" required autocomplete="off" placeholder="Masukan Nama" value="<?php echo $row['nama'] ?>"></div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Mapel">Mapel yg Diajar</label>
                                                <div class="col-sm-10">
                                                	<select name="MAPEL" class="form-control" id="Mapel">
                                                		<option disabled>Pilih Mapel</option>
                                                		<option selected value="<?php echo $row['id_mapel'] ?>"><?php echo $row['nama_mapel'] ?></option>
                                                		<?php while ($baris = mysqli_fetch_assoc($result_namamapel)) { ?>
                                                			<?php if ($baris['id'] != $row['id_mapel']): ?>
                                                				<option value="<?php echo $baris['id'] ?>"><?php echo $baris['id_mapel'] ?></option>
                                                			<?php endif ?>
                                                			
                                                		<?php } ?>
                                                	</select>
                                            	</div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="jk">Jenis kelamin</label>
                                                <div class="col-sm-10">
                                                	<select name="JK" class="form-control" id="jk">
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
                                            <div class="position-relative row mt-5 mb-5">
                                                <div class="col-sm-10 offset-sm-2">
                                                    <button class="btn btn-success" type="submit" name="ubah_guru">Simpan</button>
                                                    <a href="beranda.php?hal=guru" class="btn btn-danger">Batal</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                </div>
<?php } else{
    ?><script type="text/javascript">window.history.back();</script><?php
} ?>
