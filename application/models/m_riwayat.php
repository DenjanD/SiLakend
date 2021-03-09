<?php

    class m_riwayat extends CI_Model{

        public function get_data($keyword,$limit,$start){
            $this->db->select('DATE_FORMAT(tbord.tgl_pinjam, "%d %M %Y") as tgl_pinjam, DATE_FORMAT(tbord.tgl_kembali, "%d %M %Y") as tgl_kembali, tbpeg.NAMA AS Nama_Peminjam, tbord.alasan_pinjam, tbord.dari, tbord.ke, tbord.status, tbord.waktu_kembali, tbord.keterangan, tbpeng.NAMA AS Supir, tbkend.nama_kendaraan AS Kendaraan, tbkend.id_kendaraan');
            $this->db->join('tb_master_pegawai AS tbpeg', 'tbord.id_pegawai=tbpeg.ID');
            $this->db->join('tb_master_pengemudi AS tbpeng', 'tbord.supir=tbpeng.ID');
            $this->db->join('tb_master_kendaraan AS tbkend', 'tbord.kendaraan=tbkend.id_kendaraan');
            $this->db->like('tbord.alasan_pinjam',$keyword);
            $this->db->or_like('tbord.dari',$keyword);
            $this->db->or_like('tbord.ke',$keyword);
            $this->db->or_like('tbord.status',$keyword);
            $this->db->or_like('tbpeg.NAMA',$keyword);
            $this->db->or_like('tbord.keterangan',$keyword);
            $this->db->or_like('tbpeng.NAMA',$keyword);
            $this->db->or_like('tbkend.nama_kendaraan',$keyword);
            $this->db->order_by("tbord.tgl_pinjam");
            return $this->db->get('sy_order_peminjaman AS tbord',$limit,$start)->result_array();
        }
        public function get_keyword($keyword){

            /*$this->db->select('tborder.tgl_pinjam,tbpegawai.NAMA,tborder.alasan_pinjam,tborder.dari,tborder.ke,tborder.status');
            $this->db->from('sy_order_peminjaman AS tborder');
            $this->db->join('tb_master_pegawai AS tbpegawai', 'tborder.id_pegawai=tbpegawai.ID');
            $this->db->join('tb_master_unit AS tbunit', 'tbpegawai.ASALUNIT=tbunit.ID');
            $this->db->join('tb_master_pengemudi AS tbsupir', 'tborder.supir=tbsupir.ID');
            $this->db->join('tb_master_kendaraan AS tbmobil', 'tborder.kendaraan=tbmobil.id_kendaraan');
            */
            $this->db->select('DATE_FORMAT(tbord.tgl_pinjam, "%d %M %Y") as tgl_pinjam, DATE_FORMAT(tbord.tgl_kembali, "%d %M %Y") as tgl_kembali, tbpeg.NAMA AS Nama_Peminjam, tbord.alasan_pinjam, tbord.dari, tbord.ke, tbord.status, tbord.waktu_kembali, tbord.keterangan, tbpeng.NAMA AS Supir, tbkend.nama_kendaraan AS Kendaraan, tbkend.id_kendaraan');
            $this->db->from('sy_order_peminjaman AS tbord');
            $this->db->join('tb_master_pegawai AS tbpeg', 'tbord.id_pegawai=tbpeg.ID');
            $this->db->join('tb_master_pengemudi AS tbpeng', 'tbord.supir=tbpeng.ID');
            $this->db->join('tb_master_kendaraan AS tbkend', 'tbord.kendaraan=tbkend.id_kendaraan');
            $this->db->like('tbord.alasan_pinjam',$keyword);
            $this->db->or_like('tbord.dari',$keyword);
            $this->db->or_like('tbord.ke',$keyword);
            $this->db->or_like('tbord.status',$keyword);
            $this->db->or_like('tbpeg.NAMA',$keyword);
            $this->db->or_like('tbord.keterangan',$keyword);
            $this->db->or_like('tbpeng.NAMA',$keyword);
            $this->db->or_like('tbkend.nama_kendaraan',$keyword);
            return $this->db->get()->result_array();
        
        }
       
    }


?>