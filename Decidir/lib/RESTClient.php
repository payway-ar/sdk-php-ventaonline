<?php
namespace Decidir;

class RESTClient{
	private $url = NULL;
	private $endpoint = NULL;
	private $httpHeader = array();
	private $key = NULL;
	private $httpCodes = array("200","201");

	const DECIDIR_ENDPOINT_TEST = "https://developers.decidir.com/api/v1/";
	const DECIDIR_ENDPOINT_PROD = "https://api.decidir.com/api/v1/";

	public function __construct($header_http_array, $mode = "test"){
		$this->httpHeader = $header_http_array;
		if($mode == "test") {
			$this->endpoint = self::DECIDIR_ENDPOINT_TEST;
		} elseif ($mode == "prod") {
			$this->endpoint = self::DECIDIR_ENDPOINT_PROD;	
		}
	}

	public function setUrl($url){
		$this->url = $this->endpoint.$url;
	}

	public function getUrl($url){
		return $this->url;
	}

	public function setKey($action){
		if($action == 'healthcheck'){
			$this->key = "";

		}elseif($action == 'tokens'){
			$this->key = $this->httpHeader['public_key'];

		}else{
			$this->key = $this->httpHeader['private_key'];
		}
	}

	public function get($action, $data){
		$this->setUrl($action);
		$this->setKey($action);

		return $this->RESTService("GET", $data);
	}

	public function post($action, $data){
		$this->setUrl($action);
		$this->setKey($action);

		return $this->RESTService("POST", $data);
	}

	public function put(){
		//do something
	}

	public function delete($action, $data){
		$this->setUrl($action);
		$this->setKey($action);

		return $this->RESTService("DELETE", $data);
	}
	//RESTResource
	private function RESTService($method = "GET", $data){
		$header_http = array(
					'Cache-Control: no-cache', 
					'content-type: application/json',
					'apikey:'. $this->key
					);
		$curl = curl_init($this->url);
		$curl_post_data = array();

		switch($method){
			case "POST":
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	
					break;

			case "GET":
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
					break;

			case "PUT":
					curl_setopt($curl, CURLOPT_PUT, 1);
            		break;

			case "DELETE":
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
					break;
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

		if($response == false || !in_array($codeResponse, $this->httpCodes)){
			$err = "curl error: ".curl_error($curl);
			throw new Exception($err);
		}

		curl_close($curl);

		return json_decode($response, true);
	}
}
