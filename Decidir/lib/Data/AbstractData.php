<?php

namespace Decidir\Data;

abstract class AbstractData {
	protected $dataResponse = array();
	private $field_required;
	
	public function __construct(array $data){
		$this->dataResponse = $data;

		if(!empty($this->field_required)){

			$this->forValidateFields($this->dataResponse);

			foreach ($this->field_required as $key => $value) {
				if($value['name'] != "" && $key != null){
					$exist = $this->keyExists($this->dataResponse,$value['name']);

					if(!$exist){
						throw new \Decidir\Exception\RequiredValue($value['name']);
					}

				}

			}

		}
	}

	function keyExists( Array $array, $key ) {
	    if (array_key_exists($key, $array)) {
	        return true;
	    }
	    foreach ($array as $k=>$v) {
	        if (!is_array($v)) {
	            continue;
	        }
	        if (array_key_exists($key, $v)) {
	            return true;
	        }
	    }
	    return false;
	}

	private function forValidateFields($fieldValues){
		
		foreach($fieldValues as $index => $value){

			if(is_array($value)){
				$this->forValidateFields($value);

			}else{

				if(array_key_exists($index, $this->field_required)){
					$this->FieldName = $this->field_required[$index]['name'];
					
					if($value == ""){
						throw new \Decidir\Exception\EmptyValue($index);
					}

				}else{
					throw new \Decidir\Exception\AllowValue($index);
				}

			}

		}

	}


	public function setRequiredFields($data){
		$this->field_required = $data;
	}

	public function getRequiredFields($data){
		return $this->field_required;
	}

	public function getDataField(){
		return $this->dataResponse;
	}
}




