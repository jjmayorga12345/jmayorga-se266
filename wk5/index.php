<?php

require 'functions.php';

$firstName = '';
$lastName = '';
$married = '';
$birthDate = '';
$height_feet = '';
$height_inches = '';
$weight = '';


if (isset($_POST["patient_intake_submit"])) {
    $firstName = filter_input(INPUT_POST, 'first_name');
    $lastName = filter_input(INPUT_POST, 'last_name');
    $married = filter_input(INPUT_POST, 'married');
    $birthDate = filter_input(INPUT_POST, 'birth_date');
    $height_feet = filter_input(INPUT_POST, 'height_feet', FILTER_VALIDATE_INT);
    $height_inches = filter_input(INPUT_POST, 'height_inches', FILTER_VALIDATE_INT);
    $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT);
}


require 'index.view.php';