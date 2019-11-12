<?php
/**
 * @project yandex-direct-client
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

/**
 * Возвращает параметры креативов, отвечающих заданным критериям.
 *
 * @author Dmitry Gladyshev <deel@email.ru>
 */
final class Creatives extends Service
{
    /**
     * Возвращает параметры креативов, отвечающих заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $VideoExtensionCreativeFieldNames
     * @param $CpcVideoCreativeFieldNames
     * @param $CpmVideoCreativeFieldNames
     * @param $Page
     * @return array|\DOMDocument
     *
     * @throws \ReflectionException
     * @throws \Yandex\Direct\Exception\ErrorResponseException
     * @throws \Yandex\Direct\Exception\Exception
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $VideoExtensionCreativeFieldNames = null,
        $CpcVideoCreativeFieldNames = null,
        $CpmVideoCreativeFieldNames = null,
        $Page = null
    )
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
