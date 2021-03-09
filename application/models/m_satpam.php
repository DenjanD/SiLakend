<?php 

    class m_satpam extends CI_Model{

        function get_data(){
            $statustugas = 'Berangkat';

            $this->db->select('tbord.id_peminjaman, tbpeg.NAMA, tbord.dari, tbord.ke, DATE_FORMAT(tbord.tgl_pinjam, "%d %M %Y") as tgl_pinjam, tbord.waktu_berangkat, tbord.lama_pinjam, tbord.keterangan, tbkend.nama_kendaraan, tbord.kendaraan, tbord.supir');
            $this->db->from('sy_order_peminjaman AS tbord');
            $this->db->join('tb_master_pegawai AS tbpeg','tbord.id_pegawai=tbpeg.ID');
            $this->db->join('tb_master_kendaraan AS tbkend','tbord.kendaraan=tbkend.id_kendaraan');
            $this->db->where('tbord.status =', $statustugas);
            return $this->db->get()->result_array();
        }
        function inputkmpulang($kmnya,$id_kendaraan,$id_order,$id_supir){
            $statusakhir = "Selesai";
            $statuspengemudiakhir = "Tidak Bertugas";
            $statuskendakhir = "Tersedia";

            //query cek km keluar
            $this->db->select('km_keluar');
            $this->db->from('sy_order_peminjaman');
            $this->db->where('kendaraan',$id_kendaraan);
            $this->db->where('id_peminjaman',$id_order);
            $km_keluarnya = $this->db->get()->result_array();
            foreach($km_keluarnya as $kmk) :
                $km_keluarini = $kmk['km_keluar'];
            endforeach;
            //periksa km_keluar > km_masuk ? 
            if($kmnya < $km_keluarini){
                $peringatan = "1";
                return $peringatan;
            }

            //query date & time pulang kend
            $this->db->select('CURDATE() AS tgl_pulang, CURTIME() AS jam_pulang');
            $row = $this->db->get()->result_array();
                foreach ($row as $dnt) :
                    $tgl_pulang = $dnt['tgl_pulang'];
                    $jam_pulang = $dnt['jam_pulang'];
                endforeach;

            //Input/Update sy_order_peminjaman 
            $this->db->set('tgl_kembali',$tgl_pulang);
            $this->db->set('waktu_kembali',$jam_pulang);
            $this->db->set('km_masuk',$kmnya);
            $this->db->set('status',$statusakhir);
            $this->db->where('id_peminjaman =',$id_order);
            $this->db->update('sy_order_peminjaman');

            //Update Tabel Pengemudi
            $this->db->set('STATUS',$statuspengemudiakhir);
            $this->db->where('ID =',$id_supir);
            $this->db->update('tb_master_pengemudi');

            //Update Tabel Kendaraan
            $this->db->set('status', $statuskendakhir);
            $this->db->set('jumlah_km',$kmnya);
            $this->db->where('id_kendaraan =',$id_kendaraan);
            $this->db->update('tb_master_kendaraan');


        }
        public function get_keyword($keyword){
            $statustugas = 'Berangkat';

            $this->db->select('tbord.id_peminjaman, tbpeg.NAMA, tbord.dari, tbord.ke, tbord.tgl_pinjam, tbord.waktu_berangkat, tbord.lama_pinjam, tbord.keterangan, tbkend.nama_kendaraan, tbord.kendaraan, tbord.supir, tbord.status');
            $this->db->from('sy_order_peminjaman AS tbord');
            $this->db->join('tb_master_pegawai AS tbpeg','tbord.id_pegawai=tbpeg.ID');
            $this->db->join('tb_master_kendaraan AS tbkend','tbord.kendaraan=tbkend.id_kendaraan');
            $this->db->like('tbpeg.NAMA',$keyword);
            $this->db->or_like('tbord.dari',$keyword);
            $this->db->or_like('tbord.ke',$keyword);
            $this->db->or_like('tbord.waktu_berangkat',$keyword);
            $this->db->or_like('tbkend.nama_kendaraan',$keyword);
            $this->db->or_like('tbkend.id_kendaraan',$keyword);
            $this->db->having('tbord.status =', $statustugas);
            return $this->db->get()->result_array();
        
        }

    }



?>