<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('security');
	}
	
	public function get_historico_cli(){
	
		$this->db->select('historico_cliente.Acao_Realizada, historico_cliente.Data_Acao, historico_cliente.Campo_Alterado, historico_cliente.Valor_Antigo, historico_cliente.Valor_Novo');
		$this->db->from('historico_cliente');
		$this->db->join('Cliente', "cliente.idCliente = historico_cliente.Cliente_idCliente", 'inner' );
		$this-> db -> where ('Cliente.Login_Cli', $this->session->userdata('user'));
		$query = $this->db->get();
		return $query->result();
	
	
	
	}
	
	public function relatorio_ebook(){
	
		$this->db->select('ebook.idEbook, ebook.Titulo_Ebook, log_cliente_ebook.Data_Acao, log_cliente_ebook.Status_Cli_Ebook');
		$this->db->from('log_cliente_ebook');
		$this->db->join('Cliente', "cliente.idCliente = log_cliente_ebook.Cliente_idCliente", 'inner' );
		$this->db->join('Ebook', "ebook.idEbook = log_cliente_ebook.Ebook_idEbook", 'inner' );
		$this-> db -> where ('Cliente.Login_Cli', $this->session->userdata('user'));
		$query = $this->db->get();
		return $query->result();
	
	
	
	}
	
	public function verificaPergunta($login){
		$this->db->select('Pergunta');
		$this-> db -> from ('Cliente');
		$this-> db -> where('Login_Cli', $login );		
		$query = $this-> db -> get();
		
		return $query->result();
	}
	
	public function verificaResposta($login){
		$this->db->select('Resposta');
		$this-> db -> from ('Cliente');
		$this-> db -> where('Login_Cli', $login );
		$query = $this-> db -> get();
	
		return $query->result();
	}
	
	public function getIdCliente($login){
		$this-> db -> select ('idCliente');
		$this-> db -> from ('Cliente');
		$this-> db -> where('Login_Cli', $login );
		$this-> db -> limit(1);
		
		$query = $this-> db -> get();
		
		return $query->result();
	}
	
	public function log_cli_ebook($idCli, $idEbook, $acao){	
		
		$dados = array(
			'Cliente_idCliente' => $idCli,
			'Ebook_idEbook' => $idEbook,
			'Status_Cli_Ebook' => $acao	
		);
		
		$this->db->set('Data_Acao', 'NOW()', FALSE);
		
		if( ! $this->db->insert('log_cliente_ebook', $dados)){
			var_dump( $this->db->error());
			return;
		}
		
	}
	
	public function insert_cliente($dados){

		$dados_cliente = array(
				'nome_cli' => $dados['nome'],
				'email_cli' => $dados['email'],
				'telefone_cli' => $dados['telefone'],
				'cpf_cli' => $dados['cpf'],
				'newsletter' => $dados['newsletter'],
				//'token' => $dados['token'],
				'pergunta' => $dados['pergunta'],
				'resposta' => $dados['resposta'],
				'status_cli' => true,
				'login_cli' => $dados['login'],
				'senha_cli' => $dados['senha']
		);
			
		$this->db->set('data_cadastro', 'NOW()', FALSE);
		
		if( ! $this->db->insert('cliente', $dados_cliente)){
			echo $this->db->error();
			return;
		}
		
		
		return $this->db->insert_id();
		}
	
	public function login($login, $senha){
		
		$sql = "select idCliente, Login_Cli from Cliente Where Login_Cli = '$login' AND Senha_Cli = '$senha' AND Status_Cli = true;";
		
		
		$query = $this->db->query($sql);
		
		if($query -> num_rows() == 1){
			return $query->result();
		}
		else{
			return false;
		}
	}
	
	public function checa_cpf($cpf){
		
		$this-> db -> select ('Login_Cli');
		$this-> db -> from ('Cliente');
		$this-> db -> where('CPF_Cli', $cpf );
		$this-> db -> limit(1);
		
		$query = $this-> db -> get();
	
		if($query->num_rows() != 0){
			return false;
		}
		else{
			return true;
		}
	}
	
	public function checa_login($login){
	
		$this-> db -> select ('idCliente');
		$this-> db -> from ('Cliente');
		$this-> db -> where('Login_Cli', $login );
		$this-> db -> limit(1);
	
		$query = $this-> db -> get();
	
		if($query->num_rows() != 0){
			return false;
		}
		else{
			return true;
		}
	}
	
	public function get_cli(){
		$this-> db -> select ('*');
		$this-> db -> from ('Cliente');
		$this-> db -> where('Login_Cli', $this->session->userdata('user') );
		$this-> db -> limit(1);
	
		$query = $this-> db -> get();
	
		return $query->result();
	}
	
	public function update_cliente($cli){
	
		$this->db->set('Nome_Cli', $cli['nome']);
		$this->db->set('Telefone_Cli', $cli['telefone']);
		$this->db->set('Email_Cli', $cli['email']);

		$this->db->set('CPF_Cli', $cli['cpf']);
		$this->db->set('Newsletter', $cli['newsletter']);
		$this->db->set('Token', $cli['token']);
		$this->db->set('Pergunta', $cli['pergunta']);
		$this->db->set('Resposta', $cli['resposta']);
	
		$this-> db -> where('Login_Cli', $this->session->userdata('user'));
		
		if( ! $this-> db ->update('Cliente')){
			echo $this->db->error();
			return;
		}
		
		return $this->db->affected_rows();
	}
	

	public function delete_cliente($cod){
		$this->db->set('Status_Cli', false);
		$this->db->where('idCliente', $cod);
		$this->db->update('Cliente');
		return $this->db->affected_rows();
	}
	
	public function get_cli_lista(){
		$this-> db -> select ('idCliente, Nome_Cli, Status_Cli, Login_Cli');
		$this-> db -> from ('Cliente');
	
		$query = $this-> db -> get();
	
		return $query->result();
	}
		
	public function get_cli_ativo(){
		$this-> db -> select ('idCliente, Nome_Cli, Status_Cli, Login_Cli');
		$this-> db -> from ('Cliente');
		$this -> db -> where('Status_Cli', true);
	
		$query = $this-> db -> get();
	
		return $query->result();
	}
	
	public function get_cli_inativo(){
		$this-> db -> select ('idCliente, Nome_Cli, Status_Cli, Login_Cli');
		$this-> db -> from ('Cliente');
		$this -> db -> where('Status_Cli', false);
	
		$query = $this-> db -> get();
	
		return $query->result();
	}
	
	public function muda_status($dados){
		
		$this-> db -> set('Status_Cli',$dados['status']);
		$this-> db -> where('idCliente', $dados['id']);
		
		if( ! $this-> db -> update('Cliente')){
			var_dump ($this->db->error());
			return;
		}
		
		
		return $this-> db -> affected_rows();
		
	}
	
	public function troca_senha($senha, $user){
		
		$this->db->set('Senha_Cli', $senha);
		$this->db->where ('Login_Cli', $user);
		$this->db->update('Cliente');
		return $this->db->affected_rows();
		
		
	}
	
	public function get_senha($login){
		$this-> db -> select ('Senha_Cli');
		$this-> db -> from ('Cliente');
		$this-> db -> where('Login_Cli', $login );
		$this-> db -> limit(1);
	
		$query = $this-> db -> get();
	
		return $query->result();
	}
	
	
}