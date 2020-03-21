<?php
declare(strict_types=1);

namespace App\Tests\App\Business\Model;

use App\Business\Model\FindEntity;
use App\Redis\RedisService;
use App\Redis\RedisServiceInterface;
use MessageInfo\NumberAPIDataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FindEntityTest extends KernelTestCase
{

    /**
     * @var \App\Redis\RedisServiceInterface
     */
    private $redis;

    /**
     * @var \App\Business\Model\FindEntity
     */
    private FindEntity $finder;

    protected function setUp()
    {
        parent::setUp();
        static::bootKernel();

        $this->finder = self::$container->get(FindEntity::class);
        $this->redis = self::$container->get(RedisServiceInterface::class);

        $transfer = new NumberAPIDataProvider();
        $transfer->setNumber('testkey');
        $transfer->setDoctorId(1);
        $transfer->setStatus(true);

        $this->redis->set('testkey', json_encode($transfer->toArray(), JSON_THROW_ON_ERROR, 512));
    }

    protected function tearDown(): void
    {
        $this->redis->delete('testkey');
        parent::tearDown();
    }

    public function testGetByNumber(): void
    {

        $data = $this->finder->getByNumber('testkey');

        $this->assertTrue($data->getStatus());
        $this->assertSame(1, $data->getDoctorId());
    }

    public function testGetAll(): void
    {
        $data = $this->finder->getAll();

        foreach($data->getNumbers() as $item) {
            $this->assertIsBool($item->getStatus());
            $this->assertIsString($item->getNumber());
        }
    }
}
