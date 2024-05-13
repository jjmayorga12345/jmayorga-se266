<?php 
session_start();
include __DIR__ . '/model/model_patient.php';
include __DIR__ . '/functions.php';  // Assuming you have a functions file for common functionalities

if (isset($_SESSION['user'])) {
    $patients = getPatients();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>View Patients</title>
</head>
<body>
    <div class="container">
        <div class="col-sm-12">
            <h1>Patients</h1>
            <a href="index.view.php" class="btn btn-primary">Add New Patient</a>
            <?php if (isset($_SESSION['user'])): ?>
                <h4>Welcome <?= $_SESSION['user']; ?></h4>
                <b><a href="search.php">Search Patients</a></b><br>
                <a href="logout.php" class="btn btn-secondary">Logout</a><br><br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Married</th>
                            <th>Birth Date</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($patients as $patient): ?>
                        <tr>
                            <td><?= $patient['patientFirstName']; ?></td>
                            <td><?= $patient['patientLastName']; ?></td>
                            <td><?= $patient['patientMarried']; ?></td> 
                            <td><?= $patient['patientBirthDate']; ?></td>
                            <td><a class="btn btn-info" href="index.view.php?action=edit&id=<?= $patient['id']; ?>" style="text-decoration: none;">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <b><a href="login.php" class="btn btn-primary">Login</a></b><br>
            <?php endif; ?>
            <br />
        </div>
    </div>
</body>
</html>
