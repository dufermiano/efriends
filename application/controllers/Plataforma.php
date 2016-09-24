<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plataforma extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('ebook_model', 'ebook');
	}

	public function index()
	{
		$data['dados'] = $this->ebook->carrega_site();
		$this->load->view('plataforma/index', $data);
	}
	
	public function sobre(){
		$this->load->view('plataforma/sobre');
	}
	
	public function cadastro_cli(){
		$this->load->view('plataforma/cadastro_cli');
	}
	
	public function todos(){
		$this->load->view('plataforma/todos');
	}
	
	public function categorias(){
		$this->load->view('plataforma/categorias');
	}
	
	public function login(){
		$this->load->view('plataforma/login');
	}
}	
