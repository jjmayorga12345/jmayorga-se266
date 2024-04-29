<?php
include __DIR__ . '/model/model_patient.php';

$firstName = "";
$lastName = "";
$married = "";
$birthDate = "";

$heightFeet = 0;
$heightInches = 0;
$weight = 0;

if (isset($_POST['addPatient'])) {
    $firstName = filter_input(INPUT_POST, 'first_name');
    $lastName = filter_input(INPUT_POST, 'last_name');
    $married = filter_input(INPUT_POST, 'married');
    $birthDate = filter_input(INPUT_POST, 'birth_date');

    $heightFeet = filter_input(INPUT_POST, 'height_feet');
    $heightInches = filter_input(INPUT_POST, 'height_inches');
    $weight = filter_input(INPUT_POST, 'weight');

    $result = addPatient($firstName, $lastName, $married, $birthDate);
    if ($result) {
        echo "<h2>Patient added successfully</h2>";
        echo "<ul>";
        echo "<li>First Name: $firstName</li>";
        echo "<li>Last Name: $lastName</li>";
        echo "<li>Married: $married</li>";
        echo "<li>Birth Date: $birthDate</li>";
        echo "</ul>";
        echo '<a href="view_patients.php" style="display: inline-block; padding: 8px 16px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px;">View All Patients</a>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Form</title>
</head>
<body>
<h1>Add New Patient</h1>

<form name="patientForm" method="post">
    <div class="form-group">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?= $firstName; ?>">
    </div>
    <div class="form-group">
        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?= $lastName; ?>">
    </div>
    <div class="form-group">
        <label>Married:</label>
        <select name="married">
            <option value="">Select</option>
            <option value="yes" <?= ($married == 'yes') ? 'selected' : ''; ?>>Yes</option>
            <option value="no" <?= ($married == 'no') ? 'selected' : ''; ?>>No</option>
        </select>
    </div>
    <div class="form-group">
        <label>Birth Date:</label>
        <input type="date" name="birth_date" value="<?= $birthDate; ?>">
    </div>
    <div class="form-group">
        <label>Height (feet):</label>
        <input type="number" name="height_feet" value="<?= $heightFeet; ?>">
    </div>
    <div class="form-group">
        <label>Height (inches):</label>
        <input type="number" name="height_inches" value="<?= $heightInches; ?>">
    </div>
    <div class="form-group">
        <label>Weight (lb):</label>
        <input type="number" name="weight" value="<?= $weight; ?>">
    </div>

    <input type="submit" name="addPatient" value="Add Patient">
</form>

</body>
</html>
