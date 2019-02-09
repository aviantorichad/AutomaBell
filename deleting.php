<?php

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['usernamebell'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?l=settings' />";
    return false;
}
$usernameku = $_SESSION['usernamebell'];
?>
<?php

require_once "koneksi.php";
if (!empty($_REQUEST['i'])) {
    $id = (int) $_REQUEST['i'];
    $qtab = $server->query("SELECT * FROM audio WHERE id = '$id'") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
    $rtab = $qtab->fetch_array();
    $res_id = $rtab['id'];
    $res_fl = $rtab['file'];
    $res_wk = $rtab['updated'];
    $folder = "./mp3";
    $file = $folder . "/" . $res_fl;
    if (unlink($file)) {
        $qdel = $server->query("DELETE FROM audio WHERE id = '$id'") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
        if ($qdel) {
            header("location:index.php?l=s_audio&w=20#deleted");
        } else {
            header("location:index.php?l=s_audio&w=21#notdeleted");
        }
    }
}
?>