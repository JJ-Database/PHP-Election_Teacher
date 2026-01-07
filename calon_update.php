<?php
include("sambungan.php");
include("admin_menu.php");

if (isset($_POST["submit"])) {

    $idcalon   = $_POST["idcalon"];
    $namacalon = $_POST["namacalon"];
    $harga     = $_POST["harga"];

    $namafail  = $idcalon . ".png";
    $sementara = $_FILES["namafail"]["tmp_name"];

    if (!empty($sementara)) {
        move_uploaded_file($sementara, "imej/" . basename($namafail));
    }

    $sql = "UPDATE calon 
            SET namacalon = '$namacalon', 
                gambar = '$namafail', 
                harga = '$harga' 
            WHERE idcalon = '$idcalon'";

    $result = mysqli_query($sambungan, $sql);

    if ($result == true)
        echo "<h4>Berjaya kemaskini</h4>";
    else
        echo "<h4>Ralat: $sql<br>" . mysqli_error($sambungan) . "</h4>";
}

/* idcalon dari fail calon_senarai.php */
if (isset($_GET["idcalon"])) {

    $idcalon = $_GET["idcalon"];

    $sql = "SELECT * FROM calon WHERE idcalon = '$idcalon'";
    $result = mysqli_query($sambungan, $sql);

    while ($calon = mysqli_fetch_array($result)) {
        $namacalon = $calon["namacalon"];
        $harga     = $calon["harga"];
        $namafail  = $calon["gambar"];
    }
}
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3>KEMASKINI CALON</h3>

<form action="calon_update.php" method="post" enctype="multipart/form-data">
<table>

<tr>
    <td>ID Calon</td>
    <td><input type="text" name="idcalon" value="<?php echo $idcalon; ?>" readonly></td>
</tr>

<tr>
    <td>Nama Calon</td>
    <td><input type="text" name="namacalon" value="<?php echo $namacalon; ?>"></td>
</tr>

<tr>
    <td>Gambar 350x320</td>
    <td>
        <input type="file" name="namafail" accept=".png,.jpg">
        <br>
        <img width="100" src="imej/<?php echo $namafail; ?>">
    </td>
</tr>

<tr>
    <td>Moto</td>
    <td><input type="text" name="harga" value="<?php echo $harga; ?>"></td>
</tr>

</table>

<button class="update" type="submit" name="submit">Update</button>
</form>
