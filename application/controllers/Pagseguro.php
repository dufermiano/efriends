<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Pagseguro extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->model ("Ebook_model", "ebook");
		$this->load->model ("Cliente_model", "cliente");
	}
	
	public function pagseguro(){
	
		$dados['livro'] = $this->ebook->sobre_pagseguro ($this->input->post('cod'));
		echo json_encode($dados['livro']);
	}
	
	public function geraPag() {
		
		$dados = $this->input->post(); 
		
		$data ['token'] = $dados['token'];
		$data ['email'] = $dados['email'];
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



