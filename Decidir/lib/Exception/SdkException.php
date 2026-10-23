<?php
namespace Decidir\Exception;

class SdkException extends \Exception
{   
    protected $data;

    public function __construct($message, $code = 0, $data = null, ?\Throwable $previous = null) {
        parent::__construct($message, (int) $code, $previous);
        $this->data = $data;
    }

    public function getData(){
        return $this->data;
    }
}
