<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_login {
    
	public function __construct()
	{
		if (!isset($this->CI))
		{
			$this->CI =& get_instance();
		}
         //session_start();
	}
    function cek_login_admin(){
        if($this->CI->session->userdata('level') != '1'){
            if($this->CI->session->userdata('level') == '2'){
                redirect('kasir');
            }else{
                redirect('');
            }
        }
    }
    function cek_login_kasir(){
        if($this->CI->session->userdata('level') != '2'){
            if($this->CI->session->userdata('level') == '1'){
                redirect('admin');
            }else{
                redirect('');
            }
        }
    }
    function cek_login(){
        if($this->CI->session->userdata('level') == '1'){
            redirect('admin');
        }else if($this->CI->session->userdata('level') == '2'){
            redirect('kasir');
        }
    }
}