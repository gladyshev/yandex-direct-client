<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

final class AgencyCredentials implements \Gladyshev\Yandex\Direct\CredentialsInterface
{
    private $token;
    private $masterToken;
    private $login;
    private $useOperatorUnits;
    private $language;
    private $baseUrl;

    public function __construct(
        string $token,
        ?string $masterToken,
        ?string $clientLogin,
        ?bool $useOperatorUnits,
        string $language,
        string $baseUrl
    ) {
        $this->token = $token;
        $this->masterToken = $masterToken;
        $this->login = $clientLogin;
        $this->useOperatorUnits = $useOperatorUnits;
        $this->language = $language;
        $this->baseUrl = $baseUrl;
    }

    public static function buildForSandbox(
        string $token,
        ?string $masterToken = null,
        ?string $login = null,
        ?bool $useOperatorUnits = true,
        string $language = self::LANGUAGE_RU,
        string $baseUrl = self::DEFAULT_SANDBOX_BASE_URL
    ): self {
        return new self(
            $token,
            $masterToken,
            $login,
            $useOperatorUnits,
            $language,
            $baseUrl
        );
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string|null
     */
    public function getMasterToken(): ?string
    {
        return $this->masterToken;
    }

    /**
     * @return string|null
     */
    public function getClientLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @return bool|null
     */
    public function getUseOperatorUnits(): ?bool
    {
        return $this->useOperatorUnits;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function isAgency(): bool
    {
        return true;
    }
}
