<div id="status" <?php echo $status_class; ?>><a href="<?php echo $status_href; ?>" title="<?php echo $status_title; ?>" <?php echo $status_js; ?>><?php echo $status_desc; ?></a></div>
<h2>Jadwal Hari <?php echo replaceDayToInd(date("D")); ?></h2>

<table cellspacing="0">
    <tr class="header">
        <td width="30px">No</td>
        <td width="65px">Hari</td>
        <td width="50px">Jam</td>
        <td>Jadwal</td>
        <td>Audio</td>
    </tr>

    <?php
    $no = 1;
    $day = replaceDay(date("D"));
    $qtab = $server->query("SELECT * FROM resume WHERE hari='$day' ORDER BY hari ASC, jam ASC") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
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
            </tr>
            <?php
            $no++;
        }
    } else {
        ?>
        <tr>
            <td colspan="5"><center><i>** no data **</i></center></td>
    </tr>
    <?php
}
?>
</table>
<h2>Bunyikan Manual</h2>
<select name="txt_audio_manual" id="txt_audio_manual" style="max-width:600px">
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
<input type="button" name="btn_play" id="btn_play" value="Play" onclick="PlayNow()" />