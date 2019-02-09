<?php
/*
  --- automaBELL V.1, cd:20140301, cn:#flappyBELL
  --- created date : 01-Mar-2014
  --- author : Richad Avianto
  --- email : aviantorich@gmail.com
  --- blog : aviantorichad.blogspot.com
  --- website : warungkost.com
  --- Note : Gunakan dengan bijak aplikasi ini,
  --- silahkan memodifikasi sesuai kebutuhan anda dengan tidak mengubah pembuat awal aplikasi ini,
  --- jika anda mengalami kesulitan silahkan kontak email saya
  --- atau anda bisa menghubungi saya pada kontak yang sudah saya sediakan
  --- untuk kondisi yang memungkinkan penghapusan nama saya silahkan meminta ijin saya terlebih dahulu.
  =======================================================================================================================================
  change log :
  ---------------------------------------------------------------------------------------------------------------------------------------
  @01-mar-2014 (xx:xx) v.1 :
  - > core dari autoMabell sudah jadi
  - > tampilan interface yang mantap
  - > menu navigasi yang sederhana dan mudah dipahami
  - > aplikasi autoMabell berjalan dengan mantap
  - > bisa menambahkan bel untuk semua hari
  - > bisa memutar bel secara manual
  - > fitur tersembunyi bisa untuk mengupload media berformat video mp4 untuk bel
  - > login terlebih dahulu untuk mengeksekusi perubahan pengaturan
  - > ebook panduan yang masih dalam tahap pengembangan
  - > dll
  @11-mar-2014 (23:40) v.1a :
  - > penambahan tombol on/off di halaman home untuk mengaktifkan atau menonaktifkan bel (hanya admin yang bisa mengeksekusi)
  =======================================================================================================================================
 */
require_once "koneksi.php";
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
$qs = $server->query("SELECT * FROM status") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
$rs = $qs->fetch_array();
$status = $rs['status'];
if ($status == 9) { //..tidak aktif = 9
    $status_desc = 'off';
    $status_class = 'class="status_off"';
    $status_href = 'enabling.php?stat=1';
    $status_title = 'aktifkan bel';
    $status_js = 'onmouseover="this.innerHTML=\'on\'" onmouseout="this.innerHTML=\'off\'"';
} else { //..aktif = 1
    $status_desc = 'on';
    $status_class = 'class="status_on"';
    $status_href = 'enabling.php?stat=9';
    $status_title = 'nonaktifkan bel';
    $status_js = 'onmouseover="this.innerHTML=\'off\'" onmouseout="this.innerHTML=\'on\'"';
}
?>

<!DOCTYPE html>
<head>
    <link rel="shortcut icon" type="x-icon" href="img/bell.png" />
    <title>automaBELL - Bel Sekolah "Yang Kutunggu"</title>

    <script type="text/javascript">
        function menunggumu() {
            jam();
            PlayTimer();
        }
