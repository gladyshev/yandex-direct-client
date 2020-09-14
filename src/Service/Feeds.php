<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 26/08/20120 21:34
 */

namespace Gladyshev\Yandex\Direct\Service;

use ReflectionException;
use Gladyshev\Yandex\Direct\Exception\ErrorResponseException;


use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class Feeds
 *
 * Сервис предназначен для выполнения операций с фидами.
 *
 * @see https://yandex.ru/dev/direct/doc/ref-v5/feeds/feeds-docpage/
 */
final class Feeds extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает фиды.
     *
     * @param array $Feeds
     *
     * @return array
     *
     * @throws ReflectionException
     * @throws ErrorResponseException
     * @throws \Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/feeds/add-docpage/
     */
    public function add($Feeds)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'add',
            'params' => $params
        ]);
    }

    /**
     * Удаляет фиды.
     *
     * @param array $SelectionCriteria
     *
     * @return array
     *
     * @throws ReflectionException
     * @throws ErrorResponseException
     * @throws \Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/feeds/delete-docpage/
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
     * Возвращает параметры фидов, отвечающих заданным критериям.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $FileFeedFieldNames
     * @param array $UrlFeedFieldNames
     * @param array $Page
     *
     * @return array
     *
     * @throws ErrorResponseException
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/feeds/get-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $FileFeedFieldNames = null,
        $UrlFeedFieldNames = null,
        $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Изменяет параметры фида.
     *
     * @param array $Feeds
     *
     * @return array
     *
     * @throws ErrorResponseException
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/feeds/update-docpage/
     */
    public function update($Feeds)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'update',
            'params' => $params
        ]);
    }
}
