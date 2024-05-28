<?php
session_start();
include 'model/model_users.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_SESSION['userID'];
    $appointmentDate = $_POST['appointment-date'];

    $message = addAppointment($userID, $appointmentDate);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>appointments</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fff;
        }

        .header {
            background-color: #ff6f61;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .title {
            color: white;
            font-size: 24px;
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
            margin: 0;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-button, .nav-link {
            background-color: white;
            border: 1px solid #000;
            padding: 5px 10px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            text-decoration: none;
            color: black;
            font-size: 14px;
        }

        .nav-button:hover, .nav-link:hover {
            background-color: #f1f1f1;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 70px);
        }

        .appointment-box {
            background-color: #ff6f61;
            padding: 40px;
            text-align: center;
            color: white;
            border-radius: 10px;
            width: 500px;
        }

        .appointment-title {
            font-size: 36px;
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 18px;
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
        }

        .form-group input[type="date"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
        }

        .schedule-button {
            background-color: white;
            border: 1px solid #000;
            padding: 10px 20px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .schedule-button:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <img src="moon.png" alt="Moon Fitness Logo" class="logo">
            <h1 class="title">Moon Fitness</h1>
        </div>
        <div class="nav">
            <a href="details.php" class="nav-link">View Appointments</a>
            <a href="appointment.php" class="nav-link">Schedule Appointment</a>
            <a href="accountdetails.php" class="nav-link">Account Details</a>
            <a href="logout.php" class="nav-link">Logout</a>
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['userName'] ?? ''); ?></span>
        </div>
    </div>
    <div class="content">
        <div class="appointment-box">
            <h2 class="appointment-title">Schedule Appointment</h2>
            <form class="appointment-form" action="" method="post">
                <div class="form-group">
                    <label for="appointment-date">Appointment Date</label>
                    <input type="date" id="appointment-date" name="appointment-date" required>
                </div>
                <button type="submit" class="schedule-button">Schedule</button>
            </form>
            <?php
            if (isset($message)) {
                echo "<p>$message</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
