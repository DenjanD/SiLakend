<?php 

class m_login extends CI_Model{
	
	function get_pegawai(){
		$this->db->select("ID, NAMA");
		$this->db->from("tb_master_pegawai");
		$this->db->order_by("NAMA"); 
		return $this->db->get()->result_array();
	}
	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}
	function ambilnamalevel($where){
		   $this->db->select('sy_user.user_id, sy_user.nama, sy_level.nama_level, tb_master_pegawai.ASALUNIT');
           $this->db->from('sy_user');
           $this->db->join('sy_user_level', 'sy_user.user_id=sy_user_level.user_id');
		   $this->db->join('sy_level', 'sy_user_level.user_level=sy_level.level');
		   $this->db->join('tb_master_pegawai', 'sy_user.user_id=tb_master_pegawai.ID');
		   $this->db->where($where);
           return $this->db->get()->result_array();
	}	
}
?>