<?php

namespace app;

use Web3\Web3;
use App\EthPersonal;

class EthEth
{
  public function transEther($toAccount)
  {
    $web3 = new Web3('http://localhost:8545');
    $AccountsEth = new EthPersonal();
    include 'ContractVariables.php';
    $fromAccount = $contractOwner;
    $eth = $web3->eth;
    $AccountsEth->unlockAccount($fromAccount, '123456');
    // send transaction
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
        if ($err !== null) {
          echo 'Error: ' . $err->getMessage();
          return;
        }
        echo 'Tx hash: ' . $transaction . PHP_EOL;
        $AccountsEth->lockAccount($fromAccount);
      }
    );
  }
}