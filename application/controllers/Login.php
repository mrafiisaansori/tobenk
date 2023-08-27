<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->cek_login->cek_login();
		$this->load->view('login');
	}
	public function login()
	{
		$username = cleanText($this->input->post("username"));
		$password = cleanText($this->input->post("password"));
		$where = array('USERNAME' => $username);
		$cek = $this->login_model->searchData("m_pengguna", $where, "row");
		if ($cek) {
			if ($cek->PASSWORD == $password) {
				if ($cek->LEVEL == 1) {
					$sesi = array('nama_admin' => $cek->NAMA, 'id_admin' => $cek->ID, 'level' => $cek->LEVEL);
					$this->session->set_userdata($sesi);
					redirect("admin");
				} elseif ($cek->LEVEL == 2) {
					$sesi = array('nama_kasir' => $cek->NAMA, 'id_kasir' => $cek->ID, 'level' => $cek->LEVEL);
					$this->session->set_userdata($sesi);
					redirect("kasir");
				} elseif ($cek->LEVEL == 3) {
					if($this->session->userdata("id_qr")){
						$sesi = array('nama_produksi' => $cek->NAMA, 'id_produksi' => $cek->ID, 'level' => $cek->LEVEL);
						$this->session->set_userdata($sesi);
						redirect("produksi/detailList/".base64_encode_fix($this->session->userdata("id_qr")));
					}
					else{
						$sesi = array('nama_produksi' => $cek->NAMA, 'id_produksi' => $cek->ID, 'level' => $cek->LEVEL);
						$this->session->set_userdata($sesi);
						redirect("produksi");
					}
				} elseif ($cek->LEVEL == 4) {
					$sesi = array('nama_desainer' => $cek->NAMA, 'id_desainer' => $cek->ID, 'level' => $cek->LEVEL);
					$this->session->set_userdata($sesi);
					redirect("desainer");
				} elseif ($cek->LEVEL == 5) {
					$sesi = array('nama_admin' => $cek->NAMA, 'id_admin' => $cek->ID, 'level' => 1, 'manager' => 1);
					$this->session->set_userdata($sesi);
					redirect("admin");
				}
			} else {
				$sesi  = array(
					'wrong' => true
				);
				$this->session->set_flashdata($sesi);
				redirect('login');
			}
		} else {
			$sesi  = array(
				'wrong' => true
			);
			$this->session->set_flashdata($sesi);
			redirect('login');
		}
	}
	function logout()
	{
		session_destroy();
		redirect('');
	}
}
