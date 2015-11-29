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
if(!empty($_FILES['file']['tmp_name'])){// && !empty($_POST['uname'])){
	$folder = "./mp3/";
	//$unama = addslashes($_POST['uname']);
	$nama = basename($_FILES['file']['name']);
	$jenis 	= $_FILES['file']['type'];
	$size 	= $_FILES["file"]["size"];
	if($jenis == "audio/mpeg" || $jenis == "audio/mp3" || $jenis == "video/mp4"){ //.fitur tersembunyi yang memungkinkan untuk mengupload file berformat mp4
		$file = $folder.basename($_FILES['file']['name']);
		if(file_exists($file)){
			header("location:index.php?l=s_audio&w=6#filesudahada");
			return;
		}
		if(move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
			$nama = addslashes($nama);
			$qsave = mysql_query("INSERT INTO audio(`nama`,`file`) VALUES('aviantorichad','$nama')") or die("gagal query [".mysql_error()."] <a href='javascript:history.back()'>back</a>");
			if($qsave) {
				//echo "sukses upload $nama. | <a href='index.php?l=s_audio'>back</a>";
				header("location:index.php?l=s_audio&w=1#sukses");
			} else {
				header("location:index.php?l=s_audio&w=2#gagalquery");
			}
		} else {
			header("location:index.php?l=s_audio&w=3#gagalupload");
		}
	} else {
		header("location:index.php?l=s_audio&w=4#filetidaksah");
	}
} else {
		header("location:index.php?l=s_audio&w=5#fieldbelumbenar");
}
?>