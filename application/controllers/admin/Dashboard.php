<?php

class Dashboard extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_dashboard');
	}

	public function index(){
		
		// load view order
		$data['orderan'] = $this->m_dashboard->get_data();
		$data['kendaraan'] = $this->m_dashboard->get_data2();
		$data['pengemudi'] = $this->m_dashboard->get_data3();
		$data['statskend'] = $this->m_dashboard->stats_kmkendaraan();
		$data['labelkend'] = $this->m_dashboard->label_kmkendaraan();
		$data['statskend2'] = $this->m_dashboard->stats_kmkendaraan2();
		$data['labelkend2'] = $this->m_dashboard->label_kmkendaraan2();
		$data['statssupir'] = $this->m_dashboard->stats_supir();
		$data['labelsupir'] = $this->m_dashboard->label_supir();
		$data['statssupir2'] = $this->m_dashboard->stats_supir2();
		$data['labelsupir2'] = $this->m_dashboard->label_supir2();
		//$data['statsunit1'] = $this->m_dashboard->stats_unit1();
		//$data['statsunit2'] = $this->m_dashboard->stats_unit2();
		
		//Report Data - Statistik Order Unit Kerja
		$data['statsunitkerja1'] = $this->m_dashboard->stats_unitkerja1();
		$data['statsunitkerja2'] = $this->m_dashboard->stats_unitkerja2();
		$data['statsunitkerja3'] = $this->m_dashboard->stats_unitkerja3();
		$data['statsunitkerja4'] = $this->m_dashboard->stats_unitkerja4();
		//$data['statsunitkerja5'] = $this->m_laporan->stats_unitkerja5($tglawal,$tglakhir);
		//$data['statsunitkerja6'] = $this->m_laporan->stats_unitkerja6($tglawal,$tglakhir);
		$data['statsunitkerja7'] = $this->m_dashboard->stats_unitkerja7();
		$data['statsunitkerja8'] = $this->m_dashboard->stats_unitkerja8();
		$data['statsunitkerja9'] = $this->m_dashboard->stats_unitkerja9();
		$data['statsunitkerja10'] = $this->m_dashboard->stats_unitkerja10();
		$data['statsunitkerja11'] = $this->m_dashboard->stats_unitkerja11();
		$data['statsunitkerja12'] = $this->m_dashboard->stats_unitkerja12();
		//$data['statsunitkerja13'] = $this->m_laporan->stats_unitkerja13($tglawal,$tglakhir);
		//$data['statsunitkerja14'] = $this->m_laporan->stats_unitkerja14($tglawal,$tglakhir);
		//$data['statsunitkerja15'] = $this->m_laporan->stats_unitkerja15($tglawal,$tglakhir);
		//$data['statsunitkerja16'] = $this->m_laporan->stats_unitkerja16($tglawal,$tglakhir);
		//$data['statsunitkerja17'] = $this->m_laporan->stats_unitkerja17($tglawal,$tglakhir);
		$data['statsunitkerja18'] = $this->m_dashboard->stats_unitkerja18();
		$data['statsunitkerja19'] = $this->m_dashboard->stats_unitkerja19();
		$data['statsunitkerja20'] = $this->m_dashboard->stats_unitkerja20();
		$data['statsunitkerja21'] = $this->m_dashboard->stats_unitkerja21();
		$data['statsunitkerja22'] = $this->m_dashboard->stats_unitkerja22();
		$data['statsunitkerja23'] = $this->m_dashboard->stats_unitkerja23();
		$data['statsunitkerjalast'] = $this->m_dashboard->stats_unitkerjalast();
		
		//Report Data - Statistik Km Unit Kerja
		$data['statskmunitkerja1'] = $this->m_dashboard->stats_kmunitkerja1();
		$data['statskmunitkerja2'] = $this->m_dashboard->stats_kmunitkerja2();
		$data['statskmunitkerja3'] = $this->m_dashboard->stats_kmunitkerja3();
		$data['statskmunitkerja4'] = $this->m_dashboard->stats_kmunitkerja4();
		//$data['statsunitkerja5'] = $this->m_laporan->stats_unitkerja5($tglawal,$tglakhir);
		//$data['statsunitkerja6'] = $this->m_laporan->stats_unitkerja6($tglawal,$tglakhir);
		$data['statskmunitkerja7'] = $this->m_dashboard->stats_kmunitkerja7();
		$data['statskmunitkerja8'] = $this->m_dashboard->stats_kmunitkerja8();
		$data['statskmunitkerja9'] = $this->m_dashboard->stats_kmunitkerja9();
		$data['statskmunitkerja10'] = $this->m_dashboard->stats_kmunitkerja10();
		$data['statskmunitkerja11'] = $this->m_dashboard->stats_kmunitkerja11();
		$data['statskmunitkerja12'] = $this->m_dashboard->stats_kmunitkerja12();
		//$data['statsunitkerja13'] = $this->m_laporan->stats_unitkerja13($tglawal,$tglakhir);
		//$data['statsunitkerja14'] = $this->m_laporan->stats_unitkerja14($tglawal,$tglakhir);
		//$data['statsunitkerja15'] = $this->m_laporan->stats_unitkerja15($tglawal,$tglakhir);
		//$data['statsunitkerja16'] = $this->m_laporan->stats_unitkerja16($tglawal,$tglakhir);
		//$data['statsunitkerja17'] = $this->m_laporan->stats_unitkerja17($tglawal,$tglakhir);
		$data['statskmunitkerja18'] = $this->m_dashboard->stats_kmunitkerja18();
		$data['statskmunitkerja19'] = $this->m_dashboard->stats_kmunitkerja19();
		$data['statskmunitkerja20'] = $this->m_dashboard->stats_kmunitkerja20();
		$data['statskmunitkerja21'] = $this->m_dashboard->stats_kmunitkerja21();
		$data['statskmunitkerja22'] = $this->m_dashboard->stats_kmunitkerja22();
		$data['statskmunitkerja23'] = $this->m_dashboard->stats_kmunitkerja23();
		$data['statskmunitkerjalast'] = $this->m_dashboard->stats_kmunitkerjalast();
		$this->load->view('admin/v_dashboard',$data);
	}
	public function cari(){
		$keyword = $this->input->post('keyword');
		$data['orderan'] = $this->m_riwayat->get_keyword($keyword);
		$this->load->view('admin/v_riwayat',$data);
	}
	

	
}
?>