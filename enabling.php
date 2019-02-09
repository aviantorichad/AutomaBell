<?php
	if(!isset($_SESSION)){session_start();}
	if(empty($_SESSION['usernamebell'])) {
		echo "<meta http-equiv='refresh' content='0; url=index.php?l=settings' />";
		return false;
	} 
	$usernameku = $_SESSION['usernamebell'];
?>
<?php
require_once "koneksi.php";
if(!empty($_REQUEST['stat'])){
	if($_REQUEST['stat'] == 1 || $_REQUEST['stat'] == 9){
		$status = $_REQUEST['stat'];
		$query = $server->query("UPDATE status SET status = $status") or die("gagal query [".mysqli_error($server)."] <a href='javascript:history.back()'>back</a>");
		if($query){
			header("location:index.php?l=home#suksesupdatestatus");
		} else {
			header("location:index.php?l=home#gagal3");
		}
	} else {
		header("location:index.php?l=home#gagal2");
	}
} else {
	header("location:index.php?l=home#gagal1");
}
?>