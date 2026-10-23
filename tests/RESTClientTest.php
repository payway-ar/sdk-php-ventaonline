<?php

namespace Decidir\Tests;

use Decidir\RESTClient;
use PHPUnit\Framework\TestCase;

class RESTClientTest extends TestCase
{
    private function client($mode = 'test', $developer = 'dev', $grouper = 'grp', $service = 'SDK-PHP')
    {
        return new RESTClient(array(
            'public_key' => 'pub',
            'private_key' => 'priv',
            'form_apikey' => 'fkey',
            'form_site' => 'fsite',
            'x_consumer_username' => 'user',
        ), $mode, $developer, $grouper, $service);
    }

    public function testEndpointPerMode()
    {
        $this->assertSame(RESTClient::DECIDIR_ENDPOINT_TEST . '/api/v2/payments', $this->urlFor('test', 'payments'));
        $this->assertSame(RESTClient::DECIDIR_ENDPOINT_PROD . '/api/v2/payments', $this->urlFor('prod', 'payments'));
        $this->assertSame(RESTClient::DECIDIR_ENDPOINT_QA . '/api/v2/payments', $this->urlFor('qa', 'payments'));
        $this->assertSame(RESTClient::DECIDIR_ENDPOINT_DESA . '/api/v2/payments', $this->urlFor('desa', 'payments'));
    }

    public function testSpecialUrls()
    {
        $base = RESTClient::DECIDIR_ENDPOINT_TEST;
        $this->assertSame($base . '/api/v1/closures/batchclosure', $this->urlFor('test', 'closures/batchclosure'));
        $this->assertSame($base . '/api/v1/checkout-payment-button/link', $this->urlFor('test', 'checkout-payment-button/link'));
        $this->assertSame($base . '/api/v1/transaction_gateway/tokens', $this->urlFor('test', 'transaction_gateway/tokens'));
        $this->assertSame($base . '/web/validate', $this->urlFor('test', 'validate'));
        $this->assertSame($base . '/web/forms', $this->urlFor('test', 'forms'));
    }

    private function urlFor($mode, $action)
    {
        $c = $this->client($mode);
        $c->setUrl($action);
        return $c->getUrl($action);
    }

    public function testEncodeHeader64()
    {
        $c = $this->client();
        $c->encodeHeader64();
        $this->assertSame(
            array('service' => 'SDK-PHP', 'grouper' => 'grp', 'developer' => 'dev'),
            json_decode(base64_decode($c->jsonData), true)
        );
    }

    public function testSetKeySelectsKeyByAction()
    {
        $c = $this->client();
        $ref = new \ReflectionClass($c);
        $key = $ref->getProperty('key');
        $formKey = $ref->getProperty('formKey');

        $c->setKey('healthcheck');
        $this->assertSame('priv', $key->getValue($c));
        $c->setKey('tokens');
        $this->assertSame('pub', $key->getValue($c));
        $c->setKey('validate');
        $this->assertSame('fkey', $key->getValue($c));
        $this->assertSame('fsite', $formKey->getValue($c));
        $c->setKey('threeds/instruction');
        $this->assertSame('user', $formKey->getValue($c));
        $c->setKey('payments');
        $this->assertSame('priv', $key->getValue($c));
    }
}
