<?php
include("sambungan.php");
include("admin_menu.php");

if (isset($_POST["submit"])) {

    $idcalon    = $_POST["idcalon"];
    $namacalon  = $_POST["namacalon"];
    $moto       = $_POST["moto"];
    $idadmin    = $_POST["idadmin"];

    // 上传文件
    $namafail = $idcalon . ".png"; // 保存文件名
    $sementara = $_FILES["namafail"]["tmp_name"];

    if (move_uploaded_file($sementara, "Imej/" . basename($namafail))) {

        // 插入数据库
        $sql = "INSERT INTO calon VALUES('$idcalon', '$namacalon', '$namafail', '$moto', '$idadmin')";
        $result = mysqli_query($sambungan, $sql);

        if ($result) {
            echo "<h4>Berjaya tambah</h4>";
        } else {
            echo "<h4>Ralat: $sql<br>" . mysqli_error($sambungan) . "</h4>";
        }

    } else {
        echo "<h4>Gagal memuat naik fail</h4>";
    }
}
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3>BORANG TAMBAH CALON</h3>

<form action="calon_insert.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>ID Calon</td>
            <td><input required type="text" name="idcalon"></td>
        </tr>
        <tr>
            <td>Nama Calon</td>
            <td><input type="text" name="namacalon"></td>
        </tr>
        <tr>
            <td>Gambar 350x320</td>
            <td><input type="file" name="namafail" accept=".png,.jpg" required></td>
        </tr>
        <tr>
            <td>Moto</td>
            <td><input type="text" name="moto"></td>
        </tr>
        <tr>
            <td>Admin</td>
            <td>
                <select name="idadmin" required>
                    <?php
                    $sql = "SELECT * FROM admin";
                    $data = mysqli_query($sambungan, $sql);

                    while ($admin = mysqli_fetch_array($data)) {
                        echo "<option value='{$admin['idadmin']}'>{$admin['namaadmin']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>

    <button class="tambah" type="submit" name="submit">Tambah</button>
</form>
