<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url');
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
	
	
	public function novo_admin(){
		$this->load->view('dashboard/novo-admin');
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
				$login_admin = $row->Login_Admin;
			}
			
			$sess_data = array(
						
					'user' => $login_admin,
					'tipo' => 'admin',
					'logado' => true
			);
				
			$this->session->set_userdata($sess_data);
			
			redirect ( 'inicio_dash', 'refresh' );
		}
	}
	
	public function logout(){
		
		$this->session->sess_destroy();
		
		redirect("admin", 'refresh');
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
	
	public function insere_admin(){
			
		$admin = $this->input->post ();
		
		$login = $admin ['login'];
	
		$r = $this->admin->checa_login($login);
		if($r == false){
			set_msg ( "<p>Login já existente no sistema, favor inserir outro</p>" );
			redirect ( 'novo_admin', 'refresh' );
			return false;
		}
			
		$post_password1 = md5($this->input->post('senha', TRUE));
		$post_password2 = md5($this->input->post('senha2', TRUE));
	
		$dados_insert ['nome'] = $admin ['nome'];
		$dados_insert ['email'] = $admin ['email'];
		$dados_insert ['telefone'] = $admin ['tel'];
		$dados_insert ['login'] = $admin ['login'];
		if($post_password1 != $post_password2){
				
			set_msg ( "<p>Senhas devem coincidir</p>" );
			redirect ( 'novo_admin', 'refresh' );
		}
		else{
			$dados_insert ['senha'] = $post_password1;
		
			$result = $this->admin->insert_admin ( $dados_insert );
				
		}
		if ($result) {
			set_msg ( "<p>Inserção feita com sucesso</p>" );
			redirect ( 'novo_admin', 'refresh' );
		}
	
	}
	
	public function recuperaSenha(){
	
		$admin['login'] = $this->input->post('login');
		$admin['pergunta'] = $this->input->post('pergunta');
		$admin['resposta'] = $this->input->post('resposta');
	
		if($this->admin->getIdAdmin($admin['login'])){
				
			$p = $this->admin->verificaPergunta($admin['login']);
			foreach($p as $pergunta):
			if($admin['pergunta'] == $pergunta->Pergunta){
	
				$r = $this->admin->verificaResposta($admin['login']);
					
				foreach ($r as $resposta):
				if($admin['resposta'] == $resposta->Resposta){
					redirect("recupera_senha_admin?login=".$admin['login'], "refresh");
				}
				else{
					set_msg ( "<p>Resposta/Resposta incorreta, verifique se a escrita está correta com acentos e letras maiúsculas</p>" );
					redirect ( 'esqueci_senha_admin', 'refresh' );
				}
				endforeach;
			}
			else{
				set_msg ( "<p>Resposta/Resposta incorreta, verifique se a escrita está correta com acentos e letras maiúsculas</p>" );
				redirect ( 'esqueci_senha_admin', 'refresh' );
			}
			endforeach;
				
				
				
		}
		else{
			set_msg ( "<p>Login Inválido</p>" );
			redirect ( 'esqueci_senha_admin', 'refresh' );
		}
	
	}
	
	public function muda_senha(){
		$this->load->view("dashboard/recupera_senha");
	}
	
	public function senha(){
		$senha1 = $this->input->post('senha1');
		$senha2 = $this->input->post('senha2');
	
		$login = $this->input->post('login');
	
		if($senha1 != $senha2){
			set_msg ( "Senhas devem coincidir." );
			redirect('recupera_senha_admin?login='.$login, 'refresh');
			return false;
		}
	
		$senha_crip = md5($senha1);
	
		$r = $this->admin->get_senha($login);
	
		foreach($r as $atual):
		if($atual->Senha_Admin == $senha_crip):
		set_msg ( "Nova senha não deve ser igual a atual." );
		redirect('recupera_senha_admin?login='.$login, 'refresh');
		return false;
		endif;
		endforeach;
	
		$result = $this->admin->troca_senha ( $senha_crip, $login );
			
		set_msg ( "Senha alterada com sucesso." );
		redirect('admin', 'refresh');
	}
	
	
	
	
	
	
	
	
	
	
	
}