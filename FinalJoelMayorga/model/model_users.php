<?php

include (__DIR__ . '/db.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

function addUser($uFirstName, $uLastName, $uEmail, $uPhone, $uPassword, $uMembershipTier) {
    global $db;
    $result = "";

    $sql = "SELECT COUNT(*) FROM userregistration WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $uEmail);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        return 'Error: Email already exists';
    }

    $sql = "INSERT INTO userregistration (firstName, lastName, email, phone, password, membershipTier)
            VALUES (:fName, :lName, :email, :phone, :password, :membershipTier)";
    $stmt = $db->prepare($sql);

    $binds = array(
        ":fName" => $uFirstName,
        ":lName" => $uLastName,
        ":email" => $uEmail,
        ":phone" => $uPhone,
        ":password" => $uPassword,
        ":membershipTier" => $uMembershipTier
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = 'User Added';
    } else {
        $result = 'Error adding user: ' . $stmt->errorInfo()[2];
    }

    return $result;
}

function login($email, $pass) {
    global $db;
    
    $result = [];
    $stmt = $db->prepare("SELECT * FROM UserRegistration WHERE Email = :email AND Password = :pass");
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':pass', $pass);
   
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
     
    return $result;
}

function addAppointment($userID, $appointmentDate) {
    global $db;
    $result = "";

    $sql = "INSERT INTO appointments (UserID, AppointmentDate)
            VALUES (:userID, :appointmentDate)";
    $stmt = $db->prepare($sql);

    $binds = array(
        ":userID" => $userID,
        ":appointmentDate" => $appointmentDate
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = 'Appointment Scheduled';
    } else {
        $result = 'Error scheduling appointment: ' . $stmt->errorInfo()[2];
    }

    return $result;
}

function getAppointments($userID) {
    global $db;
    $sql = "SELECT a.AppointmentID, a.AppointmentDate, u.FirstName, u.Email 
            FROM appointments a
            JOIN UserRegistration u ON a.UserID = u.UserID
            WHERE a.UserID = :userID";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteAppointment($appointmentID) {
    global $db;
    if (empty($appointmentID)) {
        return false;
    }
    $sql = "DELETE FROM appointments WHERE AppointmentID = :appointmentID";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':appointmentID', $appointmentID);
    return $stmt->execute();
}

function getUserInfo($userID) {
    global $db;
    $sql = "SELECT FirstName, LastName, Email, Phone, Password, MembershipTier FROM UserRegistration WHERE UserID = :userID";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUserInfo($userID, $firstName, $lastName, $email, $phone, $password, $membershipTier) {
    global $db;
    $sql = "UPDATE UserRegistration SET FirstName = :firstName, LastName = :lastName, Email = :email, Phone = :phone, Password = :password, MembershipTier = :membershipTier WHERE UserID = :userID";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':firstName', $firstName);
    $stmt->bindValue(':lastName', $lastName);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':membershipTier', $membershipTier);
    $stmt->bindValue(':userID', $userID);
    return $stmt->execute();
}
?>
