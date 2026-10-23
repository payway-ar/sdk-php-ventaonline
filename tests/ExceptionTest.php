<?php

namespace Decidir\Tests;

use Decidir\Exception\AllowValue;
use Decidir\Exception\EmptyValue;
use Decidir\Exception\RequiredValue;
use Decidir\Exception\SdkException;
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    public function testSdkExceptionCarriesMessageCodeAndData()
    {
        $e = new SdkException('boom', 400, array('a' => 1));
        $this->assertSame('boom', $e->getMessage());
        $this->assertSame(400, $e->getCode());
        $this->assertSame(array('a' => 1), $e->getData());
        $this->assertNull($e->getPrevious());
    }

    public function testSdkExceptionKeepsPrevious()
    {
        $prev = new \Exception('inner');
        $e = new SdkException('outer', 1, null, $prev);
        $this->assertSame($prev, $e->getPrevious());
    }

    public function testRequiredValue()
    {
        $e = new RequiredValue('amount');
        $this->assertSame('Campo: amount es obligatorio.', $e->getMessage());
        $this->assertSame(99977, $e->getCode());
        $this->assertSame('amount', $e->getData());
        $this->assertInstanceOf(SdkException::class, $e);
    }

    public function testEmptyValue()
    {
        $e = new EmptyValue('amount');
        $this->assertSame('Campo: amount no puede estar vacio.', $e->getMessage());
        $this->assertSame('amount', $e->getData());
    }

    public function testAllowValue()
    {
        $e = new AllowValue('foo');
        $this->assertSame('Campo: foo no es requerido.', $e->getMessage());
        $this->assertSame('foo', $e->getData());
    }
}
