<?php
namespace Decidir\Healthcheck;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class HealthCheckResponse extends \Decidir\Data\AbstractData {
	protected $name;
	protected $version;
	protected $buildTime;

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"name" => array(
				"name" => "name"
			),
			"version" => array(
				"name" => "version"
			),
			"buildTime" => array(
				"name" => "buildTime"
			)
		));

		parent::__construct($data);
	}

	public function getName(){
		return $this->name;
	}

	public function getVersion(){
		return $this->version;
	}

	public function getBuildTime(){
		return $this->buildTime;
	}

}