<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Cliente extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->model('cliente_model', 'cliente');
		$this->load->model('admin_model', 'admin');
	}
	
	public function validaToken(){
		
	}
	
	public function clientes(){
		$dados['clientes'] = $this->cliente->get_cli_lista();
		$this->load->view('dashboard/clientes');
	}
	
    public function lista_clientes(){
		$dados['clientes'] = $this->cliente->get_cli_lista();
		echo json_encode($dados['clientes']);
	}
	
	public function relatorio_historico(){
		$dados['relatorio'] = $this->cliente->get_historico_cli();
		echo json_encode($dados['relatorio']);
	}

	public function relatorio_ebook(){
		$dados['relatorio'] = $this->cliente->relatorio_ebook();
		echo json_encode($dados['relatorio']);
	}
	
	public function lista_cli_ativo(){
	
		$dados['clientes'] = $this->cliente->get_cli_ativo();
		echo json_encode($dados['clientes']);
	}
	
	public function lista_cli_inativo(){
	
		$dados['clientes'] = $this->cliente->get_cli_inativo();
		echo json_encode($dados['clientes']);
		
	}
	
	public function recuperaSenha(){
		
		$cliente['login'] = $this->input->post('login');
		$cliente['pergunta'] = $this->input->post('pergunta');
		$cliente['resposta'] = $this->input->post('resposta');
		
		if($this->cliente->getIdCliente($cliente['login'])){
			
			$p = $this->cliente->verificaPergunta($cliente['login']);
			foreach($p as $pergunta):
				if($cliente['pergunta'] == $pergunta->Pergunta){
				
					$r = $this->cliente->verificaResposta($cliente['login']);
					
					foreach ($r as $resposta):
						if($cliente['resposta'] == $resposta->Resposta){
						redirect("recupera_senha?login=".$cliente['login'], "refresh");
					}
					else{
						set_msg ( "<p>Resposta/Resposta incorreta, verifique se a escrita está correta com acentos e letras maiúsculas</p>" );
						redirect ( 'esqueci_senha', 'refresh' );
					}
					endforeach;
				}
				else{
					set_msg ( "<p>Resposta/Resposta incorreta, verifique se a escrita está correta com acentos e letras maiúsculas</p>" );
					redirect ( 'esqueci_senha', 'refresh' );
				}
			endforeach;
			
			
			
		}
		else{
			set_msg ( "<p>Login Inválido</p>" );
			redirect ( 'esqueci_senha', 'refresh' );
		}
	
	}
	
	public function muda_senha(){
		$senha1 = $this->input->post('senha1');
		$senha2 = $this->input->post('senha2');
		
		$login = $this->input->post('login');
		
		if($senha1 != $senha2){
			set_msg ( "Senhas devem coincidir." );
			redirect('recupera_senha?login='.$login, 'refresh');
			return false;
		}
		
		$senha_crip = md5($senha1);
				
			$r = $this->cliente->get_senha($login);
		
			foreach($r as $atual):
			if($atual->Senha_Cli == $senha_crip):
			set_msg ( "Nova senha não deve ser igual a atual." );
			redirect('recupera_senha?login='.$login, 'refresh');
			return false;
			endif;
			endforeach;
				
			$result = $this->cliente->troca_senha ( $senha_crip, $login );	
			
			set_msg ( "Senha alterada com sucesso." );
			redirect('login', 'refresh');
	}
	
	
	
	public function troca_senha(){
		$this->load->view("plataforma/troca_senha");
	}
	
	
	public function muda_status(){
		$idcli =  $this->input->get ( 'cod' );
		$status =  $this->input->get ( 'status' );
		
		if($status == "Ativo"):
			$dados['status'] = false;
			$acao = "Desativou";
		else:
			$dados['status'] = true;
			$acao = "Ativou";
		endif;
		
		$dados['id'] = $idcli;
		
		$result = $this->cliente->muda_status($dados);
		if($result){
			
			$id = $this->admin->getIdAdmin($this->session->userdata('user'));
			
			foreach ($id as $row){
				$idAdmin = $row->idAdministrador; //coloca na variável
			}
			
			$this->admin->log_admin_cliente($idAdmin, $idcli, $acao);//registra log de cliente e ebook para publicação
			
			
			set_msg ( "<p>Mudança de status realizada</p>" );			
			redirect ( 'clientes', 'refresh' );
		}
	}
	
	public function insere_cliente(){
					
				$cliente = $this->input->post ();
			
				$cpf = $cliente['cpf'];
				
				$r = $this->cliente->checa_cpf($cpf);
				if($r == false){
					set_msg ( "<p>CPF já existente no sistema, favor inserir outro</p>" );
					redirect ( 'cadastro_cli', 'refresh' );
					return false;
				}
				
				$login = $cliente ['login'];
				
				$r = $this->cliente->checa_login($login);
				if($r == false){
					set_msg ( "<p>Login já existente no sistema, favor inserir outro</p>" );
					redirect ( 'cadastro_cli', 'refresh' );
					return false;
				}
			
				$post_password1 = md5($this->input->post('senha', TRUE));
				$post_password2 = md5($this->input->post('senha2', TRUE));
				
				$dados_insert ['nome'] = $cliente ['nome'];
				$dados_insert ['email'] = $cliente ['email'];
				$dados_insert ['telefone'] = $cliente ['telefone'];
				$dados_insert ['cpf'] = $cliente ['cpf'];
				$dados_insert ['login'] = $cliente ['login'];
				$dados_insert ['pergunta'] = $cliente ['pergunta'];
				$dados_insert ['resposta'] = $cliente ['resposta'];
				
				
				if($post_password1 != $post_password2){
					
					set_msg ( "<p>Senhas devem coincidir</p>" );
					redirect ( 'cadastro_cli', 'refresh' );
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
				$login_cli = $row->Login_Cli;
			}
			
			$sess_data = array(
					
					'user' => $login_cli,
					'tipo' => 'cliente',
					'logado' => true
			);
			
			$this->session->set_userdata($sess_data);
			
			redirect ( 'plataforma', 'refresh' );
			
			//select count(*) as count from ci_sessions WHERE data LIKE '%logado|b:1%';
			
		}
	}
	
	public function logout(){
	
		$this->session->sess_destroy();

		redirect("plataforma", "refresh");
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
		$dados_update ['token'] = $cliente ['token'];
		
		if($cliente ['pergunta'] == "Mês de aniversario?"):
		$dados_update ['pergunta'] = 1;
		
		elseif($cliente ['pergunta'] == "Time do coração?"):
		$dados_update ['pergunta'] = 2;
		
		elseif($cliente ['pergunta'] == "Qual o nome do seu cachorro?"):
		
		$dados_update ['pergunta'] = 3;
		endif;
		
		$dados_update ['resposta'] = $cliente ['resposta'];
		
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