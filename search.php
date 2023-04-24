<?php

// Verbinding maken met de database
$conn = mysqli_connect('localhost', 'gebruikersnaam', 'wachtwoord', 'databasenaam');

// Controleren of er verbinding is gemaakt
if (!$conn) {
    die("Verbinding met de database is mislukt: " . mysqli_connect_error());
}

// Zoekterm uit formulier halen en valideren
if(isset($_POST['zoekterm']) && !empty(trim($_POST['zoekterm']))){
    $zoekterm = trim($_POST['zoekterm']);

    // Controleren op mogelijke kwaadaardige invoer en voorkomen van SQL-injecties
    $zoekterm = mysqli_real_escape_string($conn, htmlspecialchars($zoekterm));

    // Query voorbereiden en uitvoeren
    $query = "SELECT * FROM producten WHERE naam LIKE ?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "s", $param_zoekterm);
    $param_zoekterm = "%$zoekterm%";

    mysqli_stmt_execute($stmt);

    $resultaat = mysqli_stmt_get_result($stmt);

    // Controleren of er resultaten zijn gevonden
    if (mysqli_num_rows($resultaat) > 0) {
        // Resultaten weergeven
        while ($row = mysqli_fetch_assoc($resultaat)) {
            echo "Naam: " . $row["naam"]. " - Prijs: " . $row["prijs"]. "<br>";
        }
    } else {
        echo "Geen resultaten gevonden.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Geen zoekterm ingevoerd.";
}

// Verbinding sluiten
mysqli_close($conn);

?>
