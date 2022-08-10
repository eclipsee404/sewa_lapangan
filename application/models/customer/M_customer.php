<?php


class M_customer extends CI_Model{

    public function get_data(){
        return $this->db->get('klien')->result_array();
        // $this->db->order_by('customer_nama','asc');
        // return $this->db->result_array();
    }

    public function set_data($tablenm,$data,$where){
        if($where != ""){
            $this->db->where($where);
            $this->db->update($tablenm,$data);
            if ($this->db->affected_rows() > 0)
            {
            return TRUE;
            }
            else
            {
            return FALSE;
            }
        }else{
            $this->db->insert($tablenm,$data);
            if ($this->db->affected_rows() > 0)
            {
            return TRUE;
            }
            else
            {
            return FALSE;
            }
        }
        
    }

    public function get_data_detail($tablenm,$where){
        $this->db->where($where);
        $data = $this->db->get('klien')->result_array();
        return $data;
    }

}