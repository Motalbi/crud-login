<?php
// Inclusie van het database-verbindingsscript
include("dbcon.php");

// Start de PHP-sessie
session_start();

// Controleer of er een ID is doorgegeven via GET
if (isset($_GET['id'])) {
    // Haal het studenten-ID op uit de GET-variabele
    $student_id = $_GET['id'];

    // Voorbereid SQL-query om gegevens van een specifieke student op te halen
    $query = "SELECT * FROM student WHERE id = :stud_id LIMIT 1";
    $statement = $conn->prepare($query);
    $data = [
        ':stud_id' => $student_id
    ];
    $statement->execute($data);

    // Fetch the result only if there is a result
    $result = $statement->fetch(PDO::FETCH_OBJ);
}

// Check for update message and display it
$updateMessage = isset($_SESSION['update_message']) ? $_SESSION['update_message'] : '';
unset($_SESSION['update_message']); // Clear the session variable
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inclusie van Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit & Update Data into Database</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

                <div class="card">
                    <div class="card-header">
                        <!-- Koptekst van de kaart met een koppeling om terug te gaan naar de indexpagina -->
                        <h3> Edit & Update Data into Database
                            <a href="index.php" class="btn btn-primary float-end">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Display update message if available -->
                        <?php if ($updateMessage): ?>
                            <div class="alert alert-success" role="alert">
                                <?= $updateMessage ?>
                            </div>
                        <?php endif; ?>

                        <!-- Formulier voor het bijwerken van studentgegevens -->
                        <form action="function.php" method="POST">
                            <!-- Verborgen invoerveld voor het studenten-ID -->
                            <input type="hidden" name="student_id" value="<?= isset($result->id) ? $result->id : '' ?>" />

                            <div class="mb-3">
                                <label>Full name</label>
                                <!-- Invoerveld voor de volledige naam met de huidige waarde -->
                                <input type="text" name="fullname" value="<?= isset($result->fullname) ? $result->fullname : '' ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <!-- Invoerveld voor e-mail met de huidige waarde -->
                                <input type="text" name="email" value="<?= isset($result->email) ? $result->email : '' ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <!-- Invoerveld voor het telefoonnummer met de huidige waarde -->
                                <input type="text" name="phone" value="<?= isset($result->phone) ? $result->phone : '' ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Course</label>
                                <!-- Invoerveld voor de cursus met de huidige waarde -->
                                <input type="text" name="course" value="<?= isset($result->course) ? $result->course : '' ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <!-- Knop om het studentenrecord bij te werken -->
                                <button type="submit" name="update_student_btn" class="btn btn-primary">Update Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inclusie van Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
