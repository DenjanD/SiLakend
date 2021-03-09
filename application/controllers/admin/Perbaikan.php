<?php 

class Perbaikan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_perbaikan');

    }
    
    public function index(){
        $data['kumpulanperbaikan'] = $this->m_perbaikan->get_perbaikan();
        $data['mobil'] = $this->m_perbaikan->get_kendaraan();
        $data['statuscari'] = 0;
        $this->load->view('admin/v_perbaikan',$data);
    }

    public function inputperbaikan(){
        //Mengambil id perbaikan yang sudah ada
        $id = $this->m_perbaikan->get_id_terakhir();
        $preid_kendaraan = $this->input->post('selmobil');
        $id_kendaraan = word_limiter($preid_kendaraan, 1, '');
        $tgl_perbaikan = $this->input->post('intglperbaikan');
        $jenis_perbaikan = $this->input->post('selperbaikan');
        $nama_perbaikan = $this->input->post('innamaperbaikan');
        $jumlah = $this->input->post('injumlah');
        $satuan = $this->input->post('selsatuan');
        $harga = $this->input->post('inhargaperbaikan');
        $total = intval($jumlah)*intval($harga);

        $insert_data = array(
            'id_perbaikan' => $id,
            'id_kendaraan' => $id_kendaraan,
            'tgl_perbaikan' => $tgl_perbaikan,
            'jenis_perbaikan' => $jenis_perbaikan,
            'nama_perbaikan' => $nama_perbaikan,
            'jumlah' => $jumlah,
            'satuan' => $satuan,
            'harga' => $harga,
            'total' => $total
        );
        $this->m_perbaikan->input_data($insert_data);
        redirect('admin/perbaikan');
    }

	public function hapus_perbaikan(){
		$id_perb_hapus = $this->uri->segment(3);
		$this->m_perbaikan->hapusperbaikan($id_perb_hapus);
		redirect('admin/perbaikan');
	}

	public function edit_perbaikan(){
		$id_perb = $this->input->post('inidperbaikan');
		$tgl_perb = $this->input->post('intglperbaikan');
		$jenis_perb = $this->input->post('injenisperbaikan');
		$nama_perb = $this->input->post('innamaperbaikan');
		$jumlah_perb = $this->input->post('injumlah');
		$satuan_perb = $this->input->post('insatuan');
		$harga_perb = $this->input->post('inharga');

		$this->m_perbaikan->updateperbaikan($id_perb,$tgl_perb,$jenis_perb,$nama_perb,$jumlah_perb,$satuan_perb,$harga_perb);
		redirect('admin/perbaikan');
	}

    public function cari(){
        if(isset($_POST['buttcari'])){
        $cari_keyword = $this->input->post('keyword');
        $cari_kendaraan = word_limiter($this->input->post('selkendaraan'),1,'');
        $cari_perbaikan = $this->input->post('selperbaikan');
        $cari_tglawal = $this->input->post('caritglawal');
        $cari_tglakhir = $this->input->post('caritglakhir');
        
        if($cari_kendaraan == '---Semua---'){
            $cari_kendaraan = '';
        }
        if($cari_perbaikan == '---Semua---'){
            $cari_perbaikan = '';
        }

        $datap['kumpulanperbaikan'] = $this->m_perbaikan->cari_perbaikan($cari_keyword, $cari_kendaraan, $cari_perbaikan, $cari_tglawal, $cari_tglakhir);
        $datap['mobil'] = $this->m_perbaikan->get_kendaraan();
        $datap['statuscari'] = 1;
        $this->load->view('admin/v_perbaikan',$datap);
    }
        //EXCEL OUTPUT
		
		else if(isset($_POST['buttexcel'])){
			$cari_keyword = $this->input->post('keyword');
            $cari_kendaraan = word_limiter($this->input->post('selkendaraan'),1,'');
            $cari_perbaikan = $this->input->post('selperbaikan');
            $cari_tglawal = $this->input->post('caritglawal');
            $cari_tglakhir = $this->input->post('caritglakhir');
			
			if($cari_kendaraan == '---Semua---'){
                $cari_kendaraan = '';
            }
            if($cari_perbaikan == '---Semua---'){
                $cari_perbaikan = '';
			}
			$banyak_data = $this->m_perbaikan->itung_cari_perbaikan($cari_keyword, $cari_kendaraan, $cari_perbaikan, $cari_tglawal, $cari_tglakhir);
			$mulai_header_totalakhir = $banyak_data + 4;
			
           
			// Load plugin PHPExcel nya
			require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					 ->setLastModifiedBy('My Notes Code')
					 ->setTitle("Laporan Perbaikan/Penggantian Komponen Kendaraan Dinas")
					 ->setSubject("Kendaraan Dinas")
					 ->setDescription("Laporan Semua Order")
					 ->setKeywords("Laporan");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN PERBAIKAN/PENGGANTIAN KOMPONEN KENDARAAN DINAS"); // Set kolom A1 dengan tulisan <-
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->mergeCells('A'.$mulai_header_totalakhir.':H'.$mulai_header_totalakhir.''); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		// Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "No"); // Set kolom A3 
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$mulai_header_totalakhir.'', "Total Akhir Biaya"); // Set kolom A3 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "Tanggal Perbaikan"); // Set kolom A3 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "Kendaraan"); // Set kolom B3 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "Jenis Perbaikan"); // Set kolom C3 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "Perbaikan/Penggantian"); // Set kolom D3 
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "Jumlah"); // Set kolom E3 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "Satuan"); // Set kolom E3 
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "Harga"); // Set kolom E3 
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "Total"); // Set kolom E3 
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('A'.$mulai_header_totalakhir.'')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
		// Panggil function view yang ada di m_laporan untuk menampilkan semua data order
		$order = $this->m_perbaikan->cari_perbaikan($cari_keyword, $cari_kendaraan, $cari_perbaikan, $cari_tglawal, $cari_tglakhir);
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        $totalakhir = 0;
		foreach($order as $data){ // Lakukan looping pada variabel order
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['tgl_perbaikan']);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['id_kendaraan']." - ".$data['nama_kendaraan']);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['jenis_perbaikan']);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['nama_perbaikan']);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['jumlah']);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['satuan']);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['harga']);
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['harga']*$data['jumlah']);

		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  
		  $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
          $totalakhir = $totalakhir + $data['harga']*$data['jumlah'];
        }
        $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $totalakhir);
        $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(4); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(17); 
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(35); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(50); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); 
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10); 
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(22); 
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(28); 
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Perbaikan Kendaraan");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Perbaikan/Penggantian Komponen Kendaraan Dinas.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
		}
		
    
	}

}


?>