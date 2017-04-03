<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 13.12.16 12:21
 */

namespace Yandex\Direct\Test;


use PHPUnit\Framework\TestCase;
use Yandex\Direct\Credentials;
use Yandex\Direct\CredentialsInterface;


class CredentialsTest extends TestCase
{
    public function testMustImplementCredentialsInterface()
    {
        $this->assertInstanceOf(CredentialsInterface::class, new Credentials);
    }

    public function testCorrectGetters()
    {
        $login = '1';
        $token = '2';
        $masterToken = '3';

        $c = new Credentials($login, $token, $masterToken);

        $this->assertEquals($login, $c->getLogin());
        $this->assertEquals($token, $c->getToken());
        $this->assertEquals($masterToken, $c->getMasterToken());
    }
}
