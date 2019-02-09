<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$timezone = "Asia/Jakarta";

$host = "localhost";
$username = "mimin";
$password = "123456";
$database = "rc_bel";

$server = mysqli_connect($host, $username, $password, $database) or die("001 - no connection to server (" . mysqli_connect_error() . ")");
$GLOBALS['server'] = $server;

if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set($timezone);
}

function getHariNm($id) {

    $query = $GLOBALS['server']->query("SELECT * FROM hari WHERE id = '$id'") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
    $row = $query->fetch_array();
    return $row['hari'];
}

function getAudioNm($id) {
    $query = $GLOBALS['server']->query("SELECT * FROM audio WHERE id = '$id'") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
    $row = $query->fetch_array();
    return $row['file'];
}

function replaceDay($hariEng) {
    switch ($hariEng) {
        case "Mon":
            return "3";
            break;
        case "Tue":
            return "4";
            break;
        case "Wed":
            return "5";
            break;
        case "Thu":
            return "6";
            break;
        case "Fri":
            return "7";
            break;
        case "Sat":
            return "8";
            break;
        case "Sun":
            return "9";
            break;
        default:
            break;
    }
}

function replaceDayToInd($hariEng) {
    switch ($hariEng) {
        case "Mon":
            return "Senin";
            break;
        case "Tue":
            return "Selasa";
            break;
        case "Wed":
            return "Rabu";
            break;
        case "Thu":
            return "Kamis";
            break;
        case "Fri":
            return "Jum'at";
            break;
        case "Sat":
            return "Sabtu";
            break;
        case "Sun":
            return "Minggu";
            break;
        default:
            break;
    }
}

function codeToMessage($code) {
    //ref: http://php.net/manual/en/features.file-upload.errors.php
    switch ($code) {
        case UPLOAD_ERR_INI_SIZE:
            $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
            break;
        case UPLOAD_ERR_PARTIAL:
            $message = "The uploaded file was only partially uploaded";
            break;
        case UPLOAD_ERR_NO_FILE:
            $message = "No file was uploaded";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $message = "Missing a temporary folder";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $message = "Failed to write file to disk";
            break;
        case UPLOAD_ERR_EXTENSION:
            $message = "File upload stopped by extension";
            break;

        default:
            $message = "Unknown upload error";
            break;
    }
    return $message;
}

?>
