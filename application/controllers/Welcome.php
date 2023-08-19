<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
	 parent::__construct();
  	}
	public function cetak($id)
	{
		$all=base64_decode_fix($id);
		$a=explode("#",$all);
		$id=$a[0];
		$data['link']=$all;
		$data['data'] = $this->db->query("SELECT * FROM view_penjualan WHERE ID='$id'")->row();
		$data['produk'] = $this->db->query("SELECT * FROM view_detail_penjualan WHERE ID_TRANSAKSI_PENJUALAN='$id'")->result();
		$data['page'] = 'cetak';
		$this->load->view($data['page'],$data);
	}
}
