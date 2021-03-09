<?php

    class Tugass extends CI_Controller{
        public function __construct()
	{
        parent::__construct();
        $this->load->model('m_tugass');
	}

        public function index(){
            $data['tugass'] = $this->m_tugass->get_tugas();
            $this->load->view('admin/v_tugass', $data);
        }

        public function berangkat(){
            $statusberangkat = 'Berangkat';
            $id_order_berangkat = $this->input->post('inidorder');
            $idkend = $this->input->post('idkendnya');
            $this->m_tugass->order_berangkat($statusberangkat,$id_order_berangkat,$idkend);
            redirect('admin/tugassupir');
        }

        public function berangkat2(){
            $statusberangkat = 'Berangkat';
            $id_order_berangkat = $this->uri->segment(3);
            $idkend = $this->uri->segment(4);
            $this->m_tugass->order_berangkat($statusberangkat,$id_order_berangkat,$idkend);
            redirect('admin/order');
        }

    }

?>