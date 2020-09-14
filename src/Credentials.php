<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

final class Credentials implements CredentialsInterface
{
    private $token;
    private $masterToken;
    private $login;
    private $baseUrl;
    private $language;
    private $useOperatorUnits;

    public function __construct(
        string $login,
        string $token,
        string $masterToken = '',
        bool $useOperatorUnits = true,
        string $language = self::LANGUAGE_RU,
        string $baseUrl = self::DEFAULT_BASE_URL
    ) {
        $this->login = $login;
        $this->token = $token;
        $this->masterToken = $masterToken;
        $this->baseUrl = $baseUrl;
        $this->language = $language;
        $this->useOperatorUnits = $useOperatorUnits;
    }

    public static function buildForSandbox(
        string $login,
        string $token,
        string $masterToken = '',
        bool $useOperatorUnits = true,
        string $language = self::LANGUAGE_RU
    ): self {
        return new self(
            $login,
            $token,
            $masterToken,
            $useOperatorUnits,
            $language,
            self::DEFAULT_SANDBOX_BASE_URL
        );
    }

    public function getMasterToken(): string
    {
        return $this->masterToken;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getUseOperatorUnits(): bool
    {
        return $this->useOperatorUnits;
    }
}
