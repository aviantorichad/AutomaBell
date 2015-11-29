<?php
//error_reporting(0);
$server = mysql_connect("localhost","root","") or die("001 - no connection to server");
$db = mysql_select_db("rc_bel", $server) or die("002 - no connection to db");
$timezone = "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) { date_default_timezone_set($timezone);}; 
function getHariNm($id){
	$query = mysql_query("SELECT * FROM hari WHERE id = '$id'") or die("gagal query [".mysql_error()."] <a href='javascript:history.back()'>back</a>");
	$row = mysql_fetch_array($query);
	return $row['hari'];
}
function getAudioNm($id){
	$query = mysql_query("SELECT * FROM audio WHERE id = '$id'") or die("gagal query [".mysql_error()."] <a href='javascript:history.back()'>back</a>");
	$row = mysql_fetch_array($query);
	return $row['file'];
}
function replaceDay($hariEng){
	switch($hariEng){
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
function replaceDayToInd($hariEng){
	switch($hariEng){
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
?>
