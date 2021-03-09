<?php

class Overview extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('m_user');
	}

	public function index(){
		$keyword = $this->input->post('keyword');
		$data['statuscari'] = '0';

		//konfigurasi pagination
        $config['base_url'] = site_url('admin/row'); //site url
        $config['total_rows'] = $this->db->count_all('tb_master_pegawai'); //total row
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
        $data['user'] = $this->m_user->get_data($keyword,$config["per_page"], $data['page']);           
 
        $data['pagination'] = $this->pagination->create_links();

		// load view admin/overview.php
		$data['kode'] = $this->m_user->kode();
		$data['no'] = $this->m_user->no();
		$data['level'] = $this->m_user->get_level();
		
		$this->load->view('admin/overview', $data);
	}
		
	public function tambah_user(){
		$id_usr_baru = $this->input->post('iniduser');
		$nama_usr_baru = $this->input->post('innamauser');
		$pass_usr_baru = $this->input->post('inpassuser');
		

		$level_user_no = $this->input->post('inlevelno');
		$level_userid = $this->input->post('iniduser');
		$level_userlevel = $this->input->post('inleveluser');
		
		$data_insert = array(
			'user_id' => $id_usr_baru,
			'nama' => $nama_usr_baru,
			'pass' => md5($pass_usr_baru),
			
		);

		$data_insert2 = array(
			'no' => $level_user_no,
			'user_id' => $level_userid,
			'user_level' => $level_userlevel,
		);

		$this->m_user->input_data($data_insert,$data_insert2);
		redirect('admin');
	}

	public function edit_user(){
		$id_usr_baru = $this->input->post('iniduser');
		$nama_usr_baru = $this->input->post('innamauser');
		$pass_usr_baru = $this->input->post('inpassuser');
		$level_usr_baru = $this->input->post('pilihlevelbaru');
		
		$data_insert = array(
			'user_id' => $id_usr_baru,
			'nama' => $nama_usr_baru,
			'pass' => md5($pass_usr_baru),
			'user_level' => $level_usr_baru
		);

		$this->m_user->update_data($data_insert,$id_usr_baru);
		redirect('admin');
	}


	public function hapus_user (){
			$user_id = $this->uri->segment(3);
			$where = array('user_id' => $user_id);
			$whereid = $user_id;
			$this->m_user->hapus_data($where,$whereid,'sy_user_level','sy_user','tb_master_pegawai');
			redirect('admin');

		
	}
	public function cari(){
		$keyword = $this->input->post('keyword');
		if($keyword == ''){
		$data['statuscari'] = '0';

		//konfigurasi pagination
        $config['base_url'] = site_url('admin/row'); //site url
        $config['total_rows'] = $this->db->count_all('tb_master_pegawai'); //total row
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
        $data['user'] = $this->m_user->get_data($keyword,$config["per_page"], $data['page']);           
 
        $data['pagination'] = $this->pagination->create_links();

		// load view admin/overview.php
		$data['kode'] = $this->m_user->kode();
		$data['no'] = $this->m_user->no();
		$data['level'] = $this->m_user->get_level();
		}

		else{

		$data['statuscari'] = '1';
		$data['user'] = $this->m_user->get_keyword($keyword);
		$data['kode'] = $this->m_user->kode();
		$data['no'] = $this->m_user->no();
		$data['level'] = $this->m_user->get_level();
		
	}
	$this->load->view('admin/overview',$data);
	}
	public function ganti_pass_user(){
		$passlama = $this->input->post('inpasslama');
		$passbaru = $this->input->post('inpassbaru');
		$where = $this->input->post('idpassganti');
		$hasil = $this->m_user->check_pass_user($passlama);
		if($hasil != null){
			$this->m_user->ganti_pass_user($passbaru,$where);
			echo "<script>alert('Password Anda telah diganti');location='dashboard';</script>";
		}
		else{
			echo "<script>alert('Password lama Anda salah!');history.go(-1);</script>";
		}
		
	}
	
	
}
?>