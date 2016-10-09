<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->model ( 'Admin_model', 'admin' );
		$this->load->library ( 'session' );
	}
	public function perfil() {
		$dados_admin ["admin"] = $this->admin->get_admin();
		$this->load->view ( 'dashboard/perfil', $dados_admin );
	}
	
	public function troca_senha(){
		$this->load->view('dashboard/troca_senha_adm');
	}
		
	public function login(){
		$login = $this->input->post ('login', TRUE);
		$senha = md5($this->input->post('senha', TRUE));
	
		$result = $this->admin->login ( $login, $senha );
	
		if ($result == false) {
			set_msg ( "Erro no login. Verifique seu usuário e senha e tente novamente." );
			redirect ( 'admin' );
		} else {
			foreach ($result as $row){
				$this->session->set_userdata("user", $row->Login_Admin);
				$this->session->set_userdata("tipo", 'admin');
			}
			$this->admin->ativa_sessao();
			redirect ( 'inicio_dash', 'refresh' );
		}
	}
	
	public function logout(){
		
		$this->admin->desativa_sessao();
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('tipo');
		redirect("admin");
	}
	
	public function altera_admin(){
		
		    $dados = $this->input->post();
			$result = $this->admin->update_admin($dados);
			
			if ($result) {
				set_msg ( "<p class='text-sucess'>Alteração feita com sucesso</p>" );
				$this->session->set_userdata("user", $dados['login']);
				redirect ( 'perfil', 'refresh' );
			}
	}
	
}