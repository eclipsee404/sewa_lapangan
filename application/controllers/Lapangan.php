<?php

class Lapangan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
         
        if($_SESSION['user_id'] == ""){
         redirect(base_url()."auth");
      }
    }

    public function index(){
        
        $this->load->model('lapangan/m_lapangan');
        $data['lapangan'] = $this->m_lapangan->get_data();

        $this->load->view('template/header');
        $this->load->view('lapangan/v_lapangan',$data);
        $this->load->view('template/footer');

    }

    public function simpan(){
        // $this->load->model('lapangan/m_lapangan');
        // echo "1";
        $id_m = "lapangan_id";
        $tablenm = "lapangan";
        $id_key1 = "lapangan_";
        foreach ($_REQUEST as $key => $value) {
            if (substr($key, 0, strlen($id_key1)) == $id_key1) {
                $data[$key] = $this->input->post($key);
            }
        }
        if($this->input->post($id_m) > 0){
            $where = array(
                $id_m => $this->input->post($id_m)
            );
        }else{
            $where = "";
        }
        // var_dump($data);
        // echo $data['lapangan_nama'];
        $this->load->model('lapangan/m_lapangan');
        $db = $this->m_lapangan->set_data($tablenm,$data,$where);
        echo $db;
    }

    public function get_edit($id){
        $id_m = "lapangan_id";
        $tablenm = "lapangan";
        $where = array(
            $id_m => $id
        );
        
        $this->load->model('lapangan/m_lapangan');
        $data = $this->m_lapangan->get_data_detail($tablenm,$where);
        echo json_encode($data);
    }

    

}