<?php


function calculateBMI($feet, $inches, $weight)
{
    $height_inches = ($feet * 12) + $inches;

    $height_m = $height_inches * 0.0254;

    $weight_kg = $weight / 2.20462;

    $bmi = $weight_kg / ($height_m * $height_m);

    return $bmi;
}


function bmiDescription($bmi)
{
    if ($bmi < 18.5) {
        return "Underweight";
    }
    elseif ($bmi >= 18.5 && $bmi < 25) {
        return "Normal weight";
    }
    elseif ($bmi >= 25 && $bmi < 30) {
        return "Overweight";
    }
    else {
        return "Obese";
    }
}

function age($birthDate)
{
    $date = new DateTime($birthDate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
}

function isDate($dob)
{
    $date_arr  = explode('-', $dob);
    return checkdate($date_arr[1], $date_arr[2], $date_arr[0]);
}
?>
