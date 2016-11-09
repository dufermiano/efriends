<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		
	}
	

	public function log_admin_ebook($idAdmin, $idEbook, $acao){
	
		$dados = array(
				'Administrador_idAdministrador' => $idAdmin,
				'Ebook_idEbook' => $idEbook,
				'Acao_Admin_Ebook' => $acao
		);
	
		$this->db->set('Data_Acao', 'NOW()', FALSE);
	
		if( ! $this->db->insert('log_administrador_ebook', $dados)){
			var_dump( $this->db->error());
			return;
		}
	
	}
	
	public function log_admin_cliente($idAdmin, $idCliente, $acao){
	
		$dados = array(
				'Administrador_idAdministrador' => $idAdmin,
				'Cliente_idCliente' => $idCliente,
				'Acao_Admin_Cli' => $acao
		);
	
		$this->db->set('Data_Acao', 'NOW()', FALSE);
	
		if( ! $this->db->insert('log_administrador_cliente', $dados)){
			var_dump( $this->db->error());
			return;
		}
	
	}
	
	public function getIdAdmin($login){
		$this-> db -> select ('idAdministrador');
		$this-> db -> from ('Administrador');
		$this-> db -> where('Login_Admin', $login );
		$this-> db -> limit(1);
	
		$query = $this-> db -> get();
	
		return $query->result();
	}
	
	public function checa_login($login){
	
		$this-> db -> select ('idAdministrador');
		$this-> db -> from ('Administrador');
		$this-> db -> where('Login_Admin', $login );
		$this-> db -> limit(1);
	
		$query = $this-> db -> get();
	
		if($query->num_rows() != 0){
			return false;
		}
		else{
			return true;
		}
	}
	
	public function insert_admin($dados){
	
		$dados_admin = array(
				'nome_admin' => $dados['nome'],
				'email_admin' => $dados['email'],
				'telefone_admin' => $dados['telefone'],
				'status_admin' => true,
				'login_admin' => $dados['login'],
				'senha_admin' => $dados['senha'],
				'pergunta' => $dados['pergunta'],
				'resposta' => $dados['resposta']
		);
			
		$this->db->set('data_cadastro', 'NOW()', FALSE);
		$this->db->insert('administrador', $dados_admin);
	
		return $this->db->insert_id();
	}
	
	
	public function login($login, $senha){
		
		$sql = "select idAdministrador, Login_Admin from Administrador Where Login_Admin = '$login' AND Senha_Admin = '$senha' AND Status_Admin = true;";
		
		$query = $this->db->query($sql);
		
		if($query -> num_rows() == 1){
			return $query->result();
		}
		else{
			return false;
		}
		
	}
	
	public function get_admin(){
		$this-> db -> select ('*');
		$this-> db -> from ('Administrador');
		$this-> db -> where('Login_Admin', $this->session->userdata('user') );
		$this-> db -> limit(1);
		
		$query = $this-> db -> get();
		
		return $query->result();
	}
	
	public function update_admin($admin){
		$this->db->set('Nome_Admin', $admin['nome']);
		$this->db->set('Telefone_Admin', $admin['telefone']);
		$this->db->set('Email_Admin', $admin['email']);		
		$this->db->set('Pergunta', $admin['pergunta']);
		$this->db->set('Resposta', $admin['resposta']);
		$this-> db -> where('Login_Admin', $this->session->userdata('user'));
		$this-> db ->update('Administrador');
		return $this->db->affected_rows();
	}
	
	public function get_senha($login){
		$this-> db -> select ('Senha_Admin');
		$this-> db -> from ('Administrador');
		$this-> db -> where('Login_Admin', $login );
		$this-> db -> limit(1);
		
		$query = $this-> db -> get();
		
		return $query->result();
	}
	
	public function troca_senha($senha, $user){
	
		$this->db->set('Senha_Admin', $senha);
		$this->db->where ('Login_Admin', $user);
		$this->db->update('ADMINISTRADOR');
		return $this->db->affected_rows();
	
	
	}
	

	public function verificaPergunta($login){
		$this->db->select('Pergunta');
		$this-> db -> from ('Administrador');
		$this-> db -> where('Login_Admin', $login );
		$query = $this-> db -> get();
	
		return $query->result();
	}
	
	public function verificaResposta($login){
		$this->db->select('Resposta');
		$this-> db -> from ('Administrador');
		$this-> db -> where('Login_Admin', $login );
		$query = $this-> db -> get();
	
		return $query->result();
	}
	
	
	
}