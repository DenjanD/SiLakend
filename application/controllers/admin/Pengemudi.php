<?php

class Pengemudi extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_pengemudi');
	}

	public function index(){
		
		// load view pengemudi
		$data['pengemudi'] = $this->m_pengemudi->get_data();
		$data['masterpegawai'] = $this->m_pengemudi->get_data2();
		$this->load->view('admin/v_pengemudi', $data);
	}
	public function tambah(){
		$idpmdbaru = $this->input->post('inidpmd');
		$namapmdbaru = $this->input->post('innamapmd');
		$statuspmdbaru = "Tidak Bertugas";
		
		$data_input = array(
			'ID' => $idpmdbaru,
			'NAMA' => $namapmdbaru,
			'STATUS' => $statuspmdbaru
		);

		$this->m_pengemudi->insert_data($data_input);
		redirect('admin/pengemudi');

	}
	public function edit(){
		$idpmdganti = $this->input->post('inidpmd');
		$namapmdganti = $this->input->post('innamapmd');
		
		$data_input = array(
		
			'NAMA' => $namapmdganti,
		);

		$this->m_pengemudi->update_data($data_input,$idpmdganti);
		redirect('admin/pengemudi');
	}
	public function hapus(){
			$idpmdhapus = $this->uri->segment(3);
			$where = array('ID' => $idpmdhapus);
			$this->m_pengemudi->hapus_data($where,'tb_master_pengemudi');
			redirect('admin/pengemudi');
	}
	public function cari(){
        $idnya= $_GET['id'];
		$cari =$this->m_pengemudi->cari($idnya); 
        echo json_encode($cari);
	} 
	public function caridata(){
		$keyword = $this->input->post('keyword');
		$data['pengemudi'] = $this->m_pengemudi->get_keyword($keyword);
		$data['masterpegawai'] = $this->m_pengemudi->get_data2();
		$this->load->view('admin/v_pengemudi',$data);
	}
	
}
?>