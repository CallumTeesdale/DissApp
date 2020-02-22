<?php

namespace Tests;

use \PHPUnit\Framework\TestCase as BaseTestCase;
use Web3\Web3;

class UnitTestCase extends BaseTestCase
{
    /**
     * web3
     *
     * @var \Web3\Web3
     */
    protected $web3;


    /**
     * testHost
     *
     * @var string
     */
    protected $testHost = 'http://localhost:8545';


    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        $web3 = new Web3($this->testHost);
        $this->web3 = $web3;
    }

    /**
     * tearDown
     *
     * @return void
     */
    public function tearDown(): void
    {
    }
}