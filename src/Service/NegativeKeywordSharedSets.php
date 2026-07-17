<?php

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Сервис предназначен для выполнения операций с наборами минус-фраз.
 *
 * @author Dmitry Gladyshev <deel@email.ru>
 */
final class NegativeKeywordSharedSets extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает наборы минус-фраз.
     *
     * @param $NegativeKeywordSharedSets
     * @return array|\DOMDocument
     *
     * @throws \Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/negativekeywordsharedsets/add-docpage/
     */
    public function add(mixed $NegativeKeywordSharedSets)
    {
        return $this->call([
            'method' => 'add',
            'params' => [
                'NegativeKeywordSharedSets' => $NegativeKeywordSharedSets
            ]
        ]);
    }

    /**
     * Изменяет наборы минус-фраз.
     *
     * @param $NegativeKeywordSharedSets
     * @return array|\DOMDocument
     *
     * @throws \Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/negativekeywordsharedsets/update-docpage/
     */
    public function update(mixed $NegativeKeywordSharedSets)
    {
        return $this->call([
            'method' => 'update',
            'params' => [
                'NegativeKeywordSharedSets' => $NegativeKeywordSharedSets
            ]
        ]);
    }

    /**
     * Возвращает наборы минус-фраз.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array|\DOMDocument
     *
     * @throws \ReflectionException
     * @throws \Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/negativekeywordsharedsets/get-docpage/
     */
    public function get(mixed $SelectionCriteria, mixed $FieldNames, mixed $Page = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Удаляет наборы минус-фраз.
     *
     * @param $SelectionCriteria
     * @return array|\DOMDocument
     *
     * @throws \Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/negativekeywordsharedsets/delete-docpage/
     */
    public function delete(mixed $SelectionCriteria)
    {
        return $this->call([
            'method' => 'delete',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }
}
