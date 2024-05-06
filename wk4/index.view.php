<?php
include __DIR__ . '/model/model_patient.php';

$error = "";
$action = filter_input(INPUT_GET, 'action') ?? 'add';
$id = filter_input(INPUT_GET, 'id');

$firstName = "";
$lastName = "";
$married = "";
$birthDate = "";

if ($action == 'edit' && $id) {
    $patient = getPatient($id);
    $firstName = $patient['patientFirstName'];
    $lastName = $patient['patientLastName'];
    $married = $patient['patientMarried'] ? 'yes' : 'no';
    $birthDate = $patient['patientBirthDate'];
}

if (isset($_POST['storePatient'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $married = $_POST['married'];
    $birthDate = $_POST['birth_date'];

    if ($error == "" && $action == 'add') {
        addPatient($firstName, $lastName, $married, $birthDate);
        header('Location: view_patients.php');
        exit;
    }

    if ($error == "" && $action == 'edit' && $id) {
        updatePatient($id, $firstName, $lastName, $married, $birthDate);
        header('Location: view_patients.php');
        exit;
    }
}

if (isset($_POST['deletePatient']) && $id) {
    deletePatient($id);
    header('Location: view_patients.php');
    exit;
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
    <title>Patients</title>
</head>
<body>

    <style type="text/css">
        .wrapper {
            display: grid;
            grid-template-columns: 180px 400px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
            color: #111;
        }
        label {
            font-weight: bold;
        }
        .mar12 {
            margin-left: 12rem;
        }
        input[type=text] {
            width: 200px;
        }
        .error {
            color: red;
        }
        div {
            margin-top: 5px;
        }
    </style>

    <div class="container">
        <div class="col-sm-12"> 
            <a class='mar12' href="view_patients.php">Back to View All Patients</a>
            <h2 class='mar12'><?= ucfirst($action); ?> Patient</h2>
            <form name="patientForm" method="post">
                <div class="wrapper">
                    <div class="label">
                        <label>First Name:</label>
                    </div>
                    <div>
                        <input type="text" name="first_name" class="form-control" value="<?= $firstName; ?>" />
                    </div>
                    <div class="label">
                        <label>Last Name:</label>
                    </div>
                    <div>
                        <input type="text" name="last_name" class="form-control" value="<?= $lastName; ?>" />
                    </div>
                    <div class="label">
                        <label>Married:</label>
                    </div>
                    <div>
                        <select name="married" class="form-control">
                            <option value="">Select</option>
                            <option value="yes" <?= ($married == 'yes') ? 'selected' : ''; ?>>Yes</option>
                            <option value="no" <?= ($married == 'no') ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                    <div class="label">
                        <label>Birth Date:</label>
                    </div>
                    <div>
                        <input type="date" name="birth_date" class="form-control" value="<?= $birthDate; ?>" />
                    </div>
                    <div>
                        &nbsp;
                    </div>
                    <div>
                        <input class="<?= $action == 'edit' ? 'btn btn-info' : 'btn btn-success'; ?>" type="submit" name="storePatient" value="<?= ucfirst($action); ?> Patient Information" />
                    </div>  
                    <div>
                        &nbsp;
                    </div>             
                    <div>
                        <?php if ($action == 'edit'): ?><input class="btn btn-danger" type="submit" name="deletePatient" value="DELETE Patient" /><?php endif; ?>
                    </div>
                </div>
            </form>

        </div>
    </div>
</body>
</html>
