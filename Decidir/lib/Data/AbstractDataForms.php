<?php

namespace Decidir\Data;

abstract class AbstractDataForms
{
	protected $dataResponse = array();
	private $field_required;

	public function __construct(array $data)
	{
		$this->dataResponse = $data;

		if (!empty($this->field_required)) {

			$this->forValidateFields($this->dataResponse);

			foreach ($this->field_required as $key => $value) {
				if ($value['name'] != "" && $key != null) {
					$exist = $this->keyExists($this->dataResponse, $key);

					if (!$exist) {
						throw new \Decidir\Exception\RequiredValue($key);
					}
				}
			}
		}
	}

	function keyExists(array $array, $key)
	{
		if (array_key_exists($key, $array)) {
			return true;
		}
		foreach ($array as $k => $v) {
			if (!is_array($v)) {
				continue;
			}
			if (array_key_exists($key, $v)) {
				return true;
			}
		}
		return false;
	}

	private function forValidateFields($fieldValues)
	{
		foreach ($fieldValues as $index => $value) {
			if (is_array($value) && $index != "fraud_detection") {
				$this->forValidateFields($value);
			} else {
				if (is_array($this->field_required) && array_key_exists($index, $this->field_required)) {
					$this->FieldName = $this->field_required[$index]['name'];
					if ($value === "") {
						error_log("Advertencia: El campo '$index' está vacío pero no se detendrá el flujo.");
					}
				}
			}
		}
	}

	public function getRequiredFields($data)
	{
		return $this->field_required;
	}

	public function getDataField()
	{
		return $this->dataResponse;
	}
}
