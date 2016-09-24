<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->library('session');
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
		
		$this -> db -> select('idCliente, Login_Cli, Senha_Cli');
		$this -> db -> from('Cliente');
		$this->db->where('Login_Cli', $login);
		$this->db->where('Senha_Cli', $senha);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
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
	
		$this->db->set('Senha_Cli', $cli['senha']);
		$this->db->set('Nome_Cli', $cli['nome']);
		$this->db->set('Telefone_Cli', $cli['telefone']);
		$this->db->set('Email_Cli', $cli['email']);
		$this->db->set('Senha_Cli', $cli['senha']);
		if($cli['status'] == "Ativo"){
			$this->db->set('Status_Cli', true);
		}
		else{
			$this->db->set('Status_Cli', false);
		}
		$this->db->set('CPF_Cli', $cli['cpf']);
		$this->db->set('Newsletter', $cli['newsletter']);
	
		$this-> db -> where('Login_Cli', $this->session->userdata('user'));
		$this-> db ->update('Cliente');
		return $this->db->affected_rows();
	}
	
	
	
	
}