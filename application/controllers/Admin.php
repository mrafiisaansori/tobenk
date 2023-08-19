<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	private $_template = 'admin/admin_us';

	function __construct()
	{
		parent::__construct();
		$this->cek_login->cek_login(1);
		$this->load->model('Admin_model');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$hal = array('menu' => 'dashboard');
		$this->session->set_userdata($hal);

		$data['page'] = 'admin/dashboard';
		$this->load->view($this->_template, $data);
	}
	//START IDENTITAS
	function lihatIdentitas()
	{
		$hal = array('menu' => 'identitas');
		$this->session->set_userdata($hal);

		$data['identitas'] = $this->Admin_model->getIdentitas();
		$data['page'] = 'admin/identitas';
		$this->load->view($this->_template, $data);
	}
	function modalEditIdentitas()
	{
		$data = $this->Admin_model->getIdentitas();
		echo json_encode($data);
	}
	function editIdentitas()
	{
		$data = $this->Admin_model->getIdentitas();
		$logo = $data->LOGO;
		if ($_FILES['logo']) {
			$config['upload_path'] = './upload/logo';
			$config['allowed_types'] = 'png';
			$config['max_size']     = '5000';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('logo')) {
				$file = $this->upload->data();
				$logo = $file['file_name'];
			}
		}

		$update = $this->Admin_model->updateIdentitas($logo);
		if ($update) {
			$this->session->set_flashdata('judul', 'Identitas');
			$this->session->set_flashdata('status', 'Berhasil ubah data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Identitas');
			$this->session->set_flashdata('status', 'Gagal ubah data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/identitas.html');
	}
	//END IDENTITAS

	//START PENGGUNA
	function lihatPengguna()
	{
		$hal = array('menu' => 'pengguna');
		$this->session->set_userdata($hal);

		$data['pengguna'] = $this->Admin_model->getPengguna();
		$data['page'] = 'admin/pengguna';
		$this->load->view($this->_template, $data);
	}
	function tambahPengguna()
	{
		$username = $this->input->post('username');
		$cekUsername = $this->Admin_model->getPenggunaByUsername($username);
		if (!$cekUsername) {
			$insert = $this->Admin_model->insertPengguna();
			if ($insert) {
				$this->session->set_flashdata('judul', 'Pengguna');
				$this->session->set_flashdata('status', 'Berhasil tambah data');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('judul', 'Pengguna');
				$this->session->set_flashdata('status', 'Gagal tambah data');
				$this->session->set_flashdata('type', 'error');
			}
		} else {
			$this->session->set_flashdata('judul', 'Pengguna');
			$this->session->set_flashdata('status', 'Gagal tambah data,Username telah digunakan');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/pengguna.html');
	}
	function modalEditPengguna()
	{
		$id = $this->input->post('id');
		$data = $this->Admin_model->getPenggunaById($id);
		echo json_encode($data);
	}
	function editPengguna()
	{
		$id = $this->input->post('id');
		$update = $this->Admin_model->updatePengguna($id);
		if ($update) {
			$this->session->set_flashdata('judul', 'Pengguna');
			$this->session->set_flashdata('status', 'Berhasil edit data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Pengguna');
			$this->session->set_flashdata('status', 'Gagal edit data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/pengguna.html');
	}
	function deletePengguna($id)
	{
		$delete = $this->Admin_model->deletePengguna($id);
		if ($delete) {
			$this->session->set_flashdata('judul', 'Pengguna');
			$this->session->set_flashdata('status', 'Berhasil hapus data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Pengguna');
			$this->session->set_flashdata('status', 'Gagal hapus data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/pengguna.html');
	}
	function resetPasswordPengguna($id)
	{
		$reset = $this->Admin_model->resetPasswordPengguna($id);
		if ($reset) {
			$this->session->set_flashdata('judul', 'Pengguna');
			$this->session->set_flashdata('status', 'Berhasil reset password');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Pengguna');
			$this->session->set_flashdata('status', 'Gagal reset password');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/pengguna.html');
	}
	//END PENGGUNA

	// START KATEGORI
	function lihatKategori()
	{
		$hal = array('menu' => 'kategori');
		$this->session->set_userdata($hal);

		$data['kategori'] = $this->Admin_model->getKategori();
		$data['page'] = 'admin/kategori';
		$this->load->view($this->_template, $data);
	}
	function tambahKategori()
	{
		$insert = $this->Admin_model->insertKategori();
		if ($insert) {
			$this->session->set_flashdata('judul', 'Kategori');
			$this->session->set_flashdata('status', 'Berhasil tambah data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Kategori');
			$this->session->set_flashdata('status', 'Gagal tambah data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/kategori.html');
	}
	function modalEditKategori()
	{
		$id = $this->input->post('id');
		$data = $this->Admin_model->getKategoriById($id);
		echo json_encode($data);
	}
	function editKategori()
	{
		$id = $this->input->post('id');
		$update = $this->Admin_model->updateKategori($id);
		if ($update) {
			$this->session->set_flashdata('judul', 'Kategori');
			$this->session->set_flashdata('status', 'Berhasil edit data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Kategori');
			$this->session->set_flashdata('status', 'Gagal edit data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/kategori.html');
	}
	function deleteKategori($id)
	{
		$delete = $this->Admin_model->deleteKategori($id);
		if ($delete) {
			$this->session->set_flashdata('judul', 'Kategori');
			$this->session->set_flashdata('status', 'Berhasil hapus data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Kategori');
			$this->session->set_flashdata('status', 'Gagal hapus data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/kategori.html');
	}
	// END KATEGORI

	//START PRODUK
	function lihatProduk()
	{
		$hal = array('menu' => 'produk');
		$this->session->set_userdata($hal);

		$data['kategori'] = $this->Admin_model->getKategori();
		$data['page'] = 'admin/produk';
		$this->load->view($this->_template, $data);
	}
	function getTabelJsonProduk()
	{
		$aColumns = array('ID_PRODUK', 'NAMA_PRODUK', 'KETERANGAN', 'DESKRIPSI_KATEGORI', 'STOK', 'HARGA_BELI', 'HARGA_JUAL', 'ID_KATEGORI');

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
			$cek_transaksi = $this->db->get_where("t_detail_penjualan", ["ID_PRODUK" => $data->ID_PRODUK]);
			if ($cek_transaksi->num_rows() == 0) {
				$delete = "onclick='deleteData(" . $data->ID_PRODUK . ")'";
			} else {
				$delete = "onclick='tidak()'";
			}
			$row = array();
			$row[] = $seq_number;
			//$row[] = "<a target='_blank' href='".site_url('urgent/penyusutan/'.$data->ID_PRODUK)."'>".$data->NAMA_PRODUK."</a>";
			$row[] = "<a onclick='modalHistory(" . $data->ID_PRODUK . ")' href='javascript:void(0)'>" . $data->NAMA_PRODUK . "</a>";
			$row[] = $data->KETERANGAN;
			$row[] = $data->DESKRIPSI_KATEGORI;
			$row[] = $data->STOK;
			$row[] = formatRupiah($data->HARGA_BELI);
			$row[] = formatRupiah($data->HARGA_JUAL);
			$row[] = "
			<a onclick='modalStok(" . $data->ID_PRODUK . ")' class='btn btn-info mr-1' style='color:white;'><i class='fas fa-luggage-cart'></i></a>
				<a onclick='modalEditProduk(" . $data->ID_PRODUK . ")' class='btn btn-warning mr-1' style='color:white;'><i class='mdi mdi-pencil'></i></a>
				<a style='color:white;' class='btn btn-danger' " . $delete . "><i class='mdi mdi-delete'></i></a>							
			";
			$output['aaData'][] = $row;
			$seq_number++;
		}

		echo json_encode($output);
	}
	function stokInsidentil()
	{
		$jenis = $this->input->post("jenis");
		$jumlah = $this->input->post("jumlah");
		$id = $this->input->post("id");
		$keterangan = $this->input->post("keterangan");
		$insert_rekam = $this->Admin_model->insertRekamStok($id, $jumlah, $jenis, $keterangan);
		if ($jenis == 1) {
			$ket = "Restok";
			$this->db->query("UPDATE m_produk SET STOK=STOK+$jumlah WHERE ID='$id'");
		} else {
			$ket = "Retur";
			$this->db->query("UPDATE m_produk SET STOK=STOK-$jumlah WHERE ID='$id'");
		}
		$this->session->set_flashdata('judul', 'Berhasil');
		$this->session->set_flashdata('status', $ket . ' Berhasil');
		$this->session->set_flashdata('type', 'success');
		redirect('admin/produk.html');
	}
	function modalHistory()
	{
		$id = $this->input->post("id");
		$produk = $this->db->get_where("m_produk", ["ID" => $id])->row();
		$data = $this->db->get_where("t_rekam_stok", ["ID_PRODUK" => $id]);
		echo "<table class='table table-striped table-bordered'>
		<tr>
			<th>Keterangan</th>
			<th>Jenis</th>
			<th>Tanggal</th>
			<th>Qty</th>
		</tr>";
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $key) {
				if ($key->JENIS == 1) {
					$jenis = "<button class='btn btn-sm btn-primary'><i class='fas fa-plus-circle mr-1'></i>Masuk</button>";
				} else {
					$jenis = "<button class='btn btn-sm btn-danger'><i class='fas fa-minus-circle mr-1'></i>Keluar</button>";
				}
				echo "<tr>
				<td>" . $key->KETERANGAN . "</td>
				<td>" . $jenis . "</td>
				<td>" . tgl_jam_indo_lengkap($key->TANGGAL) . "</td>
				<td>" . $key->QTY . "</td>
				</tr>";
			}
		}
		echo "
		<tr>
		<td colspan='3'><b>Stok Saat Ini</b></td>
		<td>" . $produk->STOK . "</td>
		</tr>
		</table>";
	}
	function getHargaBeli()
	{
		$id = $this->input->post("id_produk");
		$data = $this->db->get_where("m_produk", ["ID" => $id]);
		if ($data->num_rows() > 0) {
			echo formatRupiah($data->row()->HARGA_BELI);
		} else {
			echo formatRupiah(0);
		}
	}
	function tambahProduk()
	{
		if ($_FILES['foto']['name']) {
			$config['upload_path'] = './upload/product/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size'] = 500;
			$config['max_width'] = 800;
			$config['max_height'] = 533;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata('judul', 'Produk');
				$this->session->set_flashdata('status', $this->upload->display_errors());
				$this->session->set_flashdata('type', 'error');
				redirect('admin/produk.html');
			} else {
				$upload_data = $this->upload->data();
				$file_name = "upload/product/" . $upload_data['file_name'];
				$insert = $this->Admin_model->insertProdukWithImage($file_name);
			}
		} else {
			$insert = $this->Admin_model->insertProduk();
		}

		if ($insert) {
			$data = $this->Admin_model->getProdukById($insert);
			$insert_rekam = $this->Admin_model->insertRekamStok($insert, $data->STOK, '1', 'Stok Opname');
			$this->session->set_flashdata('judul', 'Produk');
			$this->session->set_flashdata('status', 'Berhasil tambah data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Produk');
			$this->session->set_flashdata('status', 'Gagal tambah data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/produk.html');
	}
	function modalEditProduk()
	{
		$id = $this->input->post('id');
		$data = $this->Admin_model->getProdukById($id);
		echo json_encode($data);
	}
	function editProduk()
	{
		$id = $this->input->post('id');

		if ($_FILES['foto']['name']) {
			$config['upload_path'] = './upload/product/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size'] = 500;
			$config['max_width'] = 800;
			$config['max_height'] = 533;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata('judul', 'Produk');
				$this->session->set_flashdata('status', $this->upload->display_errors());
				$this->session->set_flashdata('type', 'error');
				redirect('admin/produk.html');
			} else {
				$upload_data = $this->upload->data();
				$file_name = "upload/product/" . $upload_data['file_name'];
				$update = $this->Admin_model->updateProdukWithImage($id, $file_name);
			}
		} else {
			$update = $this->Admin_model->updateProduk($id);
		}
		if ($update) {
			$this->session->set_flashdata('judul', 'Produk');
			$this->session->set_flashdata('status', 'Berhasil edit data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Produk');
			$this->session->set_flashdata('status', 'Gagal edit data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/produk.html');
	}
	function deleteProduk($id)
	{
		$data = $this->Admin_model->getProdukById($id);
		$keterangan = $data->NAMA_PRODUK . "#" . $data->DESKRIPSI_KATEGORI . "#Delete Data";
		$insert_rekam = $this->Admin_model->insertRekamStok($id, $data->STOK, '2', $keterangan);
		if ($insert_rekam) {
			$delete = $this->Admin_model->deleteProduk($id);
			if ($delete) {
				unlink($data->FOTO);
				$this->session->set_flashdata('judul', 'Produk');
				$this->session->set_flashdata('status', 'Berhasil hapus data');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('judul', 'Produk');
				$this->session->set_flashdata('status', 'Gagal hapus data');
				$this->session->set_flashdata('type', 'error');
			}
		} else {
			$this->session->set_flashdata('judul', 'Produk');
			$this->session->set_flashdata('status', 'Gagal hapus data');
			$this->session->set_flashdata('type', 'error');
		}

		redirect('admin/produk.html');
	}
	//END PRODUK

	// START SUPPLIER
	function lihatSupplier()
	{
		$hal = array('menu' => 'supplier');
		$this->session->set_userdata($hal);

		$data['supplier'] = $this->Admin_model->getSupplier();
		$data['page'] = 'admin/supplier';
		$this->load->view($this->_template, $data);
	}
	function tambahSupplier()
	{
		$insert = $this->Admin_model->insertSupplier();
		if ($insert) {
			$this->session->set_flashdata('judul', 'Supplier');
			$this->session->set_flashdata('status', 'Berhasil tambah data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Supplier');
			$this->session->set_flashdata('status', 'Gagal tambah data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/supplier.html');
	}
	function modalEditSupplier()
	{
		$id = $this->input->post('id');
		$data = $this->Admin_model->getSupplierById($id);
		echo json_encode($data);
	}
	function editSupplier()
	{
		$id = $this->input->post('id');
		$update = $this->Admin_model->updateSupplier($id);
		if ($update) {
			$this->session->set_flashdata('judul', 'Supplier');
			$this->session->set_flashdata('status', 'Berhasil edit data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Supplier');
			$this->session->set_flashdata('status', 'Gagal edit data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/supplier.html');
	}
	function deleteSupplier($id)
	{
		$delete = $this->Admin_model->deleteSupplier($id);
		if ($delete) {
			$this->session->set_flashdata('judul', 'Supplier');
			$this->session->set_flashdata('status', 'Berhasil hapus data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Supplier');
			$this->session->set_flashdata('status', 'Gagal hapus data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/supplier.html');
	}
	// END Supplier

	// START JENIS BAYAR
	function lihatJenisBayar()
	{
		$hal = array('menu' => 'jenis-bayar');
		$this->session->set_userdata($hal);

		$data['jenisbayar'] = $this->Admin_model->getJenisBayar();
		$data['page'] = 'admin/jenis_bayar';
		$this->load->view($this->_template, $data);
	}
	function tambahJenisBayar()
	{
		$insert = $this->Admin_model->insertJenisBayar();
		if ($insert) {
			$this->session->set_flashdata('judul', 'Jenis Bayar');
			$this->session->set_flashdata('status', 'Berhasil tambah data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Jenis Bayar');
			$this->session->set_flashdata('status', 'Gagal tambah data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/jenis-bayar.html');
	}
	function modalEditJenisBayar()
	{
		$id = $this->input->post('id');
		$data = $this->Admin_model->getJenisBayarById($id);
		echo json_encode($data);
	}
	function editJenisBayar()
	{
		$id = $this->input->post('id');
		$update = $this->Admin_model->updateJenisBayar($id);
		if ($update) {
			$this->session->set_flashdata('judul', 'Jenis Bayar');
			$this->session->set_flashdata('status', 'Berhasil edit data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Jenis Bayar');
			$this->session->set_flashdata('status', 'Gagal edit data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/jenis-bayar.html');
	}
	function deleteJenisBayar($id)
	{
		$delete = $this->Admin_model->deleteJenisBayar($id);
		if ($delete) {
			$this->session->set_flashdata('judul', 'Jenis Bayar');
			$this->session->set_flashdata('status', 'Berhasil hapus data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Jenis Bayar');
			$this->session->set_flashdata('status', 'Gagal hapus data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/jenis-bayar.html');
	}
	// END JENIS BAYAR

	//START PEMBELIAN 
	function lihatPembelian()
	{
		$hal = array('menu' => 'pembelian');
		$this->session->set_userdata($hal);

		$data['page'] = 'admin/pembelian';
		$this->load->view($this->_template, $data);
	}
	function  getTabelJsonPembelian()
	{
		$aColumns = array('ID_PEMBELIAN', 'NO_NOTA', 'TANGGAL', 'NAMA_USER', 'STATUS', 'ID_USER');

		//primary key
		$sIndexColumn = "ID_PEMBELIAN";

		//nama table database
		$sTable = "view_pembelian";


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
			$row = array();
			$row[] = $seq_number;
			$row[] = "<a href='" . base_url('admin/detail-pembelian-' . $data->ID_PEMBELIAN . '.html') . "' class='btn btn-success' title='Detail Pembelian'>" . $data->NO_NOTA . "</a>";
			$row[] = tgl_indo_lengkap($data->TANGGAL);
			$row[] = $data->NAMA_USER;
			if ($data->STATUS == 0) {
				$row[] = "<a class='badge badge-danger' style='color:white;'>Belum</a>";
				$row[] = "
					<a onclick='modalEditPembelian(" . $data->ID_PEMBELIAN . ")' class='btn btn-warning' style='color:white;'><i class='mdi mdi-pencil'></i></a>&nbsp;
					<a style='color:white;' class='btn btn-danger' onclick='deleteData(" . $data->ID_PEMBELIAN . ")'><i class='mdi mdi-delete'></i></a>							
				";
			} else {
				$row[] = "<a class='badge badge-primary' style='color:white;'>Selesai</a>";
				$row[] = "";
			}
			$output['aaData'][] = $row;
			$seq_number++;
		}

		echo json_encode($output);
	}
	function tambahPembelian()
	{
		$insert = $this->Admin_model->insertPembelian();
		if ($insert) {
			redirect('admin/detail-pembelian-' . $insert . '.html');
		} else {
			$this->session->set_flashdata('judul', 'Pembelian');
			$this->session->set_flashdata('status', 'Gagal tambah data');
			$this->session->set_flashdata('type', 'error');
			redirect('admin/pembelian.html');
		}
	}
	function modalEditPembelian()
	{
		$id = $this->input->post('id');
		$data = $this->Admin_model->getPembelianById($id);
		echo json_encode($data);
	}
	function editPembelian()
	{
		$id = $this->input->post('id');
		$update = $this->Admin_model->updatePembelian($id);
		if ($update) {
			$this->session->set_flashdata('judul', 'Pembelian');
			$this->session->set_flashdata('status', 'Berhasil edit data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Pembelian');
			$this->session->set_flashdata('status', 'Gagal edit data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/pembelian.html');
	}
	function hapusPembelian($id_pembelian)
	{
		$pembelian = $this->Admin_model->getPembelianById($id_pembelian);
		$detailPembelian = $this->Admin_model->getDetailPembelianByIdPembelian($id_pembelian);
		if ($pembelian->STATUS == 1) {
			$this->session->set_flashdata('judul', 'Pembelian');
			$this->session->set_flashdata('status', 'Tidak Bisa Dihapus.Transaksi sudah selesai.');
			$this->session->set_flashdata('type', 'error');
		} else {
			$this->Admin_model->deleteDetailPembelianByIdPembelian($id_pembelian);
			$delete = $this->Admin_model->deletePembelian($id_pembelian);
			if ($delete) {
				$this->session->set_flashdata('judul', 'Pembelian');
				$this->session->set_flashdata('status', 'Berhasil hapus data');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('judul', 'Pembelian');
				$this->session->set_flashdata('status', 'Gagal hapus data');
				$this->session->set_flashdata('type', 'error');
			}
		}
		// if($detailPembelian){
		// 	foreach($detailPembelian as $db){
		// 		$keterangan ="Penghapusan barang  dengan no nota : ".$pembelian->NO_NOTA;
		// 		$insert = $this->Admin_model->insertRekamStok($db->ID_PRODUK,$db->QTY,'2',$keterangan);
		// 		if($insert){
		// 			$this->Admin_model->ubahStokProduk($db->ID_PRODUK,$db->QTY,2);
		// 			$this->Admin_model->deleteDetailPembelian($db->ID_DETAIL_PEMBELIAN);
		// 		}else{
		// 			$this->session->set_flashdata('judul','Pembelian');
		// 			$this->session->set_flashdata('status','Ada data yang tidak terhapus, silahkan ulangi kembali.');
		// 			$this->session->set_flashdata('type','error');
		// 			redirect('admin/pembelian.html');
		// 		}
		// 	}
		// 	$delete = $this->Admin_model->deletePembelian($id_pembelian);
		// 	if($delete){
		// 		$this->session->set_flashdata('judul','Pembelian');
		// 		$this->session->set_flashdata('status','Berhasil hapus data');
		// 		$this->session->set_flashdata('type','success');

		// 	}else{
		// 		$this->session->set_flashdata('judul','Pembelian');
		// 		$this->session->set_flashdata('status','Gagal hapus data');
		// 		$this->session->set_flashdata('type','error');
		// 	}
		// }else{
		// 	$delete = $this->Admin_model->deletePembelian($id_pembelian);
		// 	if($delete){
		// 		$this->session->set_flashdata('judul','Pembelian');
		// 		$this->session->set_flashdata('status','Berhasil hapus data');
		// 		$this->session->set_flashdata('type','success');

		// 	}else{
		// 		$this->session->set_flashdata('judul','Pembelian');
		// 		$this->session->set_flashdata('status','Gagal hapus data');
		// 		$this->session->set_flashdata('type','error');
		// 	}
		// }
		redirect('admin/pembelian.html');
	}
	function detailPembelian($id_pembelian)
	{
		$data['id_pembelian'] = $id_pembelian;
		$data['pembelian'] = $this->Admin_model->getPembelianById($id_pembelian);
		$data['detail_pembelian'] = $this->Admin_model->getDetailPembelianByIdPembelian($id_pembelian);
		$data['supplier'] = $this->Admin_model->getSupplier();
		$data['page'] = 'admin/detail_pembelian';
		$this->load->view($this->_template, $data);
	}
	function cariProduk()
	{
		$cari = $this->input->post('cari');
		$produk = $this->Admin_model->cariProduk($cari);
		if ($produk) {
			foreach ($produk as $p) {
				echo "<option value='" . $p->ID_PRODUK . "'>" . $p->NAMA_PRODUK . "</option>";
			}
		} else {
			echo "<option value=''>Data tidak ditemukan</option>";
		}
	}
	function tambahDetailPembelian($id_pembelian)
	{
		$produk = $this->input->post('produk');
		$jumlah = $this->input->post('jumlah');
		$dataProduk = $this->Admin_model->getProdukById($produk);
		$stok_lama = $dataProduk->STOK;
		$dataPembelian = $this->Admin_model->getPembelianById($id_pembelian);
		$insert = $this->Admin_model->insertDetailPembelian($id_pembelian, $stok_lama);
		if ($insert) {
			//insert rekam
			// $keterangan ="Pembelian barang dengan no nota : ".$dataPembelian->NO_NOTA;
			// $this->Admin_model->insertRekamStok($dataProduk->ID_PRODUK,$jumlah,'1',$keterangan);
			// //ubah stok produk
			// $this->Admin_model->ubahStokProduk($dataProduk->ID_PRODUK,$jumlah,1);
			$this->session->set_flashdata('judul', 'Detail Pembelian');
			$this->session->set_flashdata('status', 'Berhasil tambah data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Detail Pembelian');
			$this->session->set_flashdata('status', 'Gagal tambah data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/detail-pembelian-' . $id_pembelian . '.html');
	}
	function deleteDetailPembelian($id_pembelian, $id_detail_pembelian)
	{
		$detailPembelian = $this->Admin_model->getDetailPembelianById($id_detail_pembelian);
		$dataPembelian = $this->Admin_model->getPembelianById($id_pembelian);
		if ($dataPembelian->STATUS == 1) {
			$this->session->set_flashdata('judul', 'Detail Pembelian');
			$this->session->set_flashdata('status', 'Tidak Bisa Dihapus.Transaksi sudah selesai.');
			$this->session->set_flashdata('type', 'error');
		} else {
			// $keterangan ="Penghapusan barang  dengan no nota : ".$dataPembelian->NO_NOTA;
			// $insert = $this->Admin_model->insertRekamStok($detailPembelian->ID_PRODUK,$detailPembelian->QTY,'2',$keterangan);
			$delete = $this->Admin_model->deleteDetailPembelian($id_detail_pembelian);
			if ($delete) {
				// $this->Admin_model->ubahStokProduk($detailPembelian->ID_PRODUK,$detailPembelian->QTY,2);
				// $this->Admin_model->deleteDetailPembelian($id_detail_pembelian);
				$this->session->set_flashdata('judul', 'Detail Pembelian');
				$this->session->set_flashdata('status', 'Berhasil hapus data');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('judul', 'Detail Pembelian');
				$this->session->set_flashdata('status', 'Gagal hapus data');
				$this->session->set_flashdata('type', 'error');
			}
		}
		redirect('admin/detail-pembelian-' . $id_pembelian . '.html');
	}
	function modalSelesaikanPembelian()
	{
		$id_pembelian = $this->input->post('id_pembelian');
		$data['id_pembelian'] = $id_pembelian;
		$data['detailPembelian'] = $this->Admin_model->getDetailPembelianByIdPembelian($id_pembelian);
		$data['pembelian'] = $this->Admin_model->getPembelianById($id_pembelian);
		$this->load->view('admin/modal_selesaikan_pembelian', $data);
	}
	function selesaikanPembelian($id_pembelian)
	{

		$detailPembelian = $this->Admin_model->getDetailPembelianByIdPembelian($id_pembelian);
		$pembelian = $this->Admin_model->getPembelianById($id_pembelian);

		if ($detailPembelian) {
			foreach ($detailPembelian as $dp) {
				//insert rekam
				$keterangan = "Pembelian barang dengan No Nota : <a target='_blank' href='" . site_url('admin/detail-pembelian-' . $pembelian->ID_PEMBELIAN . '.html') . "'>" . $pembelian->NO_NOTA . "</a>";
				$stok = $dp->QTY;
				$this->Admin_model->insertRekamStok($dp->ID_PRODUK, $stok, '1', $keterangan);
				//ubah stok produk
				$harga_beli = $this->input->post('harga_produk_' . $dp->ID_DETAIL_PEMBELIAN);
				$this->Admin_model->ubahStokHargaProduk($dp->ID_PRODUK, $stok, 1, $harga_beli);
			}
			$update = $this->Admin_model->updateStatusPembelian($id_pembelian);
			if ($update) {
				$this->session->set_flashdata('judul', 'Pembelian');
				$this->session->set_flashdata('status', 'Berhasil selesaikan Pembelian');
				$this->session->set_flashdata('type', 'success');
				redirect('admin/pembelian.html');
			} else {
				$this->session->set_flashdata('judul', 'Pembelian');
				$this->session->set_flashdata('status', 'Gagal selesaikan Pembelian');
				$this->session->set_flashdata('type', 'error');
				redirect('admin/detail-pembelian-' . $id_pembelian . '.html');
			}
		}
		// if($update){
		// 	$this->session->set_flashdata('judul','Pembelian');
		// 	$this->session->set_flashdata('status','Berhasil selesaikan Pembelian');
		// 	$this->session->set_flashdata('type','success');
		// 	redirect('admin/pembelian.html');
		// }else{
		// 	$this->session->set_flashdata('judul','Pembelian');
		// 	$this->session->set_flashdata('status','Gagal selesaikan Pembelian');
		// 	$this->session->set_flashdata('type','error');
		// 	redirect('admin/detail-pembelian-'.$id_pembelian.'.html');
		// }
	}

	//START RETUR
	function lihatRetur()
	{
		$hal = array('menu' => 'retur');
		$this->session->set_userdata($hal);

		$data['page'] = 'admin/retur';
		$this->load->view($this->_template, $data);
	}
	function  getTabelJsonRetur()
	{
		$aColumns = array('ID_RETUR', 'NO_NOTA', 'TANGGAL', 'NAMA_USER', 'ID_USER');

		//primary key
		$sIndexColumn = "ID_RETUR";

		//nama table database
		$sTable = "view_retur";


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
			$row = array();
			$row[] = $seq_number;
			$row[] = "<a href='" . base_url('admin/detail-retur-' . $data->ID_RETUR . '.html') . "' class='btn btn-success' title='Detail Pembelian'>" . $data->NO_NOTA . "</a>";
			$row[] = tgl_indo_lengkap($data->TANGGAL);
			$row[] = $data->NAMA_USER;
			$row[] = "
					<a onclick='modalEditRetur(" . $data->ID_RETUR . ")' class='btn btn-warning' style='color:white;'><i class='mdi mdi-pencil'></i></a>&nbsp;
					<a style='color:white;' class='btn btn-danger' onclick='deleteData(" . $data->ID_RETUR . ")'><i class='mdi mdi-delete'></i></a>							
				";
			$output['aaData'][] = $row;
			$seq_number++;
		}

		echo json_encode($output);
	}
	function tambahRetur()
	{
		$insert = $this->Admin_model->insertRetur();
		if ($insert) {
			redirect('admin/detail-retur-' . $insert . '.html');
		} else {
			$this->session->set_flashdata('judul', 'Retur');
			$this->session->set_flashdata('status', 'Gagal tambah data');
			$this->session->set_flashdata('type', 'error');
			redirect('admin/retur.html');
		}
	}
	function modalEditRetur()
	{
		$id = $this->input->post('id');
		$data = $this->Admin_model->getReturById($id);
		echo json_encode($data);
	}
	function editRetur()
	{
		$id = $this->input->post('id');
		$update = $this->Admin_model->updateRetur($id);
		if ($update) {
			$this->session->set_flashdata('judul', 'Retur');
			$this->session->set_flashdata('status', 'Berhasil edit data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Retur');
			$this->session->set_flashdata('status', 'Gagal edit data');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/retur.html');
	}
	function hapusRetur($id_retur)
	{
		$retur = $this->Admin_model->getReturById($id_retur);
		$detailRetur = $this->Admin_model->getDetailReturByIdRetur($id_retur);
		if ($detailRetur) {
			foreach ($detailRetur as $dr) {
				$this->Admin_model->insertRekamStok($dr->ID_PRODUK, $dr->QTY, '1', 'Pembatalan retur dari admin');
				$this->Admin_model->ubahStokProduk($dr->ID_PRODUK, $dr->QTY, 1);
				$this->Admin_model->deleteDetailRetur($dr->ID_DETAIL_RETUR);
			}
		}
		// $this->Admin_model->deleteDetailReturByIdRetur($id_retur);
		$delete = $this->Admin_model->deleteRetur($id_retur);
		if ($delete) {
			$this->session->set_flashdata('judul', 'Retur');
			$this->session->set_flashdata('status', 'Berhasil hapus data');
			$this->session->set_flashdata('type', 'success');
		} else {
			$this->session->set_flashdata('judul', 'Retur');
			$this->session->set_flashdata('status', 'Gagal hapus data');
			$this->session->set_flashdata('type', 'error');
		}

		redirect('admin/retur.html');
	}
	function detailRetur($id_retur)
	{
		$data['id_retur'] = $id_retur;
		$data['retur'] = $this->Admin_model->getReturById($id_retur);
		$data['detail_retur'] = $this->Admin_model->getDetailReturByIdRetur($id_retur);
		$data['supplier'] = $this->Admin_model->getSupplier();
		$data['page'] = 'admin/detail_retur';
		$this->load->view($this->_template, $data);
	}
	function tambahDetailRetur($id_retur)
	{
		$produk = $this->input->post('produk');
		$jumlah = $this->input->post('jumlah');
		$ret = $this->db->get_where("t_retur", ["ID" => $id_retur])->row();
		$keterangan = "Retur barang dengan No Nota <a target='_blank' href='" . site_url('admin/detail-retur-' . $ret->ID . '.html') . "'>" . $ret->NO_NOTA . "</a> , Keterangan (" . $this->input->post('keterangan') . ")";
		//echo $keterangan;exit();
		$dataProduk = $this->Admin_model->getProdukById($produk);
		if ($jumlah <= $dataProduk->STOK) {
			$insertDetail = $this->Admin_model->insertDetailRetur($id_retur, $dataProduk->STOK);
			if ($insertDetail) {
				//rekam
				$insert_rekam = $this->Admin_model->insertRekamStok($produk, $jumlah, '2', $keterangan);
				$update_stok = $this->Admin_model->ubahStokProduk($produk, $jumlah, 2);
			} else {
				$this->session->set_flashdata('judul', 'Detail Retur');
				$this->session->set_flashdata('status', 'Gagal retur , coba ulangi kembali');
				$this->session->set_flashdata('type', 'error');
			}
		} else {
			$this->session->set_flashdata('judul', 'Detail Retur');
			$this->session->set_flashdata('status', 'Gagal retur stok barang tidak mencukupi');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/detail-retur-' . $id_retur . '.html');
	}
	function deleteDetailRetur($id_retur, $id_detail_retur)
	{
		$detailRetur = $this->Admin_model->getDetailReturById($id_detail_retur);
		$insert_rekam = $this->Admin_model->insertRekamStok($detailRetur->ID_PRODUK, $detailRetur->QTY, '1', 'Pembatalan retur dari admin');
		if ($insert_rekam) {
			$update_stok = $this->Admin_model->ubahStokProduk($detailRetur->ID_PRODUK, $detailRetur->QTY, 1);
			$delete = $this->Admin_model->deleteDetailRetur($id_detail_retur);
			if ($delete) {
				$this->session->set_flashdata('judul', 'Detail Retur');
				$this->session->set_flashdata('status', 'Berhasil pembatalan retur');
				$this->session->set_flashdata('type', 'success');
			} else {
				$this->session->set_flashdata('judul', 'Detail Retur');
				$this->session->set_flashdata('status', 'Gagal pembatalan retur , coba ulangi kembali');
				$this->session->set_flashdata('type', 'error');
			}
		} else {
			$this->session->set_flashdata('judul', 'Detail Retur');
			$this->session->set_flashdata('status', 'Gagal pembatalan retur , coba ulangi kembali');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/detail-retur-' . $id_retur . '.html');
	}
	//END RETUR

	//LAPORAN PENJUALAN
	function filterLaporanPenjualan()
	{
		$hal = array('menu' => 'laporan-penjualan');
		$this->session->set_userdata($hal);
		$data['kasir'] = $this->Admin_model->getPenggunaKasir();
		$data['page'] = 'admin/filter_laporan_penjualan';
		$this->load->view($this->_template, $data);
	}
	function lihatLaporanPenjualan()
	{
		$kasir = $this->input->post('kasir');
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$status = 1;
		$data['kasir'] = $kasir;
		$data['status'] = $status;
		$data['tanggal_awal'] = $tgl_awal;
		$data['tanggal_akhir'] = $tgl_akhir;
		$data['penjualan'] = $this->Admin_model->getPenjualanByKasirAndTanggal($kasir, $tgl_awal, $tgl_akhir, $status);
		$data['page'] = 'admin/lihat_laporan_penjualan';
		$this->load->view($data['page'], $data);
	}
	function cetakLaporanPenjualan($kasir, $tgl_awal, $tgl_akhir, $status)
	{
		$data['kasir'] = $kasir;
		$data['tanggal_awal'] = $tgl_awal;
		$data['tanggal_akhir'] = $tgl_akhir;
		$data['status'] = $status;
		$data['penjualan'] = $this->Admin_model->getPenjualanByKasirAndTanggal($kasir, $tgl_awal, $tgl_akhir, $status);
		if ($status == 1) {
			$status = "Transaksi Berhasil";
		} else {
			$status = "Pembatalan Transaksi";
		}
		$data['nama_status'] = $status;
		if ($kasir == "all") {
			$kasir = "Semua";
		} else {
			$kasr = $this->db->get_where("m_pengguna", ["ID" => $kasir])->row();
			$kasir = $kasr->NAMA;
		}
		$data['nama_kasir'] = $kasir;
		$data['page'] = 'admin/cetakLaporanPenjualan';
		$this->load->view($data['page'], $data);
	}

	function eksporPenjualan($kasir, $tgl_awal, $tgl_akhir, $status)
	{
		$data['kasir'] = $kasir;
		$data['tanggal_awal'] = $tgl_awal;
		$data['tanggal_akhir'] = $tgl_akhir;
		$data['status'] = $status;
		$data['penjualan'] = $this->Admin_model->getPenjualanByKasirAndTanggal($kasir, $tgl_awal, $tgl_akhir, $status);
		if ($status == 1) {
			$status = "Transaksi Berhasil";
		} else {
			$status = "Pembatalan Transaksi";
		}
		$data['nama_status'] = $status;
		if ($kasir == "all") {
			$kasir = "Semua";
		} else {
			$kasr = $this->db->get_where("m_pengguna", ["ID" => $kasir])->row();
			$kasir = $kasr->NAMA;
		}
		$data['nama_kasir'] = $kasir;
		$data['page'] = 'admin/eksporLaporanPenjualan';
		$this->load->view($data['page'], $data);
	}
	function cetakStrukPenjualan($id_penjualan)
	{
		$data['identitas'] = $this->Admin_model->getIdentitas();
		$data['data'] = $this->Admin_model->getPenjualanById($id_penjualan);
		$data['produk'] = $this->Admin_model->getDetailPenjualanByIdPenjualan($id_penjualan);
		$this->load->view('admin/print_struk_penjualan', $data);
	}
	function modalTransaksi()
	{
		$id = $this->input->post("id");
		$data['data'] = $this->db->get_where("view_penjualan", ["ID" => $id])->row();
		$data['produk'] = $this->db->get_where("view_detail_penjualan", ["ID_TRANSAKSI_PENJUALAN" => $id]);
		$this->load->view('admin/modal_transaksi', $data);
	}
	//END LAPORAN PENJUALAN
	// START UBAH PASSWORD
	function viewUbahPassword()
	{
		$id = $this->session->userdata('id_admin');
		$data['user'] = $this->Admin_model->getPenggunaById($id);
		$data['page'] = 'admin/ubah_password';
		$this->load->view($this->_template, $data);
	}
	function ubahPassword()
	{
		$id = $this->session->userdata('id_admin');
		$user = $this->Admin_model->getPenggunaById($id);
		$password_lama = $this->input->post('password_lama');
		$password_baru = $this->input->post('password_baru');
		$ulangi_password = $this->input->post('ulangi_password');
		if ($password_lama == $user->PASSWORD) {
			if ($password_baru == $ulangi_password) {
				$update = $this->Admin_model->updatePassword($id, $password_baru);
				if ($update) {
					$this->session->set_flashdata('judul', 'Ubah Password');
					$this->session->set_flashdata('status', 'Berhasil Ubah Password');
					$this->session->set_flashdata('type', 'success');
				} else {
					$this->session->set_flashdata('judul', 'Ubah Password');
					$this->session->set_flashdata('status', 'Gagal Ubah Password,ulangi kembali');
					$this->session->set_flashdata('type', 'error');
				}
			} else {
				$this->session->set_flashdata('judul', 'Ubah Password');
				$this->session->set_flashdata('status', 'Password baru tidak sama dengan ulangi password');
				$this->session->set_flashdata('type', 'error');
			}
		} else {
			$this->session->set_flashdata('judul', 'Ubah Password');
			$this->session->set_flashdata('status', 'Password lama salah');
			$this->session->set_flashdata('type', 'error');
		}
		redirect('admin/ubah-password.html');
	}
	//START TRANSAKSI
	function filterTransaksiKeuangan()
	{
		$hal = array('menu' => 'transaksi-keuangan');
		$this->session->set_userdata($hal);
		$data['page'] = 'admin/filter_transaksi_keuangan';
		$this->load->view($this->_template, $data);
	}
	function detailTransaksiKeuangan()
	{
		$tgl = $this->input->post('tgl');
		$data['tgl'] = $tgl;
		$data['transaksi'] = $this->Admin_model->getTransaksiKeuanganByTanggal($tgl);
		$data['page'] = 'admin/detail_transaksi_keuangan';
		$this->load->view($this->_template, $data);
	}
	function insertTransaksiKeuangan()
	{
		$tgl = $this->input->post('tgl');
		if ($tgl) {
			if ($this->Admin_model->insertTransaksiKeuangan($tgl)) {
				$data['tgl'] = $tgl;
				$data['transaksi'] = $this->Admin_model->getTransaksiKeuanganByTanggal($tgl);
				$data['page'] = 'admin/tabel_transaksi_keuangan';
				$this->load->view($data['page'], $data);
			} else {
				echo "0";
			}
		} else {
			echo "0";
		}
	}
	//END TRANSAKSI

	public function laporan_keuangan()
	{
		$hal = array('menu' => 'laporan');
		$this->session->set_userdata($hal);
		$data['page'] = 'admin/laporan_keuangan';
		$this->load->view($this->_template, $data);
	}
	public function LaporanTransaksiKeuangan()
	{
		$tanggal_awal = $this->input->post("tanggal_awal");
		$tanggal_akhir = $this->input->post("tanggal_akhir");
		$data['transaksi'] = $this->Admin_model->getTransaksiKeuanganByTanggalRange($tanggal_awal, $tanggal_akhir);
		$data['page'] = 'admin/laporan_transaksi_keuangan';
		$this->load->view($data['page'], $data);
	}

	//LAPORAN PENJUALAN
	function filterLaporanPenjualanHapus()
	{
		$hal = array('menu' => 'laporan-penjualan-hapus');
		$this->session->set_userdata($hal);
		$data['kasir'] = $this->Admin_model->getPenggunaKasir();
		$data['page'] = 'admin/filter_laporan_penjualan_hapus';
		$this->load->view($this->_template, $data);
	}
	function lihatLaporanPenjualanHapus()
	{
		$kasir = $this->input->post('kasir');
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$status = 1;
		$data['kasir'] = $kasir;
		$data['status'] = $status;
		$data['tanggal_awal'] = $tgl_awal;
		$data['tanggal_akhir'] = $tgl_akhir;
		$data['penjualan'] = $this->Admin_model->getPenjualanByKasirAndTanggalHapus($kasir, $tgl_awal, $tgl_akhir, $status);
		$data['page'] = 'admin/lihat_laporan_penjualan_hapus';
		$this->load->view($data['page'], $data);
	}

	function lihatCustomer()
	{
		$hal = array('menu' => 'customer');
		$this->session->set_userdata($hal);
		$data['page'] = 'admin/customer';
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
			$transaksi = $this->db->get_where("t_penjualan", ["ID_CUSTOMER" => $data->ID]);
			$lihat = site_url("admin/detailCustomer/" . base64_encode_fix($data->ID));
			$row = array();
			$row[] = $seq_number;
			$row[] = "<b>" . $data->NAMA . "</b><br><span style='font-size:10pt'>" . $data->ALAMAT . "</span>";
			$row[] = $data->NO_TELP;
			$row[] = "<span class='badge badge-success' style='font-size:11pt'>" . $transaksi->num_rows() . '</span>';
			$row[] = '<a href="' . $lihat . '" class="btn btn-primary mr-1"><i class="mdi mdi-file mr-1"></i>Lihat</a>';
			$output['aaData'][] = $row;
			$seq_number++;
		}

		echo json_encode($output);
	}
	public function detailCustomer($id)
	{
		$id = base64_decode_fix($id);
		$data['id'] = $id;
		$data['customer'] = $this->db->get_where("m_customer", ["ID" => $id])->row();
		$data['penjualan'] = $this->db->get_where("view_penjualan", ["ID_CUSTOMER" => $id]);
		$data['page'] = 'admin/detail_customer';
		$this->load->view($this->_template, $data);
	}
}
