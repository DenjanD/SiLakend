<?php

    class m_pengemudi extends CI_Model{

        public function get_data(){
            $this->db->select('*');
            $this->db->from('tb_master_pengemudi');
            $this->db->order_by('NAMA');
            return $this->db->get()->result_array();
        }
        public function get_data2(){
            $this->db->select('tb_master_pegawai.ID,tb_master_pegawai.NAMA');
            $this->db->from('tb_master_pegawai');
            $this->db->join('sy_user','tb_master_pegawai.ID=sy_user.user_id');
            $this->db->join('sy_user_level','sy_user.user_id=sy_user_level.user_id');
            $this->db->join('sy_level','sy_user_level.user_level=sy_level.level');
            $this->db->where('sy_level.nama_level="Supir"'); 
            $this->db->order_by('tb_master_pegawai.NAMA');
            return $this->db->get()->result_array();
        } 
        public function insert_data($insert){
            $this->db->insert('tb_master_pengemudi',$insert);
        }
        public function update_data($update,$where){
            $this->db->set('NAMA',$update['NAMA']);
            $this->db->where('ID',$where);
            $this->db->update('tb_master_pengemudi');
        }
        public function hapus_data($where, $table){
            $this->db->where($where);
            $this->db->delete($table);
        }
        function cari($id){
            $this->db->select('ID');
            $this->db->from('tb_master_pegawai');
            $this->db->where('NAMA',$id);
            return $this->db->get()->result_array();
            
        }
        public function get_keyword($keyword){

            $this->db->select('*');
            $this->db->from('tb_master_pengemudi');
            $this->db->like('NAMA',$keyword);
            $this->db->or_like('STATUS',$keyword);
            return $this->db->get()->result_array();
        
        }


    }


?>