<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ebook_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	public function insert_ebook($ebook){
		
         $dados_ebook = array(
         		
         		'capa' => $ebook['capa'],
         		'titulo_ebook' => $ebook['titulo'],
         		'descricao_ebook' => $ebook['descricao'],
         		'autor_ebook' => $ebook['autor'],
         		'preco_ebook' => $ebook['preco'], 
         		'categoria' => $ebook['categoria'],
         		'status_ebook' => true,
         		'obra' => $ebook['obra']
         		
         		);
		 
         $this->db->set('data_cadastro', 'NOW()', FALSE);
         $this->db->insert('ebook', $dados_ebook); 
         
		 return $this->db->insert_id(); 

	}
	
	public function get_catalogo_cli(){
		
		$sql = "select ebook.idEbook as idEbook, 
				ebook.capa as Capa, 
				ebook.Descricao_Ebook as Descricao_Ebook, 
				ebook.Titulo_Ebook as Titulo_Ebook 
				from log_cliente_ebook
				inner join ebook on ebook.idEbook = log_cliente_ebook.Ebook_idEbook
				inner join cliente on cliente.idCliente = log_cliente_ebook.Cliente_idCliente
				where cliente.sessao = true;";
		
		$query = $this->db->query($sql);
		return $query->result();
		
	}
	
	public function get_catalogo_geral(){
		$query = $this->db->get('ebook');
		return $query->result();
	}
	
	public function get_ebook($idEbook){
		$this->db->where('idEbook', $idEbook);
		$query = $this->db->get('ebook', 1);
		return $query->result();
	}
	
	public function update_ebook($ebook, $idEbook){
		
			if(!empty($ebook['capa'])){
				$this->db->set('capa', $ebook['capa']);
			}
			if(!empty($ebook['obra'])){
				$this->db->set('obra', $ebook['obra']);
			}
			$this->db->set('titulo_ebook', $ebook['titulo']);
			$this->db->set('descricao_ebook', $ebook['descricao']);
			$this->db->set('autor_ebook', $ebook['autor'] );
			$this->db->set('preco_ebook', $ebook['preco']);
			$this->db->set('categoria', $ebook['categoria']);
			if($ebook['status'] == "Ativo"){
				$this->db->set('status_ebook', true);
			}
			else{
				$this->db->set('status_ebook', false);
			}
			$this->db->where('idEbook', $idEbook);
			$this->db->update('ebook');
			
			return $this->db->affected_rows();
		
	}
	
	public function delete_ebook($idEbook){
		$this->db->where('idEbook', $idEbook);
		$this->db->delete('ebook');
		
		return $this->db->affected_rows();
	}
	
	//funcao que carrega o livro na página inicial de acordo com o status
	public function carrega_site(){
		$this->db->where('Status_ebook', true);
		$this->db->limit(5);
		$query = $this->db->get('Ebook');
		return $query->result();
	}
	
	//funcao que carrega o livro na seção 
	public function sobre($idEbook){
		
		$this->db->select('Titulo_Ebook, Descricao_Ebook, Autor_Ebook, Preco_Ebook, Capa, Categoria');
		$this->db->from('ebook');
		$this-> db -> where ('idEbook', $idEbook);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function todos(){
		$this->db->where('Status_ebook', true);
		$query = $this->db->get('ebook');
		return $query->result();
	}
		

}
