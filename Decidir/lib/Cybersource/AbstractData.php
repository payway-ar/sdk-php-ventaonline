<?php
namespace Decidir\Cybersource;

abstract class AbstractData extends \Decidir\Data\AbstractData
{	
	private $field_required = array();
	
	public function __construct(array $data){
		$this->dataResponse = $data;
		$nameMethod = "";

		foreach($this->field_required as $index => $param){
			if(array_key_exists($index, $data)){
				$nameMethod = $param['name'];
				$this->$nameMethod($index, $this->dataResponse[$index]);
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
