<?php
// fail admin_update.php perlu dipanggil dari fail admin_senarai.php

include("sambungan.php");
include("admin_menu.php");

// 如果表单已提交
if (isset($_POST["submit"])) {
    $idadmin   = $_POST["idadmin"];
    $namaadmin = $_POST["namaadmin"];
    $password  = $_POST["password"];

    $sql = "UPDATE admin SET namaadmin = '$namaadmin', password = '$password' WHERE idadmin = '$idadmin'";
    $result = mysqli_query($sambungan, $sql);

    if ($result) {
        echo "<h4>Berjaya kemaskini</h4>";
    } else {
        echo "<h4>Ralat: $sql<br>" . mysqli_error($sambungan) . "</h4>";
    }
}

// 如果通过 GET 取得 idadmin，显示原本资料
if (isset($_GET['idadmin'])) {
    $idadmin = $_GET['idadmin'];

    $sql = "SELECT * FROM admin WHERE idadmin = '$idadmin'";
    $result = mysqli_query($sambungan, $sql);

    if ($admin = mysqli_fetch_array($result)) {
        $password  = $admin['password'];
        $namaadmin = $admin['namaadmin'];
    }
}
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3>KEMASKINI ADMIN</h3>

<form action="admin_update.php" method="post">
    <table>
        <tr>
            <td>ID Admin</td>
            <td><input type="text" name="idadmin" value="<?php echo $idadmin; ?>" readonly></td>
        </tr>
        <tr>
            <td>Nama Admin</td>
            <td><input type="text" name="namaadmin" value="<?php echo $namaadmin; ?>" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" value="<?php echo $password; ?>" required></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <button class="update" type="submit" name="submit">Update</button>
            </td>
        </tr>
    </table>
</form>
