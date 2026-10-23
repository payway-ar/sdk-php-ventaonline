<?php

namespace Decidir\Tests;

use Decidir\Data\Response;
use Decidir\Exception\SdkException;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testGettersWithSnakeCaseKeys()
    {
        $r = new Response(array('site_transaction_id' => 'abc', 'amount' => 100));
        $this->assertSame('abc', $r->getSiteTransactionId());
        $this->assertSame(100, $r->getAmount());
    }

    public function testSetterReturnsSelfAndUpdates()
    {
        $r = new Response(array('amount' => 100));
        $this->assertSame($r, $r->setAmount(200));
        $this->assertSame(200, $r->getAmount());
    }

    public function testStatusDetailsReturnsStdClass()
    {
        $r = new Response(array('status_details' => array('ticket' => '1', 'card_authorization_code' => 'x')));
        $details = $r->getStatusDetails();
        $this->assertInstanceOf(\stdClass::class, $details);
        $this->assertSame('1', $details->ticket);
    }

    public function testUnknownPropertyThrowsSdkException()
    {
        $r = new Response(array('amount' => 1));
        $this->expectException(SdkException::class);
        $this->expectExceptionMessage('Property nope not exists');
        $r->getNope();
    }

    public function testErrorTypeInDataThrows()
    {
        try {
            new Response(array('error_type' => 'invalid_request_error'));
            $this->fail('expected exception');
        } catch (SdkException $e) {
            $this->assertSame('invalid_request_error', $e->getMessage());
            $this->assertSame(400, $e->getCode());
            $this->assertSame(array('error_type' => 'invalid_request_error'), $e->getData());
        }
    }

    public function testGetDataFieldValue()
    {
        $r = new Response(array('amount' => 5));
        $this->assertSame(5, $r->getDataFieldValue('amount'));
        $this->assertNull($r->getDataFieldValue('missing'));
    }

    public function testNonAccessorMethodReturnsNull()
    {
        $r = new Response(array('amount' => 5));
        $this->assertNull($r->doSomething());
    }
}
