<?php

interface AccountInterface
{
    public function deposit(float $amount): void;
    public function withdraw(float $amount): void;
    public function getBalance(): float;
}

class BankAccount implements AccountInterface
{
    const MIN_BALANCE = 0;
    protected float $balance;
    protected string $currency;

    public function __construct(string $currency)
    {
        $this->balance = self::MIN_BALANCE;
        $this->currency = $currency;
    }

    public function deposit(float $amount): void
    {
        if ($amount <= 0) 
        {
            throw new Exception("Amount cannot be negative.");
        }
        $this->balance += $amount;
    }

    public function withdraw(float $amount): void
    { 
        if ($amount <= 0) 
        {
            throw new Exception("Withdraw amount cannot be negative.");
        }
        if ($amount > $this->balance) 
        {
            throw new Exception("Not enough money.");
        }
        $this->balance -= $amount;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}

class SavingsAccount extends BankAccount
{
    public static float $interestRate;

    public static function setInterestRate(float $rate): void
    {
        self::$interestRate = $rate;
    }

    public function applyInterest(): void
    {
        $interest = $this->balance * (self::$interestRate / 100);
        $this->balance += $interest;
    }
}


$account1 = new BankAccount("USD");
$account2 = new SavingsAccount("USD");

SavingsAccount::setInterestRate(5.0);

$account1->deposit(100);
$account2->deposit(200);

$account1->withdraw(50);
$account2->withdraw(50);

$account2->applyInterest();

echo "Balance 1: " . $account1->getBalance() . " USD<br>";
echo "SavingsAccount balance2: " . $account2->getBalance() . " USD<br>";


try 
{
    $account1->deposit(-100);
} catch (Exception $e) 
{
    echo "Exception: " . $e->getMessage() . "<br>";
}

try 
{
    $account1->withdraw(-100);
} catch (Exception $e) 
{
    echo "Exception: " . $e->getMessage() . "<br>";
}

try 
{
    $account2->withdraw(200);
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "<br>";
}
