<?php
include("sambungan.php");
include("admin_menu.php");

// 获取要删除的 admin ID
$idadmin = $_GET["idadmin"];

// 执行删除
$sql = "DELETE FROM admin WHERE idadmin = '$idadmin'";
$result = mysqli_query($sambungan, $sql);

// 删除后跳转回列表页面
echo "<script>window.location='admin_senarai.php'</script>";
?>
