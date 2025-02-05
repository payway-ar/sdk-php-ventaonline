<?php
namespace Decidir\Forms;

include_once dirname(__FILE__) . "/../Data/Response.php";

class FormsResponse extends \Decidir\Data\Response implements \JsonSerializable {

    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function getHash() {
        return $this->getDataFieldValue("hash");
    }
    
    public function jsonSerialize(): mixed {
        return [
            'hash' => $this->getHash()
        ];
    }
}
