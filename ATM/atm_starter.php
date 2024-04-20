<?php

require_once "account.php";
require_once "checking.php";
require_once "savings.php";

session_start();

if (!isset($_SESSION['checkingAccount'])) {
    $_SESSION['checkingAccount'] = new CheckingAccount('C123', 1000, '12-20-2019');
}
$checking = $_SESSION['checkingAccount'];

if (!isset($_SESSION['savingsAccount'])) {
    $_SESSION['savingsAccount'] = new SavingsAccount('S123', 5000, '03-20-2020');
}
$savings = $_SESSION['savingsAccount'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['withdrawChecking'])) {
        $amount = floatval($_POST['checkingWithdrawAmount']);
        if ($checking->withdrawal($amount)) {
            echo "Withdrawn \${$amount} from Checking.";
        } else {
            echo "Withdrawal failed due to insufficient funds or overdraft limit.";
        }
    } elseif (isset($_POST['depositChecking'])) {
        $amount = floatval($_POST['checkingDepositAmount']);
        $checking->deposit($amount);
        echo "Deposited \${$amount} to Checking.";
    }

    if (isset($_POST['withdrawSavings'])) {
        $amount = floatval($_POST['savingsWithdrawAmount']);
        if ($savings->withdrawal($amount)) {
            echo "Withdrawn \${$amount} from Savings. ";
        } else {
            echo "Withdrawal failed due to insufficient funds.";
        }
    } elseif (isset($_POST['depositSavings'])) {
        $amount = floatval($_POST['savingsDepositAmount']);
        $savings->deposit($amount);
        echo "Deposited \${$amount} to Savings.";
    }
}

$checkingDetails = $checking->getAccountDetails();
$savingsDetails = $savings->getAccountDetails();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <style type="text/css">
        body { margin-left: 120px; margin-top: 50px; }
        .wrapper { display: grid; grid-template-columns: 300px 300px; }
        .account { border: 1px solid black; padding: 10px; }
        input[type=text] { width: 80px; }
        .accountInner { margin-left: 10px; margin-top: 10px; }
    </style>
</head>
<body>
    <form method="post">
        <h1>ATM</h1>
        <div class="wrapper">
            <div class="account">
                <?php echo $checkingDetails; ?>
                <div class="accountInner">
                    <input type="text" name="checkingWithdrawAmount" value="" />
                    <input type="submit" name="withdrawChecking" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="text" name="checkingDepositAmount" value="" />
                    <input type="submit" name="depositChecking" value="Deposit" /><br />
                </div>
            </div>
            <div class="account">
                <?php echo $savingsDetails; ?>
                <div class="accountInner">
                    <input type="text" name="savingsWithdrawAmount" value="" />
                    <input type="submit" name="withdrawSavings" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="text" name="savingsDepositAmount" value="" />
                    <input type="submit" name="depositSavings" value="Deposit" /><br />
                </div>
            </div>
        </div>
    </form>
</body>
</html>
