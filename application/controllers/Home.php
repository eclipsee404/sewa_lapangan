<?php


class Home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
         
        if($_SESSION['user_id'] == ""){
         redirect(base_url()."auth");
      }
    }
   

    public function index(){
        $this->load->view('template/header');
        $this->load->view('home/v_home');
        $this->load->view('template/footer');
    }

}