<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

/**
 * Class CredentialsInterface
 */
interface CredentialsInterface
{
    public const DEFAULT_BASE_URL = 'https://api.direct.yandex.com';
    public const DEFAULT_SANDBOX_BASE_URL = 'https://api-sandbox.direct.yandex.com';

    public const LANGUAGE_RU = 'ru';
    public const LANGUAGE_EN = 'en';
    public const LANGUAGE_TR = 'tr';
    public const LANGUAGE_UK = 'uk';

    /**
     * @return string
     */
    public function getLogin(): string;

    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return string
     */
    public function getMasterToken(): string;

    /**
     * @return string
     */
    public function getLanguage(): string;

    /**
     * @return bool
     */
    public function getUseOperatorUnits(): bool;

    /**
     * Returns base URL, ex. https://api.direct.yandex.com
     * @return string
     */
    public function getBaseUrl(): string;
}
