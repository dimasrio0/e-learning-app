<?php

if (isset($_GET['id_soal'])) {
	$id = $_GET['id_soal'];
	$id_mapel = $_GET['id_mapel'];
    $no = $_GET['no'];
    $result = mysqli_query($koneksi, "SELECT tb_soal.id, tb_mapel.nama AS mapel, tb_soal.Tingkat, tb_soal.pertanyaan, tb_soal.jawaban_A, tb_soal.jawaban_B, tb_soal.jawaban_C, tb_soal.jawaban_D, tb_soal.jawaban_E, tb_soal.kunci_jawaban FROM tb_soal INNER JOIN tb_mapel ON tb_soal.id_mapel = tb_mapel.id WHERE tb_soal.id_mapel = '$id_mapel' and tb_soal.id = '$id' ");

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
                                            <a href="#" class="mm-active">
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
                            	<div>Soal NO <?php echo $no ?>
                                    <div class="page-title-subheading">Ubah Soal</div>
                            	</div>
                            </div>
                        </div>
                    </div>

					<div class="main-card mb-3 card ml-4 mt-0 mr-4">
                                    <div class="card-body mt-2"><h4 class="card-title">Ubah</h4>
                                        <form method="post" action="proses_update.php">
                                        	<input type="hidden" name="id_soal" value="<?php echo $id ?>">
                                            <input type="hidden" name="id_mpl" value="<?php echo $id_mapel ?>">
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Mapel">Mapel</label>
                                                <div class="col-sm-10">
                                                	<select id="mapel" name="id_soal-mapel" class="form-control">
                                                        <option value="<?php echo $row['mapel'] ?>"><?php echo $row['mapel'] ?></option>
                                                    </select>
                                            	</div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Tingkat">Tingkat</label>
                                                <div class="col-sm-10">
                                                    <select id="Tingkat" name="ting" class="form-control">
                                                        <option disabled selected><?php echo $row['Tingkat'] ?></option>
                                                        <option value="X">X</option>
                                                        <option value="XI">XI</option>
                                                        <option value="XII">XII</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="jk">Pertanyaan</label>
                                                <div class="col-sm-10">
                                                	<textarea id="ckeditor" class="ckeditor form-control" name="pertanyaan" placeholder="Masukan Pertanyaan" required autocomplete="off" class="form-control" rows="9"><?php echo $row['pertanyaan'] ?>
                                                    </textarea>
                                            	</div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Alamat">Opsi-A</label>
                                                <div class="col-sm-10">   
                                                    <textarea id="ckeditor" class="ckeditor form-control" name="A" placeholder="Masukan Pertanyaan" required autocomplete="off" class="form-control" rows="9"><?php echo $row['jawaban_A'] ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Alamat">Opsi-B</label>
                                                <div class="col-sm-10">   
                                                    <textarea id="ckeditor" class="ckeditor form-control" name="B" placeholder="Masukan Pertanyaan" required autocomplete="off" class="form-control" rows="9"><?php echo $row['jawaban_B'] ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Alamat">Opsi-C</label>
                                                <div class="col-sm-10">   
                                                    <textarea name="C" placeholder="Masukan Pertanyaan" id="ckeditor" class="ckeditor form-control" required autocomplete="off" class="form-control" rows="9"><?php echo $row['jawaban_C'] ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Alamat">Opsi-D</label>
                                                <div class="col-sm-10">   
                                                    <textarea id="ckeditor" class="ckeditor form-control" name="D" placeholder="Masukan Pertanyaan" required autocomplete="off" class="form-control" rows="9"><?php echo $row['jawaban_D'] ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Alamat">Opsi-E</label>
                                                <div class="col-sm-10">   
                                                    <textarea name="E" placeholder="Masukan Pertanyaan" id="ckeditor" class="ckeditor form-control" required autocomplete="off" class="form-control" rows="9"><?php echo $row['jawaban_E'] ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-5"><label class="col-sm-2 col-form-label" for="Alamat">Kunci Jawaban</label>
                                                <div class="col-sm-10">   
                                                    <select id="mapel" name="kunjaw" class="form-control">
                                                        <option disabled>Pilih</option>
                                                        <?php if ($row['kunci_jawaban'] == "D"): ?>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="D" selected>D</option>
                                                            <option value="E">E</option>
                                                        <?php elseif($row['kunci_jawaban'] == "A"): ?>
                                                            <option value="A" selected>A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
                                                            <option value="E">E</option>
                                                        <?php elseif($row['kunci_jawaban'] == "B"): ?>
                                                            <option value="A">A</option>
                                                            <option value="B" selected>B</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
                                                            <option value="E">E</option>
                                                        <?php elseif($row['kunci_jawaban'] == "C"): ?>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C" selected>C</option>
                                                            <option value="D">D</option>
                                                            <option value="E">E</option>
                                                        <?php elseif($row['kunci_jawaban'] == "E"): ?>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
                                                            <option value="E" selected>E</option>
                                                        <?php endif ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="position-relative row mt-5 mb-5">
                                                <div class="col-sm-10 offset-sm-2">
                                                    <button class="btn btn-success" type="submit" name="ubah_soal">Simpan</button>
                                                    <a href="beranda.php?hal=det_soal&id_mapel=<?php echo $id_mapel ?>" class="btn btn-danger">Batal</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                </div>
<?php } else{
    ?><script type="text/javascript">window.history.back();</script><?php
} ?>
