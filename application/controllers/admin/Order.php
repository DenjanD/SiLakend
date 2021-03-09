<?php

class Order extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('m_order');
	}

	public function index(){
		$keyword = $this->input->post('keyword');
		$data['statuscari'] = '0';

		//konfigurasi pagination
		$config['base_url'] = site_url('admin/rowo'); //site url
		$this->db->where('id_pegawai =',$this->session->userdata('userid'));
        $config['total_rows'] = $this->db->count_all_results('sy_order_peminjaman'); //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = 2;
		
		// Membuat Style pagination
		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        //panggil function get_data yang ada pada model m_order. 
        $data['orderan'] = $this->m_order->get_data($keyword,$config["per_page"], $data['page']);           
        $data['pagination'] = $this->pagination->create_links();
		//\pagination
		
		// load view order
		$data['idinputp'] = $this->m_order->kode();
		$data['noacc'] = $this->m_order->set_no_acc();
		$this->load->view('admin/v_order',$data);
	}
	public function tambah(){
	
			$id_order = $this->m_order->kode();
			$no_order = $this->input->post('innoorder');
			$dari = $this->input->post('indari');
			$ke = $this->input->post('inke');
			$tgl_pinjam = $this->input->post('intglpinjam');
			$waktu_berangkat = $this->input->post('inwaktupergi');
			$lama_pinjam = $this->input->post('inlamap');
			$alasan_pinjam = $this->input->post('inalasanp');
			$jml_personil = $this->input->post('injmlp');
			$keterangan = $this->input->post('inket');
			$status1 = 'Diajukan';
			if($this->session->userdata('namalevel') == 'Sub Bagian Umum'){
				$status1 = 'Diteruskan';
			}
			if($this->session->userdata('namalevel') == 'Sekdir'){
				$status1 = 'Diteruskan';
			}
			if($this->session->userdata('namalevel') == 'Kepala Unit'){
				$status1 = 'Diteruskan';
			}
			if($this->session->userdata('namalevel') == 'Supir'){
				$status1 = 'Diteruskan';
			}
			
            $data_insert = array(
				'id_peminjaman' => $id_order,
				'id_pegawai' => $this->session->userdata('userid'),
				'no_order' => $no_order,
				'dari' => $dari,
				'ke' => $ke,
				'tgl_pinjam' => $tgl_pinjam,
				'waktu_berangkat' => $waktu_berangkat,
				'lama_pinjam' => $lama_pinjam,
				'alasan_pinjam' => $alasan_pinjam,
				'jumlah_personil' => $jml_personil,
				'keterangan' => $keterangan,
				'status' => $status1
            );
    
            $this->m_order->input_order($data_insert);
            redirect('admin/order');
	}
	public function hapus(){

			$idhapus = $this->uri->segment(3);
			$where = array('id_peminjaman' => $idhapus);
			$this->m_order->hapus_data($where, 'sy_order_peminjaman');
			redirect('admin/order');
	}
	public function batal(){

			$idbatal = $this->uri->segment(3);
			$where = array('id_peminjaman' => $idbatal);
			$this->m_order->batal_order($where, 'sy_order_peminjaman');
			redirect('admin/order');


	}
	public function cektgl(){
		$tglperiksa = $_GET['tgl'];
		$cek = $this->m_order->cektglcurr($tglperiksa);
		echo json_encode($cek);
		
	}
	public function cari(){
		$keyword = $this->input->post('keyword');
		if($keyword == ''){
			$data['statuscari'] = '0';

			//konfigurasi pagination
			$config['base_url'] = site_url('admin/rowo'); //site url
			$this->db->where('id_pegawai =',$this->session->userdata('userid'));
        	$config['total_rows'] = $this->db->count_all_results('sy_order_peminjaman'); //total row
			$config['per_page'] = 10;  //show record per halaman
			$config["uri_segment"] = 3;  // uri parameter
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = 2;
			
			// Membuat Style pagination
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
	 
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	 
			//panggil function get_data yang ada pada model m_order. 
			$data['orderan'] = $this->m_order->get_data($keyword,$config["per_page"], $data['page']);           
			$data['pagination'] = $this->pagination->create_links();
			//\pagination
			$data['idinputp'] = $this->m_order->kode();
			$data['noacc'] = $this->m_order->set_no_acc();
		}
		else{
			$data['statuscari'] = '1';
			$data['orderan'] = $this->m_order->get_keyword($keyword);
			$data['idinputp'] = $this->m_order->kode();
			$data['noacc'] = $this->m_order->set_no_acc();
		}
		
		$this->load->view('admin/v_order',$data);
	}
	
}
?>