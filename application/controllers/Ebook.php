<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Ebook extends CI_Controller {
	function __construct() {
		/* método construtor, carrega o helper de url para base_url */
		/* carrega o model de ebooks */
		/* carrega a library de upload */
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->model ( 'Ebook_model', 'ebook' );
		$this->load->library ( 'upload', upload_capa () );
	}
	
	// método principal, acessa o cadastro das obras
	public function index() {
		$this->load->view ( 'dashboard/cadastro-obra' );
	}
	
	// método para cadastro do ebook
	public function insere_ebook() {
		if ($this->upload->do_upload ( 'capa' )) {
			
			$upload_capa = $this->upload->data ();
			$ebook = $this->input->post ();
			$dados_insert ['titulo'] = $ebook ['titulo'];
			$dados_insert ['descricao'] = $ebook ['descricao'];
			$dados_insert ['autor'] = $ebook ['autor'];
			$dados_insert ['preco'] = $ebook ['preco'];
			$dados_insert ['categoria'] = $ebook ['categoria'];
			
			$dados_insert ['capa'] = upload_s3 ( 'users-capas', $upload_capa );
			
			// upload da capa realizado agora realizar da obra
			
			$this->upload->do_upload ( 'obra' );
			
			$upload_obra = $this->upload->data ();
			
			$dados_insert ['obra'] = upload_s3 ( 'users-obras', $upload_obra );
		} else {
			$msg = $this->upload->display_errors ();
			set_msg ( $msg );
		}
		
		$result = $this->ebook->insert_ebook ( $dados_insert );
		if ($result) {
			set_msg ( "<p>Inserção feita com sucesso</p>" );
			redirect ( 'ebook', 'refresh' );
		}
	}
	
	// método para alteração do ebook
	public function altera_ebook() {
		
		// se o upload estiver vazio, ou seja, o usuário não quer atualizar a capa nem a obra
		if (empty ( $_FILES ['capa'] ['name'] ) && empty ( $_FILES ['obra'] ['name'] )) { // se não for feito upload de capa
			
			$ebook = $this->input->post ();
			$dados_ebook ['titulo'] = $ebook ['titulo'];
			$dados_ebook ['descricao'] = $ebook ['descricao'];
			$dados_ebook ['autor'] = $ebook ['autor'];
			$dados_ebook ['preco'] = $ebook ['preco'];
			$dados_ebook ['status'] = $ebook ['status'];
			$dados_ebook ['categoria'] = $ebook ['categoria'];
		}  // se tiver arquivo para upload
else {
			// se o upload de OBRA for vazio, insere APENAS a capa
			if (empty ( $_FILES ['obra'] ['name'] )) :
				// se o upload não tiver erro
				if ($this->upload->do_upload ( 'capa' )) {
					$dados_upload = $this->upload->data ();
					$ebook = $this->input->post ();
					$dados_ebook ['titulo'] = $ebook ['titulo'];
					$dados_ebook ['descricao'] = $ebook ['descricao'];
					$dados_ebook ['autor'] = $ebook ['autor'];
					$dados_ebook ['preco'] = $ebook ['preco'];
					$dados_ebook ['categoria'] = $ebook ['categoria'];
					$dados_ebook ['status'] = $ebook ['status'];
					// update da capa no S3
					
					$dados_ebook ['capa'] = upload_s3 ( 'users-capas', $dados_upload );
				}  // se o upload tiver erro, exibe mensagem do CodeIgniter
else {
					$msg = $this->upload->upload_errors ();
					set_msg ( $msg );
				}
						// se APENAS o upload da CAPA for vazio, ele insere APENAS a obra
			elseif (empty ( $_FILES ['capa'] ['name'] )) :
				
				if ($this->upload->do_upload ( 'obra' )) {
					$dados_upload = $this->upload->data ();
					$ebook = $this->input->post ();
					$dados_ebook ['titulo'] = $ebook ['titulo'];
					$dados_ebook ['descricao'] = $ebook ['descricao'];
					$dados_ebook ['autor'] = $ebook ['autor'];
					$dados_ebook ['preco'] = $ebook ['preco'];
					$dados_ebook ['categoria'] = $ebook ['categoria'];
					$dados_ebook ['status'] = $ebook ['status'];
					// update da obra no S3
					
					$dados_ebook ['obra'] = upload_s3 ( 'users-obras', $dados_upload );
				}  // se o upload tiver erro, exibe mensagem do CodeIgniter
else {
					$msg = $this->upload->upload_errors ();
					set_msg ( $msg );
				}
			 			// se NENHUM DELES estiver VAZIO, insere AMBOS, OBRA E CAPA
			else :
				if ($this->upload->do_upload ( 'capa' )) {
					$upload_capa = $this->upload->data ();
					$ebook = $this->input->post ();
					$dados_ebook ['titulo'] = $ebook ['titulo'];
					$dados_ebook ['descricao'] = $ebook ['descricao'];
					$dados_ebook ['autor'] = $ebook ['autor'];
					$dados_ebook ['preco'] = $ebook ['preco'];
					$dados_ebook ['categoria'] = $ebook ['categoria'];
					$dados_ebook ['status'] = $ebook ['status'];
					
					$dados_ebook ['capa'] = upload_s3 ( 'users-capas', $upload_capa );
					
					// upload da capa realizado agora realizar da obra
					
					$this->upload->do_upload ( 'obra' );
					
					$upload_obra = $this->upload->data ();
					
					$dados_ebook ['obra'] = upload_s3 ( 'users-obras', $upload_obra );
				}  // se o upload tiver erro, exibe mensagem do CodeIgniter
else {
					$msg = $this->upload->upload_errors ();
					set_msg ( $msg );
				}
			

			endif;
		}
		
		$idEbook = $this->input->get ( 'cod' );
		
		$result = $this->ebook->update_ebook ( $dados_ebook, $idEbook );
		
		if (! empty ( $dados_upload )) {
			unlink ( $dados_upload ['full_path'] );
		} elseif (! empty ( $upload_capa ) && ! empty ( $upload_obra )) {
			unlink ( $upload_capa ['full_path'] );
			unlink ( $upload_obra ['full_path'] );
		}
		
		if ($result) {
			set_msg ( "<p>Alteração feita com sucesso</p>" );
			redirect ( 'catalogo_obra', 'refresh' );
		}
	}
	
	// método para exclusão do ebook ainda é preciso verificar a regra de negócio para exclusão
	public function exclui_ebook() {
		$idEbook = $this->input->get ( 'cod' );
		
		$result = $this->ebook->delete_ebook ( $idEbook );
		
		if ($result) {
			set_msg ( "<p>Exclusão feita com sucesso</p>" );
			
			redirect ( 'catalogo_obra', 'refresh' );
		}
	}
	
	// carrega o catalogo de obras do banco de dados
	public function catalogo_obra() {
		$sessao = $this->session->userdata ( 'tipo' );
		
		if ($sessao == 'cliente') {
			$dados_ebook ['ebook'] = $this->ebook->get_catalogo_cli ();
		} else {
			$dados_ebook ['ebook'] = $this->ebook->get_catalogo_geral ();
		}
		
		$this->load->view ( 'dashboard/catalogo-obra', $dados_ebook );
	}
	
	// carrega o gerenciamento do ebook selecionado no catalogo
	public function gerencia_ebook() {
		$dados_ebook ['ebook'] = $this->ebook->get_ebook ( $this->input->get ( 'cod' ) );
		
		$this->load->view ( 'dashboard/gerencia-ebook', $dados_ebook );
	}
	
	// carrega o livro selecionado ao clicar no botão 'sobre'
	public function sobre_livro() {
		
		$dados_ebook ['ebook'] = $this->ebook->sobre ( $this->input->get ( 'cod' ) );

		$this->load->view ( 'plataforma/sobre', $dados_ebook );
		
	}
}




