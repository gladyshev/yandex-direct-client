<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct\Tests;

use Gladyshev\Yandex\Direct\Exception\ServiceNotFoundException;
use Gladyshev\Yandex\Direct\ServiceInterface;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    protected $client;

    public function setUp(): void
    {
        $this->client = new \Gladyshev\Yandex\Direct\Client(
            new \Gladyshev\Yandex\Direct\Tests\Mocks\Credentials,
            new \GuzzleHttp\Client
        );
    }

    /**
     * @dataProvider validServicesDataProvider
     */
    public function testCreateService(string $serviceName): void
    {
        $instance = $this->client->createService($serviceName);

        $this->assertInstanceOf(ServiceInterface::class, $instance);
    }

    /**
     * @dataProvider validServicesDataProvider
     */
    public function testMagicCreateService(string $serviceName): void
    {
        $instance = $this->client->{$serviceName};

        $this->assertInstanceOf(ServiceInterface::class, $instance);
    }

    /**
     * @dataProvider invalidServicesDataProvider
     */
    public function testExceptionOnInvalidServiceName(string $serviceName): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->client->createService($serviceName);
    }

    /**
     * @dataProvider invalidServicesDataProvider
     */
    public function testExceptionOnInvalidServiceNameWithMagicCreate(string $serviceName): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->client->{$serviceName};
    }

    public function invalidServicesDataProvider(): array
    {
        return [
            ['foo'],
            ['bar'],
            ['buzz']
        ];
    }

    public function validServicesDataProvider(): array
    {
        $dir = new \FilesystemIterator(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Service'
        );

        $services = [];

        foreach ($dir as $fileInfo) {
            if ($fileInfo->isFile()) {
                $services[] = [$fileInfo->getBasename('.php')];
            }
        }

        return $services;
    }
}
