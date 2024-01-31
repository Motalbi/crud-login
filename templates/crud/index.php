<?php
// Start de PHP-sessie
session_start();

// Inclusie van het database-verbindingsscript
include('dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inclusie van Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>PHP Crud</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <?php if (isset($_SESSION['message'])) : ?>
                    <!-- Toon een succesbericht als deze is ingesteld in de sessievariabele -->
                    <h5 class="alert alert-success"><?php echo $_SESSION['message']; ?></h5>
                    <?php
                    // Verwijder het succesbericht uit de sessie om het slechts één keer te tonen
                    unset($_SESSION['message']);
                    ?>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <!-- Koptekst van de kaart met een koppeling om een ​​student toe te voegen -->
                        <h3> PDO Crud
                            <a href="./add.php" class="btn btn-primary float-end">Add Student</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <!-- Tabelkoppen -->
                                    <tr>
                                        <th>ID</th>
                                        <th>FullName</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Course</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // SQL-query om alle studentgegevens op te halen
                                    $query = "SELECT * FROM student";
                                    $statement = $conn->prepare($query);
                                    $statement->execute();

                                    // Fetch gegevens als objecten
                                    $statement->setFetchMode(PDO::FETCH_OBJ);
                                    $result = $statement->fetchAll();

                                    // Controleer of er resultaten zijn en toon deze in de tabel
                                    if ($result) {
                                        foreach ($result as $row) {
                                    ?>
                                            <tr>
                                                <!-- Toon studentgegevens in de tabelcellen -->
                                                <td><?= $row->id; ?></td>
                                                <td><?= $row->fullname; ?></td>
                                                <td><?= $row->email; ?></td>
                                                <td><?= $row->phone; ?></td>
                                                <td><?= $row->course; ?></td>
                                                <td>
                                                    <!-- Koppeling om een student te bewerken met de ID als parameter -->
                                                    <a href="edit.php?id=<?= $row->id; ?>" class="btn btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    <!-- Formulier om een student te verwijderen -->
                                                    <form action="function.php" method="POST">
                                                        <button type="submit" name="delete_student" value="<?= $row->id; ?>" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        // Toon een bericht als er geen records zijn gevonden
                                        ?>
                                        <tr>
                                            <td colspan="7">No records found</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inclusie van Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
