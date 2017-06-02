<?php
namespace Decidir\TokenCardsList;

include_once dirname(__FILE__)."/../Data/Response.php";

class TokenCardsListResponse extends \Decidir\Data\Response {
	protected $tokens;

	public function __construct(array $data) {
		parent::__construct($data);
	}

}
