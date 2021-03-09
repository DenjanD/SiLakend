<?php

    class m_laporan extends CI_Model{

        public function get_data(){
            $this->db->select('tborder.tgl_pinjam, tborder.dari, tborder.ke, tborder.alasan_pinjam, tbpegawai.NAMA AS nama_peminjam, tbsupir.NAMA AS nama_supir, tbmobil.nama_kendaraan, tbmobil.id_kendaraan');
            $this->db->from('sy_order_peminjaman AS tborder');
            $this->db->join('tb_master_pegawai AS tbpegawai', 'tborder.id_pegawai=tbpegawai.ID');
            $this->db->join('tb_master_pengemudi AS tbsupir', 'tborder.supir=tbsupir.ID');
            $this->db->join('tb_master_kendaraan AS tbmobil', 'tborder.kendaraan=tbmobil.id_kendaraan');
            $this->db->where("tbpegawai.NAMA = 'aha'");
            return $this->db->get()->result_array();
        }
    
        //----------------------------------------Query Report Data------------------------------------------------

        //Statistik Supir Teraktif  
        public function stats_pengemudi($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pengemudi AS tbsupir", "tborder.supir=tbsupir.ID","right");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            //Temporary Perubahan
            $this->db->where("tborder.status='Selesai'");
            $this->db->group_by("tbsupir.ID");
            return $this->db->get()->result_array();
        }

        public function label_pengemudi($tglawal,$tglakhir){
            $this->db->select("tbsupir.NAMA AS namasupir");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pengemudi AS tbsupir", "tborder.supir=tbsupir.ID","right");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            //Temporary Perubahan
            $this->db->where("tborder.status='Selesai'");
            $this->db->group_by("tbsupir.ID");
            return $this->db->get()->result_array();
        }

        // \Statistik Supir Teraktif

        //Statistik Kendaraan Terbanyak 
        public function stats_kendaraan($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join('tb_master_kendaraan AS tbmobil', 'tborder.kendaraan=tbmobil.id_kendaraan','right');
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            //Temporary Perubahan
            $this->db->where("tborder.status='Selesai'");  
            $this->db->group_by("tbmobil.id_kendaraan");
            return $this->db->get()->result_array();
        }

        public function label_kendaraan($tglawal,$tglakhir){
            $this->db->select("tbmobil.id_kendaraan AS idkend,tbmobil.nama_kendaraan AS kend");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join('tb_master_kendaraan AS tbmobil', 'tborder.kendaraan=tbmobil.id_kendaraan','right');
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            //Temporary Perubahan
            $this->db->where("tborder.status='Selesai'");
            $this->db->group_by("tbmobil.id_kendaraan");
            return $this->db->get()->result_array();
        }

        // \Statistik Kendaraan Terbanyak

        //Statistik Km Kendaraan Terbanyak 
        public function stats_kmkendaraan($tglawal,$tglakhir){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'"); 
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("kendaraan");
            return $this->db->get()->result_array();
        }

        public function label_kmkendaraan($tglawal,$tglakhir){
            $this->db->select("tborder.kendaraan AS idkend, tbkend.nama_kendaraan AS namakend");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_kendaraan AS tbkend","tbkend.id_kendaraan=tborder.kendaraan");
            $this->db->where("tborder.tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("tborder.kendaraan");
            return $this->db->get()->result_array();
        }

        // \Statistik Km Kendaraan Terbanyak

        //Statistik Km Supir Terbanyak 
        public function stats_kmsupir($tglawal,$tglakhir){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'"); 
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("supir");
            return $this->db->get()->result_array();
        }

        public function label_kmsupir($tglawal,$tglakhir){
            $this->db->select("tbpeng.NAMA AS namasupir");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pengemudi AS tbpeng","tbpeng.ID=tborder.supir");
            $this->db->where("tborder.tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("tborder.supir");
            return $this->db->get()->result_array();
        }

        // \Statistik Km Supir Terbanyak

        //Statistik Unit Kerja 
        public function stats_unitkerja1($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Adm. Akademik & Kemahasiswaan'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja2($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Adum./Sub. Bag. Sumber Daya/Kesekretariatan/Kerumahtanggaan'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja3($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Adum./Sub. Bag. Umum'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja4($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Keuangan'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja5($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Cleaner'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja6($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Houseman'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja7($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Manufaktur'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja8($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Otomasi Manufaktur dan Mekatronika'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja9($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Pengecoran Logam'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja10($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Perancangan Manufaktur'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja11($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Koperasi Pegawai POLMAN'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja12($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Manajemen'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja13($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Pensiun & Mantan'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja14($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL AE'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja15($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL DE'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja16($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL FE'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja17($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL ME'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja18($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='SATPAM'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja19($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Unit Pelayanan Masyarakat (UPM)'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja20($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Unit Penelitian, Pengembangan dan Pemberdayaan Masyarakat (UP3M)'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja21($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Unit Sosiomanufaktur'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja22($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='UPT. Logistik'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja23($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='UPT. P3'");
            return $this->db->get()->result_array();
        }
        
        public function stats_unitkerjalast($tglawal,$tglakhir){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='UPT. Puskomedia'");
            return $this->db->get()->result_array();
        }

        

        // \Statistik Unit Kerja

        //Statistik Alasan Pinjam
        public function stats_alasanpinjam1($tglawal,$tglakhir){
            $this->db->select("COUNT(id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("status = 'Selesai'");
            $this->db->where("alasan_pinjam = 'Dinas Dalam Kota'");
            return $this->db->get()->result_array();
        }
        public function stats_alasanpinjam2($tglawal,$tglakhir){
            $this->db->select("COUNT(id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("status = 'Selesai'");
            $this->db->where("alasan_pinjam = 'Dinas Luar Kota'");
            return $this->db->get()->result_array();
        }
        public function stats_alasanpinjam3($tglawal,$tglakhir){
            $this->db->select("COUNT(id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman");
            $this->db->where("tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("status = 'Selesai'");
            $this->db->where("alasan_pinjam = 'Pribadi'");
            return $this->db->get()->result_array();
        }
        // \Statistik Alasan Pinjam

        //Statistik Order Perbulan
        public function mobil_bulan1(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=1 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan2(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=2 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan3(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=3 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan4(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=4 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan5(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=5 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan6(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=6 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan7(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=7 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan8(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=8 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan9(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=9 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan10(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=10 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan11(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=11 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        public function mobil_bulan12(){
            $this->db->select("COUNT(id_peminjaman) AS banyakord");
            $this->db->from("sy_order_peminjaman as tborder");
            $this->db->where("MONTH(tgl_pinjam)=12 AND YEAR(tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status = 'Selesai'");
            return $this->db->get()->result_array();
        }
        // \Statistik Order Perbulan
        //----------------------------------------/Query Report Data------------------------------------------------

        public function get_curr_tgl(){
            $this->db->select("DATE_SUB(CURDATE(),INTERVAL 7 DAY) AS seminggu_lalu, CURDATE() AS sekarang");
            return $this->db->get()->result_array();
        }

        public function get_data_mobil(){
            $this->db->select('id_kendaraan,nama_kendaraan');
            $this->db->from('tb_master_kendaraan');
            return $this->db->get()->result_array();
        }

        public function get_data_pengemudi(){
            $this->db->select('ID,NAMA');
            $this->db->from('tb_master_pengemudi');
            return $this->db->get()->result_array();
        }
        
        public function get_laporan($tglawal,$tglakhir,$kendaraan,$pengemudi,$alasan){

            $this->db->select('DATE_FORMAT(tborder.tgl_pinjam, "%d %M %Y") AS tgl_pinjam, tborder.dari, tborder.ke, tborder.alasan_pinjam, tbpegawai.NAMA AS nama_peminjam, tbsupir.NAMA AS nama_supir, tbmobil.nama_kendaraan, tbmobil.id_kendaraan');
            $this->db->from('sy_order_peminjaman AS tborder');
            $this->db->join('tb_master_pegawai AS tbpegawai', 'tborder.id_pegawai=tbpegawai.ID');
            $this->db->join('tb_master_pengemudi AS tbsupir', 'tborder.supir=tbsupir.ID');
            $this->db->join('tb_master_kendaraan AS tbmobil', 'tborder.kendaraan=tbmobil.id_kendaraan');
            $this->db->where("tborder.tgl_pinjam BETWEEN '$tglawal' AND '$tglakhir'");
            $this->db->where("tborder.status = 'Selesai'");
            $this->db->like('tbmobil.id_kendaraan',$kendaraan);
            $this->db->like('tbsupir.ID',$pengemudi);
            $this->db->like('tborder.alasan_pinjam',$alasan);
            $this->db->order_by('tborder.tgl_pinjam');
            return $this->db->get()->result_array();
        
        }
       
    }


?>