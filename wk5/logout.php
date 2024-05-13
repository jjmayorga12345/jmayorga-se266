<?php 

session_start();
        include __DIR__ . '/model/model_patient.php';
        include __DIR__ . '/functions.php';

        session_unset(); 
        session_destroy(); 

        header('Location: view_patients.php');
        ?>