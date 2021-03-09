<?php

    class m_order extends CI_Model{

        public function get_data($keyword,$limit,$start){

            $this->db->select('DATE_FORMAT(tborder.tgl_pinjam, "%d %M %Y") AS tgl_pinjam, tborder.alasan_pinjam, tborder.keterangan, tborder.status, tborder.alasan_tolak, tbpeng.NAMA, tbkend.nama_kendaraan, tbkend.id_kendaraan, tborder.supir, tborder.id_peminjaman,tborder.id_pegawai');
            $this->db->join('tb_master_pegawai AS tbpegawai', 'tborder.id_pegawai=tbpegawai.ID','left');
            $this->db->join('tb_master_unit AS tbunit', 'tbpegawai.ASALUNIT=tbunit.ID','left');
            $this->db->join('tb_master_pengemudi AS tbpeng', 'tborder.supir=tbpeng.ID','left');
            $this->db->join('tb_master_kendaraan AS tbkend', 'tborder.kendaraan=tbkend.id_kendaraan','left');
            $this->db->like('tborder.alasan_pinjam',$keyword);
            $this->db->or_like('tborder.keterangan',$keyword);
            $this->db->or_like('tborder.status',$keyword);
            $this->db->or_like('tborder.tgl_pinjam',$keyword);
            $this->db->or_like('tbpeng.NAMA',$keyword);
            $this->db->or_like('tbkend.nama_kendaraan',$keyword);
            $this->db->having('tborder.id_pegawai =', $this->session->userdata('userid'));
            return $this->db->get('sy_order_peminjaman AS tborder',$limit,$start)->result_array();
        }
        public function kode(){
            $this->db->select('RIGHT(sy_order_peminjaman.id_peminjaman,3) as id_pinjam', FALSE);
            $this->db->order_by('id_pinjam','DESC');    
            $this->db->limit(1);    
            $query = $this->db->get('sy_order_peminjaman');  //cek dulu apakah ada sudah ada kode di tabel.    
            if($query->num_rows() <> 0){      
                 //cek kode jika telah tersedia    
                 $data = $query->row();      
                 $kode = intval($data->id_pinjam) + 1; 
            }
            else{      
                 $kode = 1;  //cek jika kode belum terdapat pada table
            }  
                $kode = str_pad($kode, 3, "0", STR_PAD_LEFT);
                $this->db->select('MONTH(CURDATE()), YEAR(CURDATE());');
                $tglin = $this->db->get()->result_array();
                foreach ($tglin as $tgl) :
                    $bulan = $tgl['MONTH(CURDATE())'];
                    $tahun = $tgl['YEAR(CURDATE())'];
                endforeach;
                $bulan = str_pad($bulan, 2, "0", STR_PAD_LEFT);
                $kodetampil = $tahun.$bulan.$kode;  
                return $kodetampil;  
           }

        public function set_no_acc(){

            //Mengambil kode ASALUNIT based on id login dari tb_master_pegawai
            $this->db->select("ASALUNIT");
            $this->db->from("tb_master_pegawai");
            $this->db->where("ID =",$this->session->userdata("userid"));
            $row = $this->db->get()->result_array();
            foreach ($row as $hsl) :
                $kodeasal = $hsl['ASALUNIT'];
            endforeach;

            //Mengambil No Acc based on kode ASALUNIT
            $this->db->select("NO_ACC");
            $this->db->from("tb_master_unit");
            $this->db->where("ID =",$kodeasal);
            $row2 = $this->db->get()->result_array();
            foreach ($row2 as $hsl2) :
                $noacc = $hsl2['NO_ACC'];
            endforeach;
            return $noacc;
        }

        public function input_order($insert){
            $this->db->insert('sy_order_peminjaman',$insert);
        }
        
        public function hapus_data($where, $table){

            $statusbatalkend = "Tersedia";
            $statusbatalsupir = "Tidak Bertugas";
            
            //query ambil id kend dan id supir berdasarkan id peminjaman
            $this->db->select("kendaraan,supir");
            $this->db->from("sy_order_peminjaman");
            $this->db->where($where);
            $ids = $this->db->get()->result_array();
            foreach ($ids as $idss) :
                $id_mobil = $idss['kendaraan'];
                $id_supir = $idss['supir'];
            endforeach;

            //query hapus data sy_order_peminjaman
            $this->db->where($where);
            $this->db->delete($table);

            //query ubah status supir
            $this->db->set("STATUS", $statusbatalsupir);
            $this->db->where("ID =",$id_supir);
            $this->db->update("tb_master_pengemudi");
        
            //query ubah status kendaraan
            $this->db->set("status", $statusbatalkend);
            $this->db->where("id_kendaraan =",$id_mobil);
            $this->db->update("tb_master_kendaraan");
        
        }

        public function batal_order($where,$table){
            $kendbatal = null;
            $sprbatal = null;
            $statusbatalkend = "Tersedia";
            $statusbatalsupir = "Tidak Bertugas";
            $statusorderbatal = "Dibatalkan";
             //query ambil id kend dan id supir berdasarkan id peminjaman
             $this->db->select("kendaraan,supir");
             $this->db->from("sy_order_peminjaman");
             $this->db->where($where);
             $ids = $this->db->get()->result_array();
             foreach ($ids as $idss) :
                 $id_mobil = $idss['kendaraan'];
                 $id_supir = $idss['supir'];
             endforeach;
 
             //query update status data batal sy_order_peminjaman
             $this->db->set('status', $statusorderbatal);
             $this->db->set('kendaraan',$kendbatal);
             $this->db->set('supir',$sprbatal);
             $this->db->where($where);
             $this->db->update($table);
 
             //query ubah status supir
             $this->db->set("STATUS", $statusbatalsupir);
             $this->db->where("ID =",$id_supir);
             $this->db->update("tb_master_pengemudi");
         
             //query ubah status kendaraan
             $this->db->set("status", $statusbatalkend);
             $this->db->where("id_kendaraan =",$id_mobil);
             $this->db->update("tb_master_kendaraan");

        }

        public function cektglcurr($tglin){
            $this->db->select('tbord.tgl_pinjam,tbord.dari,tbord.ke,tbord.jumlah_personil,tbpeg.NAMA,tbord.waktu_berangkat,tbkend.nama_kendaraan');
            $this->db->from('sy_order_peminjaman AS tbord');
            $this->db->join('tb_master_pegawai AS tbpeg',"tbpeg.ID=tbord.id_pegawai");
            $this->db->join('tb_master_kendaraan AS tbkend',"tbkend.id_kendaraan=tbord.kendaraan");
            $this->db->where('tbord.tgl_pinjam', $tglin);
            return $this->db->get()->result_array();
        }
        public function get_keyword($keyword){

            $this->db->select('DATE_FORMAT(tborder.tgl_pinjam, "%d %M %Y") AS tgl_pinjam, tborder.alasan_pinjam, tborder.keterangan, tborder.status, tborder.alasan_tolak, tbpeng.NAMA, tbkend.nama_kendaraan, tbkend.id_kendaraan, tborder.supir, tborder.id_peminjaman,tborder.id_pegawai');
            $this->db->from('sy_order_peminjaman AS tborder');
            $this->db->join('tb_master_pegawai AS tbpegawai', 'tborder.id_pegawai=tbpegawai.ID','left');
            $this->db->join('tb_master_unit AS tbunit', 'tbpegawai.ASALUNIT=tbunit.ID','left');
            $this->db->join('tb_master_pengemudi AS tbpeng', 'tborder.supir=tbpeng.ID','left');
            $this->db->join('tb_master_kendaraan AS tbkend', 'tborder.kendaraan=tbkend.id_kendaraan','left');
            $this->db->like('tborder.alasan_pinjam',$keyword);
            $this->db->or_like('tborder.keterangan',$keyword);
            $this->db->or_like('tborder.status',$keyword);
            $this->db->or_like('tborder.tgl_pinjam',$keyword);
            $this->db->or_like('tbpeng.NAMA',$keyword);
            $this->db->or_like('tbkend.nama_kendaraan',$keyword);
            $this->db->having('tborder.id_pegawai =', $this->session->userdata('userid'));
            return $this->db->get()->result_array();
        
        }
    }


?>