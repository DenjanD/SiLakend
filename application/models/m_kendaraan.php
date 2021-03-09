<?php

    class m_kendaraan extends CI_Model{

        public function get_data(){
            $this->db->select('*');
            $this->db->from('tb_master_kendaraan');
            return $this->db->get()->result_array();
         }
        
        public function kodekendaraan(){
            $this->db->select('RIGHT(id_kendaraan,2) as kode_kendaraan', FALSE);
            $this->db->order_by('kode_kendaraan','DESC');    
            $this->db->limit(1);    
            $query = $this->db->get('tb_master_kendaraan');  //cek dulu apakah ada sudah ada kode di tabel.    
            if($query->num_rows() <> 0){      
                 //cek kode jika telah tersedia    
                 $data = $query->row();      
                 $kodeawal = intval($data->kode_kendaraan) + 1;
                 $char = "P-";
                 $kode = $char . sprintf("%02s", $kodeawal);  
            }
            else{      
                $char = "P-";
                $kode = $char . sprintf("%02s", "1");  //cek jika kode belum terdapat pada table
            }  
                $kodetampil = $kode;  
                return $kodetampil;  
           }
        public function input_kendaraan($data_insert){
            $this->db->insert('tb_master_kendaraan', $data_insert);
        }
        public function update_kendaraan($data_update){
            $this->db->set('nama_kendaraan',$data_update['nama_kendaraan']);
            $this->db->set('jenis_kendaraan',$data_update['jenis_kendaraan']);
            $this->db->set('thn_keluaran',$data_update['thn_keluaran']);
            $this->db->set('tgl_pajak',$data_update['tgl_pajak']);
            $this->db->set('tgl_masaberlaku',$data_update['tgl_masaberlaku']);
            $this->db->set('no_polisi',$data_update['no_polisi']);
            $this->db->set('jumlah_km',$data_update['jumlah_km']);
            $this->db->where('id_kendaraan',$data_update['id_kendaraan']);
            $this->db->update('tb_master_kendaraan');
        }
        public function hapus_kendaraan($wherenya,$namatabel){
            $this->db->where($wherenya);
            $this->db->delete($namatabel);
        }
        public function get_keyword($keyword){

            $this->db->select('*');
            $this->db->from('tb_master_kendaraan');
            $this->db->like('id_kendaraan',$keyword);
            $this->db->or_like('nama_kendaraan',$keyword);
            $this->db->or_like('status',$keyword);
            $this->db->or_like('no_polisi',$keyword);
            $this->db->or_like('jumlah_km',$keyword);  
            return $this->db->get()->result_array();
        
        }


    }


?>