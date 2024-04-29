<?php

include (__DIR__ . '/db.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

function getPatients() {
    global $db;
    
    $results = [];

    $stmt = $db->prepare("SELECT * FROM patients ORDER BY patientLastName, patientFirstName, patientBirthDate DESC"); 
    
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return ($results);
}


function addPatient($pFirstName, $pLastName, $pMarried, $pBirthDate) {
    global $db;
    $result = "";
    
    $pMarried = ($pMarried === 'yes') ? 1 : 0;

    $sql = "INSERT INTO patients (patientFirstName, patientLastName, patientMarried, patientBirthDate) 
            VALUES (:fName, :lName, :married, :birthDate)";
    $stmt = $db->prepare($sql);

    $binds = array(
        ":fName" => $pFirstName,
        ":lName" => $pLastName,
        ":married" => $pMarried,
        ":birthDate" => $pBirthDate
    );
    
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = 'Data Added';
    } else {
        $result = 'Error adding data: ' . $stmt->errorInfo()[2];
    }
    
    return ($result);
}


?>
