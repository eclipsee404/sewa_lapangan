<?php

class Jadwal extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
         
        if($_SESSION['user_id'] == ""){
         redirect(base_url()."auth");
      }
    }

    public function index(){

        $this->load->view('template/header');
        $this->load->model('jadwal/m_jadwal');
        $data['lapangan'] = $this->m_jadwal->get_jadwal();
        $this->load->view('jadwal/v_jadwal',$data);
        $this->load->view('template/footer');

    }

}