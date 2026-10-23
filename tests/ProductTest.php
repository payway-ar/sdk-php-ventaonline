<?php

namespace Decidir\Tests;

use Decidir\Cybersource\Product;
use Decidir\Exception\EmptyValue;
use Decidir\Exception\RequiredValue;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private function data()
    {
        return array(
            'csitproductcode' => 'popblacksabbat',
            'csitproductdescription' => 'desc',
            'csitproductname' => 'name',
            'csitproductsku' => 'sku1',
            'csittotalamount' => 100,
            'csitquantity' => 1,
            'csitunitprice' => 100,
        );
    }

    public function testValidProductConstructs()
    {
        $p = new Product($this->data());
        $this->assertInstanceOf(\Decidir\Data\AbstractData::class, $p);
    }

    public function testMissingRequiredFieldThrows()
    {
        $d = $this->data();
        unset($d['csitproductsku']);
        $this->expectException(RequiredValue::class);
        new Product($d);
    }

    public function testEmptyRequiredFieldThrows()
    {
        $d = $this->data();
        $d['csitproductname'] = '';
        $this->expectException(EmptyValue::class);
        new Product($d);
    }

    public function testUnknownFieldThrowsTypeErrorBecauseNoOptionalFieldsAreDeclared()
    {
        // Documents current behavior: Product never sets optional fields, so
        // AbstractData ends up calling array_key_exists() on null.
        $d = $this->data();
        $d['bogus'] = 'x';
        $this->expectException(\TypeError::class);
        new Product($d);
    }
}
