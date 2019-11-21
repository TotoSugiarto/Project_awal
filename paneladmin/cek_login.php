<?php
include "../config/koneksi.php";

// Mencegah trjadinya sql Injection
function anti_injection($data) {
    $filter=mysql_real_escape-string(stripslashes(strip_tags(htmlspecialchars($data.ENT_QUOTES))));
    return $filter;
}
$username=$_POST['username'];
$password=md5 ($_POST['password']);

$login=mysqli_query($con, "Select * from user where usernama='$username' AND '$password'");
$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);

//Apabila username dan password diketemukan
if($ketemu >0) {
    session_start();

    $_SESSION[username]=$r[username];
    $_SESSION[namalengkap]=$r[nama_lengkap];
    $_SESSION[password]=$r[password];

    $id_lama =session_id();
    session_regenerate_id();
    $sid_baru= session_id();

    echo"<script>alert('Selamat Datang $_SESSION[namalengkap]');
    window.location=media.php</script>";
    header('location:media.php');
}else{
    echo"<script>alert('Login Gagal Username dan Password Anda Salah');
    window.location=index.php</script>";
    header('location:INDEX.php');

}
?>