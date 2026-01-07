<?php
include("sambungan.php");
include("admin_menu.php");
?>

<link rel="stylesheet" href="senarai.css">
<link rel="stylesheet" href="button.css">

<table>
    <caption>SENARAI NAMA CALON</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Gambar</th>
        <th>Moto</th>
        <th colspan="2">Tindakan</th>
    </tr>

    <?php
    $sql = "SELECT * FROM calon";
    $result = mysqli_query($sambungan, $sql);

    while ($calon = mysqli_fetch_array($result)) {
        $idcalon = $calon["idcalon"];
        echo "<tr>
                <td>{$calon['idcalon']}</td>
                <td>{$calon['namacalon']}</td>
                <td><img width='100' src='imej/{$calon['gambar']}' alt='Gambar Calon'></td>
                <td>{$calon['harga']}</td>
                <td>
                    <a href='calon_update.php?idcalon={$idcalon}' title='Update'>
                        <img src='imej/refresh.png' alt='Update'>
                    </a>
                </td>
                <td>
                    <a href='javascript:padam(\"{$idcalon}\");' title='Delete'>
                        <img src='imej/delete.png' alt='Delete'>
                    </a>
                </td>
              </tr>";
    }
    ?>
</table>

<script>
function padam(id) {
    if (confirm("Adakah anda ingin padam?")) {
        window.location = "calon_delete.php?idcalon=" + id;
    }
}
</script>
