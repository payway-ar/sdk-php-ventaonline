<?php
namespace Decidir\Data;

include_once dirname(__FILE__)."/AbstractData.php";

class Response extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {
		parent::__construct($data);
		if(array_key_exists("error_type",$data)) {
			throw new \Decidir\Exception\SdkException($data["error_type"],400,$data);
		}
	}

    public function __call($methodName, $args) {
        if (preg_match('~^(set|get)([A-Z])(.*)$~', $methodName, $matches)) {
            $property = strtolower($matches[2]) . $matches[3];
            $oproperty = $property;
            $property = $this->from_camel_case($property);
            if (!array_key_exists($property, $this->dataResponse)) {
                if (!array_key_exists($oproperty, $this->dataResponse)) {
                    throw new \Decidir\Exception\SdkException('Property ' . $property . ' not exists',0,$this->dataResponse);
                } else {
                    $property = $oproperty;
                }
            }

            switch($matches[1]) {
                case 'set':
                    $this->checkArguments($args, 1, 1, $methodName);
                    return $this->set($property, $args[0]);
                case 'get':
                    $this->checkArguments($args, 0, 0, $methodName);

                    $objectType = false;
                    if($property == "status_details") {
                        $objectType = true;
                    }

                    return $this->get($property, $objectType);

                default:
                    throw new Exception('Method ' . $methodName . ' not exists');
            }
        }
    }

    public function get($property, $objectType) {

        if($objectType){
            $obj = new \stdClass();

            foreach($this->dataResponse[$property] as $index => $value){
                $obj->$index=$value;                
            }
            $resp = $obj;

        }else{
            $resp = $this->dataResponse[$property];
        }

        return $resp;
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
