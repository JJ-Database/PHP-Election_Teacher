<?php
include("sambungan.php");

if (isset($_GET["idcalon"])) {
    // 防止 SQL 注入
    $idcalon = mysqli_real_escape_string($sambungan, $_GET["idcalon"]);

    // 执行删除
    $sql = "DELETE FROM calon WHERE idcalon = '$idcalon'";
    $result = mysqli_query($sambungan, $sql);

    if ($result) {
        echo "<script>alert('Calon berjaya dipadam');</script>";
    } else {
        echo "<script>alert('Ralat: ".mysqli_error($sambungan)."');</script>";
    }

    // 删除后跳转回列表页面
    echo "<script>window.location='calon_senarai.php';</script>";
} else {
    // 没有传 idcalon
    echo "<script>alert('Tiada calon dipilih'); window.location='calon_senarai.php';</script>";
}
?>
