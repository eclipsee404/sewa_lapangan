<?php 

class Booking extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
         
        if($_SESSION['user_id'] == ""){
         redirect(base_url()."auth");
      }
    }

    public function index(){
        $tgl = $this->input->post('tanggal');
        if($tgl == ""){
            $tgl = date("Y-m-d");
        }
        $this->load->model('booking/m_booking');
        $data['sewa'] = $this->m_booking->get_data($tgl);
        $this->load->view('template/header');
        $this->load->view('booking/v_booking',$data);
        $this->load->view('template/footer');

    }

    public function add(){
        $this->load->model('booking/m_booking');
        $this->load->view('template/header');
        $this->load->view('booking/v_booking_add');
        $this->load->view('template/footer');

    }

    public function insert_booking(){
        $klien_id = $this->input->post('klien_id');
        $lapangan_id = $this->input->post('lapangan_id');
        $sewa_tgl = $this->input->post('sewa_tgl');
        $jamnya = implode(",",$this->input->post('jamnya'));
        $sewa_id = $this->input->post('sewa_id');
        // var_dump($jamnya);
        // exit();
        $data = array(

            "klien_id" => $klien_id,
            "lapangan_id" => $lapangan_id,
            "sewa_tgl" => $sewa_tgl

        );
        $this->load->model('booking/m_booking');
        $db = $this->m_booking->insert_data('sewa',$data,$jamnya,$sewa_id);
        // redirect('booking/index');
        echo $db;

    }

    public function del($sewa_id){
        $this->load->model('booking/m_booking');
        $data = array(
            'sewa_aktif' => 0
        );
        // var_dump($data);
        // exit();
        $this->m_booking->delete_data('sewa',$data,$sewa_id);
        redirect('booking/');
    }

}