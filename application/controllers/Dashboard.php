<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
	}
	public function dashboard() {
		$this->load->view ( 'dashboard/dashboard' );
		
	}
	
	public function esqueci_senha(){
		$this->load->view('dashboard/esqueci_senha_admin');
	}
	
	public function index() {
		$this->load->view ( 'dashboard/index' );
	}
	public function relatorios() {
		$this->load->view ( 'dashboard/relatorios' );
	}
	
	public function troca_senha(){
		$this->load->view('dashboard/troca_senha');
	}
	
	public function senha(){
		
		$senha1 = $this->input->post('senha1');
		$senha2 = $this->input->post('senha2');
		
		if($senha1 != $senha2){
			set_msg ( "Senhas devem coincidir." );
			redirect ( 'troca_senha' );
			return false;
		}
		
		$senha_crip = md5($senha1);
		
		$sessao = $this->input->post('sessao');
		$user = $this->input->post('user');
		
		if($sessao == "cliente"){
			$this->load->model ( 'Cliente_model', 'cliente' );
			
			$r = $this->cliente->get_senha($user);
				
			foreach($r as $atual):
			if($atual->Senha_Cli == $senha_crip):
			set_msg ( "Nova senha não deve ser igual a atual." );
			redirect ( 'troca_senha' );
			return false;
			endif;
			endforeach;
			
			$result = $this->cliente->troca_senha ( $senha_crip, $user );
			
		}
		if($sessao == "admin"){
			$this->load->model ('Admin_model','admin');
			
			$r = $this->admin->get_senha($user);
			
			foreach($r as $atual):
			if($atual->Senha_Admin == $senha_crip):
			set_msg ( "Nova senha não deve ser igual a atual." );
			redirect ( 'troca_senha' );
			return false;
			endif;
			endforeach;
			
			$result = $this->admin->troca_senha ( $senha_crip, $user );
		}
		
		if ($result) {
			set_msg ( "<p>Senha Trocada</p>" );
			redirect ( 'troca_senha', 'refresh' );
		}
	}
}	
