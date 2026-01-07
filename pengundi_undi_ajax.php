<?php
include("sambungan.php");
session_start();

if (!isset($_SESSION["idpengguna"])) {
    echo "Sila log masuk dahulu!";
    exit();
}

$idpengundi = $_SESSION["idpengguna"];

if (isset($_POST["idcalon"])) {
    $idcalon = $_POST["idcalon"];

    // Check if already voted
    $sql = "SELECT idcalon FROM pengundi WHERE idpengundi = '$idpengundi'";
    $result = mysqli_query($sambungan, $sql);
    $pengundi = mysqli_fetch_array($result);

    if ($pengundi['idcalon'] != 'C00') {
        echo "Maaf! Anda sudah mengundi";
    } else {
        // Update vote
        $sql_update = "UPDATE pengundi SET idcalon = '$idcalon' WHERE idpengundi = '$idpengundi'";
        if (mysqli_query($sambungan, $sql_update)) {
            echo "Berjaya mengundi calon!";
        } else {
            echo "Ralat: " . mysqli_error($sambungan);
        }
    }
}
?>
