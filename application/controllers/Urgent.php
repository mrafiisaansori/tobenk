<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urgent extends CI_Controller {

	private $_template = 'admin/admin_us';
	
	function __construct(){
		parent::__construct();
		$this->cek_login->cek_login_admin();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function penyusutan($id)
	{
		$hal = array('menu'=>'penyusutan');
		$this->session->set_userdata($hal);
		$data['produk'] = $this->db->query("SELECT * FROM m_produk WHERE ID='$id'");
		$data['detail_pembelian'] = $this->db->query("SELECT * FROM t_penyusutan_produk WHERE ID_PRODUK='$id'");
		$data['page'] = 'admin/penyusutan';
		$this->load->view($this->_template,$data);
	}
	public function dopenyusutan($id)
	{
		$harga_pokok = $this->input->post('harga_pokok');
		$prosentase = $this->input->post('prosentase');
		$harga_pokok_penjualan = $this->input->post('harga_pokok_penjualan');
		$tanggal = date('Y-m-d H:i:s');
		$data = array(
	        'HARGA_JUAL_AWAL' => $harga_pokok,
	        'HARGA_JUAL_AKHIR' => $harga_pokok_penjualan,
	        'PROSENTASE_PENYUSUTAN' => $prosentase,
	        'TANGGAL' => $tanggal,
	        'ID_PRODUK' => $id
		);
		$this->db->insert('t_penyusutan_produk', $data);
		$this->db->query("UPDATE m_produk SET HARGA_JUAL='$harga_pokok_penjualan' WHERE ID='$id'");
		$this->session->set_flashdata('judul','Berhasil');
		$this->session->set_flashdata('status','Berhasil melakukan penyusutan harga jual produk');
		$this->session->set_flashdata('type','success');
		redirect('urgent/penyusutan/'.$id);
	}
	public function hapuspenyusutan($id)
	{
		$cek = $this->db->query("SELECT * FROM t_penyusutan_produk WHERE ID='$id'");
		if($cek->num_rows()>0)
		{
			$id_produk = $cek->row()->ID_PRODUK;
			$harga_pokok_penjualan = $cek->row()->HARGA_JUAL_AWAL;
			$this->db->query("UPDATE m_produk SET HARGA_JUAL='$harga_pokok_penjualan' WHERE ID='$id_produk'");
			$this->db->query("DELETE FROM t_penyusutan_produk WHERE ID='$id'");
			$this->session->set_flashdata('judul','Berhasil');
			$this->session->set_flashdata('status','Berhasil menghapus data penyusutan.');
			$this->session->set_flashdata('type','success');
			redirect('urgent/penyusutan/'.$id_produk);
		}
		else
		{
			$this->session->set_flashdata('judul','Gagal');
			$this->session->set_flashdata('status','Gagal melakukan penghapusan penyusutan produk.');
			$this->session->set_flashdata('type','error');
			redirect('urgent/produk.html');
		}
	}
	public function laporan_penyusutan()
	{
		$hal = array('menu'=>'laporan');
		$this->session->set_userdata($hal);
		$data['page'] = 'admin/laporan_penyusutan';
		$this->load->view($this->_template,$data);
	}
	public function dolaporanpenyusutan()
	{
		$tanggal_awal = $this->input->post("tanggal_awal");
		$tanggal_akhir = $this->input->post("tanggal_akhir");
		$data['detail_pembelian'] = $this->db->query("SELECT * FROM view_penyusutan_produk WHERE TANGGAL BETWEEN '$tanggal_awal 00:00:01' AND '$tanggal_akhir 23:00:59' ORDER BY TANGGAL ASC");
		$data['page'] = 'admin/dolaporanpenyusutan';
		$this->load->view($data['page'],$data);
	}

	public function laporan_pendapatan()
	{
		$hal = array('menu'=>'laporan');
		$this->session->set_userdata($hal);
		$data['page'] = 'admin/laporan_pendapatan';
		$this->load->view($this->_template,$data);
	}
	public function dolaporanpendapatan()
	{
		$tanggal_awal = $this->input->post("tanggal_awal");
		$tanggal_akhir = $this->input->post("tanggal_akhir");
		$status = $this->input->post("status");
		$data['tanggal_awal']= $tanggal_awal;
		$data['tanggal_akhir'] = $tanggal_akhir;
		$data['status'] = $status;
		$data['detail_pembelian'] = $this->db->query("SELECT DISTINCT(TANGGAL) FROM t_penjualan WHERE TANGGAL BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND `STATUS`='$status'");
		$data['page'] = 'admin/dolaporanpendapatan';
		$this->load->view($data['page'],$data);
	}
	public function cetak_laporan_pendapatan($tanggal,$status){
		$data['tanggal'] = $tanggal;
		$data['status'] = $status;
		if($status==1){
			$status="Transaksi Berhasil";
		}
		else{
			$status="Pembatalan Transaksi";
		}
		$data['nama_status'] = $status;
		$data['detail_penjualan'] = $this->db->query("SELECT * FROM view_detail_penjualan WHERE TANGGAL='$tanggal' AND `STATUS`='$status'")->result();
		$this->load->view('admin/cetakLaporanPendapatan',$data);
	}
	public function cetaklappendapatan($tanggal_awal,$tanggal_akhir,$status){
		$data['tanggal_awal']= $tanggal_awal;
		$data['tanggal_akhir'] = $tanggal_akhir;
		$data['status'] = $status;
		if($status==1){
			$status="Transaksi Berhasil";
		}
		else{
			$status="Pembatalan Transaksi";
		}
		$data['nama_status'] = $status;
		$data['detail_pembelian'] = $this->db->query("SELECT DISTINCT(TANGGAL) FROM t_penjualan WHERE TANGGAL BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND `STATUS`='$status'");
		$this->load->view('admin/cetaklappendapatan',$data);
	}


	public function laporan_stok()
	{
		$hal = array('menu'=>'laporan_stok');
		$this->session->set_userdata($hal);
		$data['page'] = 'admin/laporan_stok';
		$this->load->view($this->_template,$data);
	}
	public function dolaporanstok()
	{
		$tahun = $this->input->post("tahun");
		$data['tahun']=$tahun;
		$data['detail_pembelian'] = $this->db->query("SELECT * FROM m_produk ORDER BY NAMA ASC");
		$data['page'] = 'admin/dolaporanstok';
		$this->load->view($data['page'],$data);
	}
}	
