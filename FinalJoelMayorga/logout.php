<?php 

session_start();
        include __DIR__ . '/model/model_users.php';

        session_unset(); 
        session_destroy(); 

        header('Location: login.php');
        ?>