<?php
    class Kendaraan extends CI_Controller{
        public function __construct()
	{
        parent::__construct();
        $this->load->model('m_kendaraan');
	}

        public function index(){
            
            $data['kendaraan'] = $this->m_kendaraan->get_data();
            $data['kodekendaraan'] = $this->m_kendaraan->kodekendaraan();
            $this->load->view('admin/v_kendaraan', $data);
        }
        public function tambah_kendaraan(){
            $id_kend_baru = $this->input->post('inidkend');
            $nama_kend_baru = $this->input->post('innamakend');
            $jenis_kend_baru = $this->input->post('injeniskend');
            $thn_kend_baru = $this->input->post('inthnkend');
            $nopol_kend_baru = $this->input->post('innopolkend');
            $pajak_kend_baru = $this->input->post('intglpajak');
            $berlaku_kend_baru = $this->input->post('intglberlaku');
            $jumlah_km_kend = $this->input->post('inkmkend');
            
            $data_insert = array(
                'id_kendaraan' => $id_kend_baru,
                'nama_kendaraan' => $nama_kend_baru,
                'jenis_kendaraan' => $jenis_kend_baru,
                'thn_keluaran' => $thn_kend_baru,
                'tgl_pajak' => $pajak_kend_baru,
                'tgl_masaberlaku' => $berlaku_kend_baru,
                'no_polisi' => $nopol_kend_baru,
                'jumlah_km' => $jumlah_km_kend
            );
    
            $this->m_kendaraan->input_kendaraan($data_insert);
            redirect('admin/mobil');
        }
        public function edit_kendaraan(){
            $id_kend_up = $this->input->post('inidkend');
            $nama_kend_up = $this->input->post('innamakend');
            $jenis_kend_up = $this->input->post('injeniskend');
            $thn_kend_up = $this->input->post('inthnkend');
            $nopol_kend_up = $this->input->post('innopolkend');
            $pajak_kend_up = $this->input->post('intglpajak');
            $berlaku_kend_up = $this->input->post('intglberlaku');
            $jumlah_km_kend_up = $this->input->post('inkmkend');

            $data_up = array(
                'id_kendaraan' => $id_kend_up,
                'nama_kendaraan' => $nama_kend_up,
                'jenis_kendaraan' => $jenis_kend_up,
                'thn_keluaran' => $thn_kend_up,
                'tgl_pajak' => $pajak_kend_up,
                'tgl_masaberlaku' => $berlaku_kend_up,
                'no_polisi' => $nopol_kend_up,
                'jumlah_km' => $jumlah_km_kend_up
            );

            $this->m_kendaraan->update_kendaraan($data_up);
            redirect('admin/mobil');
        }
        public function hapus_kendaraan(){
            $idhapus = $this->uri->segment(3);
            $where = array('id_kendaraan' => $idhapus);
            $this->m_kendaraan->hapus_kendaraan($where,'tb_master_kendaraan');
            redirect('admin/mobil');
        }
        public function cari(){
            $keyword = $this->input->post('keyword');
            $data['kendaraan'] = $this->m_kendaraan->get_keyword($keyword);
            $data['kodekendaraan'] = $this->m_kendaraan->kodekendaraan();
            $this->load->view('admin/v_kendaraan', $data);
        }
           

        
    }


?>