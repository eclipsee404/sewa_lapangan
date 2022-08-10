<?php

class M_jadwal extends CI_Model{


    public function get_jadwal(){
        
        return $this->db->get('lapangan')->result_array();


    }

}