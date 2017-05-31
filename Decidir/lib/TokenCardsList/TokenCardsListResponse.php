<?php
namespace Decidir\TokenCardsList;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class TokenCardsListResponse extends \Decidir\Data\AbstractData {
	protected $tokens;

	public function __construct(array $data) {
			$this->setRequiredFields(array(
				"tokens" => array(
					"name" => "tokens"
				)
			));

		parent::__construct($data);
	}

	public function getTokens(){
		return $this->tokens;
	}
}