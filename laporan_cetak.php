<?php
include("sambungan.php");
include("admin_menu.php");
?>

<link rel="stylesheet" href="senarai.css">
<link rel="stylesheet" href="button.css">

<main>
<div id="printarea">

<?php
if (isset($_POST['submit'])) {

    $pilih = $_POST['pilih'];

    /* ================= SQL ASAS ================= */
    $sql = "
    SELECT calon.idcalon, calon.namacalon,
           COUNT(pengundi.idcalon) AS jum_ikut_calon
    FROM calon
    LEFT JOIN pengundi ON calon.idcalon = pengundi.idcalon
    WHERE calon.idcalon != 'C00'
    GROUP BY calon.idcalon
    ORDER BY jum_ikut_calon DESC
    ";

    $result = mysqli_query($sambungan, $sql);

    /* ==================================================
       PILIHAN 1 : JUMLAH UNDI
    ================================================== */
    if ($pilih == 1) {

        echo "<table>
        <caption>
            <img src='imej/tajuk.png' width='400'><br>
            SENARAI CALON MENGIKUT JUMLAH UNDI
        </caption>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jumlah Undi</th>
        </tr>";

        while ($undian = mysqli_fetch_array($result)) {
            echo "<tr>
                <td>{$undian['idcalon']}</td>
                <td>{$undian['namacalon']}</td>
                <td>{$undian['jum_ikut_calon']}</td>
            </tr>";
        }

        echo "</table>";
    }

    /* ==================================================
       PILIHAN 2 : PERATUS UNDI
    ================================================== */
    if ($pilih == 2) {

        // jumlah semua undi (tidak termasuk C00)
        $sql_undi = "SELECT COUNT(*) AS jumlah FROM pengundi WHERE idcalon != 'C00'";
        $data_undi = mysqli_fetch_array(mysqli_query($sambungan, $sql_undi));
        $jum_semua_undi = $data_undi['jumlah'];

        echo "<table>
        <caption>
            <img src='imej/tajuk.png' width='400'><br>
            SENARAI CALON MENGIKUT PERATUS UNDI
        </caption>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Carta</th>
            <th>Peratus</th>
        </tr>";

        mysqli_data_seek($result, 0); // ulang result set

        while ($undian = mysqli_fetch_array($result)) {

            $peratus = ($jum_semua_undi > 0)
                ? number_format(($undian['jum_ikut_calon'] / $jum_semua_undi) * 100, 1)
                : 0;

            echo "<tr>
                <td>{$undian['idcalon']}</td>
                <td>{$undian['namacalon']}</td>
                <td><progress value='$peratus' max='100'></progress></td>
                <td>$peratus%</td>
            </tr>";
        }

        echo "</table>";
    }
}
?>

</div>

<center>
    <button class="cetak" onclick="printPageArea()">Cetak</button>
</center>
</main>

<script>
function printPageArea() {
    var printContent = document.getElementById("printarea").innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
}
</script>
