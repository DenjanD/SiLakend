<?php

class Laporan extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_laporan');
	}

	public function index(){
		
		// load view laporan
		$data['laporan'] = $this->m_laporan->get_data();
		$data['default_tgl'] = $this->m_laporan->get_curr_tgl();
		$data['data_mobil'] = $this->m_laporan->get_data_mobil();
		$data['data_pengemudi'] = $this->m_laporan->get_data_pengemudi();
		//Report Data - Statistik Supir Teraktif
		/*$data['statssupir'] = $this->m_laporan->stats_pengemudi();
		$data['statssupirlabel'] = $this->m_laporan->label_pengemudi();*/
		//Report Data - Statistik Order Perbulan dalam setahun
		$data['mobil_bulan1'] = $this->m_laporan->mobil_bulan1();
		$data['mobil_bulan2'] = $this->m_laporan->mobil_bulan2();
		$data['mobil_bulan3'] = $this->m_laporan->mobil_bulan3();
		$data['mobil_bulan4'] = $this->m_laporan->mobil_bulan4();
		$data['mobil_bulan5'] = $this->m_laporan->mobil_bulan5();
		$data['mobil_bulan6'] = $this->m_laporan->mobil_bulan6();
		$data['mobil_bulan7'] = $this->m_laporan->mobil_bulan7();
		$data['mobil_bulan8'] = $this->m_laporan->mobil_bulan8();
		$data['mobil_bulan9'] = $this->m_laporan->mobil_bulan9();
		$data['mobil_bulan10'] = $this->m_laporan->mobil_bulan10();
		$data['mobil_bulan11'] = $this->m_laporan->mobil_bulan11();
		$data['mobil_bulan12'] = $this->m_laporan->mobil_bulan12();
		$this->load->view('admin/v_laporan',$data);
	}

	//PERUBAHAN
	public function allinone(){
		if(isset($_POST['buttpdf'])){
		$this->load->library('Dompdf_gen');
		$tglawal = $this->input->post('tglawal');
		$tglakhir = $this->input->post('tglakhir');
		$prekendaraan = $this->input->post('kendaraan');
		$kendaraan = word_limiter($prekendaraan, 1,$end_char = '');
		$pengemudi = $this->input->post('pengemudi');
		$alasan = $this->input->post('alasan');

			if($kendaraan == "---Semua---"){
				$kendaraan = "";
			}
			if($pengemudi == "---Semua---"){
				$pengemudi = "";
			}
			if($alasan == "---Semua---"){
				$alasan = "";
			}

		$data['laporan'] = $this->m_laporan->get_laporan($tglawal,$tglakhir,$kendaraan,$pengemudi,$alasan);
		//$data['laporan'] = $this->m_laporan->get_data();
		$this->load->view('laporan_pdf', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size,$orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_orderan.pdf", array('Attachment' =>false));

		}
		//BUTTON Tampilkan Data DIKLIK
		else if(isset($_POST['buttdata'])){
			
	//Pengambilan Filtrasi Pencarian
		$tglawal = $this->input->post('tglawal');
		$tglakhir = $this->input->post('tglakhir');
		$prekendaraan = $this->input->post('kendaraan');
		$kendaraan = word_limiter($prekendaraan, 1,$end_char = '');
		$prepengemudi = $this->input->post('pengemudi');
		$pengemudi = word_limiter($prepengemudi, 1,$end_char = '');
		$alasan = $this->input->post('alasan');

			if($kendaraan == "---Semua---"){
				$kendaraan = "";
			}
			if($pengemudi == "---Semua---"){
				$pengemudi = "";
			}
			if($alasan == "---Semua---"){
				$alasan = "";
			}
	// \Pengambilan Filtrasi Pencarian
		$data['laporan'] = $this->m_laporan->get_laporan($tglawal,$tglakhir,$kendaraan,$pengemudi,$alasan);
		$data['default_tgl'] = $this->m_laporan->get_curr_tgl();
		$data['data_mobil'] = $this->m_laporan->get_data_mobil();
		$data['data_pengemudi'] = $this->m_laporan->get_data_pengemudi();
		$data['labeltglawal'] = date("d-M-Y", strtotime($tglawal)); 
		$data['labeltglakhir'] = date("d-M-Y", strtotime($tglakhir)); 
		//Report Data - Statistik Supir Teraktif
		$data['statssupir'] = $this->m_laporan->stats_pengemudi($tglawal,$tglakhir);
		$data['statssupirlabel'] = $this->m_laporan->label_pengemudi($tglawal,$tglakhir);

		//Report Data - Statistik Kendaraan Terbanyak
		$data['statskendaraan'] = $this->m_laporan->stats_kendaraan($tglawal,$tglakhir);
		$data['statskendaraanlabel'] = $this->m_laporan->label_kendaraan($tglawal,$tglakhir);

		//Report Data - Statistik Km Kendaraan Terbanyak
		$data['statskmkendaraan'] = $this->m_laporan->stats_kmkendaraan($tglawal,$tglakhir);
		$data['statskmkendaraanlabel'] = $this->m_laporan->label_kmkendaraan($tglawal,$tglakhir);

		//Report Data - Statistik Km Supir Terbanyak
		$data['statskmsupir'] = $this->m_laporan->stats_kmsupir($tglawal,$tglakhir);
		$data['statskmsupirlabel'] = $this->m_laporan->label_kmsupir($tglawal,$tglakhir);

		//Report Data - Statistik Unit Kerja
		$data['statsunitkerja1'] = $this->m_laporan->stats_unitkerja1($tglawal,$tglakhir);
		$data['statsunitkerja2'] = $this->m_laporan->stats_unitkerja2($tglawal,$tglakhir);
		$data['statsunitkerja3'] = $this->m_laporan->stats_unitkerja3($tglawal,$tglakhir);
		$data['statsunitkerja4'] = $this->m_laporan->stats_unitkerja4($tglawal,$tglakhir);
		//$data['statsunitkerja5'] = $this->m_laporan->stats_unitkerja5($tglawal,$tglakhir);
		//$data['statsunitkerja6'] = $this->m_laporan->stats_unitkerja6($tglawal,$tglakhir);
		$data['statsunitkerja7'] = $this->m_laporan->stats_unitkerja7($tglawal,$tglakhir);
		$data['statsunitkerja8'] = $this->m_laporan->stats_unitkerja8($tglawal,$tglakhir);
		$data['statsunitkerja9'] = $this->m_laporan->stats_unitkerja9($tglawal,$tglakhir);
		$data['statsunitkerja10'] = $this->m_laporan->stats_unitkerja10($tglawal,$tglakhir);
		$data['statsunitkerja11'] = $this->m_laporan->stats_unitkerja11($tglawal,$tglakhir);
		$data['statsunitkerja12'] = $this->m_laporan->stats_unitkerja12($tglawal,$tglakhir);
		//$data['statsunitkerja13'] = $this->m_laporan->stats_unitkerja13($tglawal,$tglakhir);
		//$data['statsunitkerja14'] = $this->m_laporan->stats_unitkerja14($tglawal,$tglakhir);
		//$data['statsunitkerja15'] = $this->m_laporan->stats_unitkerja15($tglawal,$tglakhir);
		//$data['statsunitkerja16'] = $this->m_laporan->stats_unitkerja16($tglawal,$tglakhir);
		//$data['statsunitkerja17'] = $this->m_laporan->stats_unitkerja17($tglawal,$tglakhir);
		$data['statsunitkerja18'] = $this->m_laporan->stats_unitkerja18($tglawal,$tglakhir);
		$data['statsunitkerja19'] = $this->m_laporan->stats_unitkerja19($tglawal,$tglakhir);
		$data['statsunitkerja20'] = $this->m_laporan->stats_unitkerja20($tglawal,$tglakhir);
		$data['statsunitkerja21'] = $this->m_laporan->stats_unitkerja21($tglawal,$tglakhir);
		$data['statsunitkerja22'] = $this->m_laporan->stats_unitkerja22($tglawal,$tglakhir);
		$data['statsunitkerja23'] = $this->m_laporan->stats_unitkerja23($tglawal,$tglakhir);
		$data['statsunitkerjalast'] = $this->m_laporan->stats_unitkerjalast($tglawal,$tglakhir);

		//Report Data - Statistik Alasan Pinjam
		$data['statsalasanpinjam1'] = $this->m_laporan->stats_alasanpinjam1($tglawal,$tglakhir);
		$data['statsalasanpinjam2'] = $this->m_laporan->stats_alasanpinjam2($tglawal,$tglakhir);
		$data['statsalasanpinjam3'] = $this->m_laporan->stats_alasanpinjam3($tglawal,$tglakhir);

		//Report Data - Statistik Order Perbulan
		$data['mobil_bulan1'] = $this->m_laporan->mobil_bulan1();
		$data['mobil_bulan2'] = $this->m_laporan->mobil_bulan2();
		$data['mobil_bulan3'] = $this->m_laporan->mobil_bulan3();
		$data['mobil_bulan4'] = $this->m_laporan->mobil_bulan4();
		$data['mobil_bulan5'] = $this->m_laporan->mobil_bulan5();
		$data['mobil_bulan6'] = $this->m_laporan->mobil_bulan6();
		$data['mobil_bulan7'] = $this->m_laporan->mobil_bulan7();
		$data['mobil_bulan8'] = $this->m_laporan->mobil_bulan8();
		$data['mobil_bulan9'] = $this->m_laporan->mobil_bulan9();
		$data['mobil_bulan10'] = $this->m_laporan->mobil_bulan10();
		$data['mobil_bulan11'] = $this->m_laporan->mobil_bulan11();
		$data['mobil_bulan12'] = $this->m_laporan->mobil_bulan12();

		//Membuka view laporan beserta data filtrasi 
		$this->load->view('admin/v_laporan',$data);
		}

		else if(isset($_POST['buttexcel'])){
		$tglawal = $this->input->post('tglawal');
		$tglakhir = $this->input->post('tglakhir');
		$prekendaraan = $this->input->post('kendaraan');
		$kendaraan = word_limiter($prekendaraan, 1,$end_char = '');
		$pengemudi = $this->input->post('pengemudi');
		$alasan = $this->input->post('alasan');

			if($kendaraan == "---Semua---"){
				$kendaraan = "";
			}
			if($pengemudi == "---Semua---"){
				$pengemudi = "";
			}
			if($alasan == "---Semua---"){
				$alasan = "";
			}
			// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/classes/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					 ->setLastModifiedBy('My Notes Code')
					 ->setTitle("Laporan Penggunaan Kendaraan Dinas")
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
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN PENGGUNAAN KENDARAAN DINAS"); // Set kolom A1 dengan tulisan <-
		$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "No"); // Set kolom A3 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "Tanggal Pinjam"); // Set kolom A3 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Peminjam"); // Set kolom B3 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "Alasan Pinjam"); // Set kolom C3 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "Dari"); // Set kolom D3 
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "Ke"); // Set kolom E3 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "Nama Supir"); // Set kolom E3 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "Kendaraan"); // Set kolom E3 
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		// Panggil function view yang ada di m_laporan untuk menampilkan semua data order
		$order = $this->m_laporan->get_laporan($tglawal,$tglakhir,$kendaraan,$pengemudi,$alasan);
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($order as $data){ // Lakukan looping pada variabel order
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['tgl_pinjam']);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nama_peminjam']);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['alasan_pinjam']);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['dari']);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['ke']);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['nama_supir']);
		  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['id_kendaraan']." - ".$data['nama_kendaraan']);

		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(4); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(13); 
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(35); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(25); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(25); 
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); 
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); 
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Penggunaan Kendaraan");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Kendaraan Dinas.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
		}
	}
