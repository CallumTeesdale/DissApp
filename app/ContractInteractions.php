<?php


namespace app;




use Web3\Contract;
use Web3\Web3;
use App\EthPersonal;

class ContractInteractions
{

    private $web3;
    private $Abi;
    private $contractAddress;
    private $contractOwner;
    private $AccountsEth;

    public function __construct()
    {
        include('ContractVariables.php');
        $this->Abi = $Abi;
        $this->contractOwner = $contractOwner;
        $this->contractAddress = $contractAddress;
        $this->web3 = new Web3('http://localhost:8545');
    }

    public function contractGetBalance($account)
    {

        //create a web3/contract object
        $contract = new Contract($this->web3->provider, $this->Abi);
        $accountBalance = '';
        //use the contract object to call the balanceOf function in the contract
        $contract->at($this->contractAddress)->call('balanceOf', $account, function ($err, $balance) use (&$accountBalance) {
            if ($err !== null) {
                // @codeCoverageIgnoreStart
                throw $err;
                $accountBalance = 0;
                // @codeCoverageIgnoreStop
            }
            if ($balance) {
                $accountBalance = $balance;
            }
        });
        return $accountBalance;
    }

    public function transfer($toAccount, $ammount)
    {
        //create a web3/contract object
        $contract = new Contract($this->web3->provider, $this->Abi);
        $AccountsEth = new EthPersonal();
        $contractOwner = $this->contractOwner;
        $AccountsEth->unlockAccount($contractOwner);
        $contract->at($this->contractAddress)->send('transfer', $toAccount, $ammount, [
            'from' => $contractOwner,
            'gas' => '0x200b20'
        ], function ($err, $result) use ($contract,  $contractOwner, $toAccount, $AccountsEth) {
            if ($err !== null) {
                throw $err;
            }
            if ($result) {
                echo "\nTransaction has made:) id: " . $result . "\n";
            }
            $transactionId = $result;
            $contract->eth->getTransactionReceipt($transactionId, function ($err, $transaction) use ($contractOwner, $toAccount, $AccountsEth) {
                if ($err !== null) {
                    throw $err;
                }
                if ($transaction) {
                    echo "\nTransaction has mind:) block number: " . $transaction->blockNumber . "\nTransaction dump:\n";
                    //var_dump($transaction);
                    $AccountsEth->lockAccount($contractOwner);
                }
            });
        });
    }
}