<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

final class Credentials implements \Gladyshev\Yandex\Direct\CredentialsInterface
{
    private string $token;
    private ?string $masterToken;
    private ?string $clientLogin;
    private ?bool $useOperatorUnits;
    private bool $isAgency;
    private string $language;
    private string $baseUrl;

    /**
     * @param string $token                 # OAuth2 токен доступа
     * @param string|null $masterToken      # Токен для финансовых операций (не поддерживается API V5)
     * @param string|null $clientLogin      # Логин клиента Агентства (если isAgency = true, иначе NULL)
     * @param bool|null $useOperatorUnits   # Расходовать баллы агентства (если isAgency = true, иначе NULL)
     * @param bool $isAgency                # Аккаунт Агентства или Клиента
     * @param string $language              # Язык в тексте ответов
     * @param string $baseUrl               # URL сервера API
     */
    public function __construct(
        string $token,
        ?string $masterToken,
        ?string $clientLogin,
        ?bool $useOperatorUnits,
        bool $isAgency,
        string $language,
        string $baseUrl
    ) {
        $this->token = $token;
        $this->masterToken = $masterToken;
        $this->clientLogin = $clientLogin;
        $this->useOperatorUnits = $useOperatorUnits;
        $this->language = $language;
        $this->baseUrl = $baseUrl;
        $this->isAgency = $isAgency;
    }

    public static function agency(
        string $token,
        ?string $masterToken = null,
        ?string $clientLogin = null,
        bool $useOperatorUnits = true,
        string $language = self::LANGUAGE_RU
    ): self {
        return new self(
            $token,
            $masterToken,
            $clientLogin,
            $useOperatorUnits,
            true,
            $language,
            self::DEFAULT_BASE_URL
        );
    }

    public static function agencySandbox(
        string $token,
        ?string $masterToken = null,
        ?string $login = null,
        bool $useOperatorUnits = true,
        string $language = self::LANGUAGE_RU
    ): self {
        return new self(
            $token,
            $masterToken,
            $login,
            $useOperatorUnits,
            true,
            $language,
            self::DEFAULT_SANDBOX_BASE_URL
        );
    }

    public static function client(
        string $token,
        ?string $masterToken = null,
        string $language = self::LANGUAGE_RU
    ): self {
        return new self(
            $token,
            $masterToken,
            null,
            null,
            false,
            $language,
            self::DEFAULT_BASE_URL
        );
    }

    public static function clientSandbox(
        string $token,
        ?string $masterToken = null,
        string $language = self::LANGUAGE_RU
    ): self {
        return new self(
            $token,
            $masterToken,
            null,
            null,
            false,
            $language,
            self::DEFAULT_SANDBOX_BASE_URL
        );
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getMasterToken(): ?string
    {
        return $this->masterToken;
    }

    public function getClientLogin(): ?string
    {
        return $this->clientLogin;
    }

    public function getUseOperatorUnits(): ?bool
    {
        return $this->useOperatorUnits;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function isAgency(): bool
    {
        return $this->isAgency;
    }
}
