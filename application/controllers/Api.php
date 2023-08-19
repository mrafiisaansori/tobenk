<?php
require APPPATH . 'libraries/REST_Controller.php';
class Api extends REST_Controller {

    public function __construct() {
       parent::__construct();
    }

    public function user_post()
    {
        $input = $this->input->post();
        if($input)
        {
            $this->db->select('NAMA, TELP, USERNAME, LEVEL');
            $data = $this->db->get_where("m_pengguna", $input)->row_array();
            if($data)
            {
                $data = array('response' => TRUE,'data' => $data);
                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $data = array('response' => FALSE,'data' => 'Username atau password tidak sesuai.');
                $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
            
        }
        else
        {
            $data = array('response' => FALSE,'data' => 'Format inputan salah.');
            $this->response($data, REST_Controller::HTTP_NOT_FOUND);
        }
        
    }
    public function produk_get($id = 0)
    {
         header("Access-Control-Allow-Origin: *");
        if(!empty($id)){
            $data = $this->db->get_where("m_produk", ['ID' => $id])->row_array();
        }else{
            $data = $this->db->get("m_produk")->result();
        }
        $data = array('response' => TRUE,'data' => $data);
        $this->response($data, REST_Controller::HTTP_OK);
    }
    // THEME API //
	/*public function index_get($id = 0)
	{
        if(!empty($id)){
            $data = $this->db->get_where("items", ['id' => $id])->row_array();
        }else{
            $data = $this->db->get("items")->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
	}
    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('items',$input);
        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
    }
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('items', $input, array('id'=>$id));
        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }
    public function index_delete($id)
    {
        $this->db->delete('items', array('id'=>$id));
        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }*/
    // END THEME API //
}