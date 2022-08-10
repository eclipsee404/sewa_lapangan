<?php

class Customer extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
         
        if($_SESSION['user_id'] == ""){
         redirect(base_url()."auth");
      }
    }

    public function index(){
        
        $this->load->model('customer/m_customer');
        $data['customer'] = $this->m_customer->get_data();

        $this->load->view('template/header');
        $this->load->view('customer/v_customer',$data);
        $this->load->view('template/footer');

    }

    public function simpan(){
        // $this->load->model('customer/m_customer');
        // echo "1";
        $id_m = "klien_id";
        $tablenm = "klien";
        $id_key1 = "klien_";
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
        // echo $data['customer_nama'];
        $this->load->model('customer/m_customer');
        $db = $this->m_customer->set_data($tablenm,$data,$where);
        echo $db;
    }

    public function get_edit($id){
        $id_m = "klien_id";
        $tablenm = "klien";
        $where = array(
            $id_m => $id
        );
        
        $this->load->model('customer/m_customer');
        $data = $this->m_customer->get_data_detail($tablenm,$where);
        echo json_encode($data);
    }

    

}