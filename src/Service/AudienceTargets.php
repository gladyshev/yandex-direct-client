<?php

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class AudienceTargets
 * @package Gladyshev\Yandex\Direct\Service
 */
final class AudienceTargets extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает условия нацеливания на аудиторию, назначает ставки и приоритеты для создаваемых ретаргетингов.
     *
     * @param $AudienceTargets
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/add-docpage/
     */
    public function add($AudienceTargets)
    {
        return $this->call([
            'method' => 'add',
            'params' => [
                'AudienceTargets' => $AudienceTargets
            ]
        ]);
    }

    /**
     * Удаляет условия нацеливания на аудиторию.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/delete-docpage/
     */
    public function delete($SelectionCriteria)
    {
        return $this->call([
            'method' => 'delete',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * Возвращает параметры условий нацеливания на аудиторию.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @throws \Throwable
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Возобновляет показы по ранее остановленным условиям нацеливания на аудиторию.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/resume-docpage/
     */
    public function resume($SelectionCriteria)
    {
        return $this->call([
            'method' => 'resume',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * Назначает ставки и приоритеты для условий нацеливания на аудиторию.
     *
     * @param $Bids
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/setBids-docpage/
     */
    public function setBids($Bids)
    {
        return $this->call([
            'method' => 'setBids',
            'params' => [
                'Bids' => $Bids
            ]
        ]);
    }

    /**
     * Останавливает показы по условиям нацеливания на аудиторию.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/suspend-docpage/
     */
    public function suspend($SelectionCriteria)
    {
        return $this->call([
            'method' => 'suspend',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }
}
