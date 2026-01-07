<?php
include("sambungan.php"); 
include("admin_menu.php");

if (isset($_POST["submit"])) {

    $idpengundi   = $_POST["idpengundi"];
    $password     = $_POST["password"];
    $namapengundi = $_POST["namapengundi"];

    $sql = "
        UPDATE pengundi 
        SET password = '$password',
            namapengundi = '$namapengundi'
        WHERE idpengundi = '$idpengundi'
    ";

    $result = mysqli_query($sambungan, $sql);

    if ($result == true)
        echo "<h4>Berjaya kemaskini</h4>";
    else
        echo "<h4>Ralat: $sql<br>" . mysqli_error($sambungan) . "</h4>";
}

/* =======================
   GET DATA BY ID
   ======================= */
if (isset($_GET["idpengundi"])) {

    $idpengundi = $_GET["idpengundi"];

    $sql = "SELECT * FROM pengundi WHERE idpengundi = '$idpengundi'";
    $result = mysqli_query($sambungan, $sql);

    if ($pengundi = mysqli_fetch_array($result)) {
        $namapengundi = $pengundi["namapengundi"];
        $password     = $pengundi["password"];
    }
}
?>

<link rel="stylesheet" href="borang.css">
<link rel="stylesheet" href="button.css">

<h3>KEMASKINI PENGUNDI</h3>

<form action="pengundi_update.php" method="post">
<table>

<tr>
    <td>ID Pengundi</td>
    <td>
        <input type="text" name="idpengundi" 
               value="<?php echo $idpengundi; ?>" readonly>
    </td>
</tr>

<tr>
    <td>Nama Pengundi</td>
    <td>
        <input type="text" name="namapengundi" 
               value="<?php echo $namapengundi; ?>" required>
    </td>
</tr>

<tr>
    <td>Password</td>
    <td>
        <input type="text" name="password" 
               value="<?php echo $password; ?>" required>
    </td>
</tr>

</table>

<button class="update" type="submit" name="submit">Update</button>
</form>
