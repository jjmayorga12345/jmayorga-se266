<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moon Fitness</title>
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
        .nav-link {
            background-color: white;
            border: 1px solid #000;
            padding: 5px 10px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            text-decoration: none;
            color: black;
            font-size: 14px;
        }
        .nav-link:hover {
            background-color: #f1f1f1;
        }
        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 70px);
        }
        .promo {
            background-color: #ff6f61;
            padding: 40px;
            text-align: center;
            color: white;
            border-radius: 10px;
        }
        .promo-text {
            font-size: 24px;
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
            margin: 0;
        }
        .promo-price {
            font-size: 48px;
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
            margin: 10px 0 0 0;
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
            <?php if (isset($_SESSION['userID'])): ?>
                <a href="details.php" class="nav-link">View Appointments</a>
                <a href="appointment.php" class="nav-link">Schedule Appointment</a>
                <a href="accountdetails.php" class="nav-link">Account Details</a>
                <a href="logout.php" class="nav-link">Logout</a>
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['userName'] ?? ''); ?></span>
            <?php else: ?>
                <a href="login.php" class="nav-link">Login</a>
                <a href="regis.php" class="nav-link">Register</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="content">
        <div class="promo">
            <p class="promo-text">STARTING AT!</p>
            <p class="promo-price">$5.99 A MONTH!</p>
        </div>
    </div>
</body>
</html>
