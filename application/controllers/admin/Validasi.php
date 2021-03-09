<?php

class Validasi extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_validasi');
	}

	public function index(){
		
		// load view order
		
		$data['orderan'] = $this->m_validasi->get_data();
		$data['kendaraan'] = $this->m_validasi->get_kendaraan();
		$data['supir'] = $this->m_validasi->get_supir();
		$this->load->view('admin/v_validasi',$data);
	}

	public function valid1(){
		if(isset($_POST['buttterima'])){
			$id_data = $this->input->post('inidorder');
			$statusord = $this->input->post('instatusorder');
			$levelord = $this->input->post('inlevelorder');
			$noaccorder = $this->input->post('innoorder');
			$idwhere = $id_data;
			if($this->session->userdata('namalevel') == 'Kepala Unit' OR $this->session->userdata('namalevel') == 'Kepala Bagian Kepeg' OR $this->session->userdata('namalevel') == 'Sekdir'){
				
				if($levelord == "Sub Bagian Umum"){
					$status = "Diterima";
					$prekendaraannya = $this->input->post('pilihkendaraan');
					$kendaraannya = word_limiter($prekendaraannya,1,'');
					$presupirnya = $this->input->post('pilihsupir');
					$supirnya = word_limiter($presupirnya,1,'');
					$validakhir = array('status' => $status,'kendaraan' => $kendaraannya,'supir' => $supirnya);
				
				}
				else{
					$status = "Diteruskan";
					$validakhir = array('status' => $status);
				}
				
			}
			else if($this->session->userdata('namalevel') == 'Sub Bagian Umum' OR $this->session->userdata('namalevel') == 'Administrator'){
				$status = "Diterima";
				$prekendaraannya = $this->input->post('pilihkendaraan');
				$kendaraannya = word_limiter($prekendaraannya,1,'');
				$presupirnya = $this->input->post('pilihsupir');
				$supirnya = word_limiter($presupirnya,1,'');
				$validakhir = array('status' => $status,'kendaraan' => $kendaraannya,'supir' => $supirnya);
			}
			$this->m_validasi->valid_data1($idwhere,$validakhir,$statusord,$noaccorder);
			redirect('admin/validasi');
		}
		
	}
	public function tolak_order(){
			$id_data = $this->uri->segment(3);
			$alasan_tolak = $this->uri->segment(4);
			$alasan_tolak = urldecode($alasan_tolak);
			$idwhere = $id_data;
			$status = "Ditolak";
			$validakhir = array('status' => $status,'alasan_tolak' => $alasan_tolak);
			$this->m_validasi->batal_valid($idwhere,$validakhir);
			redirect('admin/validasi');
	}
	
	
	
}
?>