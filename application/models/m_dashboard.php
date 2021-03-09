<?php

    class m_dashboard extends CI_Model{

        public function get_data(){
            $this->db->select('tbpeg.NAMA, DATE_FORMAT(tborder.tgl_pinjam, "%d %M %Y") AS tgl_pinjam, tbkend.nama_kendaraan, tbkend.id_kendaraan, tborder.dari, tborder.ke, tbpem.NAMA AS supir');
            $this->db->from('sy_order_peminjaman AS tborder');
            $this->db->join('tb_master_pegawai AS tbpeg', 'tborder.id_pegawai=tbpeg.ID');
            $this->db->join('tb_master_kendaraan AS tbkend', 'tborder.kendaraan=tbkend.id_kendaraan');
            $this->db->join('tb_master_pengemudi AS tbpem', 'tborder.supir=tbpem.ID');
            $this->db->where('tgl_pinjam BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 6 DAY)');
            $this->db->where("tborder.status = 'Diterima'");
            return $this->db->get()->result_array();
        }
        public function get_data2(){
            $this->db->select('id_kendaraan, nama_kendaraan');
            $this->db->from('tb_master_kendaraan');
            $this->db->where("status = 'Tersedia'");
            return $this->db->get()->result_array();
        }
        public function get_data3(){
            $this->db->select('NAMA');
            $this->db->from('tb_master_pengemudi');
            $this->db->where("status = 'Tidak Bertugas'");
            return $this->db->get()->result_array();
        }
        // \Statistik Kendaraan Terbanyak

        //Statistik Km Kendaraan Terbanyak 
        public function stats_kmkendaraan(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->where("YEAR(tgl_pinjam)=YEAR(CURDATE())"); 
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("kendaraan");
            return $this->db->get()->result_array();
        }

        public function label_kmkendaraan(){
            $this->db->select("tborder.kendaraan AS idkend, tbkend.nama_kendaraan AS namakend");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_kendaraan AS tbkend","tbkend.id_kendaraan=tborder.kendaraan");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("tborder.kendaraan");
            return $this->db->get()->result_array();
        }
        public function stats_kmkendaraan2(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlkm");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->where("YEAR(tgl_pinjam)=YEAR(CURDATE())"); 
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("kendaraan");
            return $this->db->get()->result_array();
        }

        public function label_kmkendaraan2(){
            $this->db->select("tborder.kendaraan AS idkend, tbkend.nama_kendaraan AS namakend");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_kendaraan AS tbkend","tbkend.id_kendaraan=tborder.kendaraan");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("tborder.kendaraan");
            return $this->db->get()->result_array();
        }
        public function stats_supir(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlkm");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())"); 
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("supir");
            return $this->db->get()->result_array();
        }

        public function label_supir(){
            $this->db->select("tbpeng.NAMA AS namasupir");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pengemudi AS tbpeng","tbpeng.ID=tborder.supir");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("tborder.supir");
            return $this->db->get()->result_array();
        }
        public function stats_supir2(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())"); 
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("supir");
            return $this->db->get()->result_array();
        }

        public function label_supir2(){
            $this->db->select("tbpeng.NAMA AS namasupir");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pengemudi AS tbpeng","tbpeng.ID=tborder.supir");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("tborder.supir");
            return $this->db->get()->result_array();
        }
        /*
        public function stats_unit1(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tbpeg.ID=tborder.id_pegawai");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("MONTH(tborder.tgl_pinjam)=MONTH(CURDATE())"); 
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("tbunit.NAMA_UNIT");
            return $this->db->get()->result_array();
        }

        public function stats_unit2(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tbpeg.ID=tborder.id_pegawai");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("MONTH(tborder.tgl_pinjam)=MONTH(CURDATE())"); 
            $this->db->where("tborder.km_masuk IS NOT NULL"); 
            $this->db->group_by("tbunit.NAMA_UNIT");
            return $this->db->get()->result_array();
        }
        */
        //Statistik Order Unit Kerja 
        public function stats_unitkerja1(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Adm. Akademik & Kemahasiswaan'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja2(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Adum./Sub. Bag. Sumber Daya/Kesekretariatan/Kerumahtanggaan'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja3(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Adum./Sub. Bag. Umum'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja4(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Keuangan'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja5(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Cleaner'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja6(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Houseman'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja7(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Manufaktur'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja8(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Otomasi Manufaktur dan Mekatronika'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja9(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Pengecoran Logam'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja10(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Perancangan Manufaktur'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja11(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Koperasi Pegawai POLMAN'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja12(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Manajemen'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja13(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Pensiun & Mantan'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja14(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL AE'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja15(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL DE'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja16(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL FE'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja17(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL ME'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja18(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='SATPAM'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja19(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Unit Pelayanan Masyarakat (UPM)'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja20(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Unit Penelitian, Pengembangan dan Pemberdayaan Masyarakat (UP3M)'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja21(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Unit Sosiomanufaktur'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja22(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='UPT. Logistik'");
            return $this->db->get()->result_array();
        }

        public function stats_unitkerja23(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='UPT. P3'");
            return $this->db->get()->result_array();
        }
        
        public function stats_unitkerjalast(){
            $this->db->select("COUNT(tborder.id_peminjaman) AS jmlord");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='UPT. Puskomedia'");
            return $this->db->get()->result_array();
        }

        

        // \Statistik Order Unit Kerja

        //Statistik Km Unit Kerja 
        public function stats_kmunitkerja1(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Adm. Akademik & Kemahasiswaan'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja2(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Adum./Sub. Bag. Sumber Daya/Kesekretariatan/Kerumahtanggaan'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja3(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Adum./Sub. Bag. Umum'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja4(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Bagian Keuangan'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja5(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Cleaner'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja6(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Houseman'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja7(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Manufaktur'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja8(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Otomasi Manufaktur dan Mekatronika'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja9(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Pengecoran Logam'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja10(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Jurusan Teknik Perancangan Manufaktur'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja11(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Koperasi Pegawai POLMAN'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja12(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Manajemen'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja13(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Pensiun & Mantan'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja14(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL AE'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja15(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL DE'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja16(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL FE'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja17(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='PPL ME'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja18(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='SATPAM'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja19(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Unit Pelayanan Masyarakat (UPM)'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja20(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Unit Penelitian, Pengembangan dan Pemberdayaan Masyarakat (UP3M)'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja21(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='Unit Sosiomanufaktur'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja22(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='UPT. Logistik'");
            return $this->db->get()->result_array();
        }

        public function stats_kmunitkerja23(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='UPT. P3'");
            return $this->db->get()->result_array();
        }
        
        public function stats_kmunitkerjalast(){
            $this->db->select("SUM(km_masuk)-SUM(km_keluar) AS jmlkm, tbunit.NAMA_UNIT");
            $this->db->from("sy_order_peminjaman AS tborder");
            $this->db->join("tb_master_pegawai AS tbpeg","tborder.id_pegawai=tbpeg.ID");
            $this->db->join("tb_master_unit AS tbunit","tbpeg.ASALUNIT=tbunit.ID");
            $this->db->where("YEAR(tborder.tgl_pinjam)=YEAR(CURDATE())");
            $this->db->where("tborder.status='Selesai'");
            $this->db->where("tbunit.NAMA_UNIT='UPT. Puskomedia'");
            return $this->db->get()->result_array();
        }

        

        // \Statistik Km Unit Kerja

        // \Statistik Km Kendaraan Terbanyak
        /*
        public function get_keyword($keyword){

            $this->db->select('tborder.tgl_pinjam,tbpegawai.NAMA,tborder.alasan_pinjam,tborder.dari,tborder.ke,tborder.status');
            $this->db->from('sy_order_peminjaman AS tborder');
            $this->db->join('tb_master_pegawai AS tbpegawai', 'tborder.id_pegawai=tbpegawai.ID');
            $this->db->join('tb_master_unit AS tbunit', 'tbpegawai.ASALUNIT=tbunit.ID');
            $this->db->join('tb_master_pengemudi AS tbsupir', 'tborder.supir=tbsupir.ID');
            $this->db->join('tb_master_kendaraan AS tbmobil', 'tborder.kendaraan=tbmobil.id_kendaraan');
            $this->db->like('tborder.alasan_pinjam',$keyword);
            $this->db->or_like('tborder.dari',$keyword);
            $this->db->or_like('tborder.ke',$keyword);
            $this->db->or_like('tborder.status',$keyword);
            $this->db->or_like('tborder.tgl_pinjam',$keyword);
            $this->db->or_like('tbpegawai.NAMA',$keyword);
            return $this->db->get()->result_array();
        
        }
       */
    }


?>