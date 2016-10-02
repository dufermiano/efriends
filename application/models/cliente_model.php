<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('security');
	}
	
	public function insert_cliente($dados){

		$dados_cliente = array(
				'nome_cli' => $dados['nome'],
				'email_cli' => $dados['email'],
				'telefone_cli' => $dados['telefone'],
				'cpf_cli' => $dados['cpf'],
				'newsletter' => $dados['newsletter'],
				'status_cli' => true,
				'login_cli' => $dados['login'],
				'senha_cli' => $dados['senha']
		);
			
		$this->db->set('data_cadastro', 'NOW()', FALSE);
		$this->db->insert('cliente', $dados_cliente);
		 
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
	
	public function get_cli(){
		$this-> db -> select ('*');
		$this-> db -> from ('Cliente');
		$this-> db -> where('Login_Cli', $this->session->userdata('user') );
		$this-> db -> limit(1);
	
		$query = $this-> db -> get();
	
		return $query->result();
	}
	
	public function ativa_sessao(){
		$this-> db -> set('Sessao', true);
		$this-> db -> where('Login_Cli', $this->session->userdata('user'));
		$this-> db -> update('Cliente');
	}
	
	public function desativa_sessao(){
		$this-> db -> set('Sessao', false);
		$this-> db -> where('Login_Cli', $this->session->userdata('user'));
		$this-> db -> update('Cliente');
	}
	
	
	public function update_cliente($cli){
	
		$this->db->set('Nome_Cli', $cli['nome']);
		$this->db->set('Telefone_Cli', $cli['telefone']);
		$this->db->set('Email_Cli', $cli['email']);

		$this->db->set('CPF_Cli', $cli['cpf']);
		$this->db->set('Newsletter', $cli['newsletter']);
	
		$this-> db -> where('Login_Cli', $this->session->userdata('user'));
		$this-> db ->update('Cliente');
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
		$this-> db -> update('Cliente');
		return $this-> db -> affected_rows();
		
	}
	
	public function troca_senha($senha, $user){
		
		$this->db->set('Senha_Cli', $senha);
		$this->db->where ('Login_Cli', $user);
		$this->db->update('Cliente');
		return $this->db->affected_rows();
		
		
	}
	
	public function get_senha(){
		$this-> db -> select ('Senha_Cli');
		$this-> db -> from ('Cliente');
		$this-> db -> where('Login_Cli', $this->session->userdata('user') );
		$this-> db -> limit(1);
	
		$query = $this-> db -> get();
	
		return $query->result();
	}
	
	
}