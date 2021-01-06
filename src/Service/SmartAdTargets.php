<?php

namespace Gladyshev\Yandex\Direct\Service;

use ReflectionException;
use Gladyshev\Yandex\Direct\Exception\ErrorResponseException;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class SmartAdTargets
 *
 * Сервис предназначен для выполнения операций с фильтрами — условиями нацеливания для смарт-баннеров.
 *
 * @see https://yandex.ru/dev/direct/doc/ref-v5/smartadtargets/smartadtargets-docpage/
 */
final class SmartAdTargets extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает фильтры — условия нацеливания для смарт-баннеров, назначает CPC,
     * CPA или приоритет для создаваемых фильтров.
     *
     * @param array $SmartAdTargets
     *
     * @return array
     *
     * @throws ReflectionException
     * @throws ErrorResponseException
     * @throws \Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/smartadtargets/add-docpage/
     */
    public function add($SmartAdTargets)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'add',
            'params' => $params
        ]);
    }

    /**
     * Удаляет фильтры — условия нацеливания для смарт-баннеров.
     *
     * @param array $SelectionCriteria
     *
     * @return array
     *
     * @throws ErrorResponseException
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/smartadtargets/delete-docpage/
     */
    public function delete($SelectionCriteria)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'delete',
            'params' => $params
        ]);
    }

    /**
     * Возвращает параметры фильтров — условий нацеливания для смарт-баннеров.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $Page
     *
     * @return array
     *
     * @throws ErrorResponseException
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/smartadtargets/get-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Возобновляет показы по ранее остановленным фильтрам — условиям нацеливания для смарт-баннеров.
     *
     * @param array $SelectionCriteria
     *
     * @return array
     *
     * @throws ErrorResponseException
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/smartadtargets/resume-docpage/
     */
    public function resume($SelectionCriteria)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'resume',
            'params' => $params
        ]);
    }

    /**
     * Назначает CPC, CPA и приоритеты для фильтров.
     *
     * @param array $Bids
     *
     * @return array
     *
     * @throws ErrorResponseException
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/smartadtargets/setBids-docpage/
     */
    public function setBids($Bids)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'setBids',
            'params' => $params
        ]);
    }

    /**
     * Останавливает показы по фильтрам — условиям нацеливания для смарт-баннеров.
     *
     * @param array $SelectionCriteria
     *
     * @return array
     *
     * @throws ErrorResponseException
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/smartadtargets/suspend-docpage/
     */
    public function suspend($SelectionCriteria)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'suspend',
            'params' => $params
        ]);
    }

    /**
     * Изменяет параметры фильтров — условий нацеливания для смарт-баннеров.
     *
     * @param array $SmartAdTargets
     *
     * @return array
     *
     * @throws ErrorResponseException
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/smartadtargets/update-docpage/
     */
    public function update($SmartAdTargets)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'update',
            'params' => $params
        ]);
    }
}
