<?php
require_once "./account.php";

class SavingsAccount extends Account 
{
    public function withdrawal($amount) 
    {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            return true;
        } else {
            return false;
        }
    }

    public function getAccountDetails() 
    {
        $accountDetails = "<h2>Savings Account</h2>";
        $accountDetails .= parent::getAccountDetails();
        
        return $accountDetails;
    }
    
}
?>
