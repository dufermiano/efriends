<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
	}
	public function dashboard() {
		$this->load->view ( 'dashboard/dashboard' );
		
	}
	public function index() {
		$this->load->view ( 'dashboard/index' );
	}
	public function relatorios() {
		$this->load->view ( 'dashboard/relatorios' );
	}
}	
