<?php
class Admin_model extends CI_Model
{
    function getIdentitas()
    {
        $query = "SELECT * FROM m_identitas WHERE ID='1'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function updateIdentitas($logo)
    {
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $email = $this->input->post('email');
        $website = $this->input->post('website');

        $query = "UPDATE m_identitas SET NAMA='$nama',ALAMAT='$alamat',NO_TELP='$telp',EMAIL='$email',WEBSITE='$website',LOGO='$logo' WHERE ID='1'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getPengguna()
    {
        $query = "SELECT * FROM m_pengguna";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function getPenggunaByUsername($username)
    {
        $query = "SELECT * FROM m_pengguna WHERE USERNAME='$username'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function insertPengguna()
    {
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level = $this->input->post('level');
        $telp = $this->input->post('telp');
        $query = "INSERT INTO m_pengguna (NAMA,USERNAME,PASSWORD,LEVEL,TELP) VALUES ('$nama','$username','$password','$level','$telp')";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getPenggunaById($id)
    {
        $query = "SELECT * FROM m_pengguna WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function updatePengguna($id)
    {
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        $level = $this->input->post('level');
        $telp = $this->input->post('telp');

        $query = "UPDATE m_pengguna SET NAMA ='$nama',LEVEL='$level',TELP='$telp' WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function deletePengguna($id)
    {
        $query = "DELETE FROM m_pengguna WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function resetPasswordPengguna($id)
    {
        $query = "UPDATE m_pengguna SET PASSWORD=USERNAME WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function getKategori()
    {
        $query = "SELECT * FROM m_kategori";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function insertKategori()
    {
        $deskripsi = $this->input->post('deskripsi');
        $query = "INSERT INTO m_kategori (DESKRIPSI) VALUES ('$deskripsi')";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getKategoriById($id)
    {
        $query = "SELECT * FROM m_kategori WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function updateKategori($id)
    {
        $deskripsi = $this->input->post('deskripsi');
        $query = "UPDATE m_kategori SET DESKRIPSI ='$deskripsi' WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function deleteKategori($id)
    {
        $query = "DELETE FROM m_kategori WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function getProduk()
    {
        $query = "SELECT * FROM view_produk";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function insertProduk()
    {
        $nama = addslashes($this->input->post('nama'));
        $kategori = $this->input->post('kategori');
        $stok = $this->input->post('stok');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $barcode = $this->input->post('barcode');
        $keterangan = $this->input->post('keterangan');
        $ukuran = $this->input->post('ukuran');
        $tanpa_stok = $this->input->post('tanpa_stok');
        $query = "INSERT INTO m_produk (NAMA,ID_KATEGORI,STOK,HARGA_BELI,HARGA_JUAL,BARCODE,KETERANGAN,UKURAN,TANPA_STOK) VALUES ('$nama','$kategori','$stok','$harga_beli','$harga_jual','$barcode','$keterangan','$ukuran','$tanpa_stok')";
        $query = $this->db->query($query);
        if ($query) {
            $this->insertProdukDetail($this->db->insert_id());
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    function insertProdukWithImage($filename)
    {
        $nama = addslashes($this->input->post('nama'));
        $kategori = $this->input->post('kategori');
        $stok = $this->input->post('stok');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $barcode = $this->input->post('barcode');
        $keterangan = $this->input->post('keterangan');
        $ukuran = $this->input->post('ukuran');
        $tanpa_stok = $this->input->post('tanpa_stok');
        $query = "INSERT INTO m_produk (NAMA,ID_KATEGORI,STOK,HARGA_BELI,HARGA_JUAL,BARCODE,FOTO,KETERANGAN,UKURAN,TANPA_STOK) VALUES ('$nama','$kategori','$stok','$harga_beli','$harga_jual','$barcode','$filename','$keterangan','$ukuran','$tanpa_stok')";
        $query = $this->db->query($query);
        if ($query) {
            $this->insertProdukDetail($this->db->insert_id());
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    function insertProdukDetail($id_produk)
    {
        $ukuran = $this->input->post('ukuran');
        $stok = $this->input->post('stok');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $barcode = $this->input->post('barcode');


        for ($i = 0; $i < count($ukuran); $i++) {
            $data_insert = array(
                'ID_PRODUK' => $id_produk,
                'UKURAN' => $ukuran[$i],
                'STOK' => $stok[$i],
                'HARGA_BELI' => $harga_beli[$i],
                'HARGA_JUAL' => $harga_jual[$i],
                'BARCODE' => $barcode[$i],
            );
            $this->db->insert('m_produk_detail', $data_insert);
            $id_produk_detail = $this->db->insert_id();
            $rekam_insert[] = array(
                'ID_PRODUK' => $id_produk,
                'ID_PRODUK_DETAIL' => $id_produk_detail,
                'JENIS' => 1,
                'QTY' => $stok[$i],
                'TANGGAL' => date('Y-m-d H:i:sa'),
                'KETERANGAN' => 'Stok Opname'
            );
        }
        $this->db->insert_batch('t_rekam_stok', $rekam_insert);
    }
    function getProdukById($id)
    {
        $query = "SELECT * FROM view_produk WHERE ID_PRODUK='$id'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function getProdukDetailById($id)
    {
        return $this->db->get_where('m_produk_detail', array('ID' => $id))->row();
    }
    function getProdukDetailByIdProduk($id)
    {
        return $this->db->get_where('m_produk_detail', array('ID_PRODUK' => $id))->result();
    }
    function getPenjualanByIdPd($id)
    {
        return $this->db->get_where('t_detail_penjualan', array('ID_PRODUK_DETAIL' => $id))->result();
    }
    function getPembelianByIdPd($id)
    {
        return $this->db->get_where('t_detail_pembelian', array('ID_PRODUK_DETAIL' => $id))->result();
    }
    function getReturByIdPd($id)
    {
        return $this->db->get_where('t_detail_retur', array('ID_PRODUK_DETAIL' => $id))->result();
    }
    function insertRekamStok($produk, $stok, $jenis, $keterangan)
    {
        $tanggal = date('Y-m-d H:i:sa');
        $keterangan = addslashes($keterangan);
        $query = "INSERT INTO t_rekam_stok (ID_PRODUK,JENIS,QTY,TANGGAL,KETERANGAN) VALUES ('$produk','$jenis','$stok','$tanggal','$keterangan')";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function insertRekamStok2($produk, $produk_detail, $stok, $jenis, $keterangan)
    {
        $insert = array(
            'ID_PRODUK' => $produk,
            'ID_PRODUK_DETAIL' => $produk_detail,
            'JENIS' => $jenis,
            'QTY' => $stok,
            'TANGGAL' => date('Y-m-d H:i:sa'),
            'KETERANGAN' => $keterangan
        );
        $this->db->insert('t_rekam_stok', $insert);
        return true;
    }
    function updateProduk($id)
    {
        $nama = addslashes($this->input->post('nama'));
        $kategori = $this->input->post('kategori');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $barcode = $this->input->post('barcode');
        $keterangan = $this->input->post('keterangan');
        $ukuran = $this->input->post('ukuran');
        $tanpa_stok = $this->input->post('tanpa_stok');
        $query = "UPDATE m_produk SET NAMA='$nama',ID_KATEGORI='$kategori',HARGA_BELI='$harga_beli',HARGA_JUAL='$harga_jual',BARCODE='$barcode',KETERANGAN='$keterangan',UKURAN='$ukuran',TANPA_STOK='$tanpa_stok' WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function updateProdukWithImage($id, $filename)
    {
        $nama = addslashes($this->input->post('nama'));
        $kategori = $this->input->post('kategori');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $barcode = $this->input->post('barcode');
        $keterangan = $this->input->post('keterangan');
        $ukuran = $this->input->post('ukuran');
        $query = "UPDATE m_produk SET NAMA='$nama',ID_KATEGORI='$kategori',HARGA_BELI='$harga_beli',HARGA_JUAL='$harga_jual',BARCODE='$barcode',FOTO='$filename',KETERANGAN='$keterangan',UKURAN='$ukuran' WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function deleteProduk($id)
    {
        $query = "DELETE FROM m_produk WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            $this->db->delete('m_produk_detail', array('ID_PRODUK' => $id));
            return true;
        } else {
            return false;
        }
    }


    function getSupplier()
    {
        $query = "SELECT * FROM m_supplier";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function insertSupplier()
    {
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $nama_pic = $this->input->post('nama_pic');
        $telp_pic = $this->input->post('telp_pic');
        $query = "INSERT INTO m_supplier (NAMA,ALAMAT,NO_TELP,NAMA_PIC,NO_TELP_PIC) VALUES ('$nama','$alamat','$telp','$nama_pic','$telp_pic')";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getSupplierById($id)
    {
        $query = "SELECT * FROM m_supplier WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function updateSupplier($id)
    {
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $nama_pic = $this->input->post('nama_pic');
        $telp_pic = $this->input->post('telp_pic');
        $query = "UPDATE m_supplier SET NAMA ='$nama',ALAMAT='$alamat',NO_TELP='$telp',NAMA_PIC='$nama_pic',NO_TELP_PIC='$telp_pic' WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function deleteSupplier($id)
    {
        $query = "DELETE FROM m_supplier WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function getJenisBayar()
    {
        $query = "SELECT * FROM m_jenis_bayar";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function insertJenisBayar()
    {
        $nama = $this->input->post('nama');
        $query = "INSERT INTO m_jenis_bayar (NAMA) VALUES ('$nama')";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getJenisBayarById($id)
    {
        $query = "SELECT * FROM m_jenis_bayar WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function updateJenisBayar($id)
    {
        $nama = $this->input->post('nama');
        $query = "UPDATE m_jenis_bayar SET NAMA ='$nama' WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function deleteJenisBayar($id)
    {
        $query = "DELETE FROM m_jenis_bayar WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function insertPembelian()
    {
        $no_nota = $this->input->post('no_nota');
        $tanggal = $this->input->post('tanggal');
        $user = $this->session->userdata('id_admin');

        $query = "INSERT INTO t_pembelian (NO_NOTA,TANGGAL,ID_USER) VALUES ('$no_nota','$tanggal','$user')";
        $query = $this->db->query($query);
        if ($query) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    function getPembelianById($id)
    {
        $query = "SELECT * FROM view_pembelian WHERE ID_PEMBELIAN='$id'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function updatePembelian($id)
    {
        $no_nota = $this->input->post('no_nota');
        $tanggal = $this->input->post('tanggal');
        $user = $this->session->userdata('id_admin');

        $query = "UPDATE t_pembelian SET NO_NOTA='$no_nota',TANGGAL='$tanggal',ID_USER='$user' WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function deletePembelian($id)
    {
        $query = "DELETE FROM t_pembelian WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getDetailPembelianByIdPembelian($id_pembelian)
    {
        $query = "SELECT * FROM view_detail_pembelian WHERE ID_TRANSAKSI_PEMBELIAN='$id_pembelian' ORDER BY ID_DETAIL_PEMBELIAN DESC";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function cariProduk($cari)
    {
        $query = "SELECT * FROM view_produk WHERE NAMA_PRODUK LIKE '%$cari%' AND TANPA_STOK = 0";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function insertDetailPembelian($id_pembelian, $stok_lama)
    {
        $produk = $this->input->post('produk');
        $produk_detail = $this->input->post('produk_detail');
        $harga_beli = str_replace(".", "", $this->input->post('harga_beli'));
        $jumlah = $this->input->post('jumlah');
        $supplier = $this->input->post('supplier');

        $query = "INSERT INTO t_detail_pembelian (ID_TRANSAKSI_PEMBELIAN,ID_PRODUK,HARGA_BELI,QTY,QTY_LAMA,ID_SUPPLIER,ID_PRODUK_DETAIL)
        VALUES ('$id_pembelian','$produk','$harga_beli','$jumlah','$stok_lama','$supplier','$produk_detail')";
        $query = $this->db->query($query);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function ubahStokProduk($id_produk, $jumlah, $jenis)
    {
        $set_stok = '';
        if ($jenis == 1) {
            $set_stok = "SET STOK=STOK+$jumlah";
        } else {
            $set_stok = "SET STOK=STOK-$jumlah";
        }
        $query = "UPDATE m_produk $set_stok WHERE ID='$id_produk'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function ubahStokProduk2($id_produk, $jumlah, $jenis)
    {
        $set_stok = '';
        if ($jenis == 1) {
            $set_stok = "SET STOK=STOK+$jumlah";
        } else {
            $set_stok = "SET STOK=STOK-$jumlah";
        }
        $query = "UPDATE m_produk_detail $set_stok WHERE ID='$id_produk'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function ubahStokHargaProduk($id_produk, $jumlah, $jenis, $harga_beli)
    {
        $set_stok = '';
        if ($jenis == 1) {
            $set_stok = "SET STOK=STOK+$jumlah";
        } else {
            $set_stok = "SET STOK=STOK-$jumlah";
        }
        $query = "UPDATE m_produk $set_stok,HARGA_BELI='$harga_beli' WHERE ID='$id_produk'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function ubahStokHargaProdukDetail($id_produk_detail, $jumlah, $jenis, $harga_beli)
    {
        $set_stok = '';
        if ($jenis == 1) {
            $set_stok = "SET STOK=STOK+$jumlah";
        } else {
            $set_stok = "SET STOK=STOK-$jumlah";
        }
        $query = "UPDATE m_produk_detail $set_stok,HARGA_BELI='$harga_beli' WHERE ID='$id_produk_detail'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getDetailPembelianById($id)
    {
        $query = "SELECT * FROM view_detail_pembelian WHERE ID_DETAIL_PEMBELIAN='$id'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function deleteDetailPembelianByIdPembelian($id_pembelian)
    {
        $query = "DELETE FROM t_detail_pembelian WHERE ID_TRANSAKSI_PEMBELIAN='$id_pembelian'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function deleteDetailPembelian($id)
    {
        $query = "DELETE FROM t_detail_pembelian WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function updateStatusPembelian($id)
    {
        $query = "UPDATE t_pembelian SET STATUS = '1' WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function insertRetur()
    {
        $no_nota = $this->input->post('no_nota');
        $tanggal = $this->input->post('tanggal');
        $user = $this->session->userdata('id_admin');

        $query = "INSERT INTO t_retur (NO_NOTA,TANGGAL,ID_USER) VALUES ('$no_nota','$tanggal','$user')";
        $query = $this->db->query($query);
        if ($query) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    function getReturById($id)
    {
        $query = "SELECT * FROM view_retur WHERE ID_RETUR='$id'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function updateRetur($id)
    {
        $no_nota = $this->input->post('no_nota');
        $tanggal = $this->input->post('tanggal');
        $user = $this->session->userdata('id_admin');

        $query = "UPDATE t_retur SET NO_NOTA='$no_nota',TANGGAL='$tanggal',ID_USER='$user' WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function deleteRetur($id)
    {
        $query = "DELETE FROM t_retur WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function getDetailReturById($id)
    {
        $query = "SELECT * FROM view_detail_retur WHERE ID_DETAIL_RETUR='$id'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function getDetailReturByIdRetur($id_retur)
    {
        $query = "SELECT * FROM view_detail_retur WHERE ID_TRANSAKSI_RETUR='$id_retur' ORDER BY ID_DETAIL_RETUR DESC";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function deleteDetailReturByIdRetur($id_retur)
    {
        $query = "DELETE FROM t_detail_retur WHERE ID_TRANSAKSI_RETUR='$id_retur'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function insertDetailRetur($id_retur, $stok_lama)
    {
        $produk = $this->input->post('produk');
        $produk_detail = $this->input->post('produk_detail');
        $jumlah = $this->input->post('jumlah');
        $supplier = $this->input->post('supplier');
        $keterangan = $this->input->post('keterangan');

        $query = "INSERT INTO t_detail_retur (ID_TRANSAKSI_RETUR,ID_PRODUK,QTY,QTY_LAMA,ID_SUPPLIER,KETERANGAN,ID_PRODUK_DETAIL) VALUES 
        ('$id_retur','$produk','$jumlah','$stok_lama','$supplier','$keterangan','$produk_detail')";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function deleteDetailRetur($id)
    {
        $query = "DELETE FROM t_detail_retur WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getPenggunaKasir()
    {
        $query = "SELECT * FROM m_pengguna WHERE LEVEL='2'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function getPenjualanByKasirAndTanggal($kasir, $tgl_awal, $tgl_akhir, $status)
    {
        $w_kasir = '';
        if ($kasir != 'all') {
            $w_kasir = "AND ID_USER ='$kasir'";
        }
        $query = "SELECT * FROM view_penjualan WHERE  TANGGAL BETWEEN '$tgl_awal' AND '$tgl_akhir' AND `STATUS`='1' $w_kasir ORDER BY ID ASC";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function getPenjualanByKasirAndTanggalHapus($kasir, $tgl_awal, $tgl_akhir, $status)
    {
        $w_kasir = '';
        if ($kasir != 'all') {
            $w_kasir = "AND ID_USER ='$kasir'";
        }
        $query = "SELECT * FROM view_penjualan WHERE  TANGGAL BETWEEN '$tgl_awal' AND '$tgl_akhir' AND `STATUS`='0' $w_kasir ORDER BY ID ASC";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function getPenjualanById($id_penjualan)
    {
        $query = "SELECT * FROM view_penjualan WHERE ID='$id_penjualan'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function getDetailPenjualanByIdPenjualan($id_penjualan)
    {
        $query = "SELECT * FROM view_detail_penjualan WHERE ID_TRANSAKSI_PENJUALAN='$id_penjualan'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function updatePassword($id, $password)
    {
        $query = "UPDATE m_pengguna SET PASSWORD='$password' WHERE ID='$id'";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    function getTransaksiKeuanganByTanggal($tgl)
    {
        $query = "SELECT * FROM t_transaksi WHERE TANGGAL='$tgl' ORDER BY ID ASC";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function getTransaksiKeuanganByTanggalRange($tgl_awal, $tgl_akhir)
    {
        $query = "SELECT * FROM t_transaksi WHERE TANGGAL BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY ID ASC";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function insertTransaksiKeuangan($tgl)
    {
        $nama = $this->input->post('nama');
        $jenis = $this->input->post('jenis');
        $nominal = $this->input->post('nominal');

        $query = "INSERT INTO t_transaksi (NAMA_TRANSAKSI,JENIS_TRANSAKSI,NOMINAL,TANGGAL) VALUES ('$nama','$jenis','$nominal','$tgl')";
        $query = $this->db->query($query);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
