<?php
declare(strict_types=1);

namespace App\Tests\App\Business\Model;

use App\Business\Model\FindEntity;
use App\Business\Model\Persist;
use MessageInfo\NumberAPIDataProvider;
use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PersistTest extends KernelTestCase
{
    /**
     * @var \App\Business\Model\Persist
     */
    private $persist;

    /**
     * @var \App\Redis\RedisService
     */
    private $redis;

    protected function setUp()
    {
        parent::setUp();
        static::bootKernel();

        $this->persist = self::$container->get(Persist::class);
        $this->redis = self::$container->get(RedisService::class);
    }

    protected function tearDown(): void
    {
        /** @var \App\Redis\RedisService $redis */
        $this->redis->delete('abc');
        parent::tearDown();
    }

    public function testPersist(): void
    {
        $transfer = new NumberCreationRequestAPIDataProvider();
        $transfer->setDoctorId(1);
        $transfer->setNumber('abc');
        $transfer->setCreationDate('2020-01-01 01:30:21');

        $this->persist->persistCreation($transfer);

        dd($this->redis->get('abc'));
        $this->assertJson('', $this->redis->get('abc'));

        $transfer = new NumberChangeStateRequestAPIDataProvider();
        $transfer->setNumber('abc');
        $transfer->setStatus(true);
        $transfer->setModifiedStateDate('2020-01-01 01:30:21');

        $this->persist->persistChange($transfer);
    }
}
