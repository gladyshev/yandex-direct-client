<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

/**
 * Interface ServiceInterface
 *
 * @author Dmitry Gladyshev <gladyshevd@icloud.com>
 */
interface ServiceInterface {
    /**
     * Create Yandex Direct API Request by Params.
     *
     * @param array $params
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function call(array $params = []);

    public function getName(): string;
}
