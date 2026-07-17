<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

final class Credentials implements \Gladyshev\Yandex\Direct\CredentialsInterface
{
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
        private readonly string $token,
        private readonly ?string $masterToken,
        private readonly ?string $clientLogin,
        private readonly ?bool $useOperatorUnits,
        private readonly bool $isAgency,
        private readonly string $language,
        private readonly string $baseUrl
    ) {
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

    #[\Override]
    public function getToken(): string
    {
        return $this->token;
    }

    #[\Override]
    public function getMasterToken(): ?string
    {
        return $this->masterToken;
    }

    #[\Override]
    public function getClientLogin(): ?string
    {
        return $this->clientLogin;
    }

    #[\Override]
    public function getUseOperatorUnits(): ?bool
    {
        return $this->useOperatorUnits;
    }

    #[\Override]
    public function getLanguage(): string
    {
        return $this->language;
    }

    #[\Override]
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    #[\Override]
    public function isAgency(): bool
    {
        return $this->isAgency;
    }
}
