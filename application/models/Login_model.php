<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }
    
    function searchData($tabel,$where,$type)
    {
    	$query = $this->db->get_where($tabel,$where);

    	if($query->num_rows()>0)
    	{
    		if($type=='result')
    		{
    			return $query->result();
    		}
    		elseif($type=='rows')
    		{
    			return $query->num_rows();
    		}
    		else
    		{
    			return $query->row();
    		}
    	}
    	else
    	{
    		return false;
    	}
    }    
    function searchDataOrder($tabel,$where,$type,$field)
    {
        $query = $this->db->order_by($field, 'DESC')->get_where($tabel, $where);
        if($query->num_rows()>0)
        {
            if($type=='result')
            {
                return $query->result();
            }
            elseif($type=='rows')
            {
                return $query->num_rows();
            }
            else
            {
                return $query->row();
            }
        }
        else
        {
            return false;
        }
    }
    function showData($tabel,$type)
    {
    	$query = $this->db->get($tabel);
    	if($query->num_rows()>0)
    	{
    		if($type=='result')
    		{
    			return $query->result();
    		}
    		elseif($type=='rows')
    		{
    			return $query->num_rows();
    		}
    		else
    		{
    			return $query->row();
    		}
    	}
    	else
    	{
    		return false;
    	}
    }
}
?>