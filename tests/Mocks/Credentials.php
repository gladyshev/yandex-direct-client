<?php

namespace Gladyshev\Yandex\Direct\Tests\Mocks;

use Gladyshev\Yandex\Direct\CredentialsInterface;

class Credentials implements CredentialsInterface
{
    public function getToken(): string
    {
        return '';
    }

    public function getClientLogin(): ?string
    {
        return '';
    }

    public function getMasterToken(): ?string
    {
        return '';
    }

    public function getUseOperatorUnits(): ?bool
    {
        return true;
    }

    public function getLanguage(): string
    {
        return self::LANGUAGE_RU;
    }

    public function getBaseUrl(): string
    {
        return self::DEFAULT_SANDBOX_BASE_URL;
    }

    public function isAgency(): bool
    {
        return true;
    }
}