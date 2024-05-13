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

    return $results;
}

function getPatient($id) {
    global $db;
    $result = [];

    $stmt = $db->prepare("SELECT * FROM patients WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return $result;
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

    return $result;
}

function updatePatient($id, $pFirstName, $pLastName, $pMarried, $pBirthDate) {
    global $db;
    $result = "";
    $pMarried = ($pMarried === 'yes') ? 1 : 0;

    $sql = "UPDATE patients SET patientFirstName = :fName, patientLastName = :lName, patientMarried = :married, patientBirthDate = :birthDate WHERE id = :id";
    $stmt = $db->prepare($sql);

    $binds = array(
        ":fName" => $pFirstName,
        ":lName" => $pLastName,
        ":married" => $pMarried,
        ":birthDate" => $pBirthDate,
        ":id" => $id
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = 'Data Updated';
    } else {
        $result = 'Error updating data: ' . $stmt->errorInfo()[2];
    }

    return $result;
}

function deletePatient($id) {
    global $db;
    $result = "Data was not deleted";
    $stmt = $db->prepare("DELETE FROM patients WHERE id=:id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $result = 'Data Deleted';
    }

    return $result;
}

function login($user, $pass){
    global $db;
    
    $result = [];
    $stmt = $db->prepare("SELECT * FROM users WHERE username=:user AND password=sha1(:pass)");
    $stmt->bindValue(':user', $user);
    $stmt->bindValue(':pass', $pass);
   
    if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    
     }
     
     return ($result);
}

function searchPatients($firstName, $lastName, $isMarried) {
    global $db;
    $binds = array();

    $sql = "SELECT * FROM patients WHERE 0=0";

    if ($firstName != "") {
        $sql .= " AND patientFirstName LIKE :firstName";
        $binds['firstName'] = '%' . $firstName . '%';
    }

    if ($lastName != "") {
        $sql .= " AND patientLastName LIKE :lastName";
        $binds['lastName'] = '%' . $lastName . '%';
    }

    if ($isMarried !== '') {
        $sql .= " AND patientMarried = :isMarried";
        $binds['isMarried'] = $isMarried;
    }

    $sql .= " ORDER BY patientLastName, patientFirstName";

    $results = array();
    $stmt = $db->prepare($sql);

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;
}




?>
