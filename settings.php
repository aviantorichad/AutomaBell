<?php
if (!isset($_REQUEST['l'])) {
    //echo "<meta http-equiv='refresh' content='0; url=index.php?l=settings' />";
    header("location:index.php?l=settings");
}
if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['usernamebell'])) {
    include_once "i_login.php";
    return false;
}
$usernameku = $_SESSION['usernamebell'];
?>
<?php
require_once "koneksi.php";
$msg = "";
if (!empty($_REQUEST['w'])) {
    switch ((int) $_REQUEST['w']) {
        //.saving
        case "1": //.sukses simpan
            $msg = "<span style='padding:5px;margin-left:5px;background:lightgreen;color:green;border:1px dashed green;box-shadow:0 0 1px green;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>Jadwal berhasil disimpan.</span>";
            break;
        case "2": //.gagal simpan
            $msg = "<span style='padding:5px;margin-left:5px;background:pink;color:maroon;border:1px dashed maroon;box-shadow:0 0 1px maroon;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>Gagal menyimpan jadwal.</span>";
            break;
        case "3": //.perintah tidak sah
            $msg = "<span style='padding:5px;margin-left:5px;background:lightyellow;color:maroon;border:1px dashed orange;box-shadow:0 0 1px orange;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>Perintah tidak sah.</span>";
            break;
        //.delete
        case "20": //.sukses menghapus
            $msg = "<span style='padding:5px;margin-left:5px;background:lightgreen;color:green;border:1px dashed green;box-shadow:0 0 1px green;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>Jadwal berhasil dihapus.</span>";
            break;
        case "21": //.gagal menghapus
            $msg = "<span style='padding:5px;margin-left:5px;background:pink;color:maroon;border:1px dashed maroon;box-shadow:0 0 1px maroon;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>Gagal menghapus jadwal.</span>";
            break;
        default:
            $msg = "";
            break;
    }
}
?>
<script type="text/javascript">function validateTime() {
        var data = document.getElementById("txt_jam").value;
        if (data != null || data != "") {
            var res = data.split(':');
            if (res.length == 2) {
                var hh = res[0];
                var mm = res[1];
                if (hh >= 0 && hh <= 23) {
                    if (mm >= 0 && mm <= 59) {
                        return true;
                    } else {
                        alert("Isian menit belum benar.");
                        return false;
                    }
                } else {
                    alert("Isian jam  belum benar.");
                    return false;
                }
            } else {
                alert("Isian jam  belum benar.");
                return false;
            }
        } else {
            alert("Isian jam  belum benar.");
            return false;
        }
    }</script>
