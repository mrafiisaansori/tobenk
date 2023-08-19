<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cek_login
{

    public function __construct()
    {
        if (!isset($this->CI)) {
            $this->CI = &get_instance();
        }
        //session_start();
    }
    function cek_login($level_cek = null)
    {
        if ($level_cek == null) { //halaman login
            return true;
        }

        //selain halaman login
        $level = $this->CI->session->userdata('level');
        $redirect = array(
            1 => 'admin',
            2 => 'kasir',
            3 => 'produksi',
            4 => 'desainer'
        );
        if (!isset($level)) {
            redirect('login');
        } elseif ($level == $level_cek) {
            return true;
        } else {
            redirect($redirect[$level]);
        }
    }
}
