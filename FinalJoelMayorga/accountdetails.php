<?php
session_start();
include 'model/model_users.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['userID'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $membershipTier = $_POST['membership-tier'];

    if (updateUserInfo($userID, $firstName, $lastName, $email, $phone, $password, $membershipTier)) {
        $message = 'Account information updated successfully.';
    } else {
        $message = 'Failed to update account information.';
    }
}

$userInfo = getUserInfo($userID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>acc detailz</title>
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

        .account-box {
            background-color: #ff6f61;
            padding: 40px;
            text-align: center;
            color: white;
            border-radius: 10px;
            width: 600px;
        }

        .account-title {
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
        .form-group input[type="password"],
        .form-group select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
        }

        .account-button {
            background-color: white;
            border: 1px solid #000;
            padding: 10px 20px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .account-button:hover {
            background-color: #f1f1f1;
        }

        .message {
            margin-bottom: 20px;
            font-size: 18px;
            color: white;
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
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
        <div class="account-box">
            <h2 class="account-title">Account Details</h2>
            <?php if ($message): ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" value="<?php echo htmlspecialchars($userInfo['FirstName'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" value="<?php echo htmlspecialchars($userInfo['LastName'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userInfo['Email'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($userInfo['Phone'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($userInfo['Password'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="membership-tier">Membership Tier</label>
                    <select id="membership-tier" name="membership-tier" required>
                        <option value="basic" <?php echo (strtolower($userInfo['MembershipTier']) == 'basic') ? 'selected' : ''; ?>>Basic</option>
                        <option value="legacy" <?php echo (strtolower($userInfo['MembershipTier']) == 'legacy') ? 'selected' : ''; ?>>Legacy</option>
                        <option value="platinum" <?php echo (strtolower($userInfo['MembershipTier']) == 'platinum') ? 'selected' : ''; ?>>Platinum</option>
                    </select>
                </div>
                <button type="submit" class="account-button">Apply Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
