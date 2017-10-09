<?php
namespace Decidir\Exception;

class SdkException extends \Exception
{   
    protected $data;
    protected $message;
    protected $code;
    protected $previous;

    public function __construct($message, $code = 0, $data, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    public function getData(){
        return $this->data;
    }
}
