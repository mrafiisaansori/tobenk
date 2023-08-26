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
    function list()
    {
        //pagination setting
        $data = $this->db->query("SELECT * FROM view_penjualan ORDER BY ID DESC")->result();
        $per_page = 10;
        $total_data = count($data);
        $total_page = ceil($total_data / $per_page);
        $page = 1;
        if ($this->input->post('page')) {
            $page = $this->input->post('page');
        } else if ($this->session->userdata('page')) {
            $page = $this->session->userdata('page');
        }
        $offset = ($page - 1) * $per_page;
        //end pagination

        $data = $this->db->query("SELECT * FROM view_penjualan WHERE  STATUS_PENGERJAAN = 3 ORDER BY ID DESC LIMIT $per_page OFFSET $offset")->result();
        $data['data'] = $data;
        $data['current_page'] = $page;
        $data['total_page'] = $total_page;
        $data['page'] = 'produksi/list_kerjaan';
        $this->load->view($this->_template, $data);
    }

    function detailList($id)
    {
        $id = base64_decode_fix($id);
        $data["id"] = $id;
        $data['data'] = $this->db->get_where("view_penjualan", ["ID" => $id])->row();
        $data['produk'] = $this->db->get_where("view_detail_penjualan", ["ID_TRANSAKSI_PENJUALAN" => $id]);
        $data['revisi'] = $this->db->order_by("ID", "DESC")->get_where("t_revisi_desain", ["ID_PENJUALAN" => $id])->row();
        $data['page'] = 'produksi/detail_kerjaan';
        $this->load->view($this->_template, $data);
    }
    function selesaiProduksi($id)
    {
        $id = base64_decode_fix($id);
        $tgl = date("Y-m-d H:i:s");
        $this->db->query("UPDATE t_penjualan SET STATUS_PENGERJAAN=4,SELESAI='$tgl',SP_4='$tgl' WHERE ID='$id'");
        $return = array(
            'status' => true,
            'judul' => 'Success',
            'pesan' => "Produksi selesai",
            'type' => 'success'
        );
        $this->session->set_flashdata($return);
        redirect("produksi/detailList/" . base64_encode_fix($id));
    }


    function historiKerjaan()
    {
        $data['data'] = $this->db->get_where('view_penjualan', array('STATUS_PENGERJAAN >' => 2))->result();
        $data['page'] = 'produksi/histori_kerjaan';
        $this->load->view($this->_template, $data);
    }
    function detailHistoriKerjaan($id)
    {
        $id = base64_decode_fix($id);
        $data["id"] = $id;
        $data['data'] = $this->db->get_where("view_penjualan", ["ID" => $id])->row();
        $data['produk'] = $this->db->get_where("view_detail_penjualan", ["ID_TRANSAKSI_PENJUALAN" => $id]);
        $data['revisi'] = $this->db->order_by("ID", "DESC")->get_where("t_revisi_desain", ["ID_PENJUALAN" => $id])->row();
        $data['page'] = 'produksi/detail_histori_kerjaan';
        $this->load->view($this->_template, $data);
    }
    function modalHistoriRevisi($id)
    {
        $id = base64_decode_fix($id);
        $data['data'] = $this->db->get_where("t_revisi_desain", ["ID_PENJUALAN" => $id])->result();
        $this->load->view("desainer/modal_histori_revisi", $data);
    }
}
