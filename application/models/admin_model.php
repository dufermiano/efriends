<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		
	}
	
	public function login($login, $senha){
		$this -> db -> select('idAdministrador, Login_Admin, Senha_Admin');
		$this -> db -> from('Administrador');
		$this->db->where('Login_Admin', $login);
		$this->db->where('Senha_Admin', $senha);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
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
}