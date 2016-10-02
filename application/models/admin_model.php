<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		
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
	
	public function ativa_sessao(){
		$this-> db -> set('Sessao', true);
		$this-> db -> where('Login_Admin', $this->session->userdata('user'));
		$this-> db -> update('Administrador');
	}
	
	public function desativa_sessao(){
		$this-> db -> set('Sessao', false);
		$this-> db -> where('Login_Admin', $this->session->userdata('user'));
		$this-> db -> update('Administrador');
	}
	
	public function update_admin($admin){

		$this->db->set('Senha_Admin', $admin['senha']);
		$this->db->set('Nome_Admin', $admin['nome']);
		$this->db->set('Telefone_Admin', $admin['telefone']);
		$this->db->set('Email_Admin', $admin['email']);
		if($admin['status'] == "Ativo"){
			$this->db->set('Status_Admin', true);
		}
		else{
			$this->db->set('Status_Admin', false);
		}
		
		$this-> db -> where('Login_Admin', $this->session->userdata('user'));
		$this-> db ->update('Administrador');
		return $this->db->affected_rows();
	}
	
	
	public function troca_senha($senha, $user){
	
		$this->db->set('Senha_Admin', $senha);
		$this->db->where ('Login_Admin', $user);
		$this->db->update('Administrador');
		return $this->db->affected_rows();
	
	
	}
	
	
	
}