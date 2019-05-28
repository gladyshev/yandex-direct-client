<?php
/**
 * @project yandex-direct-client
 */

namespace Yandex\Direct\Service;

use DOMDocument;
use Throwable;
use Yandex\Direct\Exception\ErrorResponseException;
use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;

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
     * @throws Throwable
     * @throws ErrorResponseException
     * @throws Exception
     * @see https://tech.yandex.ru/direct/doc/ref-v5/turbopages/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = array_filter([
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames' => $FieldNames,
            'Page' => $Page
        ]);

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
