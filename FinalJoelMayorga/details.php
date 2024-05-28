<?php
session_start();
include 'model/model_users.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['userID'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointmentID'])) {
    $appointmentID = $_POST['appointmentID'];

    if (!empty($appointmentID)) {
        if (deleteAppointment($appointmentID)) {
            $message = 'Appointment successfully cancelled.';
        } else {
            $message = 'Failed to cancel the appointment.';
        }
    } else {
        $message = 'Invalid appointment ID.';
    }
}

$appointments = getAppointments($userID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moon Fitness - Booked Appointments</title>
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
            gap: 10px;
        }

        .nav-button, .nav-link {
            background-color: white;
            border: 1px solid #000;
            padding: 5px 10px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            text-decoration: none;
            color: black;
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
            width: 600px;
        }

        .appointment-title {
            font-size: 36px;
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid white;
            padding: 10px;
            text-align: left;
        }

        th {
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
        }

        .cancel-button {
            background-color: white;
            border: 1px solid #000;
            padding: 5px 10px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .cancel-button:hover {
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
            <h2 class="appointment-title">Booked Appointments</h2>
            <?php if ($message): ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Appointment Date</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($appointment['FirstName'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($appointment['Email'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($appointment['AppointmentDate'] ?? ''); ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="appointmentID" value="<?php echo htmlspecialchars($appointment['AppointmentID'] ?? ''); ?>">
                                <button type="submit" class="cancel-button">Cancel</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
