<?php

class Login extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->helper('text');
		$this->load->helper('cookie');
	}

	public function index(){
		// load view admin/login.php
		if(isset($_COOKIE['login'])){

			$where = array(
				'sy_user.user_id' => $this->input->cookie('login[user]'),
				'sy_user.pass' => md5($this->input->cookie('login[pass]'))
			);

			$cek = $this->m_login->cek_login("sy_user", $where)->num_rows();
			$userlog = $this->m_login->ambilnamalevel($where);
		foreach($userlog as $usrlog){
			$id_log = $usrlog['user_id'];
			$namalog = $usrlog['nama'];
			$levellog = $usrlog['nama_level'];
			$unitlog = $usrlog['ASALUNIT'];
		}
		if($cek > 0){

			$data_session = array(
				'userid' => $id_log,
				'nama' => $namalog,
				'namalevel' =>$levellog,
				'status' => $levellog,
				'asalunit' => $unitlog
			);
			$this->session->set_userdata($data_session);
			if($this->session->userdata('status') == 'Administrator'){
				echo "<script>location='index.php/admin';</script>";
			}
			if($this->session->userdata('status') == 'Satpam'){
				echo "<script>location='index.php/admin/satpam';</script>";
			}
			else{
				echo "<script>location='index.php/admin/dashboard';</script>";
			}
			}
		}
		else{
		$dataload['daftarpegawai'] = $this->m_login->get_pegawai();
		$this->load->view('v_login', $dataload);
	}
	}

	public function aksi_login(){
	
		$preusername = $this->input->post('userid');
		$username = word_limiter($preusername,1,'');
		$password = $this->input->post('userpass');
		$where = array(
			'sy_user.user_id' => $username,
			'sy_user.pass' => md5($password)
		);
		$cek = $this->m_login->cek_login("sy_user", $where)->num_rows();
		$userlog = $this->m_login->ambilnamalevel($where);
		foreach($userlog as $usrlog){
			$id_log = $usrlog['user_id'];
			$namalog = $usrlog['nama'];
			$levellog = $usrlog['nama_level'];
			$unitlog = $usrlog['ASALUNIT'];
		}
		if($cek > 0){

			$data_session = array(
				'userid' => $id_log,
				'nama' => $namalog,
				'namalevel' =>$levellog,
				'status' => $levellog,
				'asalunit' => $unitlog
			);
			if($this->input->post('checkingat')){
				$time = time();
				$this->input->set_cookie("login[user]",$username, $time + 259200);
				$this->input->set_cookie("login[pass]",$password, $time + 259200);
			}
			
			$this->session->set_userdata($data_session);

			if($this->session->userdata('status') == 'Administrator'){
				echo "<script>location='admin';</script>";
			}
			if($this->session->userdata('status') == 'Satpam'){
				echo "<script>location='admin/satpam';</script>";
			}
			else{
				echo "<script>location='admin/dashboard';</script>";
			}
			
		}
		else{
			echo "<script>alert('USER ID ATAU PASSWORD ANDA SALAH');history.go(-1);</script>";
		}
	
	}
	
	public function aksi_logout(){
		$this->session->sess_destroy();
		if(isset($_COOKIE['login']))      
			{
				$time = time();
    			delete_cookie("login[user]");
    			delete_cookie("login[pass]");
			}
		echo "<script>location='awal';</script>";
		
	}
	public function petunjukpeng0(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng0");
	}
	public function petunjukpeng(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng");
	}
	public function petunjukpeng2(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng2");
	}
	public function petunjukpeng3(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng3");
	}
	public function petunjukpeng4(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng4");
	}
	public function petunjukpeng5(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng5");
	}
	public function petunjukpeng6(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng6");
	}
	public function petunjukpeng7(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng7");
	}
	public function petunjukpeng8(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng8");
	}
	public function petunjukpeng9(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng9");
	}
	public function petunjukpeng10(){
		$this->load->view("v_petunjukpeng/prototype_v_petunjukpeng10");
	}

}
?>