<?php
if ($status == 1) {
    ?>
            function PlayTimer() {
                setTimeout("PlayTimer()", 1000);
                var Jam = new Date().toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                var url = "play.php";
    <?php
    $day = replaceDay(date("D"));
    $qtab = $server->query("SELECT * FROM resume WHERE hari='$day' ORDER BY hari ASC") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
    while ($rtab = $qtab->fetch_array()) {
        $res_id = $rtab['id'];
        $res_hr = $rtab['hari'];
        $res_hr = getHariNm($res_hr);
        $res_jm = $rtab['jam'];
        $res_jw = $rtab['jadwal'];
        $res_fl = $rtab['audio'];
        //$res_fl = getAudioNm($res_fl);
        $res_wk = $rtab['updated'];
        $res_wk = date_format(date_create($res_wk), "d-M-Y (H:i:s)");
        $qmp3 = $server->query("SELECT * FROM audio WHERE id = '$res_fl'") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
        $rmp3 = $qmp3->fetch_array();
        $audio_id = $rmp3['id'];
        $audio_nm = $rmp3['nama'];
        $audio_fl = $rmp3['file'];
        ?>
                    //.****************awal logika
                    if (Jam == "<?php echo $res_jm . ":00"; ?>") {
                        url = url + "?s=" + <?php echo $res_fl; ?>;
                        window.open(url, "playNOW", "toolbar=no,scrollbars=no,resizable=no,top=200,left=200,width=200,height=200,menubar=no,titlebar=no,location=no");
                    }
                    //.##################akhir logika
    <?php } ?>

                if (Jam == "00:01:00") {
                    location.reload();
                }
            }
    <?php
} else {
    echo "function PlayTimer(){}";
}
?>
        function PlayNow() {
            var param = document.getElementById("txt_audio_manual").value;
            var url = "play.php"
            url = url + "?s=" + param;
            window.open(url, "playNOW", "toolbar=no,scrollbars=no,resizable=no,top=200,left=200,width=200,height=200,menubar=no,titlebar=no,location=no");
        }
        function jam() {
            setTimeout("jam()", 1000);
            var Tgl = new Date().toDateString();
            var tglPisah = Tgl.split(' ');
            var hari = replaceDay(tglPisah[0]);
            var tgl = tglPisah[2];
            var bln = tglPisah[1];
            var thn = tglPisah[3];
            Tgl = hari + ", " + tgl + "-" + bln + "-" + thn;
            var Jam = new Date().toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
            document.getElementById("jam").innerHTML = "<span style='width:100%;'><span>Jam : </span><span style='font-size:34px;'>" + Jam + "</span></span>";
            document.getElementById("tgl").innerHTML = "<span style='font-size:12px;float:right;color:#f0f0f0;'>Hari ini : <span style='font-weight:bold;color:#fff;'>" + Tgl + "</span></span>";
        }
        function replaceDay(hariEng) {
            switch (hariEng) {
                case"Mon":
                    return"Senin";
                    break;
                case"Tue":
                    return"Selasa";
                    break;
                case"Wed":
                    return"Rabu";
                    break;
                case"Thu":
                    return"Kamis";
                    break;
                case"Fri":
                    return"Jum'at";
                    break;
                case"Sat":
                    return"Sabtu";
                    break;
                case"Sun":
                    return"Minggu";
                    break;
                default:
                    return hariEng;break;}
        }
    </script>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body onload="menunggumu()">

    <div id="global">
        <div id="wrapper">
            <div id="navigasi">
                <div>
                    <a href="index.php?l=home" <?php
                    if (isset($_GET['l'])) {
                        if ($_GET['l'] == 'home') {
                            echo 'class="aktiv"';
                        }
                    }
                    ?>><img src="img/bg-icon.png" style="background-image: url('img/glyphicons-halflings-white.png');background-position: 0px -24px;background-repeat: no-repeat;margin-right:3px;"/>Beranda</a>
                    <a href="index.php?l=settings" <?php
                    if (isset($_GET['l'])) {
                        if ($_GET['l'] == 'settings') {
                            echo 'class="aktiv"';
                        }
                    }
                    ?>><img src="img/bg-icon.png" style="background-image: url('img/glyphicons-halflings-white.png');background-position: -360px -144px;background-repeat: no-repeat;margin-right:3px;"/>Pengaturan</a>
                    <a href="index.php?l=s_audio" <?php
                    if (isset($_GET['l'])) {
                        if ($_GET['l'] == 's_audio') {
                            echo 'class="aktiv"';
                        }
                    }
                    ?>><img src="img/bg-icon.png" style="background-image: url('img/glyphicons-halflings-white.png');background-position: -336px -24px;background-repeat: no-repeat;margin-right:3px;"/>Unggah MP3</a>
                    <a href="Panduan.pdf" target="_blank" title="Bantuan"><img src="img/bg-icon.png" style="background-image: url('img/glyphicons-halflings-white.png');background-position: -96px -96px;background-repeat: no-repeat;margin-right:3px;" title="Bantuan"/></a>
                    <span id="tgl"></span>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div id="header">
                <h1 style="font-size:34px;"><img src="img/bell.png" align="left" />automa<span style="color:gold;">BELL</span></h1>
                <span style="font-family:fixedsys;">automatic <span style="color:gold;font-weight:bold;">bell</span> school solution</span>
                <div id="jam"></div>
            </div>
            <div style="clear:both;"></div>
            <div id="content">
                <?php
                if (isset($_GET['l'])) {
                    $show = $_GET['l'];
                    if (file_exists($show . ".php")) {
                        include $show . ".php";
                    } else {
                        echo "page not found";
                    }
                } else {
                    //header("location:index.php?l=home");
                    echo "<meta http-equiv='refresh' content='0; url=index.php?l=home' />";
                }
                ?>
            </div>
            <div style="clear:both;"></div>
            <div id="footer">
                <i>*Berjalan optimal di browser Mozilla Firefox dan Google Chrome terbaru</i><br/>
                automaBELL v.2 - cd:20190209, cn:#viralBell<br/>
                copyright &copy; 2014 - 2019 | <a href="https://github.com/aviantorichad" target="_blank">Richad Avianto</a>
                <?php
                if (!empty($_SESSION['usernamebell'])) {
                    echo "<div><a href='p_logout.php' title='logout'>Logout</a></div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
<!--
--- automaBELL V.1, cd:20140301, cn:#flappyBELL
--- created date : 01-Mar-2014
--- author : Richad Avianto
--- email : aviantorich@gmail.com
--- blog : aviantorichad.blogspot.com
--- website : warungkost.com
--- Note : Gunakan dengan bijak aplikasi ini, 
--- silahkan memodifikasi sesuai kebutuhan anda dengan tidak mengubah pembuat awal aplikasi ini, 
--- jika anda mengalami kesulitan silahkan kontak email saya 
--- atau anda bisa menghubungi saya pada kontak yang sudah saya sediakan
--- untuk kondisi yang memungkinkan penghapusan nama saya silahkan meminta ijin saya terlebih dahulu.
-->
</html>