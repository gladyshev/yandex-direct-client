<?php

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class TurboPages
 *
 * @author Dmitry Gladyshev <deel@email.ru>
 * @since 2.5
 */
final class TurboPages extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array|null $Page
     * @return array|\DOMDocument
     *
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/turbopages/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
