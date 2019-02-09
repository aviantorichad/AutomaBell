<!DOCTYPE html>
<head>
    <link rel="shortcut icon" type="x-icon" href="img/bell.png" />
    <title>Play Now - automaBELL</title>
    <style>
        body{background:#222;color:#777;}

    </style>
</head>
<body>
    <?php
    if (!empty($_REQUEST['s'])) {
        $s = $_REQUEST['s'];
    } else {
        echo "invalid operation!";
        return;
    }
    require_once "koneksi.php";
    $s = (int) $s;
    $query = $server->query("SELECT * FROM audio WHERE id='$s'") or die("gagal query [" . mysqli_error($server) . "] <a href='javascript:history.back()'>back</a>");
    $row = $query->fetch_array();
    $audio = $row['file'];
    if (!$audio) {
        echo "invalid selection!";
        return;
    }
//$audio = "clang.wav";
    /*
      if(!empty($row[$s])) {
      $audio = $row[$s];
      } else {
      echo "invalid selection!";
      return;
      }
     */
//$ending_time = strtotime("+ 2 minutes");
    /*
      echo $ending_time;
      echo "<br/>";
      echo strtotime("now");

      echo "<br/>";

     */
    ?>

    <h2 style="position:absolute;top:0;left:0;text-align:center;font-family:arial;text-align:center;width:100%;color:#777;font-size:18px;"><?php echo $audio; ?></h2>
    <object height=100%; data="<?php echo "mp3/" . $audio; ?>" style="position:absolute;bottom:0;left:0;width:100%;text-align:center;display:block;;"></object>
</body>
<!--
--- automaBELL V.1, cd:20140301, cn:#flappyBELL
--- created date : 01-Mar-2014
--- revision to mysqli : 09-Feb-2019
--- author : Richad Avianto
--- email : aviantorich@gmail.com
--- blog : aviantorichad.blogspot.com
--- website : warungkost.com
--- Note : Gunakan dengan bijak aplikasi ini, 
--- silahkan memodifikasi sesuai kebutuhan anda dengan tidak mengubah pembuat awal aplikasi ini, 
--- jika anda mengalami kesulitan silahkan kontak email saya 
--- atau anda bisa menghubungi saya pada kontak yang sudah saya sediakan
--- untuk kondisi yang memungkinkan penghapusan nama saya silahkan meminta ijin saya terlebih dahulu.
-->
</html>

<?php
//echo "<audio controls><source src='".$audio."' type='audio/wav'>not support</audio>";
/*
  while(strtotime("now") < $ending_time){
  //echo "<script type='text/javascript'>self.location = '".$audio."';</script>";
  }
 */
?>