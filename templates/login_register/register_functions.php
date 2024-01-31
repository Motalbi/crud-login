<?php

// Valideert registratiegegevens en retourneert een array met fouten (indien aanwezig)
function validateRegistration($fullName, $email, $password, $passwordRepeat)
{
    $errors = array();

    // Controleert of alle velden zijn ingevuld
    if (empty($fullName) or empty($email) or empty($password) or empty($passwordRepeat)) {
        array_push($errors, "All fields are required");
    }

    // Controleert of het e-mailadres een geldig formaat heeft
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }

    // Controleert of het wachtwoord minimaal 8 tekens lang is
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }

    // Controleert of de wachtwoorden overeenkomen
    if ($password !== $passwordRepeat) {
        array_push($errors, "Password does not match");
    }

    return $errors;
}

// Controleert of een e-mailadres al bestaat in de database
function checkExistingEmail($conn, $email)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Retourneert true als het e-mailadres al bestaat, anders false
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        // Retourneert een foutbericht als er een databasefout optreedt
        return "Error: " . $e->getMessage();
    }
}

// Registreert een nieuwe gebruiker in de database
function registerUser($conn, $fullName, $email, $passwordHash)
{
    try {
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $fullName);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $passwordHash);
        $stmt->execute();

        // Retourneert een succesbericht als de registratie succesvol is
        return "You are registered successfully.";
    } catch (PDOException $e) {
        // Retourneert een foutbericht als er een databasefout optreedt
        return "Error: " . $e->getMessage();
    }
}
?>
