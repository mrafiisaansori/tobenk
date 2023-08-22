<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{

	private $_template = 'kasir/kasir_us';
	private $_template_full = 'kasir/kasir_us_full';

	function __construct()
	{
		parent::__construct();
		$this->cek_login->cek_login(2);
		$this->load->library('user_agent');
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index()
	{
		$hal = array('menu' => 'dashboard');
		$this->session->set_userdata($hal);

		$data['page'] = 'kasir/dashboard';
		$this->load->view($this->_template, $data);
	}
	public function transaksi()
	{
		$hal = array('menu' => 'transaksi');
		$this->session->set_userdata($hal);



		$data['page'] = 'kasir/transaksi';
		$this->load->view($this->_template, $data);
	}

	public function cari()
	{
		$nama = $this->input->post("nama");
		$cek = $this->db->query("SELECT * FROM m_produk WHERE NAMA LIKE '%$nama%' ORDER BY NAMA ASC");
		if ($cek->num_rows() > 0) {
			foreach ($cek->result() as $key) {
				echo "<option value='" . $key->ID . "'>" . $key->NAMA . "</option>";
			}
		}
	}
	public function tabel()
	{
		$data['page'] = 'kasir/tabel';
		$this->load->view($data['page'], $data);
	}
	public function total()
	{
		$diskon = str_replace(".", "", $this->input->post("diskon"));
		if ($diskon > 0) {
			$hd = $this->cart->total() - $diskon;
			echo $this->cart->total() . "#" . formatRupiah($hd) . "#" . count($this->cart->contents()) . "#" . $hd;
		} else {
			echo $this->cart->total() . "#" . formatRupiah($this->cart->total()) . "#" . count($this->cart->contents()) . "#" . $this->cart->total();
		}
	}
	public function barcode()
	{
		$barcode = $this->input->post("barcode");
		$cek = $this->db->query("SELECT * FROM m_produk WHERE BARCODE='$barcode'");
		if ($cek->num_rows() > 0) {
			if ($cek->row()->STOK > 0) {
				if ($this->cart->contents()) {
					$qty_old = 1;
					foreach ($this->cart->contents() as $item) {
						if ($item['id'] == $cek->row()->ID) {
							$qty_old = $item['qty'] + 1;
						}
					}
					if ($qty_old <= $cek->row()->STOK) {
						$data = array(
							'id'      => $cek->row()->ID,
							'qty'     => 1,
							'price'   => $cek->row()->HARGA_JUAL,
							'name'    => $cek->row()->NAMA
						);
						$this->cart->insert($data);
						echo "1";
					} else {
						echo "0";
					}
				} else {
					$data = array(
						'id'      => $cek->row()->ID,
						'qty'     => 1,
						'price'   => $cek->row()->HARGA_JUAL,
						'name'    => $cek->row()->NAMA
					);
					$this->cart->insert($data);
					echo "1";
				}
			} else {
				echo "0";
			}
		} else {
			echo "99";
		}
	}
	public function beli()
	{
		$barang = $this->input->post("barang");
		$cek = $this->db->query("SELECT * FROM view_produk_detail WHERE ID='$barang'");
		if ($cek->num_rows() > 0) {

			if($cek->row()->TANPA_STOK==1){
				if ($this->cart->contents()) {
					$qty_old = 1;
					foreach ($this->cart->contents() as $item) {
						if ($item['id'] == $cek->row()->ID) {
							$qty_old = $item['qty'] + 1;
						}
					}
					$data = array(
						'id'      => $cek->row()->ID,
						'qty'     => 1,
						'price'   => $cek->row()->HARGA_JUAL,
						'name'    => base64_encode_fix($cek->row()->NAMA)
					);
					$this->cart->insert($data);
					echo "1";
				} else {
					$data = array(
						'id'      => $cek->row()->ID,
						'qty'     => 1,
						'price'   => $cek->row()->HARGA_JUAL,
						'name'    => base64_encode_fix($cek->row()->NAMA)
					);
					$this->cart->insert($data);
					echo "1";
				}
			}
			else
			{
				if ($cek->row()->STOK > 0) {
					if ($this->cart->contents()) {
						$qty_old = 1;
						foreach ($this->cart->contents() as $item) {
							if ($item['id'] == $cek->row()->ID) {
								$qty_old = $item['qty'] + 1;
							}
						}
						if ($qty_old <= $cek->row()->STOK) {
							$data = array(
								'id'      => $cek->row()->ID,
								'qty'     => 1,
								'price'   => $cek->row()->HARGA_JUAL,
								'name'    => base64_encode_fix($cek->row()->NAMA)
							);
							$this->cart->insert($data);
							echo "1";
						} else {
							echo "0";
						}
					} else {
						$data = array(
							'id'      => $cek->row()->ID,
							'qty'     => 1,
							'price'   => $cek->row()->HARGA_JUAL,
							'name'    => base64_encode_fix($cek->row()->NAMA)
						);
						$this->cart->insert($data);
						echo "1";
					}
				} else {
					echo "0";
				}
			}

		} else {
			echo "99";
		}
	}
	function gantiqty()
	{
		$produk = $this->input->post('produk');
		$produk = $this->db->query("SELECT * FROM view_produk_detail WHERE ID='$produk'")->row();
		if($produk->TANPA_STOK==0){
			if ($this->input->post('qty') <= $produk->STOK) {
				$rowid = $this->input->post('rowid');
				$qty = $this->input->post('qty');
				$data = array(
					'rowid'   => $rowid,
					'qty'     => $qty
				);
				$this->cart->update($data);
				echo 1;
			} else {
				echo 99;
			}
		}
		else
		{
			$rowid = $this->input->post('rowid');
			$qty = $this->input->post('qty');
			$data = array(
				'rowid'   => $rowid,
				'qty'     => $qty
			);
			$this->cart->update($data);
			echo 1;
		}
	}
	public function batal()
	{
		$rowid = $this->input->post('id');
		$data = array(
			'rowid'   => $rowid,
			'qty'     => 0
		);
		$this->cart->update($data);
	}
	public function bayar()
	{
		$nominal_belanja = $this->input->post("nominal_belanja");
		$jenis = $this->input->post("jenis");
		$bayar = str_replace(".", "", $this->input->post("bayar"));
		$keterangan = $this->input->post("keterangan");
		$diskon = str_replace(".", "", $this->input->post("diskon"));
		if ($diskon) {
			$diskon = $diskon;
		} else {
			$diskon = "0";
		}

		// $od_sph = $this->input->post("od-sph");
		// $od_cyl = $this->input->post("od-cyl");
		// $od_axis = $this->input->post("od-axis");
		// $od_add = $this->input->post("od-add");
		// $od_pd = $this->input->post("od-pd");
		// $os_sph = $this->input->post("os-sph");
		// $os_cyl = $this->input->post("os-cyl");
		// $os_axis = $this->input->post("os-axis");
		// $os_add = $this->input->post("os-add");
		// $os_pd = $this->input->post("os-pd");

		$metode = $this->input->post("metode");
		$resep = $this->input->post("resep");
		$estimasi = $this->input->post("estimasi");
		$customer = $this->input->post("customer");
		$status = $this->input->post("status");
		$file_mentah = $this->input->post("file_mentah");

		
		$id_kasir = $this->session->userdata("id_kasir");
		$tanggal = date("Y-m-d");
		$jam = date("H:i:s");

		if ($metode == 2) {
			$lunas = 0;
			$bayar = $bayar;
		} else {
			$lunas = 1;
			$bayar = $nominal_belanja - $diskon;
		}

		if ($this->cart->contents()) {
			$lebih = 0;
			$notes = '';
			foreach ($this->cart->contents() as $items) {
				//Cek Stok
				$id = $items['id'];
				$qty = $items['qty'];
				$produk = $this->db->query("SELECT * FROM m_produk WHERE ID='$id'");
				if ($produk->num_rows() > 0) {
					if ($qty > $produk->row()->STOK) {
						$lebih += 1;
						$notes .= $produk->row()->NAMA . " (" . $produk->row()->NAMA . ")\r\n";
					}
				}
			}
			//echo $lebih." - ".$notes;exit();
			if ($lebih > 0) {
				$return = array(
					'status' => true,
					'judul' => 'Produk Ini Melebihi Stok',
					'pesan' => $notes,
					'type' => 'warning'
				);
				$this->session->set_flashdata($return);
				if ($this->agent->is_mobile()) {
					redirect('transaksi-mobile.html');
				} else {
					redirect('transaksi-full.html');
				}
			}

			//End Cek Stok
			$file_name="";
			if ($_FILES['file_customer']['name']) {
				$config['upload_path'] = './upload/file_customer/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|cdr';
				$config['max_size'] = 2046;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file_customer')) {
					$this->session->set_flashdata('judul', 'Produk');
					$this->session->set_flashdata('status', $this->upload->display_errors());
					$this->session->set_flashdata('type', 'error');
					redirect('transaksi-full.html');
				} else {
					$upload_data = $this->upload->data();
					$file_name = $upload_data['file_name'];
				}
			}

			$data = array(
				'TANGGAL' => $tanggal,
				'JAM' => $jam,
				'ID_JENIS_BAYAR' => $jenis,
				'TOTAL' => $nominal_belanja,
				'ID_USER' => $id_kasir,
				'KETERANGAN' => $keterangan,
				'DISKON' => $diskon,
				'RESEP' => $resep,
				'ESTIMASI_SELESAI' => $estimasi,
				'ID_CUSTOMER' => $customer,
				// 'OD_SPH' => $od_sph,
				// 'OD_CYL' => $od_cyl,
				// 'OD_AXIS' => $od_axis,
				// 'OD_ADD' => $od_add,
				// 'OD_PD' => $od_pd,
				// 'OS_SPH' => $os_sph,
				// 'OS_CYL' => $os_cyl,
				// 'OS_AXIS' => $os_axis,
				// 'OS_ADD' => $os_add,
				// 'OS_PD' => $os_pd,
				'ID_METODE_BAYAR' => $metode,
				'BAYAR' => $bayar,
				'STATUS_PENGERJAAN' => 0,
				'LUNAS' => $lunas,
				'FILE_MENTAH' => $file_mentah,
				'FILE_CUSTOMER' => $file_name
			);
			$this->db->insert('t_penjualan', $data);
			$id_last = $this->db->insert_id();

			foreach ($this->cart->contents() as $items) {
				$id = $items['id'];
				$qty = $items['qty'];
				$produk = $this->db->query("SELECT * FROM view_produk_detail WHERE ID='$id'");
				if ($produk->num_rows() > 0) {
					$harga_beli = $produk->row()->HARGA_BELI;
					$harga_jual = $items['price'];
					$id_produk=$produk->row()->ID_PRODUK;
					$data2 = array(
						'ID_TRANSAKSI_PENJUALAN' => $id_last,
						'ID_PRODUK' => $id_produk,
						'HARGA_BELI' => $harga_beli,
						'HARGA_JUAL' => $harga_jual,
						'QTY' => $qty,
						'ID_PRODUK_DETAIL' => $id
					);
					$this->db->insert('t_detail_penjualan', $data2);
					$jenis = 2;
					$tanggal = date("Y-m-d H:i:s");
					$keterangan = "Transaksi Penjualan Nomor " . sprintf("%06d", $id_last);
					$query = $this->db->query("INSERT INTO t_rekam_stok (ID_PRODUK,JENIS,QTY,TANGGAL,KETERANGAN,ID_PRODUK_DETAIL) VALUES ('$id_produk','$jenis','$qty','$tanggal','$keterangan','$id')");
				}
				$this->db->query("UPDATE m_produk_detail SET STOK=STOK-$qty WHERE ID='$id'");
			}
			$this->cart->destroy();
			redirect("kasir/pilih/" . base64_encode_fix($id_last . "#" . $bayar));
		}
	}
	public function cetak($id, $bayar)
	{
		$id = base64_decode_fix($id);
		$bayar = base64_decode_fix($bayar);
		$identitas = $this->db->get("m_identitas")->row();
		$all = base64_encode_fix($id . "#" . $identitas->NAMA);
		$data['link'] = $all;
		$data['bayar'] = $bayar;
		$data['data'] = $this->db->query("SELECT * FROM view_penjualan WHERE ID='$id'")->row();
		$data['produk'] = $this->db->query("SELECT * FROM view_detail_penjualan WHERE ID_TRANSAKSI_PENJUALAN='$id'")->result();
		$data['page'] = 'kasir/cetak';
		$this->load->view($data['page'], $data);
	}
	public function cetak_ulang($id)
	{
		//$data['bayar'] = $bayar;
		$data['data'] = $this->db->query("SELECT * FROM view_penjualan WHERE ID='$id'")->row();
		$data['produk'] = $this->db->query("SELECT * FROM view_detail_penjualan WHERE ID_TRANSAKSI_PENJUALAN='$id'")->result();
		$data['page'] = 'kasir/cetak_ulang';
		$this->load->view($data['page'], $data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("");
	}
	public function laporan()
	{
		$hal = array('menu' => 'laporan');
		$this->session->set_userdata($hal);
		$data['page'] = 'kasir/laporan';
		$this->load->view($this->_template, $data);
	}
	public function dolaporan()
	{
		$tanggal_awal = $this->input->post("tanggal_awal");
		$tanggal_akhir = $this->input->post("tanggal_akhir");
		$status = $this->input->post("transaksi");
		$id_kasir = $this->session->userdata("id_kasir");
		$data['status'] = $status;
		$data['data'] = $this->db->query("SELECT * FROM view_penjualan WHERE TANGGAL BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND ID_USER='$id_kasir' AND `STATUS`='1' ORDER BY TANGGAL ASC");
		$data['page'] = 'kasir/dolaporan';
		$this->load->view($data['page'], $data);
	}
	public function stok()
	{
		$data['page'] = 'kasir/stok';
		$this->load->view($this->_template, $data);
	}
	function getTabelJsonProduk()
	{
		$aColumns = array('ID_PRODUK', 'NAMA_PRODUK', 'UKURAN', 'DESKRIPSI_KATEGORI', 'STOK', 'HARGA_JUAL', 'TANPA_STOK');

		//primary key
		$sIndexColumn = "ID_PRODUK";

		//nama table database
		$sTable = "view_produk";


		$sLimit = "";
		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
			$sLimit = "LIMIT " . $this->db->escape($_GET['iDisplayStart']) . ", " .
				$this->db->escape($_GET['iDisplayLength']);
		}

		if (isset($_GET['iSortCol_0'])) {
			$sOrder = "ORDER BY  ";
			for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
				if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
					$sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
                         " . $this->db->escape($_GET['sSortDir_' . $i]) . ", ";
				}
			}

			$sOrder = substr_replace($sOrder, "", -2);
			if ($sOrder == "ORDER BY") {
				$sOrder = "";
			}
		}

		$sWhere = "";

		if ($_GET['sSearch'] != "") {
			$sWhere = "WHERE (";
			for ($i = 0; $i < count($aColumns); $i++) {
				$sWhere .= $aColumns[$i] . " LIKE '%" . $_GET['sSearch'] . "%' OR ";
			}
			$sWhere = substr_replace($sWhere, "", -3);
			$sWhere .= ") ";
		}

		for ($i = 0; $i < count($aColumns); $i++) {
			if ($_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
				if ($sWhere == "") {
					$sWhere = "WHERE ";
				} else {
					$sWhere .= " AND ";
				}
				$sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape($_GET['sSearch_' . $i]) . "%' ";
			}
		}
		$hOrder = str_replace("'", "", $sOrder);
		$hLimit = str_replace("'", "", $sLimit);
		$sQuery = "
            SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
            FROM   $sTable
            $sWhere
            $hOrder
            $hLimit
		";
		$rResult = $this->db->query($sQuery)->result();

		$sQuery = "
            SELECT FOUND_ROWS() AS JUMLAH
        ";
		$rResultFilterTotal = $this->db->query($sQuery);
		$aResultFilterTotal = $rResultFilterTotal->row();
		$iFilteredTotal = $aResultFilterTotal->JUMLAH;

		$sQuery = "
            SELECT COUNT(" . $sIndexColumn . ") AS JUMLAH
            FROM   $sTable
		";
		$rResultTotal = $this->db->query($sQuery);
		$aResultTotal = $rResultTotal->row();
		$iTotal = $aResultTotal->JUMLAH;

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		$seq_number = $_GET['iDisplayStart'] + 1;
		foreach ($rResult as $data) {
			if($data->TANPA_STOK==1){
				$status="<span class='badge badge-danger'>Tanpa Stok</span>";
			}else{
				$status="<span class='badge badge-success'>Dengan Stok</span>";
			}
			$row = array();
			$row[] = $seq_number;
			$row[] = $data->NAMA_PRODUK;
			$row[] = $data->UKURAN;
			$row[] = $data->DESKRIPSI_KATEGORI;
			$row[] = $data->STOK;
			$row[] = formatRupiah($data->HARGA_JUAL);
			$row[] = $status;
			$output['aaData'][] = $row;
			$seq_number++;
		}

		echo json_encode($output);
	}
	public function password()
	{
		$id_kasir = $this->session->userdata("id_kasir");
		$data['data'] = $this->db->query("SELECT * FROM m_pengguna WHERE ID='$id_kasir'")->row();
		$data['page'] = 'kasir/password';
		$this->load->view($this->_template, $data);
	}
	public function changePass()
	{
		$id_user = $this->session->userdata("id_kasir");
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
					redirect("kasir/password");
				} else {
					$return = array(
						'status' => true,
						'judul' => 'Failed',
						'pesan' => "Old password doesnt match.",
						'type' => 'error'
					);
					$this->session->set_flashdata($return);
					redirect("kasir/password");
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
			redirect("kasir/password");
		}
	}
	public function pilih($id)
	{
		$id = base64_decode_fix($id);
		$da = explode("#", $id);
		$data['parse'] = base64_encode_fix($id);
		$data['id'] = $da[0];
		$data['bayar'] = $da[1];
		$hal = array('menu' => 'transaksi');
		$this->session->set_userdata($hal);
		$data['transaksi'] = $this->db->get_where("view_penjualan", ["ID" => $id])->row();
		$data['page'] = 'kasir/pilih';
		$this->load->view($this->_template, $data);
	}
	public function kirimWa()
	{
		$id = $this->input->post("parse");
		$id = base64_decode_fix($id);
		$da = explode("#", $id);
		$id = $da[0];
		$bayar = $da[1];

		$identitas = $this->db->get("m_identitas")->row();
		$transaksi = $this->db->get_where("view_penjualan", ["ID" => $id]);
		$detail = $this->db->get_where("view_detail_penjualan", ["ID_TRANSAKSI_PENJUALAN" => $id]);

		if ($transaksi->num_rows() > 0) {
			$pesan = "*NOTA ELEKTRONIK*\r\n\r\n" . $identitas->NAMA . "\r\n" . $identitas->ALAMAT . "\r\n" . $identitas->NO_TELP . "\r\n\r\n*Nomor Nota* : " . sprintf("%06d", $transaksi->row()->ID) . "\r\n*Tanggal* : " . tgl_indo_lengkap($transaksi->row()->TANGGAL) . "\r\n*Customer* : " . ($transaksi->row()->NAMA_CUSTOMER) . "\r\n*Estimasi Selesai* : " . tgl_indo_lengkap($transaksi->row()->ESTIMASI_SELESAI) . "\r\n\r\n======================\r\n\r\n*Detail Transaksi*\r\n\r\n";
			if ($detail->num_rows() > 0) {
				foreach ($detail->result() as $key) {
					$tot = $key->HARGA_JUAL * $key->QTY;
					$pesan .= "✅  " . $key->NAMA_PRODUK . " (" . $key->KETERANGAN . ") @" . formatRupiah($key->HARGA_JUAL) . " x " . $key->QTY . "\r\n*" . formatRupiah($tot) . "*\r\n\r\n";
				}
			}
			$hd = $transaksi->row()->TOTAL - $transaksi->row()->DISKON;
			if ($transaksi->row()->ID_METODE_BAYAR == 1) {
				$metode = "Full Payment";
			} else {
				$metode = "Down Payment";
			}

			if ($transaksi->row()->ID_METODE_BAYAR == 1) $tex = "Kembalian";
			else $tex = "Kurang Bayar";
			$tsemua = $transaksi->row()->BAYAR - $hd;
			$pesan .= "======================\r\n\r\n*Pembayaran* : " . $transaksi->row()->JENIS_BAYAR . "\r\n*Metode* : " . $metode . "\r\n*Diskon* : " . formatRupiah($transaksi->row()->DISKON) . "\r\n*Tota Tagihan* : " . formatRupiah($hd) . "\r\n*Tota Bayar* : " . formatRupiah($transaksi->row()->BAYAR) . "\r\n*" . $tex . "* : " . formatRupiah(abs($tsemua));
			$pesan .= "\r\n\r\n" . site_url("cetak/" . base64_encode_fix($id . "#" . $identitas->NAMA)) . "\r\n";
			$data  = array(
				'no' => $this->input->post("no_hp"),
				'pesan' => $pesan,
				'poweredby' => $_SERVER['SERVER_NAME']
			);
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($curl, CURLOPT_URL, "https://gateway.rafiisa.com/whatsapp");
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			$result = curl_exec($curl);
			curl_close($curl);
		}
		$return = array(
			'status' => true,
			'judul' => 'Success',
			'pesan' => "Pesan berhasil terkirim",
			'type' => 'success'
		);
		$this->session->set_flashdata($return);
		redirect("kasir/pilih/" . $this->input->post("parse"));
	}
	public function transaksi_full()
	{
		$hal = array('menu' => 'transaksi');
		$this->session->set_userdata($hal);

		// if ($this->agent->is_mobile()) {
		// 	redirect('transaksi-mobile.html');
		// }

		$data['page'] = 'kasir/transaksi_full';
		$this->load->view($this->_template, $data);
	}
	public function showProduk()
	{
		$kategori = $this->input->post("id_kategori");
		$pencarian = $this->input->post("pencarian");
		//echo is_numeric($pencarian);exit();
		if ($kategori != '0') {
			if ($pencarian) {
				if (is_numeric($pencarian) == 1) {
					$this->db->like('BARCODE', $pencarian);
				} else {
					$this->db->like('NAMA', $pencarian);
				}
			}
			$produk = $this->db->get_where("view_produk_detail", ["ID_KATEGORI" => $kategori]);
		} else {
			if ($pencarian) {
				if (is_numeric($pencarian) == 1) {
					$this->db->like('BARCODE', $pencarian);
				} else {
					$this->db->like('NAMA', $pencarian);
				}
			}
			$produk = $this->db->get("view_produk_detail");
		}
		//echo $this->db->last_query();exit();
		if ($produk->num_rows() > 0) {
			foreach ($produk->result() as $key) {
				if($key->TANPA_STOK==1){
					if ($key->FOTO) {
						$image = site_url($key->FOTO);
					} else {
						$image = site_url('upload/product/product.jpg');
					}
					echo '
						<div class="col-md-3" style="cursor: pointer" onclick="beli(' . $key->ID . ')">
								<div class="card">
										<img class="card-img-top img-fluid" src="' . $image . '" alt="' . $key->NAMA . '">
										<div class="card-body">
												<h4 class="card-title font-size-16 text-center">' . $key->NAMA.'</h4>
												<p class="card-text text-center" style="font-size:10pt"><span class="badge badge-primary" style="font-size:10pt">' . $key->UKURAN . '</span></p>
												<center><p class="card-text">
														<small class="text-muted text-center" style="font-size:13pt;color:#2fa97c!important">' . formatRupiah($key->HARGA_JUAL) . '</small>
												</p></center>
										</div>
								</div>
						</div>
					';
				}
				else
				{
					if($key->TANPA_STOK==0){
						if ($key->FOTO) {
							$image = site_url($key->FOTO);
						} else {
							$image = site_url('upload/product/product.jpg');
						}
						echo '
							<div class="col-md-3" style="cursor: pointer" onclick="beli(' . $key->ID . ')">
									<div class="card">
											<img class="card-img-top img-fluid" src="' . $image . '" alt="' . $key->NAMA . '">
											<div class="card-body">
													<h4 class="card-title font-size-16 text-center">' . $key->NAMA .'</h4>
													<p class="card-text text-center" style="font-size:10pt"><span class="badge badge-primary" style="font-size:10pt">' . $key->UKURAN . '</span></p>
													<center><p class="card-text">
															<small class="text-muted text-center" style="font-size:13pt;color:#2fa97c!important">' . formatRupiah($key->HARGA_JUAL) . '</small>
													</p></center>
											</div>
									</div>
							</div>
						';
					}
				}
			}
		} else {
			echo '
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<center><img class="mt-5" src="' . site_url('theme/Vertical/dist/assets/images/error-img.png') . '" width="200px"/><br><br><h4 class="mb-5" style="color:#2fa97c">Produk Tidak Ditemukan</h4></center>
					</div>
				</div>
			</div>
			';
		}
	}
	public function transaksi_mobile()
	{
		$hal = array('menu' => 'transaksi');
		$this->session->set_userdata($hal);
		$data['page'] = 'kasir/transaksi_mobile';
		$this->load->view($this->_template, $data);
	}
	public function showProdukMobile()
	{
		$kategori = $this->input->post("id_kategori");
		$pencarian = $this->input->post("pencarian");
		//echo is_numeric($pencarian);exit();
		if ($kategori != '0') {
			if ($pencarian) {
				if (is_numeric($pencarian) == 1) {
					$this->db->like('BARCODE', $pencarian);
				} else {
					$this->db->like('NAMA_PRODUK', $pencarian);
				}
			}
			$produk = $this->db->get_where("view_produk", ["ID_KATEGORI" => $kategori, "STOK>" => 0]);
		} else {
			if ($pencarian) {
				if (is_numeric($pencarian) == 1) {
					$this->db->like('BARCODE', $pencarian);
				} else {
					$this->db->like('NAMA_PRODUK', $pencarian);
				}
			}
			$produk = $this->db->get_where("view_produk", ["STOK>" => 0]);
		}
		//echo $this->db->last_query();exit();
		if ($produk->num_rows() > 0) {
			foreach ($produk->result() as $key) {
				if ($key->FOTO) {
					$image = site_url($key->FOTO);
				} else {
					$image = site_url('upload/product/product.jpg');
				}
				echo '
				<div class="col-md-12" style="cursor: pointer;" onclick="beli(' . $key->ID_PRODUK . ')">
					<div class="card flex-row">
						<img width="50%" class="card-img-left example-card-img-responsive" src="' . $image . '" />
						<div class="card-body">
							<h4 class="card-title h5 h4-sm">' . $key->NAMA_PRODUK . '</h4>
							<p class="card-text">' . $key->KETERANGAN . '<br></p>
							<p class="card-text" style="font-size:12pt;color:#2fa97c!important"><b>' . formatRupiah($key->HARGA_JUAL) . '</b></p>							
						</div>
					</div>
				</div>
				';
			}
		} else {
			echo '
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<center><img class="mt-5" src="' . site_url('theme/Vertical/dist/assets/images/error-img.png') . '" width="200px"/><br><br><h4 class="mb-5" style="color:#2fa97c">Produk Tidak Ditemukan</h4></center>
					</div>
				</div>
			</div>
			';
		}
	}
	public function delete_transaksi()
	{
		$id = $this->input->post("id");
		$penjualan = $this->db->get_where("t_detail_penjualan", array("ID_TRANSAKSI_PENJUALAN" => $id));
		if ($penjualan->num_rows() > 0) {
			foreach ($penjualan->result() as $key) {
				$produk = $key->ID_PRODUK;
				$jenis = 1;
				$stok = $key->QTY;
				$tanggal = date("Y-m-d H:i:s");
				$keterangan = "Pembatalan Transaksi Nomor " . sprintf("%06d", $id);
				$query = $this->db->query("INSERT INTO t_rekam_stok (ID_PRODUK,JENIS,QTY,TANGGAL,KETERANGAN) VALUES ('$produk','$jenis','$stok','$tanggal','$keterangan')");
				$this->db->query("UPDATE m_produk SET STOK=STOK+$stok WHERE ID='$produk'");
			}
			$this->db->query("UPDATE t_penjualan SET `STATUS`=0 WHERE ID='$id'");
			echo "1";
		} else {
			echo "0";
		}
	}
	function simpanCustomer()
	{
		$nama = $this->input->post("nama");
		$alamat = $this->input->post("alamat");
		$no_hp = $this->input->post("no_hp");
		$data = array(
			'NAMA' => $nama,
			'ALAMAT' => $alamat,
			'NO_TELP' => $no_hp
		);
		$this->db->insert('m_customer', $data);
		echo $this->db->insert_id();
	}
	function detail($id)
	{
		$id = base64_decode_fix($id);
		$data["id"] = $id;
		$data['data'] = $this->db->get_where("view_penjualan", ["ID" => $id])->row();
		$data['produk'] = $this->db->get_where("view_detail_penjualan", ["ID_TRANSAKSI_PENJUALAN" => $id]);
		$hal = array('menu' => 'laporan');
		$this->session->set_userdata($hal);
		$data['page'] = 'kasir/detail';
		$this->load->view($this->_template, $data);
	}
	function status($id,$status)
	{
		$id = base64_decode_fix($id);
		$data = array(
			'STATUS_PENGERJAAN' => $status
		);
		$this->db->where('ID', $id);
		$this->db->update('t_penjualan', $data);
		$return = array(
			'status' => true,
			'judul' => 'Success',
			'pesan' => "Berhasil Update Status",
			'type' => 'success'
		);
		$this->session->set_flashdata($return);
		redirect("kasir/detail/" . base64_encode_fix($id));
	}
	function selesai($id)
	{
		$id = base64_decode_fix($id);
		$data = array(
			'STATUS_PENGERJAAN' => 1,
			'SELESAI' => date("Y-m-d H:i:s")
		);
		$this->db->where('ID', $id);
		$this->db->update('t_penjualan', $data);
		$return = array(
			'status' => true,
			'judul' => 'Success',
			'pesan' => "Transaksi Selesai",
			'type' => 'success'
		);
		$this->session->set_flashdata($return);
		redirect("kasir/detail/" . base64_encode_fix($id));
	}
	function ambil($id)
	{
		$id = base64_decode_fix($id);
		$penjualan = $this->db->get_where("view_penjualan", ["ID" => $id])->row();
		if ($penjualan->ID_METODE_BAYAR == 1) {
			$data = array(
				'STATUS_PENGERJAAN' => 5,
				'LUNAS' => 1,
				'AMBIL' => date("Y-m-d H:i:s")
			);
		} else {
			$data = array(
				'STATUS_PENGERJAAN' => 5,
				'LUNAS' => 1,
				'BAYAR' => $penjualan->TOTAL - $penjualan->DISKON,
				'AMBIL' => date("Y-m-d H:i:s")
			);
		}

		$this->db->where('ID', $id);
		$this->db->update('t_penjualan', $data);
		$return = array(
			'status' => true,
			'judul' => 'Success',
			'pesan' => "Transaksi Selesai",
			'type' => 'success'
		);
		$this->session->set_flashdata($return);
		redirect("kasir/detail/" . base64_encode_fix($id));
	}
	public function laporan_batal()
	{
		$hal = array('menu' => 'laporan');
		$this->session->set_userdata($hal);
		$data['page'] = 'kasir/laporan_batal';
		$this->load->view($this->_template, $data);
	}
	public function dolaporanbatal()
	{
		$tanggal_awal = $this->input->post("tanggal_awal");
		$tanggal_akhir = $this->input->post("tanggal_akhir");
		$status = $this->input->post("transaksi");
		$id_kasir = $this->session->userdata("id_kasir");
		$data['status'] = $status;
		$data['data'] = $this->db->query("SELECT * FROM view_penjualan WHERE TANGGAL BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND ID_USER='$id_kasir' AND `STATUS`='0' ORDER BY TANGGAL ASC");
		$data['page'] = 'kasir/dolaporanbatal';
		$this->load->view($data['page'], $data);
	}
	public function customer()
	{
		$data['page'] = 'kasir/customer';
		$this->load->view($this->_template, $data);
	}
	function getTabelJsonCustomer()
	{
		$aColumns = array('ID', 'NAMA', 'ALAMAT', 'NO_TELP', 'STATUS');

		//primary key
		$sIndexColumn = "ID";

		//nama table database
		$sTable = "m_customer";


		$sLimit = "";
		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
			$sLimit = "LIMIT " . $this->db->escape($_GET['iDisplayStart']) . ", " .
				$this->db->escape($_GET['iDisplayLength']);
		}

		if (isset($_GET['iSortCol_0'])) {
			$sOrder = "ORDER BY  ";
			for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
				if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
					$sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
                         " . $this->db->escape($_GET['sSortDir_' . $i]) . ", ";
				}
			}

			$sOrder = substr_replace($sOrder, "", -2);
			if ($sOrder == "ORDER BY") {
				$sOrder = "";
			}
		}

		$sWhere = "";

		if ($_GET['sSearch'] != "") {
			$sWhere = "WHERE (";
			for ($i = 0; $i < count($aColumns); $i++) {
				$sWhere .= $aColumns[$i] . " LIKE '%" . $_GET['sSearch'] . "%' OR ";
			}
			$sWhere = substr_replace($sWhere, "", -3);
			$sWhere .= ") ";
		}

		for ($i = 0; $i < count($aColumns); $i++) {
			if ($_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
				if ($sWhere == "") {
					$sWhere = "WHERE ";
				} else {
					$sWhere .= " AND ";
				}
				$sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape($_GET['sSearch_' . $i]) . "%' ";
			}
		}
		$hOrder = str_replace("'", "", $sOrder);
		$hLimit = str_replace("'", "", $sLimit);
		$sQuery = "
            SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
            FROM   $sTable
            $sWhere
            $hOrder
            $hLimit
		";
		$rResult = $this->db->query($sQuery)->result();

		$sQuery = "
            SELECT FOUND_ROWS() AS JUMLAH
        ";
		$rResultFilterTotal = $this->db->query($sQuery);
		$aResultFilterTotal = $rResultFilterTotal->row();
		$iFilteredTotal = $aResultFilterTotal->JUMLAH;

		$sQuery = "
            SELECT COUNT(" . $sIndexColumn . ") AS JUMLAH
            FROM   $sTable
		";
		$rResultTotal = $this->db->query($sQuery);
		$aResultTotal = $rResultTotal->row();
		$iTotal = $aResultTotal->JUMLAH;

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		$seq_number = $_GET['iDisplayStart'] + 1;
		foreach ($rResult as $data) {
			if ($data->STATUS == 1) {
				$lihat = site_url("kasir/detailCustomer/" . base64_encode_fix($data->ID));
				$row = array();
				$row[] = $seq_number;
				$row[] = $data->NAMA;
				$row[] = $data->ALAMAT;
				$row[] = $data->NO_TELP;
				$row[] = '<a href="' . $lihat . '" class="btn btn-primary mr-1"><i class="mdi mdi-file mr-1"></i>Lihat</a>';
				$output['aaData'][] = $row;
				$seq_number++;
			}
		}

		echo json_encode($output);
	}
	public function detailCustomer($id)
	{
		$id = base64_decode_fix($id);
		$data['id'] = $id;
		$data['customer'] = $this->db->get_where("m_customer", ["ID" => $id])->row();
		$data['penjualan'] = $this->db->get_where("view_penjualan", ["ID_CUSTOMER" => $id]);
		$data['page'] = 'kasir/detail_customer';
		$this->load->view($this->_template, $data);
	}
	public function editCustomer($id)
	{
		$id = base64_decode_fix($id);
		$data = array(
			'NAMA' => $this->input->post("nama"),
			'ALAMAT' => $this->input->post("alamat"),
			'NO_TELP' => $this->input->post("no_telp")
		);
		$this->db->where('ID', $id);
		$this->db->update('m_customer', $data);
		$return = array(
			'status' => true,
			'judul' => 'Success',
			'pesan' => "Berhasil Edit Customer",
			'type' => 'success'
		);
		$this->session->set_flashdata($return);
		redirect("kasir/detailCustomer/" . base64_encode_fix($id));
	}
	function hapusCustomer($id)
	{
		$id = base64_decode_fix($id);
		$data = array(
			'STATUS' => 0,
		);
		$this->db->where('ID', $id);
		$this->db->update('m_customer', $data);
		$return = array(
			'status' => true,
			'judul' => 'Success',
			'pesan' => "Berhasil Menghapus Customer",
			'type' => 'success'
		);
		$this->session->set_flashdata($return);
		redirect("kasir/customer");
	}
	function historyTerakhir()
	{
		$id_customer = $this->input->post("id_customer");
		$query = $this->db->order_by('ID', 'DESC')->get_where("t_penjualan", ["ID_CUSTOMER" => $id_customer]);
		echo json_encode($query->row());
	}
	function desain_selesai()
    {
        $data['data'] = $this->db->get_where('view_penjualan', array('STATUS_PENGERJAAN' => 1))->result();
        $data['page'] = 'kasir/desain_selesai';
        $this->load->view($this->_template, $data);
    }
	function produksi_selesai()
    {
        $data['data'] = $this->db->get_where('view_penjualan', array('STATUS_PENGERJAAN' => 4))->result();
        $data['page'] = 'kasir/produksi_selesai';
        $this->load->view($this->_template, $data);
    }
}
