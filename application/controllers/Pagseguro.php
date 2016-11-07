<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Pagseguro extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
	}
	public function geraPag() {
		
		$dados = $this->input->post(); 
		
		$data ['token'] = 'B2F5E79534D44759B3221A614BC0F814';
		$data ['email'] = 'dufermiano43@gmail.com';
		$data ['currency'] = 'BRL';
		$data ['itemId1'] = $dados['id'];
		$data ['itemQuantity1'] = '1';
		$data ['itemDescription1'] = $dados['titulo'];
		$data ['itemAmount1'] = $dados['valor'];
		
		$url = 'https://ws.pagseguro.uol.com.br/v2/checkout';
		
		$data = http_build_query ( $data );
		
		$curl = curl_init ( $url );
		
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $curl, CURLOPT_POST, true );
		curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data );
		curl_setopt ( $curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
		$xml = curl_exec ( $curl );
		
		curl_close ( $curl );
		
		$xml = simplexml_load_string ( $xml );
		echo $xml->code;
	}
}



