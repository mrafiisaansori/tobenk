<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Desainer extends CI_Controller
{

    private $_template = 'desainer/desainer_us';

    function __construct()
    {
        parent::__construct();
        $this->cek_login->cek_login(4);
        $this->load->library('user_agent');
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        $hal = array('menu' => 'dashboard');
        $this->session->set_userdata($hal);

        $data['page'] = 'desainer/dashboard';
        $this->load->view($this->_template, $data);
    }

    public function password()
    {
        $id_desainer = $this->session->userdata("id_desainer");
        $data['data'] = $this->db->query("SELECT * FROM m_pengguna WHERE ID='$id_desainer'")->row();
        $data['page'] = 'desainer/password';
        $this->load->view($this->_template, $data);
    }
    public function changePass()
    {
        $id_user = $this->session->userdata("id_desainer");
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
                    redirect("desainer/password");
                } else {
                    $return = array(
                        'status' => true,
                        'judul' => 'Failed',
                        'pesan' => "Old password doesnt match.",
                        'type' => 'error'
                    );
                    $this->session->set_flashdata($return);
                    redirect("desainer/password");
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
            redirect("desainer/password");
        }
    }

    function list()
    {
        $data['data'] = $this->db->get_where('view_penjualan', array('STATUS >=' => 1))->result();
        $data['page'] = 'desainer/list_kerjaan';
        $this->load->view($this->_template, $data);
    }
    function detailList($id)
    {
        $id = base64_decode_fix($id);
        $data["id"] = $id;
        $data['data'] = $this->db->get_where("view_penjualan", ["ID" => $id])->row();
        $data['produk'] = $this->db->get_where("view_detail_penjualan", ["ID_TRANSAKSI_PENJUALAN" => $id]);
        $data['page'] = 'desainer/detail_kerjaan';
        $this->load->view($this->_template, $data);
    }
    function uploadDesain($id)
    {
        $id = base64_decode_fix($id);
        $detail = $this->db->get_where("view_penjualan", ["ID" => $id])->row();
        if ($detail->STATUS_PENGERJAAN > 2) {
            $return = array(
                'status' => true,
                'judul' => 'Failed',
                'pesan' => "You cant upload design again.",
                'type' => 'error'
            );
            $this->session->set_flashdata($return);
            redirect("desainer/detailList/" . base64_encode_fix($id));
        }

        $data_update = array(
            'FILE_MENTAH' => $this->input->post('file_mentah'),
        );

        $config['upload_path']          = './upload/mockup/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['file_name']            = base64_encode_fix($_FILES['mockup']['name']);
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('mockup')) {
            $data_update['MOCKUP'] = $this->upload->data('file_name');
            $data_update['STATUS_PENGERJAAN'] = 1;
        }
        $this->db->update("t_penjualan", $data_update, ["ID" => $id]);
        //unlink last mockup
        if (isset($data_update['MOCKUP']) && $data_update['MOCKUP'] != "") {
            unlink("./upload/mockup/" . $detail->MOCKUP);
        }
        $return = array(
            'status' => true,
            'judul' => 'Success',
            'pesan' => "Upload mockup successfully",
            'type' => 'success'
        );
        $this->session->set_flashdata($return);
        redirect("desainer/detailList/" . base64_encode_fix($id));
    }
}
