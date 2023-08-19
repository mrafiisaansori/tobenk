<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	private $_template = 'kasir/kasir_us';
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function menu()
	{
		$hal = array('menu'=>'menu');
		$this->session->set_userdata($hal);
		$data['page'] = 'kasir/menu';
		$this->load->view($this->_template,$data);
	}
}
