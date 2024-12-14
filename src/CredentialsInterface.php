<?php

namespace Gladyshev\Yandex\Direct;

interface CredentialsInterface
{
    public const DEFAULT_BASE_URL = 'https://api.direct.yandex.com';
    public const DEFAULT_SANDBOX_BASE_URL = 'https://api-sandbox.direct.yandex.com';

    public const LANGUAGE_RU = 'ru';
    public const LANGUAGE_EN = 'en';
    public const LANGUAGE_TR = 'tr';
    public const LANGUAGE_UK = 'uk';

    public function getToken(): string;
    public function getClientLogin(): ?string;
    public function getMasterToken(): ?string;
    public function getUseOperatorUnits(): ?bool;
    public function getLanguage(): string;
    public function getBaseUrl(): string;
    public function isAgency(): bool;
}
