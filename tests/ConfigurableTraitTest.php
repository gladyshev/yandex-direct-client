<?php
/**
 * @author Dmitry Gladyshev <dgladyshev@seopult.ru>
 * @created 11.12.16 20:03
 */

namespace Yandex\Direct\Test;


use PHPUnit\Framework\TestCase;
use Yandex\Direct\ConfigurableTrait;


class ConfigurableTraitTest extends TestCase
{
    /**
     * @expectedException \Yandex\Direct\Exception\InvalidArgumentException
     */
    public function testSetOptionThrowsExceptionWithoutIgnoreFlag()
    {
        $mock = $this->buildConfigurableClass();
        $mock->setOptions(['incorrectName' => 100], false);
    }

    public function testSetOptionDoNotThrowsExceptionWithIgnoreFlag()
    {
        $mock = $this->buildConfigurableClass();
        $mock->setOptions(['incorrectName' => 100], true);
    }


    public function testUseSetterIfExist()
    {
        $mock = $this->buildConfigurableClass();
        $mock->setOptions(['withSetterProperty' => 2]);
        $this->assertEquals($mock->withSetterProperty, 3);  // Setter logic: 2 + 1
    }

    public function testInitPublicProperty()
    {
        $mock = $this->buildConfigurableClass();
        $mock->setOptions(['withoutSetterProperty' => 2]);
        $this->assertEquals($mock->withoutSetterProperty, 2);
    }


    protected function buildConfigurableClass()
    {
        return new MockClassForTestingConfigurableTrait();
    }
}

class MockClassForTestingConfigurableTrait
{
    use ConfigurableTrait;

    public $withoutSetterProperty;
    public $withSetterProperty;

    public function setWithSetterProperty($value)
    {
        $this->withSetterProperty = $value + 1;
    }
}