<?php

// Product toevoegen aan de winkelwagen
function voeg_product_toe_aan_winkelwagen($product_id, $aantal) {
    // Controleren of het product al in de winkelwagen zit
    if (isset($_SESSION['winkelwagen'][$product_id])) {
        // Product aantal bijwerken
        $_SESSION['winkelwagen'][$product_id] += $aantal;
    } else {
        // Product toevoegen aan de winkelwagen
        $_SESSION['winkelwagen'][$product_id] = $aantal;
    }
}

// Product uit de winkelwagen verwijderen
function verwijder_product_uit_winkelwagen($product_id) {
    unset($_SESSION['winkelwagen'][$product_id]);
}

// Winkelwagen weergeven
function toon_winkelwagen() {
    // Als de winkelwagen leeg is, toon dan een bericht
    if (empty($_SESSION['winkelwagen'])) {
        echo "Uw winkelwagen is leeg.";
    } else {
        // Loop door de winkelwagen array en toon de producten en aantallen
        foreach ($_SESSION['winkelwagen'] as $product_id => $aantal) {
            echo "Product ID: " . $product_id . " - Aantal: " . $aantal . "<br>";
        }
    }
}

// Winkelwagen bijwerken
function werk_winkelwagen_bij($product_id, $aantal) {
    // Controleren of het product in de winkelwagen zit
    if (isset($_SESSION['winkelwagen'][$product_id])) {
        // Als het aantal 0 is, verwijder dan het product uit de winkelwagen
        if ($aantal == 0) {
            verwijder_product_uit_winkelwagen($product_id);
        } else {
            // Product aantal bijwerken
            $_SESSION['winkelwagen'][$product_id] = $aantal;
        }
    }
}

// Start de sessie om de winkelwagen array op te slaan
session_start();

// Als de winkelwagen array nog niet bestaat, maak deze dan aan
if (!isset($_SESSION['winkelwagen'])) {
    $_SESSION['winkelwagen'] = array();
}

?>
