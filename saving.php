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
if (!empty($_POST['submit'])) {
    if (!empty($_POST['txt_hari']) && !empty($_POST['txt_jam']) && !empty($_POST['txt_jadwal']) && !empty($_POST['txt_audio'])) {
        $hari = $_POST['txt_hari'];
        $jam = $_POST['txt_jam'];
        $jadwal = addslashes($_POST['txt_jadwal']);
        $audio = $_POST['txt_audio'];
        if ($hari == 1) { //.1=semua
            $query = $server->query("INSERT INTO resume(`hari`,`jam`,`jadwal`,`audio`) VALUES('3','$jam','$jadwal','$audio')") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
            $query = $server->query("INSERT INTO resume(`hari`,`jam`,`jadwal`,`audio`) VALUES('4','$jam','$jadwal','$audio')") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
            $query = $server->query("INSERT INTO resume(`hari`,`jam`,`jadwal`,`audio`) VALUES('5','$jam','$jadwal','$audio')") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
            $query = $server->query("INSERT INTO resume(`hari`,`jam`,`jadwal`,`audio`) VALUES('6','$jam','$jadwal','$audio')") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
            $query = $server->query("INSERT INTO resume(`hari`,`jam`,`jadwal`,`audio`) VALUES('7','$jam','$jadwal','$audio')") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
            $query = $server->query("INSERT INTO resume(`hari`,`jam`,`jadwal`,`audio`) VALUES('8','$jam','$jadwal','$audio')") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
            $query = $server->query("INSERT INTO resume(`hari`,`jam`,`jadwal`,`audio`) VALUES('9','$jam','$jadwal','$audio')") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
        } else {
            $query = $server->query("INSERT INTO resume(`hari`,`jam`,`jadwal`,`audio`) VALUES('$hari','$jam','$jadwal','$audio')") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
        }
        header("location:index.php?l=settings&w=1");
    } else {
        header("location:index.php?l=settings&w=2");
    }
} else {
    header("location:index.php?l=settings&w=3");
}
?>