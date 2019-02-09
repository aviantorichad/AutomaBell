<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['usernamebell'])) {
    session_destroy();
    header("location:index.php?l=settings#sukseslogout");
} else {
    header("location:index.php?l=settings#nologout");
}
?>