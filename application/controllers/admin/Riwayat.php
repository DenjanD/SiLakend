<?php

class Riwayat extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('m_riwayat');
	}

	public function index(){
		//PAGINATION
		$keyword = $this->input->post('keyword');
		$data['statuscari'] = '0';

		//konfigurasi pagination
        $config['base_url'] = site_url('admin/rowr'); //site url
        $config['total_rows'] = $this->db->count_all('sy_order_peminjaman'); //total row
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
 
        //panggil function get_data yang ada pada model m_user. 
        $data['orderan'] = $this->m_riwayat->get_data($keyword,$config["per_page"], $data['page']);           
		$data['pagination'] = $this->pagination->create_links();
		
		// load view order
		$this->load->view('admin/v_riwayat',$data);
	}
	public function cari(){
		$keyword = $this->input->post('keyword');
		if($keyword == ''){
			$data['statuscari'] = '0';

			//konfigurasi pagination
			$config['base_url'] = site_url('admin/rowr'); //site url
			$config['total_rows'] = $this->db->count_all('sy_order_peminjaman'); //total row
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
	 
			//panggil function get_data yang ada pada model m_user. 
			$data['orderan'] = $this->m_riwayat->get_data($keyword,$config["per_page"], $data['page']);           
			$data['pagination'] = $this->pagination->create_links();
		}
		else{
			$data['statuscari'] = '1';
			$data['orderan'] = $this->m_riwayat->get_keyword($keyword);
		}
		$this->load->view('admin/v_riwayat',$data);
	}
	

	
}
		
?>