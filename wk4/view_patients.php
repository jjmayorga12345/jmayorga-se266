<?php
include __DIR__ . '/model/model_patient.php';

$patients = getPatients();
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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Married</th>
                        <th>Birth Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?= $patient['patientFirstName']; ?></td>
                        <td><?= $patient['patientLastName']; ?></td>
                        <td><?= $patient['patientMarried']; ?></td> 
                        <td><?= $patient['patientBirthDate']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <br />
            <a href="index.view.php" class="btn btn-primary">Add New Patient</a>
        </div>
    </div>
</body>
</html>
