<?php
/**
 * @project yandex-direct-client
 */

namespace Gladyshev\Yandex\Direct\Tests;

use Gladyshev\Yandex\Direct\Credentials;
use Gladyshev\Yandex\Direct\CredentialsInterface;
use PHPUnit\Framework\TestCase;

class CredentialsTest extends TestCase
{
    private $credentials;

    public function setUp(): void
    {
        $this->credentials = new Credentials(
            'token',
            'masterToken',
            'clientLogin',
            true,
            true,
            'language',
            'baseUrl'
        );
    }

    public function testGetToken()
    {
        $this->assertEquals('token', $this->credentials->getToken());
    }

    public function testGetUseOperatorUnits()
    {
        $this->assertEquals(true, $this->credentials->getUseOperatorUnits());
    }

    public function testGetClientLogin()
    {
        $this->assertEquals('clientLogin', $this->credentials->getClientLogin());
    }

    public function testGetMasterToken()
    {
        $this->assertEquals('masterToken', $this->credentials->getMasterToken());
    }

    public function testIsAgency()
    {
        $this->assertEquals(true, $this->credentials->isAgency());
    }

    public function testGetLanguage()
    {
        $this->assertEquals('language', $this->credentials->getLanguage());
    }

    public function testGetBaseUrl()
    {
        $this->assertEquals('baseUrl', $this->credentials->getBaseUrl());
    }

    public function testAgency()
    {
        $credentials = \Gladyshev\Yandex\Direct\Credentials::agency(
            'token',
            'masterToken',
            'login',
            true,
            'language'
        );

        $this->assertInstanceOf(CredentialsInterface::class, $credentials);
        $this->assertEquals(true, $credentials->isAgency());
        $this->assertEquals(CredentialsInterface::DEFAULT_BASE_URL, $credentials->getBaseUrl());
        $this->assertEquals('token', $credentials->getToken());
        $this->assertEquals('masterToken', $credentials->getMasterToken());
        $this->assertEquals('login', $credentials->getClientLogin());
        $this->assertEquals('language', $credentials->getLanguage());
    }

    public function testAgencySandbox()
    {
        $credentials = \Gladyshev\Yandex\Direct\Credentials::agencySandbox(
            'token',
            'masterToken',
            'login',
            true,
            'language'
        );

        $this->assertInstanceOf(CredentialsInterface::class, $credentials);
        $this->assertEquals(true, $credentials->isAgency());
        $this->assertEquals(CredentialsInterface::DEFAULT_SANDBOX_BASE_URL, $credentials->getBaseUrl());
        $this->assertEquals('token', $credentials->getToken());
        $this->assertEquals('masterToken', $credentials->getMasterToken());
        $this->assertEquals('login', $credentials->getClientLogin());
        $this->assertEquals('language', $credentials->getLanguage());
    }

    public function testClient()
    {
        $credentials = \Gladyshev\Yandex\Direct\Credentials::client(
            'token',
            'masterToken',
            'language'
        );

        $this->assertInstanceOf(CredentialsInterface::class, $credentials);
        $this->assertEquals(false, $credentials->isAgency());
        $this->assertEquals(CredentialsInterface::DEFAULT_BASE_URL, $credentials->getBaseUrl());
        $this->assertEquals('token', $credentials->getToken());
        $this->assertEquals('masterToken', $credentials->getMasterToken());
        $this->assertEquals(null, $credentials->getClientLogin());
        $this->assertEquals(null, $credentials->getUseOperatorUnits());
        $this->assertEquals('language', $credentials->getLanguage());
    }

    public function testClientSandbox()
    {
        $credentials = Credentials::clientSandbox(
            'token',
            'masterToken',
            'language'
        );

        $this->assertInstanceOf(CredentialsInterface::class, $credentials);
        $this->assertEquals(false, $credentials->isAgency());
        $this->assertEquals(CredentialsInterface::DEFAULT_SANDBOX_BASE_URL, $credentials->getBaseUrl());
        $this->assertEquals('token', $credentials->getToken());
        $this->assertEquals('masterToken', $credentials->getMasterToken());
        $this->assertEquals(null, $credentials->getClientLogin());
        $this->assertEquals(null, $credentials->getUseOperatorUnits());
        $this->assertEquals('language', $credentials->getLanguage());
    }
}
