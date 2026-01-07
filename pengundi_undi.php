<?php
include("sambungan.php");
session_start(); // Make sure session is started

if (isset($_POST["submit"])) {

    // Get idpengundi from session instead of POST
    if (!isset($_SESSION["idpengguna"])) {
        echo "<script>alert('Sila log masuk dahulu!'); window.location='login.php';</script>";
        exit();
    }

    $idpengundi = $_SESSION["idpengguna"];
    $idcalon = $_POST["idcalon"];
    $sudah_undi = false;

    // Check if the user has already voted
    $sql = "SELECT * FROM pengundi WHERE idpengundi = '$idpengundi'";
    $result = mysqli_query($sambungan, $sql);
    $pengundi = mysqli_fetch_array($result);

    if ($pengundi['idcalon'] != 'C00') {
        $sudah_undi = true;
    }

    if (!$sudah_undi) {
        // Update the chosen candidate
        $sql_update = "UPDATE pengundi SET idcalon = '$idcalon' WHERE idpengundi = '$idpengundi'";
        $result_update = mysqli_query($sambungan, $sql_update);

        if ($result_update) {
            echo "<script>alert('Berjaya Mengundi Calon'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Ralat: ".mysqli_error($sambungan)."'); window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('Maaf! Anda sudah mengundi'); window.location='index.php';</script>";
    }
}
?>
