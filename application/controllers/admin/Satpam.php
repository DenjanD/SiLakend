<?php

    class Satpam extends CI_Controller{
        public function __construct()
	{
        parent::__construct();
        $this->load->model('m_satpam');
    }

        function index(){
            $data['order'] = $this->m_satpam->get_data();
            $this->load->view('admin/v_satpam', $data);
        }
        function inputkm(){
            $km_pulang = $this->input->post('inkmpulang');
            $id_kendaraan = $this->input->post('idkendnya');
            $id_order = $this->input->post('inidorder');
            $id_supir = $this->input->post('inidsupir');
            if($km_pulang == ""){
                echo "<script>alert('Kilometer kendaraan belum diisi!');history.go(-1);</script>";
            }
            else{
                $hasil = $this->m_satpam->inputkmpulang($km_pulang,$id_kendaraan,$id_order,$id_supir);
                if($hasil == "1"){
                    echo "<script>alert('Isi kilometer masuk dengan benar!');history.go(-1);</script>";
                }
                else{
                    redirect('admin/satpam');
                }
                
                
            }
           
        }
        public function cari(){
            $keyword = $this->input->post('keyword');
            $data['order'] = $this->m_satpam->get_keyword($keyword);
            $this->load->view('admin/v_satpam',$data);
        }
        

        
    }

?>