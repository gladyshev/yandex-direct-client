<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 08.12.16 16:07
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

/**
 * Class AudienceTargets
 * @package Yandex\Direct\Service
 */
final class AudienceTargets extends Service
{
    /**
     * Создает условия нацеливания на аудиторию, назначает ставки и приоритеты для создаваемых ретаргетингов.
     *
     * @param $AudienceTargets
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/add-docpage/
     */
    public function add($AudienceTargets)
    {
        return $this->request([
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
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/delete-docpage/
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
     * Возвращает параметры условий нацеливания на аудиторию.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @throws Exception
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/get-docpage/
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
     * Возобновляет показы по ранее остановленным условиям нацеливания на аудиторию.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/resume-docpage/
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
     * Назначает ставки и приоритеты для условий нацеливания на аудиторию.
     *
     * @param $Bids
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/setBids-docpage/
     */
    public function setBids($Bids)
    {
        return $this->request([
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
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/audiencetargets/suspend-docpage/
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
}
