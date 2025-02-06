<?php
namespace Decidir\Forms;

include_once dirname(__FILE__) . "/../Data/AbstractDataForms.php";

class Data extends \Decidir\Data\AbstractDataForms {

    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function getData() {
        return json_encode($this->getDataField());
    }
}
