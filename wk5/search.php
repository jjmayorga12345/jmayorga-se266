<?php 
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: restricted.php');
    exit();
}

include __DIR__ . '/model/model_patient.php';
include __DIR__ . '/functions.php';

$firstName = $lastName = $isMarried = '';
if (isset($_POST['search'])) {
    $firstName = filter_input(INPUT_POST, 'first_name');
    $lastName = filter_input(INPUT_POST, 'last_name');
    $isMarried = isset($_POST['isMarried']) ? '1' : '0';
}

$patients = searchPatients($firstName, $lastName, $isMarried);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        label {
            color: black;
        }
        input[type="text"], input[type="submit"], input[type="checkbox"] {
            color: black;
            background-color: white;
        }
    </style>
    <title>Search Patients</title>
</head>
<body>
    <div class="container">
        <div class="col-sm-12">
            <h1>Patients</h1>
            <a href="view_patients.php">View All Patients</a>

            <form method="POST" name="search_patients">
                <div class="wrapper">
                    <div class="label">
                        <label>First Name:</label>
                        <input type="text" name="first_name" value="<?= $firstName; ?>" />
                    </div>
                    <div class="label">
                        <label>Last Name:</label>
                        <input type="text" name="last_name" value="<?= $lastName; ?>" />
                    </div>
                    <div class="label">
                        <label>Married:</label>
                        <input type="checkbox" name="isMarried" value="1" <?= $isMarried === '1' ? 'checked' : ''; ?>>
                    </div>
                    <div>
                        <input type="submit" name="search" value="Search" />
                    </div>
                </div>
            </form>
        
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Birth Date</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?= $patient['id']; ?></td>
                        <td><?= $patient['patientFirstName']; ?></td>
                        <td><?= $patient['patientLastName']; ?></td>
                        <td><?= $patient['patientBirthDate']; ?></td>
                        <td><a href="index.view.php?action=edit&id=<?= $patient['id']; ?>" class="btn btn-info" style="text-decoration: none;">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <br />
        </div>
    </div>
</body>
</html>
