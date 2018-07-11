<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 23/04/2018 10:12
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;

/**
 * Class Leads
 *
 * Сервис позволяет получить данные, введенные пользователями в формы на турбо-страницах.
 *
 * @package Yandex\Direct\Service
 * @see https://tech.yandex.ru/direct/doc/ref-v5/leads/leads-docpage/
 */
final class Leads extends Service
{
    /**
     * Возвращает данные, введенные пользователями в формы на турбо-страницах.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $Page
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/leads/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = [
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames' => $FieldNames
        ];

        if ($Page) {
            $params['Page'] = $Page;
        }

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
