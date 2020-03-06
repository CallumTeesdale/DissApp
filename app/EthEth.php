<?php

namespace app;

use Web3\Web3;
use App\EthPersonal;

/**
 * * Class to transfer ether
 */
class EthEth
{

    /**
     * * Transfer ther function
     *   @param string
     *   hex representation of the account to transfer to
     */
    public function transEther($toAccount)
    {

        /**
         * * Create a new web 3 class and EthPersonal class
         */
        $web3 = new Web3('http://localhost:8545');
        $AccountsEth = new EthPersonal();

        /**
         * * Get the contract variables and set them
         */
        include 'ContractVariables.php';
        $fromAccount = $contractOwner;
        $eth = $web3->eth;

        /**
         * * Unlock the account of the owner
         */
        $AccountsEth->unlockAccount($fromAccount, '123456');

        /**
         * * Send the ether
         */
        $eth->sendTransaction(
            [
                'from' => $fromAccount,
                'to' => $toAccount,
                'value' => '0x9536c708910000'
            ],
            function ($err, $transaction) use (
                $eth,
                $fromAccount,
                $toAccount,
                $AccountsEth
            ) {
                //@codeCoverageIgnoreStart
                if ($err !== null) {
                    echo 'Error: ' . $err->getMessage();
                    return;
                }
                //@codeCoverageIgnoreStop
                echo 'Tx hash: ' . $transaction . PHP_EOL;
            }
        );
        $AccountsEth->lockAccount($fromAccount);
    }
}