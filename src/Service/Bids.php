<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:32
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

/**
 * Class Bids
 * @package Yandex\Direct\Service
 */
final class Bids extends Service
{
    /**
     * Назначает фиксированные ставки и приоритеты для ключевых фраз.
     *
     * @param $Bids
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bids/set-docpage/
     */
    public function set($Bids)
    {
        return $this->request([
            'method' => 'set',
            'params' => [
                'Bids' => $Bids
            ]
        ]);
    }

    /**
     * Конструктор ставок — рассчитывает ставки для фраз по заданному алгоритму.
     *
     * @param $Bids
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bids/setAuto-docpage/
     */
    public function setAuto($Bids)
    {
        return $this->request([
            'method' => 'setAuto',
            'params' => [
                'Bids' => $Bids
            ]
        ]);
    }

    /**
     * Возвращает ставки и приоритеты для ключевых фраз, отвечающих заданным критериям, а также данные,
     * полезные при подборе ставок: данные аукциона по позициям показа на поиске и ставки для охвата различных
     * долей аудитории в сетях.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @throws Exception
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bids/get-docpage/
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
