<?php
// Start de PHP-sessie
session_start();

// Inclusie van het database-verbindingsscript
include('dbcon.php');

// Als het formulier wordt ingediend om een student toe te voegen
if (isset($_POST['save_student_btn'])) {
    // Haal de benodigde gegevens op uit de POST-variabelen
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    try {
        // Voorbereid SQL-query om een student toe te voegen
        $query = "INSERT INTO student (fullname, email, phone, course) VALUES (:fullname, :email, :phone, :course)";
        $statement = $conn->prepare($query);

        // Bind de parameters en voer de query uit
        $data = [
            ':fullname' => $fullname,
            ':email' => $email,
            ':phone' => $phone,
            ':course' => $course,
        ];

        $query_execute = $statement->execute($data);

        // Controleer of de query met succes is uitgevoerd en stel een sessiebericht in
        if ($query_execute) {
            $_SESSION['message'] = "Student added successfully";
        } else {
            $_SESSION['message'] = "Failed to add student";
        }

        // Redirect naar add.php
        header('Location: add.php');
        exit(0);
    } catch (PDOException $e) {
        // Vang een PDO-uitzondering op en toon de foutmelding
        echo $e->getMessage();
    }
}

// Als het formulier wordt ingediend om een student te verwijderen
if (isset($_POST['delete_student'])) {
    // Haal het studenten-ID op uit de POST-variabele
    $student_id = $_POST['delete_student'];

    try {
        // Voorbereid SQL-query om een student te verwijderen
        $query = "DELETE FROM student WHERE id=:stud_id";
        $statement = $conn->prepare($query);
        $data = [':stud_id' => $student_id];
        $query_execute = $statement->execute($data);

        // Controleer of de query met succes is uitgevoerd en stel een sessiebericht in
        if ($query_execute) {
            $_SESSION['message'] = "Student deleted";
        } else {
            $_SESSION['message'] = "Failed to delete student";
        }
    } catch (PDOException $e) {
        // Vang een PDO-uitzondering op en toon de foutmelding
        echo $e->getMessage();
    }

    // Redirect naar index.php
    header('Location: index.php');
    exit(0);
}

// Als het formulier wordt ingediend om een student bij te werken
if (isset($_POST['update_student_btn'])) {
    // Haal de benodigde gegevens op uit de POST-variabelen
    $student_id = $_POST['student_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    try {
        // Voorbereid SQL-query om een student bij te werken
        $query = "UPDATE student SET fullname = :fullname, email = :email, phone = :phone, course = :course WHERE id = :stud_id LIMIT 1";
        $statement = $conn->prepare($query);

        // Bind de parameters en voer de query uit
        $data = [
            ':fullname' => $fullname,
            ':email' => $email,
            ':phone' => $phone,
            ':course' => $course,
            ':stud_id' => $student_id
        ];

        $query_execute = $statement->execute($data);

        // Controleer of de query met succes is uitgevoerd en stel een sessiebericht in
        if ($query_execute) {
            $_SESSION['update_message'] = "Updated successfully";
        } else {
            $_SESSION['update_message'] = "Failed to update student";
        }

        // Redirect naar edit.php met student ID
        header('Location: edit.php?id=' . $student_id);
        exit(0);
    } catch (PDOException $e) {
        // Vang een PDO-uitzondering op en toon de foutmelding
        echo $e->getMessage();
    }
}
?>
