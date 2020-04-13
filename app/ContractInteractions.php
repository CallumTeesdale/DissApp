<?php

namespace app;

use Web3\Contract;
use Web3\Web3;
use App\EthPersonal;
use Exception;

/**
 * Class ContractInteractions
 * @package app
 */
class ContractInteractions
{
    /**
     * @var Web3
     */
    private $web3;
    /**
     * @var
     */
    private $Abi;
    /**
     * @var
     */
    private $contractAddress;
    /**
     * @var
     */
    private $contractOwner;
    /**
     * @var
     */
    private $AccountsEth;

    /**
     * ContractInteractions constructor.
     */
    public function __construct()
    {
        /**
         * * Set the needed variables
         */
        include 'ContractVariables.php';
        $this->Abi = $Abi;
        $this->contractOwner = $contractOwner;
        $this->contractAddress = $contractAddress;
        $this->web3 = new Web3('http://localhost:8545');
    }

    /**
     * @param $account
     * @return string
     */
    public function contractGetBalance($account)
    {
        /**
         * * create a web3/contract object
         */
        $contract = new Contract($this->web3->provider, $this->Abi);
        $accountBalance = '';

        /**
         * * use the contract object to call the balanceOf function in the contract
         */
        $contract
            ->at($this->contractAddress)
            ->call('balanceOf', $account, function ($err, $balance) use (
                &$accountBalance
            ) {
                if ($err !== null) {

                    /**
                     * * If there was an error throw and set the account balance to display 0
                     */
                    // @codeCoverageIgnoreStart
                    throw $err;
                    $accountBalance = 0;
                    // @codeCoverageIgnoreStop
                }
                if ($balance) {
                    /**
                     * * if no errors the set account blance to the returned balance
                     */
                    $accountBalance = $balance;
                }
            });
        return $accountBalance;
    }

    /**
     * * Function to transfer tokens from one account to the other
     * @param string $toAccount
     *  hex representation of the account the transfer will go to
     *
     * @param string $fromAccount
     *  hex representation of the account the transfer is from
     *
     * @param string $password
     *  the password of the from account to allow the unlock
     *
     * @param int $ammount
     *  int representation of the amount to be transferred
     *
     * @return mixed
     *  Returns a view
     * @throws Exception
     */
    public function transfer($toAccount, $fromAccount, $password, $ammount)
    {
        /**
         * * create a web3/contract object
         */
        $contract = new Contract($this->web3->provider, $this->Abi);
        $AccountsEth = new EthPersonal();

        /**
         * * Before you can send any token the account needs to be unlocked, try to unlock it
         */
        try {
            $AccountsEth->unlockAccount($fromAccount, $password);
        } catch (Exception $e) {

            /**
             * * there was an error unlocking the account, catch the error
             */
            throw $e;
        }

        /**
         * * Start the transfer of the token
         */
        $contract->at($this->contractAddress)->send(
            'transfer',
            $toAccount,
            $ammount,
            [
                'from' => $fromAccount,
                'gas' => '0x200b20'
            ],

            /**
             * * Set the callback
             */
            function ($err, $result) use (
                $contract,
                $fromAccount,
                $toAccount,
                $AccountsEth
            ) {
                /**
                 * * If there was an error throw it
                 */
                if ($err !== null) {
                    echo 'trans err';
                    throw $err;
                }

                /**
                 * * If the tranfer was succesful get the transactio reciept
                 */
                if ($result) {
                    // echo "\nTransaction made: id: " . $result . "\n";
                }
                $transactionId = $result;
                $contract->eth->getTransactionReceipt($transactionId, function (
                    $err,
                    $transaction
                ) use ($fromAccount, $toAccount, $AccountsEth) {

                    /**
                     * * If there was an error throw it
                     */
                    if ($err !== null) {
                        echo 'trans err';
                        throw $err;
                    }

                    /**
                     * * If getting the transactio was succesful
                     */
                    if ($transaction) {
                        // echo "\nTransaction has mind:) block number: " .
                        //     $transaction->blockNumber .
                        //     "\nTransaction dump:\n";
                        //var_dump($transaction);
                        echo 'trans succ';
                    }
                });
            }
        );

        /**
         * * Lock the account
         */
        $AccountsEth->lockAccount($fromAccount);
    }
}
