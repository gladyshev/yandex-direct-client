<?php
/**
 * @project yandex-direct-client
 */

namespace Yandex\Direct\Service;

use DOMDocument;
use ReflectionException;
use Yandex\Direct\Exception\ErrorResponseException;
use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

/**
 * Возвращает параметры креативов, отвечающих заданным критериям.
 *
 * @see https://yandex.ru/dev/direct/doc/ref-v5/creatives/creatives-docpage/
 */
final class Creatives extends Service
{
    /**
     * Возвращает параметры креативов, отвечающих заданным критериям.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $VideoExtensionCreativeFieldNames
     * @param array $CpcVideoCreativeFieldNames
     * @param array $CpmVideoCreativeFieldNames
     * @param array $SmartCreativeFieldNames
     * @param array $Page
     * @return array|DOMDocument
     *
     * @throws ErrorResponseException
     * @throws Exception
     * @throws ReflectionException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/creatives/get-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $VideoExtensionCreativeFieldNames = null,
        $CpcVideoCreativeFieldNames = null,
        $CpmVideoCreativeFieldNames = null,
        $SmartCreativeFieldNames = null,
        $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
