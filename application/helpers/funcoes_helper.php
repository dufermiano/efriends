<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// load do arquivo autoload.php da AWS
require "vendor/autoload.php";

// definição do s3 client para upload de imagens e arquivos pdf com obras
use Aws\S3\S3Client;

if(!function_exists('set_msg')):
	//seta uma mensagem via session para ser lida posteriormente
	function set_msg($msg=NULL){
		$ci = & get_instance();
		$ci->session->set_userdata('aviso', $msg);
	}
endif;

if(!function_exists('get_msg')):
	//retorna uma mensagem definida pela função set_msg
	function get_msg($destroy=TRUE){
		$ci = & get_instance();
		$retorno = $ci->session->userdata('aviso');
		if($destroy) $ci->session->unset_userdata('aviso');
		return $retorno;
	}
endif;

if(!function_exists('upload_capa')):
//define as configurações para upload de imagens/arquivos
function upload_capa($path='./arquivos/', $types='jpg|png|jpeg|pdf', $size=10240){
	$config['upload_path'] = $path;
	$config['allowed_types'] = $types;
	$config['max_size'] = $size;
	return $config;
}
endif;

if(!function_exists('upload_s3')):
function upload_s3($bucket, $object){
	
	
	try{
		// cria o objeto do cliente, necessita passar as credenciais da AWS
		$clientS3 = S3Client::factory(array(
				// definição das credenciais AWS para S3
				//mudar ao fazer upload pro bitbuck para NULL
				'key'    => "AKIAJJRO4QOIAMVKGH4A", 
				'secret' => "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"
		));
			
		// método putObject envia os dados pro bucket selecionado das capas
		$response = $clientS3->putObject(array(
				'Bucket' => $bucket,
				'Key'    => $object['file_name'],
				'SourceFile' => $object['full_path'],
				'ACL' => 'public-read'
		));
		
		return $response['ObjectURL']; 
	
	}catch(Exception $e) {
		set_msg( "Erro > {$e->getMessage()}");
	}
}
endif;

