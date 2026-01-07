<?php
include("sambungan.php");
include("pengundi_menu.php");

echo "<link rel='stylesheet' href='button.css'>";
echo "<main>";

$sql = "SELECT * FROM calon";
$result = mysqli_query($sambungan, $sql);

// Fetch all calon into an array
$calon_list = [];
while ($row = mysqli_fetch_array($result)) {
    if ($row['idcalon'] != 'C00') {
        $calon_list[] = $row;
    }
}

if (isset($_SESSION["idpengguna"])) {

    $idpengundi = $_SESSION["idpengguna"];

    // 🔍 检查是否已经投票
    $sql_semak = "
        SELECT pengundi.idpengundi, calon.namacalon, pengundi.idcalon
        FROM pengundi
        JOIN calon ON pengundi.idcalon = calon.idcalon
        WHERE pengundi.idpengundi = '$idpengundi'
        AND pengundi.idcalon != 'C00'
    ";
    $result_semak = mysqli_query($sambungan, $sql_semak);

    if ($undian = mysqli_fetch_array($result_semak)) {
        // 已投票
        $namacalon = $undian['namacalon'];
        echo "<p class='info'>Anda telah mengundi calon: <b>$namacalon</b></p>";
    } else {
        // 未投票, show candidates
        echo "<div class='gambar'>";
        foreach ($calon_list as $calon) {
            echo "
            <figure>
                <img class='home' src='imej/{$calon['gambar']}'>
                <figcaption>
                    <input type='radio' name='idcalon' value='{$calon['idcalon']}' required>
                    <br>{$calon['namacalon']}
                </figcaption>
            </figure>
            ";
        }
        echo "</div>";

        // Submit button
        echo "<button id='undiButton' class='button' onclick='undiCalon()'>Undi</button>";
    }
}

echo "</main>";
?>

<script>
function undiCalon() {
    // Get selected candidate
    let selected = document.querySelector('input[name="idcalon"]:checked');
    if (!selected) {
        alert("Sila pilih calon sebelum mengundi!");
        return;
    }

    let idcalon = selected.value;

    // Send via AJAX to PHP to update the database
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "pengundi_undi_ajax.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (this.status == 200) {
            alert(this.responseText); // show success or error
            window.location.reload(); // refresh page to show voted status
        }
    };
    xhr.send("idcalon=" + idcalon);
}
</script>

