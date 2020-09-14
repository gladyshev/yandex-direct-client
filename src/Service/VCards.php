<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class VCards
 *
 * @author Dmitry Gladyshev <gladyshevd@icloud.com>
 */
final class VCards extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает виртуальные визитки.
     *
     * @param $VCards
     * @return array
     *
     * @throws \Throwable
     * @throws \Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/vcards/add-docpage/
     */
    public function add($VCards)
    {
        return $this->call([
            'method' => 'add',
            'params' => [
                'VCards' => $VCards
            ]
        ]);
    }

    /**
     * Удаляет виртуальные визитки.
     *
     * @param $SelectionCriteria
     * @return array
     *
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/vcards/delete-docpage/
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
     * Возвращает виртуальные визитки, отвечающие заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     *
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/vcards/get-docpage/
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
