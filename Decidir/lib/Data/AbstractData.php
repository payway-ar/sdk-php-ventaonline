<?php
namespace Decidir\Data;

abstract class AbstractData {
	private $dataResponse = array();
	private $field_required;
	
	public function __construct(array $data){
		$this->dataResponse = $data;
		$FieldName = "";

		if(!empty($this->field_required)){
			foreach($this->field_required as $index => $param){
				if(array_key_exists($index, $this->dataResponse)){

					$FieldName = $param['name'];
					$this->$FieldName = $this->dataResponse[$param['name']];
				}else{
					throw new \Decidir\Exception\RequiredValue($index);
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

	protected function getDataField(){
		return $this->dataResponse;
	}
}




