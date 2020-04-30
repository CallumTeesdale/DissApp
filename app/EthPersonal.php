<?php

namespace App;

use Exception;
use Web3\Web3;

/**
 * * Class to allow interacting with accounts
 */
class EthPersonal
{
    public function __construct()
    {
        $this->web3 = new Web3('http://localhost:8545');
    }

    /**
     * * Function to create an account
     *  @param string $password
     *  the password to the account
     *
     *  @return string $newAccount
     *  returns a hex addressof the account
     */
    public function createEthAccount($password)
    {
        $newAccount = '';
        $personal = $this->web3->personal;

        /**
         * * create the account
         */
        $personal->newAccount($password, function ($err, $account) use (&$newAccount, &$accountArr) {
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

    /**
     * * Function to unlock an account
     *  @param string $account
     *  hex address of the account to unlock
     *
     *  @param string $password
     *  password of the account to unlock
     *
     *  @return object $unlocked
     *
     */
    public function unlockAccount($account, $password)
    {
        //unlock the account so transactions can take place
        $personal = $this->web3->personal;
        $personal->unlockAccount($account, $password, function ($err, $unlocked) {
            if ($err !== null) {
                // @codeCoverageIgnoreStart
                //echo 'Error: ' . $err->getMessage();
                throw new Exception($err);
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

    /**
     * * Function to lock an account
     *
     *  @param string $account
     *  hex address of the account to lock
     *
     *  @return object $locked
     */
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