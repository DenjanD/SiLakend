<?php

    class m_perbaikan extends CI_Model{

        public function get_perbaikan(){
            $this->db->select('tbperb.*, tbkend.nama_kendaraan');
            $this->db->join('tb_master_kendaraan as tbkend','tbperb.id_kendaraan=tbkend.id_kendaraan');
            $this->db->order_by('tgl_perbaikan');
            return $this->db->get('tb_perbaikan as tbperb')->result_array();
        }

        public function get_kendaraan(){
            $this->db->select('id_kendaraan,nama_kendaraan');
            $this->db->from('tb_master_kendaraan');
            $this->db->order_by('id_kendaraan');
            return $this->db->get()->result_array();
        }

        public function get_id_terakhir(){
            $this->db->select('id_perbaikan');
            $this->db->from('tb_perbaikan');
            $this->db->order_by('id_perbaikan','DESC');
            $this->db->limit('1');
            $hasil = $this->db->get();

            if($hasil->num_rows() <> 0){
                $data = $hasil->row();
                $id = intval($data->id_perbaikan)+1;
            }
            else{
                $id = 1;
            }
            $kode = str_pad($id, 8, "0", STR_PAD_LEFT);
            return $kode;
        }
        
        public function input_data($insert){
            $this->db->insert('tb_perbaikan',$insert);
        }

        public function cari_perbaikan($cari_keyword, $cari_kendaraan, $cari_perbaikan, $cari_tglawal, $cari_tglakhir){
            $this->db->select('tbperb.*, tbkend.nama_kendaraan');
            $this->db->from('tb_perbaikan as tbperb');
            $this->db->join('tb_master_kendaraan as tbkend','tbperb.id_kendaraan=tbkend.id_kendaraan');
            if($cari_tglawal AND $cari_tglakhir != ''){
                $this->db->where("tbperb.tgl_perbaikan BETWEEN '$cari_tglawal' AND '$cari_tglakhir'");
            }
            if($cari_tglawal != '' AND $cari_tglakhir == ''){
                $this->db->where("tbperb.tgl_perbaikan BETWEEN '$cari_tglawal' AND 'CURDATE()'");
            }
            $this->db->like('tbperb.id_kendaraan',$cari_kendaraan);
            $this->db->like('tbperb.jenis_perbaikan',$cari_perbaikan);
            $this->db->like('tbperb.nama_perbaikan',$cari_keyword);
            return $this->db->get()->result_array();
            
        }

        public function itung_cari_perbaikan($cari_keyword, $cari_kendaraan, $cari_perbaikan, $cari_tglawal, $cari_tglakhir){
            $this->db->select('tbperb.*, tbkend.nama_kendaraan');
            $this->db->from('tb_perbaikan as tbperb');
            $this->db->join('tb_master_kendaraan as tbkend','tbperb.id_kendaraan=tbkend.id_kendaraan');
            if($cari_tglawal AND $cari_tglakhir != ''){
                $this->db->where("tbperb.tgl_perbaikan BETWEEN '$cari_tglawal' AND '$cari_tglakhir'");
            }
            if($cari_tglawal != '' AND $cari_tglakhir == ''){
                $this->db->where("tbperb.tgl_perbaikan BETWEEN '$cari_tglawal' AND 'CURDATE()'");
            }
            $this->db->like('tbperb.id_kendaraan',$cari_kendaraan);
            $this->db->like('tbperb.jenis_perbaikan',$cari_perbaikan);
            $this->db->like('tbperb.nama_perbaikan',$cari_keyword);
            return $this->db->get()->num_rows();
            
        }
        public function hapusperbaikan($id){
            $this->db->where('id_perbaikan',$id);
            $this->db->delete('tb_perbaikan');
        }

        public function updateperbaikan($id_perb,$tgl_perb,$jenis_perb,$nama_perb,$jumlah_perb,$satuan_perb,$harga_perb){
            $this->db->set('tgl_perbaikan',$tgl_perb);
            $this->db->set('jenis_perbaikan',$jenis_perb);
            $this->db->set('nama_perbaikan',$nama_perb);
            $this->db->set('jumlah',$jumlah_perb);
            $this->db->set('satuan',$satuan_perb);
            $this->db->set('harga',$harga_perb);
            $this->db->set('total',$harga_perb*$jumlah_perb);
            $this->db->where('id_perbaikan',$id_perb);
            $this->db->update('tb_perbaikan');
        }
       
    }


?>