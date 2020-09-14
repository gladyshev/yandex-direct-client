<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 23/04/2018 10:12
 */

namespace Gladyshev\Yandex\Direct\Service;

use ReflectionException;


use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class Leads
 *
 * Сервис позволяет получить данные, введенные пользователями в формы на турбо-страницах.
 *
 * @package Gladyshev\Yandex\Direct\Service
 * @see https://tech.yandex.ru/direct/doc/ref-v5/leads/leads-docpage/
 */
final class Leads extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Возвращает данные, введенные пользователями в формы на турбо-страницах.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $Page
     * @return array
     *
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/leads/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
