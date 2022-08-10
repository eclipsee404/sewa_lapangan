<?php


class M_auth extends CI_Model{

    public function login_check($user_nama,$user_password){

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_nama',$user_nama);
        $this->db->where('user_password',$user_password);
        $data = $this->db->get()->result_array();

        if(count($data) > 0){

            foreach($data as $row){

                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_nama'] = $row['user_nama'];
                return true;
            }

        }else{
            return false;
        }

    }

}