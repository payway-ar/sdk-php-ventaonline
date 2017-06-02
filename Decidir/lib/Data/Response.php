<?php
namespace Decidir\Data;

include_once dirname(__FILE__)."/AbstractData.php";

class Response extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {
		parent::__construct($data);
	}

    public function __call($methodName, $args) {
        if (preg_match('~^(set|get)([A-Z])(.*)$~', $methodName, $matches)) {
            $property = strtolower($matches[2]) . $matches[3];
	    $property = $this->from_camel_case($property);
            if (!array_key_exists($property, $this->dataResponse)) {
                throw new \Decidir\Exception\SdkException('Property ' . $property . ' not exists',0,$this->dataResponse);
            }
            switch($matches[1]) {
                case 'set':
                    $this->checkArguments($args, 1, 1, $methodName);
                    return $this->set($property, $args[0]);
                case 'get':
                    $this->checkArguments($args, 0, 0, $methodName);
                    return $this->get($property);
                default:
                    throw new Exception('Method ' . $methodName . ' not exists');
            }
        }
    }

    public function get($property) {
        return $this->dataResponse[$property];
    }

    public function set($property, $value) {
        $this->dataResponse[$property] = $value;
        return $this;
    }

protected function from_camel_case($input) {
  preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
  $ret = $matches[0];
  foreach ($ret as &$match) {
    $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
  }
  return implode('_', $ret);
}
}
