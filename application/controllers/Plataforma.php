<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plataforma extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Ebook_model', 'ebook');
		$this->load->model('Cliente_model', 'cliente');
		
	}

	public function index()
	{
		$logado = $this->session->userdata ( 'logado' );
		$id = $this->cliente->getIdCliente($this->session->userdata('user'));
		
		foreach ($id as $row):
			$idCli = $row->idCliente; //coloca na variável
		endforeach;
		
		if ($logado != true):
		$data['dados'] = $this->ebook->carrega_site();
		else:
			$data['dados'] = $this->ebook->carrega_site_logado($idCli);
		endif;
		
		if($data['dados'] == null){
			$this->load->view('plataforma/index');
		}
		else{
			$this->load->view('plataforma/index', $data);
		}
		
	}
	
	public function esqueci_senha(){
		$this->load->view('plataforma/esqueci_senha');
	}
	
	public function sobre(){
		$this->load->view('plataforma/sobre');
	}
	
	public function cadastro_cli(){
		$this->load->view('plataforma/cadastro_cli');
	}
	
	public function todos(){
		$data['dados'] = $this->ebook->todos();
		$this->load->view('plataforma/todos', $data);
	}
	
	public function categorias(){
		$this->load->view('plataforma/categorias');
	}
	
	public function login(){
		$this->load->view('plataforma/login');
	}
}	
