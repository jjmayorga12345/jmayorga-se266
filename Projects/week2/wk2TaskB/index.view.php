<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Form</title>
</head>
<body>
<h1>Patient Form</h1>

<br />

<div class="form-wrapper">
    <form name="patient_intake" method="post">
        <div class="form-control">
            <label for="first_name">First Name:</label><br />
            <input type="text" id="first_name" name="first_name" value="<?= $firstName; ?>">
        </div>

        <div class="form-control">
            <label for="last_name">Last Name:</label><br />
            <input type="text" id="last_name" name="last_name" value="<?= $lastName; ?>">
        </div>

        <div class="form-control">
            <label for="married">Married:</label><br />
            <select id="married" name="married">
                <option value="">Select</option>
                <option value="yes" <?= ($married == 'yes') ? 'selected' : ''; ?>>Yes</option>
                <option value="no" <?= ($married == 'no') ? 'selected' : ''; ?>>No</option>
            </select>
        </div>

        <div class="form-control">
            <label for="birth_date">Birth Date:</label><br />
            <input type="date" id="birth_date" name="birth_date" value="<?= $birthDate; ?>">
        </div>

        <div class="form-control">
            <label for="height_feet">Height (feet):</label><br />
            <input type="number" id="height_feet" name="height_feet"  value="<?= $height_feet; ?>">
        </div>

        <div class="form-control">
            <label for="height_inches">Height (inches):</label><br />
            <input type="number" id="height_inches" name="height_inches"  value="<?= $height_inches; ?>">
        </div>

        <div class="form-control">
            <label for="weight">Weight (lb):</label><br />
            <input type="number" id="weight" name="weight"  value="<?= $weight; ?>">
        </div>

        <div class="form-submit">
            <input type="submit" name="patient_intake_submit" value="Submit">
        </div>
    </form>
</div>

<?php if (isset($_POST["patient_intake_submit"])) : ?>

    <?php

    $bmi = calculateBMI($height_feet, $height_inches, $weight);

    $age = age($birthDate);
    ?>
    <hr />
    <h2>Patient Information</h2>
    <p><span class="result-label">First Name:</span> <?= $firstName; ?></p>
    <p><span class="result-label">Last Name:</span> <?= $lastName; ?></p>
    <p><span class="result-label">Married:</span> <?= $married; ?></p>
    <p><span class="result-label">Birth Date:</span> <?= $birthDate; ?></p>
    <p><span class="result-label">Height:</span> <?= $height_feet . " feet " . $height_inches . " inches"; ?></p>
    <p><span class="result-label">Weight:</span> <?= $weight; ?> pounds</p>
    <p><span class="result-label">Age:</span> <?= $age; ?></p>
    <p><span class="result-label">BMI:</span> <?= number_format($bmi, 1); ?></p>
    <p><span class="result-label">Classification:</span> <?= bmiDescription($bmi); ?></p>

<?php endif; ?>

</body>
</html>
