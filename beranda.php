<?php session_start();
if (isset($_SESSION['username'])) {
    include 'koneksi.php';
    $user = $_SESSION['username'];
    $result_guru = mysqli_query($koneksi, "SELECT * FROM tb_guru");
    $jumlah_guru = mysqli_num_rows($result_guru);
    $result_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa");
    $jumlah_siswa = mysqli_num_rows($result_siswa);
    $result_jurusan = mysqli_query($koneksi, "SELECT * FROM tb_jurusan");
    $jumlah_jurusan = mysqli_num_rows($result_jurusan);
    $result_mapel = mysqli_query($koneksi, "SELECT * FROM tb_mapel");
    $jumlah_mapel = mysqli_num_rows($result_mapel);
    $result_ujian = mysqli_query($koneksi, "SELECT * FROM tb_ujian");
    $jumlah_ujian = mysqli_num_rows($result_ujian);

    //PAGINATION Guru
    $jmlperhalaman = 7;
    $jmldata = $jumlah_guru;
    $jmlhalaman = ceil($jmldata / $jmlperhalaman);
    $halaktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($jmlperhalaman * $halaktif) - $jmlperhalaman;

    //PAGINATION siswa
    $jmlperhalaman1 = 7;
    $jmldata1 = $jumlah_siswa;
    $jmlhalaman1 = ceil($jmldata1 / $jmlperhalaman1);
    $halaktif1 = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start1 = ($jmlperhalaman1 * $halaktif1) - $jmlperhalaman1;

    //PAGINATION mapel
    $jmlperhalaman2 = 7;
    $jmldata2 = $jumlah_mapel;
    $jmlhalaman2 = ceil($jmldata2 / $jmlperhalaman2);
    $halaktif2 = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start2 = ($jmlperhalaman2 * $halaktif2) - $jmlperhalaman2;

    //PAGINATION jurusan
    $jmlperhalaman3 = 7;
    $jmldata3 = $jumlah_jurusan;
    $jmlhalaman3 = ceil($jmldata3 / $jmlperhalaman3);
    $halaktif3 = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start3 = ($jmlperhalaman3 * $halaktif3) - $jmlperhalaman3;

    //PAGINATION ujian
    $jmlperhalaman5 = 7;
    $jmldata5 = $jumlah_ujian;
    $jmlhalaman5 = ceil($jmldata5 / $jmlperhalaman5);
    $halaktif5 = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start5 = ($jmlperhalaman5 * $halaktif5) - $jmlperhalaman5;

    $result_table_mapel = mysqli_query($koneksi, "SELECT * FROM tb_mapel LIMIT $start2, $jmlperhalaman2");

    $result_table_jurusan = mysqli_query($koneksi, "SELECT * FROM tb_jurusan LIMIT $start3, $jmlperhalaman3");

    if (isset($_GET['q'])) {
        $result_table_guru = mysqli_query($koneksi, "SELECT tb_guru.id ,tb_mapel.nama as nama_mapel, tb_guru.nip, tb_guru.nama FROM tb_guru, tb_mapel WHERE tb_guru.id_mapel = tb_mapel.id and tb_guru.nama LIKE '%" . $_GET['q'] . "%' order by tb_mapel.nama LIMIT $start, $jmlperhalaman");
    } else {
        $result_table_guru = mysqli_query($koneksi, "SELECT tb_guru.id ,tb_mapel.nama as nama_mapel, tb_guru.nip, tb_guru.nama FROM tb_guru, tb_mapel WHERE tb_guru.id_mapel = tb_mapel.id order by tb_mapel.nama LIMIT $start, $jmlperhalaman");
    }

    $result_table_siswa = mysqli_query($koneksi, "SELECT tb_siswa.id, tb_siswa.nisn, tb_siswa.nama, tb_siswa.id_kelas, concat (tb_kelas.tingkat , ' - ' ,   tb_jurusan.nama, ' - ', tb_kelas.Kelas) AS nama_kelas, tb_siswa.alamat
        FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id INNER JOIN tb_jurusan ON tb_kelas.id_jurusan = tb_jurusan.id order by tb_siswa.id_kelas LIMIT $start1, $jmlperhalaman1");

    $now = mysqli_query($koneksi, "SET @now=now()");
    $result_table_ujian = mysqli_query($koneksi, " SELECT tb_ujian.id, tb_ujian.id_mapel,tb_ujian.tingkat, tb_mapel.nama, 
                                                   tb_ujian.tgl_mulai,CASE
                                                   WHEN @now < tgl_mulai THEN 'belum mulai'
                                                   WHEN @now >= tgl_mulai && @now <= tgl_selesai THEN 'mulai'
                                                   ELSE 'selesai' END AS status,
                                                   tb_ujian.tgl_selesai, tb_ujian.waktu, tb_ujian.token
                                                   FROM tb_ujian INNER JOIN tb_mapel ON 
                                                   tb_ujian.id_mapel = tb_mapel.id
                                                   ORDER BY tb_ujian.Tingkat
                                                   LIMIT $start5, $jmlperhalaman5");

    $no = $start;
    $no1 = $start1;
    $no2 = $start2;
    $no3 = $start3;
    $no5 = $start5;

?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>ADMIN - CBT</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        <meta name="description" content="This is an example dashboard created using build-in elements and components.">
        <meta name="msapplication-tap-highlight" content="no">
        <link href="./main.css" rel="stylesheet">
        <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            var xmlhttp = new XMLHttpRequest();

            function getdata(source, id) {
                if (xmlhttp != null) {
                    var o = document.getElementById(id);
                    xmlhttp.open("GET", source);
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            o.innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.send(null);
                }
            }

            function table() {
                const a = document.getElementById('search');
                getdata("ajax/guru.php?q=" + a.value, "table");
            }
        </script>
    </head>

    <body>
        <!-- Modal Buat tambah Data-->
        <div class="modal fade" id="insertgurumodal" tabindex="-1" role="dialog" aria-labelledby="insertmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatemodalLabel">Tambah Data Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="tambah.php">
                            <!-- query untuk id_mapel-->
                            <?php
                            $result_namamapel = mysqli_query($koneksi, "SELECT tb_mapel.id as id, concat(tb_mapel.id, ' - ', tb_mapel.nama)AS id_mapel FROM tb_mapel");
                            ?>
                            <select id="inputState" class="form-control mt-2" name="id_mapel">
                                <option selected disabled>Pilih mapel</option>
                                <?php while ($pecah = mysqli_fetch_assoc($result_namamapel)) {
                                ?>
                                    <option value="<?php echo $pecah['id'] ?>"><?php echo $pecah['id_mapel'] ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" name="nama" class="form-control mt-4" placeholder="Masukan Nama" autocomplete="off" required>
                            <select id="inputState" class="form-control mt-4 mb-2" name="jenis_kelamin" required>
                                <option selected disabled>Jenis kelamin</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary" name="tambah_guru">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="insertmuridmodal" tabindex="-1" role="dialog" aria-labelledby="insertmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatemodalLabel">Tambah Data siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="tambah.php">
                            <input type="text" name="nama_siswa" class="form-control mt-2" placeholder="Masukan Nama" autocomplete="off" required>
                            <!-- query untuk kelas-->
                            <?php
                            $result_kelas = mysqli_query($koneksi, "SELECT a.id, concat(a.tingkat , ' - ' , b.nama, ' - ', a.kelas) AS nama_kelas FROM tb_kelas a INNER JOIN tb_jurusan b ON a.id_jurusan = b.id");
                            ?>
                            <select id="inputState" class="form-control mt-4" name="kelas" required>
                                <option selected disabled>Pilih Kelas</option>
                                <?php while ($row = mysqli_fetch_assoc($result_kelas)) { ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['nama_kelas'] ?></option>
                                <?php } ?>
                            </select>
                            <select id="inputState" class="form-control mt-4" name="jk_siswa" required>
                                <option selected disabled>Jenis kelamin</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                            <textarea class="form-control mt-4 mt-2" required name="alamat" placeholder="Masukan Alamat" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary" name="tambah_siswa">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="insertmapelmodal" tabindex="-1" role="dialog" aria-labelledby="insertmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatemodalLabel">Tambah Data Mapel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="tambah.php">
                            <input type="text" name="nama_mapel" class="form-control mt-2" placeholder="Masukan nama mapel" autocomplete="off" required>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary" name="tambah_mapel">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="insertjurusanmodal" tabindex="-1" role="dialog" aria-labelledby="insertmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatemodalLabel">Tambah Data Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="tambah.php">
                            <input type="text" name="nama_jurusan" class="form-control mt-2" placeholder="Masukan nama jurusan" autocomplete="off" required>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary" name="tambah_jurusan">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="insertsoalmodal" tabindex="-1" role="dialog" aria-labelledby="insertmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatemodalLabel">Tambah Data Soal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="tambah.php">
                            <?php
                            $rslt = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from tb_mapel WHERE id = '" . $_GET['id_mapel'] . "' "));
                            ?>
                            <input type="hidden" name="pelajaran" value="<?php echo $rslt['id'] ?>">
                            <input type="text" value="<?php echo $rslt['nama'] ?>" disabled class="form-control mt-2">
                            <select id="inputState" class="form-control mt-4" name="ting" required>
                                <option selected disabled>Tingkat</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                            <label class="mt-3 mb-2" for="tglm">Pertanyaan</label>
                            <textarea id="ckeditor" class="ckeditor form-control" required autocomplete="off" name="pertanyaan" placeholder="Masukan Pertanyaan" rows="5"> </textarea>
                            <label class="mt-3 mb-2" for="tglm">Opsi - A</label>
                            <textarea id="ckeditor" class="ckeditor form-control" class="form-control" required autocomplete="off" name="A" placeholder="Opsi - A" rows="5"></textarea>
                            <label class="mt-3 mb-2" for="tglm">Opsi - B</label>
                            <textarea id="ckeditor" class="ckeditor form-control" class="form-control" required autocomplete="off" name="B" placeholder="Opsi - B" rows="5"></textarea>
                            <label class="mt-3 mb-2" for="tglm">Opsi - C</label>
                            <textarea id="ckeditor" class="ckeditor form-control" class="form-control" required autocomplete="off" name="C" placeholder="Opsi - C" rows="5"></textarea>
                            <label class="mt-3 mb-2" for="tglm">Opsi - D</label>
                            <textarea id="ckeditor" class="ckeditor form-control" class="form-control" required autocomplete="off" name="D" placeholder="Opsi - D" rows="5"></textarea>
                            <label class="mt-3 mb-2" for="tglm">Opsi - E</label>
                            <textarea id="ckeditor" class="ckeditor form-control" class="form-control" required autocomplete="off" name="E" placeholder="Opsi - E" rows="5"></textarea>
                            <select name="jawaban" class="form-control mt-4" required>
                                <option selected disabled>Pilih Kunci Jawaban</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary" name="tambah_soal">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="insertujianmodal" tabindex="-1" role="dialog" aria-labelledby="insertmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatemodalLabel">Mulai Ujian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="tambah.php">
                            <!-- query untuk id_mapel-->
                            <?php
                            $result_namamapel = mysqli_query($koneksi, "SELECT tb_mapel.id as id, concat(tb_mapel.id, ' - ', tb_mapel.nama)AS id_mapel FROM tb_mapel");
                            ?>
                            <select id="inputState" required class="form-control mt-2" name="id_mapel9">
                                <option selected disabled>Pilih mapel</option>
                                <?php while ($pecah = mysqli_fetch_assoc($result_namamapel)) { ?>
                                    <option value="<?php echo $pecah['id'] ?>"><?php echo $pecah['id_mapel'] ?></option>
                                <?php } ?>
                            </select>
                            <select id="inputState" class="form-control mt-4" required name="tingkat">
                                <option selected disabled>Tingkat</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                            <label class="mt-3 mb-2" for="tglm">Tanggal Mulai</label>
                            <input id="tglm" type="datetime-local" name="tgl_mulai" class="form-control" placeholder="Tgl Mulai" autocomplete="off" required>
                            <label class="mt-3 mb-2" for="tgls">Tanggal selesai</label>
                            <input id="tgls" type="datetime-local" name="tgl_selesai" class="form-control" placeholder="Tgl Selesai" autocomplete="off" required>
                            <input type="number" name="waktu1" class="form-control mt-4" placeholder="Waktu (Menit)" autocomplete="off" required>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary" name="tambah_ujian">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <div class="app-header header-shadow">
                <div class="app-header__logo">
                    <div class="logo-src mb-2"><img src="gambar/logo-sekolah.jpg" style="padding-bottom: 5px; display: inline-block; width: 35px; height: 35px;"><span style=" display: inline-block; background-color: rgb(250, 251, 252); padding: 6px 3px 3px 3px;"><b>SMK TIP</b></span></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="app-header__content">
                    <div class="app-header-right">
                        <div class="header-btn-lg pr-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                                <img width="42" class="rounded-circle" src="gambar/user-dimas.jpg" alt="">
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                                <button type="button" tabindex="0" class="dropdown-item">Pengaturan akun</button>
                                                <div tabindex="-1" class="dropdown-divider"></div>
                                                <a href="logout.php" tabindex="0" class="dropdown-item">logout</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left  ml-3 header-user-info">
                                        <div class="widget-heading">
                                            <?php echo $user ?>
                                        </div>
                                        <div class="widget-subheading">
                                            Admin
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui-theme-settings">
                <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                    <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
                </button>
                <div class="theme-settings__inner">
                    <div class="scrollbar-container">
                        <div class="theme-settings__options-wrapper">
                            <h3 class="themeoptions-heading">Layout Options</h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-header">
                                                        <div class="switch-animate switch-on">
                                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Header</div>
                                                    <div class="widget-subheading">Makes the header top fixed, always visible!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-sidebar">
                                                        <div class="switch-animate switch-on">
                                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Sidebar</div>
                                                    <div class="widget-subheading">Makes the sidebar left fixed, always visible!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-footer">
                                                        <div class="switch-animate switch-off">
                                                            <input type="checkbox" data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Footer</div>
                                                    <div class="widget-subheading">Makes the app footer bottom fixed, always visible!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>
                                    Header Options
                                </div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">
                                    Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Choose Color Scheme</h5>
                                        <div class="theme-settings-swatches">
                                            <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light"></div>
                                            <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light"></div>
                                            <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark"></div>
                                            <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark"></div>
                                            <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark"></div>
                                            <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light"></div>
                                            <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark"></div>
                                            <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light"></div>
                                            <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light"></div>
                                            <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light"></div>
                                            <div class="divider"></div>
                                            <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light"></div>
                                            <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light"></div>
                                            <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light"></div>
                                            <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light"></div>
                                            <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light"></div>
                                            <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light"></div>
                                            <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark"></div>
                                            <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark"></div>
                                            <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark"></div>
                                            <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark"></div>
                                            <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark"></div>
                                            <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark"></div>
                                            <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark"></div>
                                            <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light"></div>
                                            <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark"></div>
                                            <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light"></div>
                                            <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light"></div>
                                            <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light"></div>
                                            <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark"></div>
                                            <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light"></div>
                                            <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light"></div>
                                            <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light"></div>
                                            <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light"></div>
                                            <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light"></div>
                                            <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light"></div>
                                            <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>Sidebar Options</div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">
                                    Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Choose Color Scheme</h5>
                                        <div class="theme-settings-swatches">
                                            <div class="swatch-holder bg-primary switch-sidebar-cs-class" data-class="bg-primary sidebar-text-light"></div>
                                            <div class="swatch-holder bg-secondary switch-sidebar-cs-class" data-class="bg-secondary sidebar-text-light"></div>
                                            <div class="swatch-holder bg-success switch-sidebar-cs-class" data-class="bg-success sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-warning switch-sidebar-cs-class" data-class="bg-warning sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-danger switch-sidebar-cs-class" data-class="bg-danger sidebar-text-light"></div>
                                            <div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light"></div>
                                            <div class="swatch-holder bg-focus switch-sidebar-cs-class" data-class="bg-focus sidebar-text-light"></div>
                                            <div class="swatch-holder bg-alternate switch-sidebar-cs-class" data-class="bg-alternate sidebar-text-light"></div>
                                            <div class="divider"></div>
                                            <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class" data-class="bg-vicious-stance sidebar-text-light"></div>
                                            <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class" data-class="bg-midnight-bloom sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-night-sky switch-sidebar-cs-class" data-class="bg-night-sky sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class" data-class="bg-slick-carbon sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-asteroid switch-sidebar-cs-class" data-class="bg-asteroid sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-royal switch-sidebar-cs-class" data-class="bg-royal sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class" data-class="bg-warm-flame sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-night-fade switch-sidebar-cs-class" data-class="bg-night-fade sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class" data-class="bg-sunny-morning sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class" data-class="bg-tempting-azure sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class" data-class="bg-amy-crisp sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class" data-class="bg-heavy-rain sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class" data-class="bg-mean-fruit sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class" data-class="bg-malibu-beach sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class" data-class="bg-deep-blue sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class" data-class="bg-ripe-malin sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class" data-class="bg-arielle-smile sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class" data-class="bg-plum-plate sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class" data-class="bg-happy-fisher sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class" data-class="bg-happy-itmeo sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class" data-class="bg-mixed-hopes sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class" data-class="bg-strong-bliss sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-grow-early switch-sidebar-cs-class" data-class="bg-grow-early sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class" data-class="bg-love-kiss sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class" data-class="bg-premium-dark sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-happy-green switch-sidebar-cs-class" data-class="bg-happy-green sidebar-text-light">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>Main Content Options</div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Page Section Tabs</h5>
                                        <div class="theme-settings-swatches">
                                            <div role="group" class="mt-2 btn-group">
                                                <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="body-tabs-line">
                                                    Line
                                                </button>
                                                <button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="body-tabs-shadow">
                                                    Shadow
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>
                    <?php if (empty($_GET['hal'])) { ?>
                        <div class="scrollbar-sidebar">
                            <div class="app-sidebar__inner">
                                <ul class="vertical-nav-menu">
                                    <li class="app-sidebar__heading">Beranda</li>
                                    <li>
                                        <a href="index.html" class="mm-active">
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
                                        <i class="pe-7s-user icon-gradient bg-mean-fruit"></i>
                                    </div>
                                    <div>Selamat Datang <?php echo $user ?>
                                        <div class="page-title-subheading">Ini Adalah Halaman Admin</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Guru</div>
                                            <div class="widget-subheading">Jumlah Guru SMK TiP</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $jumlah_guru ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Siswa</div>
                                            <div class="widget-subheading">Total siswa SMK TIP</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $jumlah_siswa ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total jurusan</div>
                                            <div class="widget-subheading">Jurusan di Smk TI Pembangunan</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $jumlah_jurusan ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } elseif ($_GET['hal'] == "guru") {
                        include 'guru.php';
                    } elseif ($_GET['hal'] == "update_guru") {
                        include 'update_guru.php';
                    } elseif ($_GET['hal'] == "update_siswa") {
                        include 'update_siswa.php';
                    } elseif ($_GET['hal'] == "siswa") {
                        include 'siswa.php';
                    } elseif ($_GET['hal'] == "mapel") {
                        include 'mapel.php';
                    } elseif ($_GET['hal'] == "update_mapel") {
                        include 'update_mapel.php';
                    } elseif ($_GET['hal'] == "jurusan") {
                        include 'jurusan.php';
                    } elseif ($_GET['hal'] == "update_jurusan") {
                        include 'update_jurusan.php';
                    } elseif ($_GET['hal'] == "soal") {
                        include 'soal.php';
                    } elseif ($_GET['hal'] == "det_soal") {
                        include 'det_soal.php';
                    } elseif ($_GET['hal'] == "update_soal") {
                        include 'update_soal.php';
                    } elseif ($_GET['hal'] == "ujian") {
                        include 'ujian.php';
                    } elseif ($_GET['hal'] == "nilai") {
                        include 'nilai.php';
                    } elseif ($_GET['hal'] == "det_nilai") {
                        include 'det_nilai.php';
                    } elseif ($_GET['hal'] == "nilai_ujian") {
                        include 'nilai_ujian.php';
                    } elseif ($_GET['hal'] == "det_ujian2") {
                        include 'det_ujian2.php';
                    } else {
            ?><script type="text/javascript">
                    window.history.back();
                </script><?php
                        }
                            ?>

            <!-- table-->


            </div>
        </div>
        <script type="text/javascript" src="jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/scripts/main.js"></script>
    </body>

    </html>

<?php
} else if (isset($_SESSION['guru'])) {
    $user = $_SESSION['guru'];
?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>GURU - CBT</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="This is an example dashboard created using build-in elements and components.">
        <meta name="msapplication-tap-highlight" content="no">
        <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
        <link href="./main.css" rel="stylesheet">
    </head>

    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <div class="app-header header-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="app-header__content">
                    <div class="app-header-left">
                        <div class="search-wrapper">
                            <div class="input-holder">
                                <input type="text" class="search-input" placeholder="Type to search">
                                <button class="search-icon"><span></span></button>
                            </div>
                            <button class="close"></button>
                        </div>
                    </div>
                    <div class="app-header-right">
                        <div class="header-btn-lg pr-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                                <img width="42" class="rounded-circle" src="gambar/user-dimas.jpg" alt="">
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                                <button type="button" tabindex="0" class="dropdown-item">Pengaturan akun</button>
                                                <div tabindex="-1" class="dropdown-divider"></div>
                                                <a href="logout.php" tabindex="0" class="dropdown-item">logout</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left  ml-3 header-user-info">
                                        <div class="widget-heading">
                                            <?php echo $user ?>
                                        </div>
                                        <div class="widget-subheading">
                                            Guru
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui-theme-settings">
                <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                    <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
                </button>
                <div class="theme-settings__inner">
                    <div class="scrollbar-container">
                        <div class="theme-settings__options-wrapper">
                            <h3 class="themeoptions-heading">Layout Options
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-header">
                                                        <div class="switch-animate switch-on">
                                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Header
                                                    </div>
                                                    <div class="widget-subheading">Makes the header top fixed, always visible!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-sidebar">
                                                        <div class="switch-animate switch-on">
                                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Sidebar
                                                    </div>
                                                    <div class="widget-subheading">Makes the sidebar left fixed, always visible!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-footer">
                                                        <div class="switch-animate switch-off">
                                                            <input type="checkbox" data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Footer
                                                    </div>
                                                    <div class="widget-subheading">Makes the app footer bottom fixed, always visible!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>
                                    Header Options
                                </div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">
                                    Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Choose Color Scheme
                                        </h5>
                                        <div class="theme-settings-swatches">
                                            <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light">
                                            </div>
                                            <div class="divider">
                                            </div>
                                            <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>Sidebar Options</div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">
                                    Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Choose Color Scheme
                                        </h5>
                                        <div class="theme-settings-swatches">
                                            <div class="swatch-holder bg-primary switch-sidebar-cs-class" data-class="bg-primary sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-secondary switch-sidebar-cs-class" data-class="bg-secondary sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-success switch-sidebar-cs-class" data-class="bg-success sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-warning switch-sidebar-cs-class" data-class="bg-warning sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-danger switch-sidebar-cs-class" data-class="bg-danger sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-focus switch-sidebar-cs-class" data-class="bg-focus sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-alternate switch-sidebar-cs-class" data-class="bg-alternate sidebar-text-light">
                                            </div>
                                            <div class="divider">
                                            </div>
                                            <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class" data-class="bg-vicious-stance sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class" data-class="bg-midnight-bloom sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-night-sky switch-sidebar-cs-class" data-class="bg-night-sky sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class" data-class="bg-slick-carbon sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-asteroid switch-sidebar-cs-class" data-class="bg-asteroid sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-royal switch-sidebar-cs-class" data-class="bg-royal sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class" data-class="bg-warm-flame sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-night-fade switch-sidebar-cs-class" data-class="bg-night-fade sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class" data-class="bg-sunny-morning sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class" data-class="bg-tempting-azure sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class" data-class="bg-amy-crisp sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class" data-class="bg-heavy-rain sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class" data-class="bg-mean-fruit sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class" data-class="bg-malibu-beach sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class" data-class="bg-deep-blue sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class" data-class="bg-ripe-malin sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class" data-class="bg-arielle-smile sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class" data-class="bg-plum-plate sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class" data-class="bg-happy-fisher sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class" data-class="bg-happy-itmeo sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class" data-class="bg-mixed-hopes sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class" data-class="bg-strong-bliss sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-grow-early switch-sidebar-cs-class" data-class="bg-grow-early sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class" data-class="bg-love-kiss sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class" data-class="bg-premium-dark sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-happy-green switch-sidebar-cs-class" data-class="bg-happy-green sidebar-text-light">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>Main Content Options</div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Page Section Tabs
                                        </h5>
                                        <div class="theme-settings-swatches">
                                            <div role="group" class="mt-2 btn-group">
                                                <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="body-tabs-line">
                                                    Line
                                                </button>
                                                <button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="body-tabs-shadow">
                                                    Shadow
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Beranda</li>
                                <li>
                                    <a href="index.html" class="mm-active">
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
                                            <a href="">
                                                <i class="metismenu-icon"></i>
                                                Siswa
                                            </a>
                                        </li>
                                        <li>
                                        <li>
                                            <a href="">
                                                <i class="metismenu-icon">
                                                </i>Soal
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
                                            <a href="">
                                                <i class="metismenu-icon"></i>
                                                Nilai-siswa
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
                                        <i class="pe-7s-notebook icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Selamat Datang <?php echo $user ?>
                                        <div class="page-title-subheading">Ini Adalah Halaman guru
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
            </div>
        </div>
        <script type="text/javascript" src="./assets/scripts/main.js"></script>
    </body>

    </html>

<?php
} elseif (isset($_SESSION['siswa'])) {

    include 'koneksi.php';
    $user = $_SESSION['siswa'];

    $data_siswa = mysqli_query($koneksi, "SELECT tb_siswa.id, tb_siswa.nisn, tb_siswa.nama, tb_siswa.id_kelas ,tb_kelas.tingkat AS keber,
              concat (tb_kelas.tingkat , ' - ' , tb_jurusan.nama, ' - ', tb_kelas.Kelas) AS nama_kelas, tb_siswa.alamat
              FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id INNER JOIN tb_jurusan 
              ON tb_kelas.id_jurusan = tb_jurusan.id WHERE tb_siswa.id = '" . $_SESSION['id'] . "' ");

    $pecah = mysqli_fetch_assoc($data_siswa);

    date_default_timezone_set("asia/jakarta");
    $tanggal = date("y-m-d");
    $jam = date("H:i:s");

    mysqli_query($koneksi, "SET @now=now()");

    $result_table_ujian = mysqli_query($koneksi, " SELECT tb_ujian.id, tb_ujian.id_mapel,tb_ujian.tingkat, tb_mapel.nama, 
                                               tb_ujian.tgl_mulai,CASE
                                               WHEN @now < tgl_mulai THEN 'belum mulai'
                                               WHEN @now >= tgl_mulai && @now <= tgl_selesai THEN 'mulai'
                                               ELSE 'selesai' END AS status,
                                               tb_ujian.tgl_selesai, tb_ujian.waktu, tb_ujian.token
                                               FROM tb_ujian INNER JOIN tb_mapel ON 
                                               tb_ujian.id_mapel = tb_mapel.id WHERE Tingkat = '" . $pecah['keber'] . "' ");

    $no = 0;

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>CBT - SISWA</title>
        <script type="text/javascript">
            var xmlhttp = new XMLHttpRequest();

            function getdata(source, id) {
                if (xmlhttp != null) {
                    var o = document.getElementById(id);
                    xmlhttp.open("GET", source);
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            o.innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.send(null);
                }
            }

            function table() {
                getdata("ajax/table_siswa.php", "tables");
            }
        </script>
        <link rel="stylesheet" type="text/css" href="css/siswa.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    </head>

    <body onload="setInterval(table,1000);" style="background-color: rgb(242, 245, 250);">

        <div class="nav">
            <div class="nav-left">
                <h1>SMK TI PEMBANGUNAN</h1>
            </div>
            <div class="nav-right">
                <img src="gambar/icon-siswa.png" id="icon-siswa">
                <a href="logout.php"><img src="gambar/icon-exit.png" id="exit"></a>
                <span>SELAMAT DATANG</span>
                <span><?php echo $pecah['nama'] ?></span>
                <span><?php echo $pecah['nama_kelas'] ?></span>
                <div style="clear: both;"></div>
                <div class="log opasiti">
                    <label>log out</label>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="container">

            <div id="tables">
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
                            <?php $query_ikutujian = mysqli_query($koneksi, "SELECT * from tb_ikutujian where id_ujian = '" . $row['id'] . "' AND id_siswa = '" . $pecah['id'] . "' ");
                            $data_ikut = mysqli_num_rows($query_ikutujian); ?>
                            <tr>
                                <td><?php echo $no += 1; ?></td>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['tingkat'] ?></td>
                                <td>
                                    <?php if ($row['status'] == "belum mulai") : ?>
                                        <a href="#" class="btn btn-danger btn-sm"><?php echo $row['status'] ?></a>
                                </td>
                                <?php if ($data_ikut == 0) : ?>
                                    <td><button class="btn btn-danger btn-sm">Belum Ikut</button></td>
                                <?php elseif ($data_ikut > 0) : ?>
                                    <td><button class="btn btn-success btn-sm">Telah Ikut</button></td>
                                <?php endif ?>
                                <td></td>
                            <?php elseif ($row['status'] == "mulai") : ?>
                                <a href="#" class="btn btn-success btn-sm">Mulai</a>
                                </td>
                                <?php if ($data_ikut == 0) : ?>
                                    <td><button class="btn btn-danger btn-sm">Belum Ikut</button></td>
                                    <td><a href="det_ujian.php?id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Kerjakan</a></td>
                                <?php elseif ($data_ikut > 0) : ?>
                                    <td><button class="btn btn-success btn-sm">Telah Ikut</button></td>
                                    <td></td>
                                <?php endif ?>
                            <?php else : ?>
                                <a href="#" class="btn btn-secondary btn-sm"><?php echo $row['status'] ?></a>
                                </td>
                                <?php if ($data_ikut == 0) : ?>
                                    <td><button class="btn btn-danger btn-sm">Belum Ikut</button></td>
                                <?php elseif ($data_ikut > 0) : ?>
                                    <td><button class="btn btn-success btn-sm">Telah Ikut</button></td>
                                <?php endif ?>
                                <td></td>
                            <?php endif ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="jquery-3.4.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>

    </html>
<?php
} else {
?><script type="text/javascript">
        window.location.href = "index.php";
    </script><?php
            }

                ?>