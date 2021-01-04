<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

final class ClientCredentials implements CredentialsInterface
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string|null
     */
    private $masterToken;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $baseUrl;

    public function __construct(
        string $token,
        ?string $masterToken,
        string $language,
        string $baseUrl
    ) {
        $this->token = $token;
        $this->masterToken = $masterToken;
        $this->language = $language;
        $this->baseUrl = $baseUrl;
    }

    public static function build(
        string $token,
        ?string $masterToken = null,
        string $language = self::LANGUAGE_RU,
        string $baseUrl = self::DEFAULT_BASE_URL
    ): self {
        return new self(
            $token,
            $masterToken,
            $language,
            $baseUrl
        );
    }

    public static function buildForSandbox(
        string $token,
        ?string $masterToken = null,
        string $language = self::LANGUAGE_RU,
        string $baseUrl = self::DEFAULT_SANDBOX_BASE_URL
    ): self {
        return new self(
            $token,
            $masterToken,
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

    public function getClientLogin(): ?string
    {
        return null;
    }

    public function getUseOperatorUnits(): ?bool
    {
        return null;
    }

    public function isAgency(): bool
    {
        return false;
    }
}
