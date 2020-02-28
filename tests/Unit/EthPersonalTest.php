<?php

namespace Tests\Unit;

use RuntimeException;
use InvalidArgumentException;
use Tests\UnitTestCase;
use App\EthPersonal;

class EthPersonalTest extends UnitTestCase
{

    public function testNewAccount()
    {
        $personal = new EthPersonal();

        $account = $personal->createEthAccount('password');

        $this->assertTrue(is_string($account));
    }
    /**
     * @test
     */
    public function testUnlockAccountFail()
    {
        $this->expectException(RuntimeException::class);

        $personal = new EthPersonal();

        $personal->unlockAccount('', '1');
    }
    /**
     * @test
     */
    public function testLockAccountFail()
    {
        $this->expectException(RuntimeException::class);

        $personal = new EthPersonal();
        $personal->unlockAccount('', '');

        $personal->lockAccount('');
    }
}