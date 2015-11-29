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
if(!empty($_REQUEST['i'])){
	$id = (int)$_REQUEST['i'];
	$qdel = mysql_query("DELETE FROM resume WHERE id = '$id'") or die("gagal query [".mysql_error()."] <a href='javascript:history.back()'>back</a>");
	if($qdel){
		header("location:index.php?l=settings&w=20#deleted");
	} else {
		header("location:index.php?l=settings&w=21#notdeleted");
	}
}
?>