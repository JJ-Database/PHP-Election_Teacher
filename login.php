<?php
include("sambungan.php");
include("pengundi_menu.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 处理表单提交
if (isset($_POST["submit"])) {

    $userid   = $_POST["userid"];
    $password = $_POST["password"];

    $jumpa = false; // 标记是否找到用户

    // 检查 pengundi
    $sql = "SELECT * FROM pengundi";
    $result = mysqli_query($sambungan, $sql);

    while ($pengundi = mysqli_fetch_array($result)) {
        if ($pengundi["idpengundi"] == $userid && $pengundi["password"] == $password) {
            $_SESSION["idpengguna"] = $pengundi["idpengundi"];
            $_SESSION["nama"]       = $pengundi["namapengundi"];
            $_SESSION["status"]     = "pengundi";
            $jumpa = true;
            
             echo "
        <script>
            localStorage.setItem('idpengundi', '{$pengundi["idpengundi"]}');
            window.location = 'Index.php';
        </script>
        ";
            break;
        }
    }

    // 如果 pengundi 不存在，则检查 admin
    if (!$jumpa) {
        $sql = "SELECT * FROM admin";
        $result = mysqli_query($sambungan, $sql);

        while ($admin = mysqli_fetch_array($result)) {
            if ($admin["idadmin"] == $userid && $admin["password"] == $password) {
                $_SESSION["idpengguna"] = $admin["idadmin"];
                $_SESSION["nama"]       = $admin["namaadmin"];
                $_SESSION["status"]     = "admin";
                $jumpa = true;
                break;
            }
        }
    }

    // 登录成功跳转
    if ($jumpa) {
        if ($_SESSION["status"] == "pengundi") {
            header("Location: Index.php");
            exit();
        } elseif ($_SESSION["status"] == "admin") {
            header("Location: calon_senarai.php");
            exit();
        }
    } else {
        echo "<script>alert('Kesalahan pada username atau password');</script>";
    }
}
?>

<link rel="stylesheet" href="button.css">
<link rel="stylesheet" href="borang.css">

<h3>LOG MASUK</h3>

<form action="login.php" method="post">
    <table>
        <tr>
            <td>ID Pengguna</td>
            <td><input type="text" name="userid" placeholder="idpengguna" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" placeholder="password" required></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <button class="login" type="submit" name="submit">Log Masuk</button>
                <button class="tambah" type="button" onclick="window.location='signup.php'">Daftar</button>
            </td>
        </tr>
    </table>
    <br>
    Belum ada idpengguna? Klik Daftar
</form>
