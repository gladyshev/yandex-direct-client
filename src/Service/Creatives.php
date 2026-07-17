<?php

namespace Gladyshev\Yandex\Direct\Service;

use DOMDocument;
use ReflectionException;
use Gladyshev\Yandex\Direct\Exception\ErrorResponseException;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Возвращает параметры креативов, отвечающих заданным критериям.
 *
 * @see https://yandex.ru/dev/direct/doc/ref-v5/creatives/creatives-docpage/
 */
final class Creatives extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Возвращает параметры креативов, отвечающих заданным критериям.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array|null $VideoExtensionCreativeFieldNames
     * @param array|null $CpcVideoCreativeFieldNames
     * @param array|null $CpmVideoCreativeFieldNames
     * @param array|null $SmartCreativeFieldNames
     * @param array|null $Page
     * @return array|DOMDocument
     *
     * @throws ErrorResponseException
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/creatives/get-docpage/
     */
    public function get(
        mixed $SelectionCriteria,
        mixed $FieldNames,
        mixed $VideoExtensionCreativeFieldNames = null,
        mixed $CpcVideoCreativeFieldNames = null,
        mixed $CpmVideoCreativeFieldNames = null,
        mixed $SmartCreativeFieldNames = null,
        mixed $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
