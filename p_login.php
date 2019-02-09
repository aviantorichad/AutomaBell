<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once "koneksi.php";
if (!empty($_POST['submit'])) {
    isset($_POST['uname']) ? $u_masuk = addslashes($_POST['uname']) : $u_masuk = 0;
    isset($_POST['pwd']) ? $p_masuk = base64_encode($_POST['pwd']) : $p_masuk = 0;
    $quser = $server->query("SELECT * FROM admin WHERE username = '" . $u_masuk . "' AND password = '" . $p_masuk . "'") or die("Terjadi kesalahan saat login.Err(Ex0.1)");
    $ruser = $quser->fetch_object();
    $id_bener = $ruser->memberid;
    $u_bener = $ruser->username;
    $p_bener = $ruser->password;
    $jabatan = $ruser->jabatan;
    $g_bener = $u_bener . "-" . $p_bener;

    $g_masuk = $u_masuk . "-" . $p_masuk;
    if ($g_bener == $g_masuk) {
        $_SESSION['usernamebell'] = $u_bener;
        header("location:index.php?l=settings#sukses");
    } else {
        header("location:index.php?l=settings#gagal");
    }
} else {
    header("location:index.php?l=settings#notsubmit");
}
?>
