<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Cliente extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->model('cliente_model', 'cliente');
	}
	
	public function clientes(){
		$dados['clientes'] = $this->cliente->get_cli_lista();
		$this->load->view('dashboard/clientes');
	}
	
    public function lista_clientes(){
		$dados['clientes'] = $this->cliente->get_cli_lista();
		echo json_encode($dados['clientes']);
	}

	public function lista_cli_ativo(){
	
		$dados['clientes'] = $this->cliente->get_cli_ativo();
		echo json_encode($dados['clientes']);
	}
	
	public function lista_cli_inativo(){
	
		$dados['clientes'] = $this->cliente->get_cli_inativo();
		echo json_encode($dados['clientes']);
		
	}
	
	public function muda_status(){
		$idcli =  $this->input->get ( 'cod' );
		$status =  $this->input->get ( 'status' );
		
		if($status == "Ativo"):
			$dados['status'] = false;
		else:
			$dados['status'] = true;
		endif;
		
		$dados['id'] = $idcli;
		
		$result = $this->cliente->muda_status($dados);
		if($result){
			set_msg ( "<p>Mudança de status realizada</p>" );
			
			$idadmin = $this->cliente->get_id_admin();
				
			foreach($idadmin as $id):
			$dados_tg['idadmin'] = $id->idAdministrador;
			endforeach;
			
			$dados_tg['idcliente'] = $this->input->get ( 'cod' );
				
			$this->cliente->trigger_admin_cliente($dados_tg);
			
			
			redirect ( 'clientes', 'refresh' );
		}
	}
	
	public function insere_cliente(){
					
				$cliente = $this->input->post ();
				
				$post_password1 = md5($this->input->post('senha', TRUE));
				$post_password2 = md5($this->input->post('senha2', TRUE));
				
				$dados_insert ['nome'] = $cliente ['nome'];
				$dados_insert ['email'] = $cliente ['email'];
				$dados_insert ['telefone'] = $cliente ['telefone'];
				$dados_insert ['cpf'] = $cliente ['cpf'];
				$dados_insert ['login'] = $cliente ['login'];
				if($post_password1 != $post_password2){
					
					set_msg ( "<p>Senhas devem coincidir</p>" );
					redirect ( 'plataforma/cadastro_cli', 'refresh' );
				}
				else{
				$dados_insert ['senha'] = $post_password1;
				
				if(isset($cliente['newsletter'])):
				$dados_insert['newsletter'] = true;
				else:
				$dados_insert['newsletter'] = false;
				endif;
				
				
			$result = $this->cliente->insert_cliente ( $dados_insert );
				}
			if ($result) {
				set_msg ( "<p>Inserção feita com sucesso</p>" );
				redirect ( 'login', 'refresh' );
			}
		
		}
		
	public function login(){
		$login = $this->input->post ('login', TRUE);
		$senha = md5($this->input->post('senha', TRUE));
		
		$result = $this->cliente->login ( $login, $senha );
		
		if ($result == false) {
			set_msg ( "Erro no login. Verifique seu usuário e senha e tente novamente." );
			redirect ( 'login' );
		} else {
			foreach ($result as $row){
				$this->session->set_userdata("user", $row->Login_Cli);
				$this->session->set_userdata("tipo", 'cliente');
			}
			$this->cliente->ativa_sessao();
			redirect ( 'inicio_dash', 'refresh' );
		}
	}
	
	public function logout(){
	
		$this->cliente->desativa_sessao();
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('tipo');
		$this->session->unset_userdata('status');
		redirect("login");
	}
	
	public function perfil(){
		$dados_cliente ["cliente"] = $this->cliente->get_cli();
		$this->load->view ( 'dashboard/perfil_cli', $dados_cliente );
	}
	
	public function altera_cliente(){
	
		$cliente = $this->input->post ();
		
		$dados_update ['nome'] = $cliente ['nome'];
		$dados_update ['email'] = $cliente ['email'];
		$dados_update ['telefone'] = $cliente ['telefone'];
		$dados_update ['cpf'] = $cliente ['cpf'];
		$dados_update ['senha'] = $cliente ['senha'];
		$dados_update ['status'] = $cliente ['status'];
		
		if(isset($cliente['news'])):
		$dados_update['newsletter'] = true;
		else:
		$dados_update['newsletter'] = false;
		endif;
		
		$result = $this->cliente->update_cliente($dados_update);
			
		if ($result) {
			set_msg ( "<p>Alteração feita com sucesso</p>" );
			redirect ( 'perfil_cli', 'refresh' );
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}