<h2>Pengaturan Jadwal <?php echo $msg; ?></h2>
<form method="post" name="jadwal" action="saving.php" onsubmit="return validateTime()">
    <select name="txt_hari" id="txt_hari">
        <?php
        $qday = $server->query("SELECT * FROM hari") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
        while ($rday = $qday->fetch_array()) {
            $hari_id = $rday['id'];
            $hari_nm = $rday['hari'];
            ?>
            <option value="<?php echo $hari_id; ?>"><?php echo $hari_nm; ?></option>
        <?php } ?>
    </select>
    <span>
        <input type="text" name="txt_jam" id="txt_jam" placeholder="mm:ss" required maxlength="5" size="5" style="text-align:center;" title="mm:ss" onfocus="show_kont_time('block')" ondblclick="show_kont_time('none')" autocomplete="off" />

        <?php //start list time//  ?>
        <style>

            ul.kont_time{
                width:185px;
                list-style:none;
                box-shadow:2px 2px 5px #222;
                float:left;
                position:absolute;
                background:#fff;
                margin:0;
                padding:0;
                display:none;
                font-size:14px;
                text-align:center;
            }
            li{
                float:left;
                padding:5px;
            }
            li:hover{
                background:#ddd;
                cursor:pointer;
            }
        </style>
        <script type="text/javascript">
            function setJam(injam) {
                var jam = injam;
                try {
                    document.getElementById("txt_jam").value = jam;
                    show_kont_time('none');
                } catch (exo) {
                    alert(exo)
                }
            }
            function show_kont_time(status) {
                try {
                    document.getElementById("kont_time").style.display = status;
                } catch (ex0) {
                    alert(ex0);
                }
            }
        </script>
        <ul class="kont_time" id="kont_time">
            <li onclick="setJam(this.innerHTML)">00:00</li>
            <li onclick="setJam(this.innerHTML)">01:00</li>
            <li onclick="setJam(this.innerHTML)">02:00</li>
            <li onclick="setJam(this.innerHTML)">03:00</li>
            <li onclick="setJam(this.innerHTML)">04:00</li>
            <li onclick="setJam(this.innerHTML)">05:00</li>
            <li onclick="setJam(this.innerHTML)">06:00</li>
            <li onclick="setJam(this.innerHTML)">07:00</li>
            <li onclick="setJam(this.innerHTML)">08:00</li>
            <li onclick="setJam(this.innerHTML)">09:00</li>
            <li onclick="setJam(this.innerHTML)">10:00</li>
            <li onclick="setJam(this.innerHTML)">11:00</li>
            <li onclick="setJam(this.innerHTML)">12:00</li>
            <li onclick="setJam(this.innerHTML)">13:00</li>
            <li onclick="setJam(this.innerHTML)">14:00</li>
            <li onclick="setJam(this.innerHTML)">15:00</li>
            <li onclick="setJam(this.innerHTML)">16:00</li>
            <li onclick="setJam(this.innerHTML)">17:00</li>
            <li onclick="setJam(this.innerHTML)">18:00</li>
            <li onclick="setJam(this.innerHTML)">19:00</li>
            <li onclick="setJam(this.innerHTML)">20:00</li>
            <li onclick="setJam(this.innerHTML)">21:00</li>
            <li onclick="setJam(this.innerHTML)">22:00</li>
            <li onclick="setJam(this.innerHTML)">23:00</li>
        </ul>
        <?php //end list time// ?>
    </span>
    <input type="text" name="txt_jadwal" id="txt_jadwal" placeholder="deskripsi jadwal" required maxlength="50" size="25" style="text-align:left;" title="deskripsi" />
    <select name="txt_audio" id="txt_audio" style="max-width:250px">
        <?php
        $qtab = $server->query("SELECT * FROM audio ORDER by file ASC") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
        while ($rtab = $qtab->fetch_array()) {
            $audio_id = $rtab['id'];
            $audio_nm = $rtab['nama'];
            $audio_fl = $rtab['file'];
            ?>
            <option value="<?php echo $audio_id; ?>"><?php echo $audio_fl; ?></option>
        <?php } ?>
    </select>
    <input type="submit" name="submit" id="submit" value="Simpan" />
</form>
<table cellspacing="0">
    <tr class="header">
        <td width="30px">No</td>
        <td width="65px">Hari</td>
        <td width="50px">Jam</td>
        <td>Jadwal</td>
        <td>Audio</td>
        <td width="135px">Diperbarui</td>
        <td width="25px">*</td>
    </tr>

    <?php
    $no = 1;
    $qtab = $server->query("SELECT * FROM resume ORDER BY hari ASC, jam ASC") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
    if ($qtab->num_rows > 0) {
        while ($rtab = $qtab->fetch_array()) {
            $res_id = $rtab['id'];
            $res_hr = $rtab['hari'];
            $res_hr = getHariNm($res_hr);
            $res_jm = $rtab['jam'];
            $res_jw = $rtab['jadwal'];
            $res_fl = $rtab['audio'];
            $res_fl = getAudioNm($res_fl);
            $res_wk = $rtab['updated'];
            $res_wk = date_format(date_create($res_wk), "d-M-Y (H:i:s)");
            $warna = ($no % 2 == 1) ? "#ffffff" : "#f0f0f0";
            ?>
            <tr bgcolor="<?php echo $warna; ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo $res_hr; ?></td>
                <td><?php echo $res_jm; ?></td>
                <td><?php echo $res_jw; ?></td>
                <td><?php echo $res_fl; ?></td>
                <td><?php echo $res_wk; ?></td>
                <td align="middle"><a href="deleting_jadwal.php?i=<?php echo $res_id; ?>" <?php echo "onclick=\"cek=confirm('Anda yakin ingin menghapus jadwal ini?');if(cek){return true;}else{return false;}\"" ?> title="Hapus"><img src="img/bg-icon.png" style="background-image: url('img/glyphicons-halflings.png');background-position:-312px 0px;background-repeat: no-repeat;" title="hapus" alt="hapus"/></a></td>
            </tr>
            <?php
            $no++;
        }
    } else {
        ?>
        <tr>
            <td colspan="7"><center><i>** no data **</i></center></td>
        </tr>
        <?php
    }
    ?>
</table>