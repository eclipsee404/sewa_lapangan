<?php

class M_booking extends CI_Model{

    public function get_data($tgl = ""){

        $this->db->select('*');
        $this->db->from('sewa');
        $this->db->join('klien','klien.klien_id = sewa.klien_id');
        $this->db->join('lapangan','lapangan.lapangan_id = sewa.lapangan_id');
        $this->db->where('sewa.sewa_aktif',1);
        if($tgl != ""){
            $this->db->where('sewa.sewa_tgl',$tgl);
        }
        return $query = $this->db->get()->result_array();

    }

    public function insert_data($tablenm,$data,$jamnya,$sewa_id){
 
        if($sewa_id == ""){
            $this->db->insert($tablenm,$data);
            if ($this->db->affected_rows() > 0)
            {
                $lastid = $this->db->insert_id();
                if($jamnya != ""){
                    $exp = explode(",",$jamnya);
                    foreach($exp as $key => $val){
                        unset($data_jam);
                        $sewa_detail_jam = $val;
                        $data_jam = array(
                            'sewa_detail_jam' => $sewa_detail_jam,
                            'sewa_id' => $lastid
                        );
                        $this->db->insert('sewa_detail',$data_jam);

                    }
                }
            
            return TRUE;
            }
            else
            {
            return FALSE;
            }
        }else{
            $this->db->where('sewa_id', $sewa_id);
            $this->db->update($tablenm, $data);


            $sql="update sewa_detail set sewa_detail_aktif = '0' where sewa_id = '$sewa_id'"; 
            $this->db->query($sql);

            if($jamnya != ""){
                $exp = explode(",",$jamnya);
                foreach($exp as $key => $val){
                    unset($data_jam);
                    $sewa_detail_jam = $val;
                    $data_jam = array(
                        'sewa_detail_jam' => $sewa_detail_jam,
                        'sewa_id' => $sewa_id
                    );
                    $this->db->insert('sewa_detail',$data_jam);

                }
            }

            return TRUE;

        }

    }

    public function delete_data($tablenm,$data,$sewa_id){
        $this->db->where('sewa_id', $sewa_id);
        $this->db->update($tablenm, $data);

        $sql="update sewa_detail set sewa_detail_aktif = '0' where sewa_id = '$sewa_id'"; 
        $this->db->query($sql);
    }

}