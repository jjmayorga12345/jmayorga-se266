<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moon Fitness - Registration</title>
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
        }

        .registration-button {
            background-color: white;
            border: 1px solid #000;
            padding: 5px 10px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            text-decoration: none;
            color: black;
        }

        .registration-button:hover {
            background-color: #f1f1f1;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 70px);
        }

        .registration-box {
            background-color: #ff6f61;
            padding: 40px;
            text-align: center;
            color: white;
            border-radius: 10px;
            width: 600px;
        }

        .registration-title {
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

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
        }

        .membership-tier {
            margin-top: 20px;
        }

        .membership-tier label {
            display: block;
            font-size: 18px;
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
        }

        .membership-tier div {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .membership-tier input[type="radio"] {
            margin-right: 10px;
        }

        .registration-button {
            background-color: white;
            border: 1px solid #000;
            padding: 10px 20px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .registration-button:hover {
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
            <a href="login.php" class="registration-button">Login</a>
        </div>
    </div>
    <div class="content">
        <div class="registration-box">
            <h2 class="registration-title">Registration</h2>
            <form class="registration-form" action="" method="post">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group membership-tier">
                    <label>Membership Tier</label>
                    <div>
                        <input type="radio" id="basic" name="membership-tier" value="basic" required>
                        <label for="basic">Basic</label>
                    </div>
                    <div>
                        <input type="radio" id="legacy" name="membership-tier" value="legacy">
                        <label for="legacy">Legacy</label>
                    </div>
                    <div>
                        <input type="radio" id="platinum" name="membership-tier" value="platinum">
                        <label for="platinum">Platinum</label>
                    </div>
                </div>
                <button type="submit" class="registration-button">Register</button>
            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    include 'model/model_users.php';
                    $firstName = $_POST['first-name'];
                    $lastName = $_POST['last-name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $password = $_POST['password'];
                    $membershipTier = $_POST['membership-tier'];

                    $message = addUser($firstName, $lastName, $email, $phone, $password, $membershipTier);
                    echo "<p>$message</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>
