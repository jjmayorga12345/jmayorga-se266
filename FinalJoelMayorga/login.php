<?php
session_start();
include __DIR__ . '/model/model_users.php';

if (isset($_POST['login'])) {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    $user = login($email, $password);
    var_dump($user);

    if (count($user) > 0) {
        echo 'HELLO';
        $_SESSION['userID'] = $user['UserID'];
        $_SESSION['userName'] = $user['FirstName'];
        header('Location: index.view.php');
        exit;
    } else {
        session_unset();
        $message = "Invalid email or password.";
    }
} else {
    $email = '';
    $password = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moon Fitness Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            text-align: center;
        }
        .header {
            background-color: #ff6f6f;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header-left {
            display: flex;
            align-items: center;
        }
        .header img {
            width: 50px;
            margin-right: 10px;
        }
        .header h1 {
            color: white;
            font-size: 2em;
            margin: 0;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }
        .register-btn {
            background-color: white;
            color: black;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .login-container {
            margin: 50px auto;
            padding: 20px;
            max-width: 400px;
            background-color: #ff6f6f;
            border-radius: 8px;
        }
        .login-container h2 {
            color: white;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }
        .login-container .label {
            text-align: left;
            color: white;
            font-size: 1.2em;
            margin-top: 10px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        .login-container input[type="submit"] {
            background-color: white;
            color: black;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <img src="moon.png" alt="Moon Logo">
            <h1>Moon Fitness</h1>
        </div>
        <a href="regis.php" class="register-btn">Register</a>
    </div>
    <div class="login-container">
        <h2>Login</h2>
        <form name="login_form" method="post">
            <div class="wrapper">
                <div class="label">
                    <label for="email">Email</label>
                </div>
                <div>
                    <input type="text" id="email" name="email" value="<?= htmlspecialchars($email); ?>" />
                </div>
                <div class="label">
                    <label for="password">Password</label>
                </div>
                <div>
                    <input type="password" id="password" name="password" value="<?= htmlspecialchars($password); ?>" />
                </div>
                <div>
                    <input type="submit" name="login" value="Login" />
                </div>
            </div>
        </form>
        <?php
        if (isset($message)) {
            echo "<p style='color: red;'>$message</p>";
        }
        ?>
    </div>
</body>
</html>
