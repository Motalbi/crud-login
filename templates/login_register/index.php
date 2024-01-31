<?php
// Start de PHP-sessie om gebruikersinformatie bij te houden
session_start();

// Controleer of de gebruiker is ingelogd, anders stuur ze naar het inlogscherm
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit(); // Zorg ervoor dat het script stopt na het omleiden
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>
</head>

<body>
    <!-- Hoofdcontainer voor de pagina-inhoud -->
    <div class="container">
        <!-- Grote kop voor het welkomstbericht -->
        <h1>Welcome to Dashboard</h1>

        <!-- Uitloglink met Bootstrap-opmaak -->
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
</body>

</html>
