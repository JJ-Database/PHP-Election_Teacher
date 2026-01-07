<?php
include("sambungan.php");
include("admin_menu.php");

$berjaya = false;

if (isset($_POST["submit"])) {

    $namajadual = strtolower($_POST["namajadual"]);

    // 上传文件
    $namafail   = $_FILES["namafail"]["name"];
    $sementara  = $_FILES["namafail"]["tmp_name"];

    move_uploaded_file($sementara, $namafail);

    $fail = fopen($namafail, "r");

    while (!feof($fail)) {

        $baris = fgets($fail);
        if ($baris == "") continue;

        $medan = explode(",", trim($baris));

        /* ================= PENGUNDI ================= */
        if ($namajadual == "pengundi") {

            $idpengundi   = $medan[0];
            $password     = $medan[1];
            $namapengundi = $medan[2];
            $idcalon      = $medan[3];

            $sql = "INSERT INTO pengundi 
                    VALUES ('$idpengundi', '$password', '$namapengundi', '$idcalon')";

            if (mysqli_query($sambungan, $sql)) {
                $berjaya = true;
            } else {
                echo "<br><center>Ralat: $sql<br>".mysqli_error($sambungan)."</center>";
            }
        }

        /* ================= ADMIN ================= */
        if ($namajadual == "admin") {

            $idadmin   = $medan[0];
            $password  = $medan[1];
            $namaadmin = $medan[2];

            $sql = "INSERT INTO admin 
                    VALUES ('$idadmin', '$password', '$namaadmin')";

            if (mysqli_query($sambungan, $sql)) {
                $berjaya = true;
            } else {
                echo "<br><center>Ralat: $sql<br>".mysqli_error($sambungan)."</center>";
            }
        }
    }

    fclose($fail);

    if ($berjaya)
        echo "<script>alert('Rekod berjaya diimport');</script>";
    else
        echo "<script>alert('Rekod tidak berjaya diimport');</script>";

    mysqli_close($sambungan);
}
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3>IMPORT DATA</h3>

<form action="import.php" method="post" enctype="multipart/form-data">
<table>
<tr>
    <td>Jadual</td>
    <td>
        <select name="namajadual" required>
            <option value="pengundi">Pengundi</option>
            <option value="admin">Admin</option>
        </select>
    </td>
</tr>

<tr>
    <td>Nama Fail</td>
    <td>
        <input type="file" name="namafail" accept=".txt,.csv" required>
    </td>
</tr>
</table>

<button class="import" type="submit" name="submit">Import</button>
</form>