/*
	public function cari(){
		$tglawal = $this->input->post('tglawal');
		$tglakhir = $this->input->post('tglakhir');
		$prekendaraan = $this->input->post('kendaraan');
		$kendaraan = word_limiter($prekendaraan, 1,$end_char = '');
		$pengemudi = $this->input->post('pengemudi');
		$alasan = $this->input->post('alasan');

			if($kendaraan == "---Semua---"){
				$kendaraan = "";
			}
			if($pengemudi == "---Semua---"){
				$pengemudi = "";
			}
			if($alasan == "---Semua---"){
				$alasan = "";
			}

		$data['laporan'] = $this->m_laporan->get_laporan($tglawal,$tglakhir,$kendaraan,$pengemudi,$alasan);
		$data['default_tgl'] = $this->m_laporan->get_curr_tgl();
		$data['data_mobil'] = $this->m_laporan->get_data_mobil();
		$data['data_pengemudi'] = $this->m_laporan->get_data_pengemudi();
		$this->load->view('admin/v_laporan',$data);
	}
	public function pdf(){
		$this->load->library('dompdf_gen');
		$tglawal = $this->input->post('tglawal');
		$tglakhir = $this->input->post('tglakhir');
		$prekendaraan = $this->input->post('kendaraan');
		$kendaraan = word_limiter($prekendaraan, 1,$end_char = '');
		$pengemudi = $this->input->post('pengemudi');
		$alasan = $this->input->post('alasan');

			if($kendaraan == "---Semua---"){
				$kendaraan = "";
			}
			if($pengemudi == "---Semua---"){
				$pengemudi = "";
			}
			if($alasan == "---Semua---"){
				$alasan = "";
			}

		//$data['laporan'] = $this->m_laporan->get_laporan($tglawal,$tglakhir,$kendaraan,$pengemudi,$alasan);
		$data['laporan'] = $this->m_laporan->get_data();
		$this->load->view('laporan_pdf', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size,$orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_orderan.pdf", array('Attachment' =>0));
	}*/
	/*public function export(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					 ->setLastModifiedBy('My Notes Code')
					 ->setTitle("Data Siswa")
					 ->setSubject("Kendaraan Dinas")
					 ->setDescription("Laporan Semua Data Siswa")
					 ->setKeywords("Data Siswa");
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
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$siswa = $this->m_laporan->get_laporan();
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa as $data){ // Lakukan looping pada variabel siswa
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nis);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->jenis_kelamin);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->alamat);
		  
		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Penggunaan Kendaraan");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Penggunaan Kendaraan.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	  }*/

	
}
?>