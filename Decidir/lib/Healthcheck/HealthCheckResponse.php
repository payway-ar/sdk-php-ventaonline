<?php
namespace Decidir\Healthcheck;

include_once dirname(__FILE__)."/../Data/Response.php";

class HealthCheckResponse extends \Decidir\Data\Response {
	protected $name;
	protected $version;
	protected $buildTime;

	public function __construct(array $data) {
		parent::__construct($data);
	}
}
