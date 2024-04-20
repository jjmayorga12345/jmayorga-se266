<?php

abstract class Account 
{
    protected $accountId;
    protected $balance;
    protected $startDate;
    
    public function __construct($id, $bal, $startDt) 
    {
        $this->accountId = $id;
        $this->balance = $bal;
        $this->startDate = $startDt;
    }
    
    public function deposit($amount) 
    {
        $this->balance += $amount;
    }

    abstract public function withdrawal($amount);
    
    public function getStartDate() 
    {
        return $this->startDate;
    }

    public function getBalance() 
    {
        return $this->balance;
    }

    public function getAccountId() 
    {
        return $this->accountId;
    }

    protected function getAccountDetails()
    {
        return "<div>Account ID: {$this->accountId}</div>
                <div>Balance: \${$this->balance}</div>
                <div>Start Date: {$this->startDate}</div>";
    }
    
    
}

?>
