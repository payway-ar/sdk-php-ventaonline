<?php
namespace Decidir\TokenCardDelete;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class TokenCardDeleteResponse extends \Decidir\Data\AbstractData {
	protected $error_type;
	protected $entity_name;
	protected $id;

	public function __construct(array $data) {
		$this->setRequiredFields(array(
			"error_type" => array(
				"name" => "error_type"
			),
			"entity_name" => array(
				"name" => "entity_name"
			),
			"id" => array(
				"name" => "id"
			)
		));

		parent::__construct($data);
	}

	public function getErrorType(){
		return $this->error_type;
	}

	public function getEntityName(){
		return $this->entity_name;
	}

	public function getId(){
		return $this->id;
	}
}