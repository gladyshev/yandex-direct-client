<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:34
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

/**
 * Class Keywords
 * @package Yandex\Direct\Service
 */
final class Keywords extends Service
{
    /**
     * Создает ключевые фразы.
     *
     * @param array $Keywords
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywords/add-docpage/
     */
    public function add($Keywords)
    {
        return $this->request([
            'method' => 'add',
            'params' => [
                'Keywords' => $Keywords
            ]
        ]);
    }

    /**
     * Удаляет ключевые фразы.
     *
     * @param array $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywords/delete-docpage/
     */
    public function delete($SelectionCriteria)
    {
        return $this->request([
            'method' => 'delete',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * Возвращает параметры ключевых фраз, отвечающих заданным критериям: значения подстановочных переменных,
     * статус и состояние, продуктивность, статистику показов и кликов, ставки и приоритеты.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $Page
     * @return array
     * @throws Exception
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywords/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Возобновляет показы по ранее остановленным ключевым фразам.
     *
     * @param array $SelectionCriteria
     * @return array
     * @throws Exception
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywords/resume-docpage/
     */
    public function resume($SelectionCriteria)
    {
        return $this->request([
            'method' => 'resume',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * Останавливает показы по ключевым фразам.
     *
     * @param array $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywords/suspend-docpage/
     */
    public function suspend($SelectionCriteria)
    {
        return $this->request([
            'method' => 'suspend',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * Изменяет параметры фраз.
     *
     * @param array $Keywords
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywords/update-docpage/
     */
    public function update($Keywords)
    {
        return $this->request([
            'method' => 'update',
            'params' => [
                'Keywords' => $Keywords
            ]
        ]);
    }
}
