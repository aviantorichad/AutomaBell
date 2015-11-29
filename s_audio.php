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
$msg = "";
if(!empty($_REQUEST['w'])){
	switch((int)$_REQUEST['w']){
		//.upload
		case "1": //.sukses upload
			$msg = "<span style='padding:5px;margin-left:5px;background:lightgreen;color:green;border:1px dashed green;box-shadow:0 0 1px green;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>File berhasil diunggah.</span>";
			break;
		case "2": //.gagal query
			$msg = "<span style='padding:5px;margin-left:5px;background:lightyellow;color:maroon;border:1px dashed orange;box-shadow:0 0 1px orange;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>File berhasil diunggah, tetapi gagal query ke db.</span>";
			break;
		case "3": //.gagal upload
			$msg = "<span style='padding:5px;margin-left:5px;background:pink;color:maroon;border:1px dashed maroon;box-shadow:0 0 1px maroon;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>Gagal mengunggah file.</span>";
			break;
		case "4": //.file tidak sah
			$msg = "<span style='padding:5px;margin-left:5px;background:pink;color:maroon;border:1px dashed maroon;box-shadow:0 0 1px maroon;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>File tidak sah.</span>";
			break;
		case "5": //.field belum benar
			$msg = "<span style='padding:5px;margin-left:5px;background:pink;color:maroon;border:1px dashed maroon;box-shadow:0 0 1px maroon;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>Field belum benar atau masih kosong.</span>";
			break;
		case "6": //.file sudah ada
			$msg = "<span style='padding:5px;margin-left:5px;background:lightyellow;color:maroon;border:1px dashed orange;box-shadow:0 0 1px orange;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>File sudah ada.</span>";
			break;
		//.delete
		case "20": //.sukses menghapus
			$msg = "<span style='padding:5px;margin-left:5px;background:lightgreen;color:green;border:1px dashed green;box-shadow:0 0 1px green;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>File berhasil dihapus.</span>";
			break;
		case "21": //.gagal menghapus
			$msg = "<span style='padding:5px;margin-left:5px;background:pink;color:maroon;border:1px dashed maroon;box-shadow:0 0 1px maroon;'><img src='img/bg-icon.png' style='background-image: url(\"img/glyphicons-halflings.png\");background-position:0px -120px;background-repeat: no-repeat;margin-right:5px;' title='info' alt='info'/>Gagal menghapus file.</span>";
			break;
		default:
			$msg = "";
			break;
	}
}
echo "<div><h2>Unggah Mp3 $msg</h2></div>";
echo "<form method='POST' name='upload_mp3' action='uploading.php' enctype='multipart/form-data'>";
echo "<div><input type='file' name='file' required /><input type='submit' name='submit' value='Unggah' /></div>";
//echo "<div>Nama : <input type='text' name='uname' value /></div>";
echo "</form>";
?>


<table cellspacing="0">
	<tr class="header">
		<td width="30px">No</td>
		<td width="25px">ID</td>
		<td>Audio</td>
		<td width="135px">Diperbarui</td>
		<td width="25px">*</td>
	</tr>
	<?php
	$no = 1;
	$qtab = mysql_query("SELECT * FROM audio ORDER by updated DESC") or die("gagal query [".mysql_error()."] <a href='javascript:history.back()'>back</a>");
	while($rtab = mysql_fetch_array($qtab)){
		$res_id = $rtab['id'];
		$res_fl = $rtab['file'];
		$res_wk = $rtab['updated'];
		$res_wk = date_format(date_create($res_wk), "d-M-Y (H:i:s)");
		$warna = ($no%2==1)?"#ffffff":"#f0f0f0";
	?>
	<tr bgcolor="<?php echo $warna; ?>">
		<td><?php echo $no; ?></td>
		<td><?php echo $res_id; ?></td>
		<td><?php echo $res_fl; ?></td>
		<td><?php echo $res_wk; ?></td>
		<td align="middle"><a href="deleting.php?i=<?php echo $res_id; ?>" <?php echo "onclick=\"cek=confirm('Anda yakin ingin menghapus file ini?\\nPastikan file yang akan anda hapus sedang tidak dipakai untuk jadwal.');if(cek){return true;}else{return false;}\"" ?> title="Hapus"><img src="img/bg-icon.png" style="background-image: url('img/glyphicons-halflings.png');background-position:-312px 0px;background-repeat: no-repeat;" title="hapus" alt="hapus"/></a></td>
	</tr>
	<?php 
	$no++;
	} 
	?>
</table>