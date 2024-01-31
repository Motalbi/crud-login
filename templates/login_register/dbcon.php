<?php

// Database-gegevens
$hostName = "localhost";   // Naam van de database-server (bijv. localhost)
$dbUser = "root";          // Gebruikersnaam voor de database-verbinding
$dbPassword = "";          // Wachtwoord voor de database-verbinding
$dbName = "students";      // Naam van de database

// Probeer een database-verbinding tot stand te brengen
try {
    // Maak een nieuw PDO-object (PHP Data Objects) voor de database-verbinding
    $conn = new PDO("mysql:host=$hostName;dbname=$dbName", $dbUser, $dbPassword);

    // Stel PDO in om fouten te tonen als uitzonderingen (exceptions)
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Succesvolle verbinding (optioneel bericht)
    // echo "Connected successfully"; 
} catch (PDOException $e) {
    // Als er een fout optreedt tijdens de verbinding, toon dan een foutbericht
    die("Connection failed: " . $e->getMessage());
}
?>


