 <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="menu.css">

<header>
    <img class="tajuk" src="imej/tajuk.png">
</header>

<nav>
    <ul>
        <li><a href="index.php"><b>RUANG UNDI</b></a></li>
    </ul>

    <ul>
        <li><a href="calon_profail.php"><b>PROFAIL</b></a></li>
    </ul>

    <ul>
        <li>
            <?php
            if (isset($_SESSION["idpengguna"]))
                echo "<a href='logout.php'><b>LOG KELUAR</b></a>";
            else
                echo "<a href='login.php'><b>LOG MASUK</b></a>";
            ?>
        </li>
    </ul>

    <?php
    if (isset($_SESSION["idpengguna"])) {

        $idpengundi = $_SESSION["idpengguna"];

        $sql = "SELECT namapengundi FROM pengundi WHERE idpengundi = '$idpengundi'";
        $result = mysqli_query($sambungan, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $pengundi = mysqli_fetch_array($result);
            echo "<h5>Selamat datang {$pengundi['namapengundi']}</h5>";
        }
    }
    ?>
</nav>
