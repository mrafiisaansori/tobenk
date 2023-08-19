<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produksi extends CI_Controller
{

    private $_template = 'produksi/produksi_us';

    function __construct()
    {
        parent::__construct();
        $this->cek_login->cek_login(3);
        $this->load->library('user_agent');
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        $hal = array('menu' => 'dashboard');
        $this->session->set_userdata($hal);

        $data['page'] = 'produksi/dashboard';
        $this->load->view($this->_template, $data);
    }

    public function password()
    {
        $id_produksi = $this->session->userdata("id_produksi");
        $data['data'] = $this->db->query("SELECT * FROM m_pengguna WHERE ID='$id_produksi'")->row();
        $data['page'] = 'produksi/password';
        $this->load->view($this->_template, $data);
    }
    public function changePass()
    {
        $id_user = $this->session->userdata("id_produksi");
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $re_password = $this->input->post('re_password');
        if ($new_password == $re_password) {
            $cek = $this->db->query("SELECT * FROM m_pengguna WHERE ID='$id_user'");
            if ($cek->num_rows() > 0) {
                if ($cek->row()->PASSWORD == $old_password) {
                    $this->db->query("UPDATE m_pengguna SET PASSWORD='$new_password' WHERE ID='$id_user'");
                    $return = array(
                        'status' => true,
                        'judul' => 'Success',
                        'pesan' => "Change password successfully",
                        'type' => 'success'
                    );
                    $this->session->set_flashdata($return);
                    redirect("produksi/password");
                } else {
                    $return = array(
                        'status' => true,
                        'judul' => 'Failed',
                        'pesan' => "Old password doesnt match.",
                        'type' => 'error'
                    );
                    $this->session->set_flashdata($return);
                    redirect("produksi/password");
                }
            }
        } else {
            $return = array(
                'status' => true,
                'judul' => 'Failed',
                'pesan' => "New password doesnt match.",
                'type' => 'error'
            );
            $this->session->set_flashdata($return);
            redirect("produksi/password");
        }
    }
}
