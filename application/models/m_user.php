<?php 

    class m_user extends CI_Model{

        public function get_data($keyword,$limit,$start){
           $this->db->select('sy_user.user_id, sy_user.nama, sy_level.nama_level');
           $this->db->join('sy_user_level', 'sy_user.user_id=sy_user_level.user_id');
           $this->db->join('sy_level', 'sy_user_level.user_level=sy_level.level');
           $this->db->like('sy_user.user_id',$keyword);
           $this->db->or_like('sy_user.nama',$keyword);
           $this->db->or_like('sy_level.nama_level',$keyword);
           $this->db->order_by('sy_user.nama');
           return $this->db->get('sy_user',$limit,$start)->result_array();
        }

        public function get_level(){
            $this->db->select("*");
            $this->db->from("sy_level");
            return $this->db->get()->result_array();
        }

        public function input_data($data_insert,$data_insert2){
            $this->db->insert('sy_user', $data_insert);
            $this->db->insert('sy_user_level', $data_insert2);
        }

        public function hapus_data($where, $whereid, $table1, $table2, $table3){
            $this->db->where($where);
            $this->db->delete($table1);
            $this->db->where('ID',$whereid);
            $this->db->delete($table3);
            $this->db->where($where);
            $this->db->delete($table2);
        }

        public function update_data($data_update,$whereupdate){
            $this->db->set('nama', $data_update['nama']);
            if($data_update['pass'] != 'd41d8cd98f00b204e9800998ecf8427e'){
                $this->db->set('pass', $data_update['pass']);
            }
            $this->db->where('user_id',$whereupdate);
            $this->db->update('sy_user');

            if($data_update['user_level'] != '---Silakan Pilih Level User---'){
                $this->db->set('user_level',$data_update['user_level']);
                $this->db->where('user_id',$whereupdate);
                $this->db->update('sy_user_level');
            }
            
        }

        public function kode(){
            $this->db->select('RIGHT(sy_user.user_id,8) as kode_user', FALSE);
            $this->db->order_by('kode_user','DESC');    
            $this->db->limit(1);    
            $query = $this->db->get('sy_user');  //cek dulu apakah ada sudah ada kode di tabel.    
            if($query->num_rows() <> 0){      
                 //cek kode jika telah tersedia    
                 $data = $query->row();      
                 $kode = intval($data->kode_user) + 1; 
            }
            else{      
                 $kode = 1;  //cek jika kode belum terdapat pada table
            }  
                $kodetampil = $kode;  
                return $kodetampil;  
           }

           public function no(){
            $this->db->select('sy_user_level.no as no_user', FALSE);
            $this->db->order_by('no_user','DESC');    
            $this->db->limit(1);    
            $query = $this->db->get('sy_user_level');  //cek dulu apakah ada sudah ada kode di tabel.    
            if($query->num_rows() <> 0){      
                 //cek kode jika telah tersedia    
                 $data = $query->row();      
                 $kode = intval($data->no_user) + 1; 
            }
            else{      
                 $kode = 1;  //cek jika kode belum terdapat pada table
            }  
                $kodetampil = $kode;  
                return $kodetampil;  
           }
           public function get_keyword($keyword){

            $this->db->select('sy_user.user_id, sy_user.nama, sy_level.nama_level');
            $this->db->join('sy_user_level', 'sy_user.user_id=sy_user_level.user_id');
            $this->db->join('sy_level', 'sy_user_level.user_level=sy_level.level');
            $this->db->like('sy_user.user_id',$keyword);
            $this->db->or_like('sy_user.nama',$keyword);
            $this->db->or_like('sy_level.nama_level',$keyword);
            return $this->db->get('sy_user')->result_array();
        
        }
        public function check_pass_user($passlama){
            $whereyeuh = $this->session->userdata('userid');

            $this->db->select('user_id');
            $this->db->from('sy_user');
            $this->db->where('pass',md5($passlama));
            $this->db->where('user_id',$whereyeuh);
            return $this->db->get()->result();
        }
        public function ganti_pass_user($passbaru,$where){

            $this->db->set('pass',md5($passbaru));
            $this->db->where('user_id',$where);
            $this->db->update('sy_user');
        }
    }


?>