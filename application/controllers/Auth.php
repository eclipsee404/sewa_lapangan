<?php

class Auth extends CI_Controller{


    public function index(){

        $this->load->view('home/v_login');        

    }

    public function login(){
        $this->load->model('auth/m_auth');
        $user_nama = $this->input->post('user_nama');
        $user_password = $this->input->post('user_password');
        
        $db = $this->m_auth->login_check($user_nama,$user_password);
        if($db == true){
            // echo "SUKSES LOGIN";
            // exit();
            redirect(base_url()."home");
        }else{
            // echo "GAGAL LOGIN";
            // exit();
            redirect(base_url()."auth/index/gagal");
        }
    }

    public function logout(){
        session_destroy();
        redirect(base_url()."auth");
    }



}