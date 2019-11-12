<?php
/**
 * @project yandex-direct-client
 */

namespace Yandex\Direct\Service;

use DOMDocument;
use Yandex\Direct\Exception\ErrorResponseException;
use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

/**
 * Class TurboPages
 *
 * @author Dmitry Gladyshev <deel@email.ru>
 * @since 2.5
 */
final class TurboPages extends Service
{
    /**
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array|null $Page
     * @return array|DOMDocument
     *
     * @throws ErrorResponseException
     * @throws Exception
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/turbopages/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
