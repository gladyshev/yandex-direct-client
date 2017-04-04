<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 04.04.17 12:00
 */

namespace Yandex\Direct\Test;

use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

/**
 * Class Helper
 * @package Yandex\Direct\Test
 */
class Helper
{
    /**
     * getPrivateProperty
     *
     * @author	Joe Sexton <joe@webtipblog.com>
     * @param 	string $className
     * @param 	string $propertyName
     * @return	ReflectionProperty
     */
    public static function getPrivateProperty( $className, $propertyName ) {
        $reflector = new ReflectionClass( $className );
        $property = $reflector->getProperty( $propertyName );
        $property->setAccessible( true );

        return $property;
    }

    /**
     * Get a private or protected method for testing/documentation purposes.
     * How to use for MyClass->foo():
     *      $cls = new MyClass();
     *      $foo = PHPUnitUtil::getPrivateMethod($cls, 'foo');
     *      $foo->invoke($cls, $...);
     * @param object $obj The instantiated instance of your class
     * @param string $name The name of your private/protected method
     * @return ReflectionMethod The method you asked for
     */
    public static function getPrivateMethod($obj, $name) {
        $class = new ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}