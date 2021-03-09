<?php 

    class m_tugass extends CI_Model{

        function get_tugas(){
            $idsupirlog = $this->session->userdata('userid');
            $statustugas = 'Diterima';

            if($this->session->userdata('namalevel') == 'Administrator'){
            $this->db->select('tbord.id_peminjaman, tbpeg.NAMA, tbord.dari, tbord.ke, tbord.tgl_pinjam, tbord.waktu_berangkat, tbord.lama_pinjam, tbord.keterangan, tbkend.nama_kendaraan, tbord.kendaraan');
            $this->db->from('sy_order_peminjaman AS tbord');
            $this->db->join('tb_master_pegawai AS tbpeg','tbord.id_pegawai=tbpeg.ID');
            $this->db->join('tb_master_kendaraan AS tbkend','tbord.kendaraan=tbkend.id_kendaraan');
            $this->db->where('tbord.status =', $statustugas);
            return $this->db->get()->result_array();
            }
            else{
            $this->db->select('tbord.id_peminjaman, tbpeg.NAMA, tbord.dari, tbord.ke, tbord.tgl_pinjam, tbord.waktu_berangkat, tbord.lama_pinjam, tbord.keterangan, tbkend.nama_kendaraan, tbord.kendaraan');
            $this->db->from('sy_order_peminjaman AS tbord');
            $this->db->join('tb_master_pegawai AS tbpeg','tbord.id_pegawai=tbpeg.ID');
            $this->db->join('tb_master_kendaraan AS tbkend','tbord.kendaraan=tbkend.id_kendaraan');
            $this->db->where('tbord.supir =' ,$idsupirlog);
            $this->db->where('tbord.status =', $statustugas);
            return $this->db->get()->result_array();
            }
        }
        function order_berangkat($statusberangkat,$idorderberangkat,$idkendpergi){
    
            //query ambil km keluar
            $this->db->select('jumlah_km');
            $this->db->from('tb_master_kendaraan');
            $this->db->where('id_kendaraan =',$idkendpergi);
            $kmkeluar = $this->db->get()->result_array();

            foreach ($kmkeluar as $kmnya) :
                $kminput = $kmnya['jumlah_km'];
            endforeach;

            //Masuk data berangkat
            $this->db->set('status', $statusberangkat);
            $this->db->set('km_keluar', $kminput);
            $this->db->where('id_peminjaman =',$idorderberangkat);
            $this->db->update('sy_order_peminjaman');

        }

    }



?>