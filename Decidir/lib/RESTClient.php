<?php
namespace Decidir;

class RESTClient{
	private $url = NULL;
	private $endpoint = NULL;
	private $keys_data = array();
	private $key = NULL;
	private $formKey = NULL;
	private $statusCodeResponse = array(200, 201, 204);
	private $action = NULL;
	public $jsonData = NULL;
	public $service = NULL;

	const DECIDIR_ENDPOINT_TEST = "https://developers.decidir.com";

	const DECIDIR_ENDPOINT_QA = "https://qa.decidir.com";
	const DECIDIR_ENDPOINT_PROD = "https://api.decidir.com";
	const DECIDIR_ENDPOINT_FORM_PROD = "https://live.decidir.com";
	//const DECIDIR_ENDPOINT_TEST = "http://localhost:9001/";

	public function __construct($keys_data_array, $mode = "test", $developer="", $grouper="", $service = "SDK-PHP"){
		$this->keys_data = $keys_data_array;
		$this->developer = $developer;
        $this->grouper = $grouper;
        $this->service = $service;

		if($mode == "test") {
			$this->endpoint = self::DECIDIR_ENDPOINT_TEST;
		} elseif ($mode == "qa") {	
			$this->endpoint = self::DECIDIR_ENDPOINT_QA;
		} elseif ($mode == "prod") {	
			$this->endpoint = self::DECIDIR_ENDPOINT_PROD;
		}
	}

	public function setUrl($url){
		if($url != 'validate'){
			if ($url == 'orchestrator/checkout/payments/link'){
				$this->endpoint = $this->endpoint.'/api/'.$url;
				$this->url = $this->endpoint;
				return;
			}
			if ($url == 'closures/batchclosure'){
				$this->endpoint = $this->endpoint.'/api/v1/'.$url;
				$this->url = $this->endpoint;
				return;
			}
			if ($url == 'transaction_gateway/tokens' || $url =='transaction_gateway/payments'){
				$this->endpoint = $this->endpoint.'/api/v1/'.$url;
				$this->url = $this->endpoint;
				return;
			}
			$this->endpoint = $this->endpoint.'/api/v2/'.$url;
			
			//Para testing local es probable que se requiera modificar el concatenado del URL..
			//$this->endpoint = $this->endpoint.$url;
		}else{	
			$this->endpoint = $this->endpoint.'/web/'.$url;
		}

		$this->url = $this->endpoint;
	}

	public function getUrl($url){
		return $this->url;
	}

	public function setKey($action){
		$this->action = $action;

		if($action == 'healthcheck' || $action == 'orchestrator/checkout/payments/link'){
			$this->key = "";

		}elseif($action == 'tokens'){
			$this->key = $this->keys_data['public_key'];
		}elseif($action == 'threeds/instruction'){
			$this->formKey = $this->keys_data['x_consumer_username'];
		}elseif($action == 'validate'){
			$this->key = $this->keys_data['form_apikey'];
			$this->formKey = $this->keys_data['form_site'];
		}else{
			$this->key = $this->keys_data['private_key'];
		}
	}

	public function get($action, $data, $query = array()) {
		$this->setUrl($action);
		$this->setKey($action);

		return $this->RESTService("GET", $data, $query);
	}

	public function post($action, $data){
		$this->setUrl($action);
		$this->setKey($action);

		return $this->RESTService("POST", $data);
	}

	public function put($action, $data){
		$this->setUrl($action);
		$this->setKey($action);

		return $this->RESTService("PUT", $data);
	}

	public function delete($action, $data){
		$this->setUrl($action);
		$this->setKey($action);

		return $this->RESTService("DELETE", $data);
	}

	public function encodeHeader64(){
    	$jsonAux = json_encode(array('service' => $this->service, 'grouper'=> $this->grouper, 'developer'=> $this->developer));
    	//echo("Json decoded---> <br><br><br><br><br><br><br>");
    	//echo $jsonAux;
    	//echo("Se encriptara el X-Source en base 64 <br><br><br><br><br><br><br> ");
    	$this->jsonData = base64_encode($jsonAux);
    	//echo("<br><br><br><br><br><br><br> X-Source Encodeado a base 64 <br><br><br><br><br><br><br>");
    	//echo $this->jsonData;
    }

	//RESTResource
	private function RESTService($method = "GET", $data="", $query = array()){
        $this->encodeHeader64();
		$header_http = array(
						'Cache-Control: no-cache',
						'content-type: application/json',
						'X-Consumer-Username:'.$this->formKey,
						'X-Source:'.$this->jsonData,
					);

		if($this->action == 'validate' || $this->action == 'threeds/instruction'){
			array_push($header_http, 'apikey: '. $this->key);
			array_push($header_http, 'X-Consumer-Username: '. $this->formKey);
		}else{
			array_push($header_http, 'apikey: '. $this->key);
		}	

		$curl = curl_init();
		$curl_post_data = array();

		switch($method){
			case "POST":
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	
					break;

			case "GET":
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
					break;

			case "PUT":
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	
            		break;

			case "DELETE":
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
					break;
		}

		if(count($query) > 0) {
			curl_setopt($curl, CURLOPT_URL, $this->url."?".http_build_query($query));
                } else {
			curl_setopt($curl, CURLOPT_URL, $this->url);
                }

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_ENCODING, "");
		curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header_http);

		$response = curl_exec($curl);
		$codeResponse = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		if($response == false && !in_array($codeResponse, $this->statusCodeResponse)){
			$err = "curl error: ".curl_error($curl);
			throw new \Exception($err);
		}

        if($codeResponse == 204) {
                $response = '{"status":"success"}';
        }
		curl_close($curl);

		return json_decode($response, true);
	}
}
