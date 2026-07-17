<?php

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class Businesses
 *
 * @author Dmitry Gladyshev <gladyshevd@icloud.com>
 *
 * @see https://yandex.ru/dev/direct/doc/ref-v5/businesses/businesses-docpage/
 */
final class Businesses extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array|null $Page
     *
     * @return array|\DOMDocument
     *
     * @throws \ReflectionException
     * @throws \Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/businesses/get-docpage/
     */
    public function get(
        mixed $SelectionCriteria,
        mixed $FieldNames,
        mixed $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
