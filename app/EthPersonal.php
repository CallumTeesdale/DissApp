<?php

namespace App;

use Web3\Web3;

class EthPersonal
{
    public function __construct()
    {
        $this->web3 = new Web3('http://localhost:8545');
    }

    public function createEthAccount()
    {
        $newAccount = '';
        $personal = $this->web3->personal;
        //create the account
        $personal->newAccount('123456', function ($err, $account) use (&$newAccount, &$accountArr) {
            if ($err !== null) {
                // @codeCoverageIgnoreStart
                echo 'Error: ' . $err->getMessage();
                return;
                // @codeCoverageIgnoreStop
            }
            $newAccount = $account;
        });
        return $newAccount;
    }
    public function unlockAccount($account)
    {
        //unlock the account so transactions can take place
        $personal = $this->web3->personal;
        $personal->unlockAccount($account, '123456', function ($err, $unlocked) {
            if ($err !== null) {
                // @codeCoverageIgnoreStart
                echo 'Error: ' . $err->getMessage();
                return;
                // @codeCoverageIgnoreStop
            }
            if ($unlocked) {

                // echo 'New account is unlocked!' . PHP_EOL;
                return $unlocked;
            } else {
                echo 'New account isn\'t unlocked!' . PHP_EOL;
            }
        });
    }

    public function lockAccount($account)
    {
        // remember to lock account after transaction
        $personal = $this->web3->personal;
        $personal->lockAccount($account, function ($err, $locked) {
            if ($err !== null) {
                // @codeCoverageIgnoreStart
                echo 'Error: ' . $err->getMessage();
                return;
                // @codeCoverageIgnoreStop
            }
            if ($locked) {
                // echo 'New account is locked!' . PHP_EOL;
                return $locked;
            } else {
                echo 'New account isn\'t locked' . PHP_EOL;
            }
        });
    }
}