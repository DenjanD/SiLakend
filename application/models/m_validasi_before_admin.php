<?php

    class m_validasi extends CI_Model{

        public function get_data(){
            $idlog = $this->session->userdata('userid');
            $status1 = "Diajukan";
            $status2 = "Diteruskan";
            $status3 = "Diterima";
            $level1 = "Kepala Bagian";
            $level2 = "Kepala Unit";
            $level3 = "Sub Bagian Umum";
            $level4 = "Staff";

            //Query Kepala Sub. Bag. Umum (Dody)
            if($this->session->userdata('namalevel') == 'Sub Bagian Umum' OR $this->session->userdata('namalevel') == 'Administrator'){   
                $this->db->select('tborder.*,DATE_FORMAT(tborder.tgl_pinjam, "%d %M %Y") as tgl_pin,DATE_FORMAT(tborder.tgl_pinjam,"%d %m %Y") as tgl_pinj, tbpegawai.NAMA');
                $this->db->from('sy_order_peminjaman AS tborder');
                $this->db->join('tb_master_pegawai AS tbpegawai', 'tborder.id_pegawai=tbpegawai.ID');
                $this->db->where('tborder.id_pegawai !=' ,$idlog);
                $this->db->where('status =',$status2);
                $this->db->or_where('status =',$status3);
                $this->db->order_by('tborder.tgl_pinjam');
            }

            //Query Sekdir
            if($this->session->userdata('namalevel') == 'Sekdir'){   
                $this->db->select('tborder.*,DATE_FORMAT(tborder.tgl_pinjam, "%d %M %Y") as tgl_pin,DATE_FORMAT(tborder.tgl_pinjam,"%d %m %Y") as tgl_pinj, tbpegawai.NAMA,tblevel.nama_level');
                $this->db->from('sy_order_peminjaman AS tborder');
                $this->db->join('tb_master_pegawai AS tbpegawai', 'tborder.id_pegawai=tbpegawai.ID');
                $this->db->join('sy_user AS tbuser', 'tbpegawai.ID=tbuser.user_id');
                $this->db->join('sy_user_level AS tbulevel', 'tbuser.user_id=tbulevel.user_id');
                $this->db->join('sy_level AS tblevel', 'tbulevel.user_level=tblevel.level');
                $this->db->where('tborder.id_pegawai !=' ,$idlog);
                $this->db->where('status =',$status1);
                $this->db->where("tblevel.nama_level IN ('Kepala Unit','Kepala Bagian Kepeg')");
                $this->db->order_by('tborder.tgl_pinjam');
            }

            //Query Khusus Kepala Bagian Kepegawaian/Umum
            if($this->session->userdata('namalevel') == 'Kepala Bagian Kepeg'){
                $asalun = $this->session->userdata('asalunit');
                $idlog = $this->session->userdata('userid');
                
                $this->db->select('tborder.*,DATE_FORMAT(tborder.tgl_pinjam, "%d %M %Y") as tgl_pin,DATE_FORMAT(tborder.tgl_pinjam,"%d %m %Y") as tgl_pinj, tbpegawai.NAMA,tblevel.nama_level');
                $this->db->from('sy_order_peminjaman AS tborder');
                $this->db->join('tb_master_pegawai AS tbpegawai', 'tborder.id_pegawai=tbpegawai.ID');
                $this->db->join('sy_user AS tbuser', 'tbpegawai.ID=tbuser.user_id');
                $this->db->join('sy_user_level AS tbulevel', 'tbuser.user_id=tbulevel.user_id');
                $this->db->join('sy_level AS tblevel', 'tbulevel.user_level=tblevel.level');
                $this->db->where("tbpegawai.ASALUNIT IN ('23','9')");
                $this->db->where('tbuser.user_id !=',$idlog);
                $this->db->where("tblevel.nama_level IN ('Sub Bagian Umum','Staff')");
                $this->db->where("tborder.status IN ('Diajukan','Diteruskan')");
                $this->db->order_by('tborder.tgl_pinjam');
                
            }

            //Query Kepala Bagian/Kepala Unit AKA Atasan Langsung
            if($this->session->userdata('namalevel') == 'Kepala Unit'){
                $asalun = array('tbpegawai.ASALUNIT' => $this->session->userdata('asalunit'));
                $idlog = $this->session->userdata('userid');
            
                $this->db->select('tborder.*,DATE_FORMAT(tborder.tgl_pinjam, "%d %M %Y") as tgl_pin,DATE_FORMAT(tborder.tgl_pinjam,"%d %m %Y") as tgl_pinj, tbpegawai.NAMA,tblevel.nama_level');
                $this->db->from('sy_order_peminjaman AS tborder');
                $this->db->join('tb_master_pegawai AS tbpegawai', 'tborder.id_pegawai=tbpegawai.ID');
                $this->db->join('sy_user AS tbuser', 'tbpegawai.ID=tbuser.user_id');
                $this->db->join('sy_user_level AS tbulevel', 'tbuser.user_id=tbulevel.user_id');
                $this->db->join('sy_level AS tblevel', 'tbulevel.user_level=tblevel.level');
                $this->db->where($asalun);
                $this->db->where('tborder.id_pegawai !=' ,$idlog);
                $this->db->where('tborder.status =' ,$status1);
                $this->db->where("tblevel.nama_level = 'Staff'");
                $this->db->order_by('tborder.tgl_pinjam');
            }   
            
                return $this->db->get()->result_array();
        }
        //Query Data Pengemudi dan Data Mobil yang tersedia
        public function get_kendaraan(){
            $statusmobil = "Tersedia";
            
            $this->db->select('id_kendaraan,nama_kendaraan');
            $this->db->from('tb_master_kendaraan');
            $this->db->where('status', $statusmobil);
        
            return  $this->db->get()->result_array();
        }

        public function get_supir(){
            $statussupir = "Tidak Bertugas";
            
            $this->db->select('ID,NAMA');
            $this->db->from('tb_master_pengemudi');
            $this->db->where('STATUS', $statussupir);
        
            return  $this->db->get()->result_array();

        }

        public function valid_data1($idvalidasi,$statusvalidasi,$statusord,$noaccorder){
            if($this->session->userdata('namalevel') == 'Sub Bagian Umum'){
                //mengambil data supir dan kendaraan sebelumnya
                $this->db->select("kendaraan,supir");
                $this->db->from("sy_order_peminjaman");
                $this->db->where("id_peminjaman =",$idvalidasi);
                $datasbm = $this->db->get()->result_array();
                
                //Memasukan data supir dan kendaraan lama ke variabel
                foreach ($datasbm as $sbm) :
                    $supirlama = $sbm['supir'];
                    $kendaraanlama = $sbm['kendaraan'];
                endforeach;

                //update status supir dan kendaraan lama yang dari bertugas menjadi tidak bertugas
                if($statusvalidasi['supir'] == NULL){
                    
                }
                else{                   
                    $this->db->set('STATUS','Tidak Bertugas');
                    $this->db->where('ID',$supirlama);
                    $this->db->update('tb_master_pengemudi');
                }
                if($statusvalidasi['kendaraan'] == NULL){

                }
                else{
                    $this->db->set('status','Tersedia');
                    $this->db->where('id_kendaraan',$kendaraanlama);
                    $this->db->update('tb_master_kendaraan');
                }

                //insert data supir dan kendaraan ke order
                $this->db->set('status',$statusvalidasi['status']);
                if($statusvalidasi['kendaraan'] == NULL){
                    
                }
                else{
                    $this->db->set('kendaraan',$statusvalidasi['kendaraan']);
                }              
                if($statusvalidasi['supir'] == NULL){

                }
                else{
                    $this->db->set('supir',$statusvalidasi['supir']);
                }
                
                $this->db->set('no_order',$noaccorder);
                $this->db->where('id_peminjaman',$idvalidasi);
                $this->db->update('sy_order_peminjaman');

                if($statusvalidasi['kendaraan'] == NULL){
                    
                }
                else{
                     //update status kendaraan baru
                    $this->db->set('status','Tidak Tersedia');
                    $this->db->where('id_kendaraan', $statusvalidasi['kendaraan']);
                    $this->db->update('tb_master_kendaraan');
                }  

                if($statusvalidasi['supir'] == NULL){
                    
                }
                else{
                 if($statusvalidasi['supir'] != 'Membawa-Sendiri'){
                        //update status pengemudi baru
                        $this->db->set('STATUS','Bertugas');
                        $this->db->where('ID', $statusvalidasi['supir']);
                        $this->db->update('tb_master_pengemudi');
                        }
                }              
                
            }
            else{
                if($this->session->userdata('namalevel') == 'Kepala Bagian Kepeg'){
                    //Khusus Order Sub Bagian Umum
                    if($statusord == 'Diteruskan'){
                        $statusvalidasi['status'] = "Diterima";
                        $this->db->set('kendaraan',$statusvalidasi['kendaraan']);
                        $this->db->set('supir',$statusvalidasi['supir']);
                        $this->db->set('no_order',$noaccorder);
                        $this->db->where('id_peminjaman',$idvalidasi);
                        $this->db->update('sy_order_peminjaman');
        
                        //update status kendaraan
                        $this->db->set('status','Tidak Tersedia');
                        $this->db->where('id_kendaraan', $statusvalidasi['kendaraan']);
                        $this->db->update('tb_master_kendaraan');
        
                        if($statusvalidasi['supir'] != 'Membawa-Sendiri'){
                        //update status pengemudi
                        $this->db->set('STATUS','Bertugas');
                        $this->db->where('ID', $statusvalidasi['supir']);
                        $this->db->update('tb_master_pengemudi');
                        }
                    }
                    
                }
                $this->db->set('status',$statusvalidasi['status']);
                $this->db->set('no_order',$noaccorder);
                $this->db->where('id_peminjaman',$idvalidasi);
                $this->db->update('sy_order_peminjaman');
            }
            

        }
        public function batal_valid($idwhere,$validakhir){
                $this->db->set($validakhir);
                $this->db->where('id_peminjaman',$idwhere);
                $this->db->update('sy_order_peminjaman');

        }
       
    }


?>