<?php
/* Program ini bertujuan untuk memasukkan admin yang baru
   Pastikan idadmin tidak sama semasa memasukkan data */

include("sambungan.php");
include("admin_menu.php");

if (isset($_POST["submit"])) {

    // 修正 $_POST 拼写错误
    $idadmin = $_POST["idadmin"];
    $password = $_POST["password"];
    $namaadmin = $_POST["namaadmin"];

    $sql = "INSERT INTO admin VALUES('$idadmin', '$password', '$namaadmin')";
    $result = mysqli_query($sambungan, $sql);

    if ($result) {
        echo "<h4>Berjaya tambah</h4>";
    } else {
        echo "<h4>Ralat: $sql<br>" . mysqli_error($sambungan) . "</h4>";
    }
}
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3>BORANG TAMBAH ADMIN</h3>

<form action="admin_insert.php" method="post">
    <table>
        <tr>
            <td>ID Admin</td>
            <td><input required type="text" name="idadmin"></td>
        </tr>
        <tr>
            <td>Nama Admin</td>
            <td><input type="text" name="namaadmin"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" placeholder="max: 8 char"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <button class="tambah" type="submit" name="submit">Tambah</button>
            </td>
        </tr>
    </table>
</form>
