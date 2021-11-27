<?php
include_once("koneksi.php");

$id_user = $_POST['id_user'];
$nohp = $_POST['nohp'];
$pass = ($_POST['password']);

$sql = "SELECT * FROM users WHERE id_user='$id_user' AND nohp='$nohp'AND password='$pass'";
session_start();
if ($_POST["captcha_code"] == $_SESSION["captcha_code"]){
    $login = mysqli_query($con, $sql);
    $ketemu = mysqli_num_rows($login);
    $r = mysqli_fetch_array($login);

    if ($ketemu > 0) {
        $_SESSION['iduser'] = $r['id_user'];
        $_SESSION['nohp'] = $r['nohp'];
        $_SESSION['passuser'] = $r['password'];
        echo "USER BERHASIL LOGIN<br>";
        echo "id user =", $_SESSION['iduser'], "<br>";
        echo "nomer hp =", $_SESSION['nohp'], "<br>";
        echo "password=", $_SESSION['passuser'], "<br>";
        echo "<a href=logout.php><b>LOGOUT</b></a></center>";
    }else {
        echo "<center>Login gagal! username, nomer hp & password tidak benar<br>";
        echo "<a href=form_login.php><b>ULANGILAGI</b></a></center>";
    }
    mysqli_close($con);
}else {
    echo "<center>Login gagal! captcha tidak benar<br>";
    echo "<a href=form_login.php><b>ULANGILAGI</b></a></center>";
}
?>