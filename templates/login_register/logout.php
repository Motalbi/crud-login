<?php
// Start de PHP-sessie
session_start();

// Vernietig de huidige sessie (afmelden)
session_destroy();

// Stuur de gebruiker door naar het inlogscherm
header("Location: login.php");
exit(); // Zorg ervoor dat het script stopt na het omleiden
?>
