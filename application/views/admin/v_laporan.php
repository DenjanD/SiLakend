<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>
<?php
       $this->session->set_userdata('halaman', 'laporan');
      if($this->session->userdata('nama') == ''){
        //echo "<script>alert('ANDA HARUS LOGIN TERLEBIH DAHULU!');history.go(-1);</script>";
        redirect('awal');
      }
    ?>

<body class="sidebar-icon-only">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
   <?php $this->load->view('admin/_partials/navbar'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
     <?php $this->load->view('admin/_partials/sidebar'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <!-- Content mulai dari sini -->
                  <h4 class="font-weight-bold mb-0">Laporan Penggunaan Kendaraan Dinas</h4>
                </div>
                <div>
                  
                </div>
              </div>
            </div>
          </div>
          <!-- Tampilan Tabel Order -->
          <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Format Laporan Kendaraan Dinas</h4>
                  <!-- kolom search data -->    
                  <?php
                    foreach ($default_tgl as $def) :
                      $def_tglawal = $def['seminggu_lalu'];
                      $def_tglskrg = $def['sekarang'];
                    endforeach;
                  
                  ?> 
                  <form action="<?php echo base_url('index.php/admin/laporan/allinone'); ?>" method="post">
                    <div class="row">
                      <div class="col-lg-5 col-md-5 col-xs-5 col-5">
                            <label>Tanggal Awal</label>
                          <input type="date" class="form-control" id="koltglawal" value="<?php echo $def_tglawal; ?>" name="tglawal" aria-label="search" aria-describedby="search">       
                      </div>
                      <div class="col-lg-2 col-md-2 col-xs-2 col-2">
                     
                          <p style="text-align:center; margin-top:40px">hingga</p>       
                      </div>
                      <div class="col-lg-5 col-md-5 col-xs-5 col-5">
                          <label>Tanggal Akhir</label>
                          <input type="date" class="form-control" id="koltglakhir" value="<?php echo $def_tglskrg; ?>" name="tglakhir" aria-label="search" aria-describedby="search">       
                      </div>
                      
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-xs-6 col-6">
                            <label>Nama Kendaraan</label>
                          <select class="form-control" id="kolkendaraan" name="kendaraan">
                            <option>---Semua---</option>
                            <?php 
                              foreach ($data_mobil as $dtf) :
                                echo "<option>".$dtf['id_kendaraan']." - ".$dtf['nama_kendaraan']."</option>";                          
                              endforeach;
                            ?>
                          </select>       
                      </div>
                      
                      <div class="col-lg-6 col-md-6 col-xs-6 col-6">
                          <label>Nama Pengemudi</label>
                          <select class="form-control" id="kolpengemudi" name="pengemudi">
                            <option>---Semua---</option>
                            <?php 
                              foreach ($data_pengemudi as $dtf) :
                                echo "<option>".$dtf['ID']." - ".$dtf['NAMA']."</option>";                          
                              endforeach;
                            ?>
                          </select>        
                      </div>
                      
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                            <label>Alasan Peminjaman</label>
                          <select class="form-control" id="kolalasan" name="alasan">
                            <option>---Semua---</option>
                            <option>Dinas Dalam Kota</option>
                            <option>Dinas Luar Kota</option>
                            <option>Pribadi</option>
                          </select>       
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-xs-12 col-12">
                            <input type="submit" class="form-control btn btn-primary" value="Tampilkan Data" name="buttdata">          
                            <input type="submit" formtarget="_blank" class="form-control btn btn-danger" value="PDF" name="buttpdf">
                            <input type="submit" formtarget="_blank" class="form-control btn btn-success" value="Excel" name="buttexcel">       
                      </div>
                    </div>
                  </form>
                  <br><br>

                  <!--<a href="<?= site_url('mpdfcontroller/printPDF') ?>" class="btn btn-danger" target="_blank">PDF</a> -->
                 
                  
                  <div class="table-responsive">
                  <table id="tabelorder" class="table table-bordered table-hover">
                  <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Pinjam</th>
                  <th>Nama Peminjam</th>
                  <th>Alasan Peminjaman</th>
                  <th>Dari</th>
                  <th>Ke</th>
                  <th>Nama Pengemudi</th>
                  <th>Kendaraan</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; foreach ($laporan as $lpr) :  $no++;?>
        
                  <tr>
                      <td><?php echo $no;?></td>
                      <td><?php echo $lpr['tgl_pinjam'];?></td>
                      <td><?php echo $lpr['nama_peminjam'];?></td>
                      <td><?php echo $lpr['alasan_pinjam'];?></td>
                      <td><?php echo $lpr['dari'];?></td>
                      <td><?php echo $lpr['ke'];?></td>
                      <td><?php echo $lpr['nama_supir'];?></td>
                      <td><?php echo $lpr['id_kendaraan']." - "; ?><?php echo $lpr['nama_kendaraan'];?></td>
                        
                  </tr>           
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
                  </div>
                  <!-- /Div Tabel -->
                  <!-- Div Charts -->
                  <!-- Get Data Order Perbulan -->
                  <?php 
                    foreach ($mobil_bulan1 as $bulan1) :
                      $jml_order1 = $bulan1['banyakord'];          
                    endforeach;
                    foreach ($mobil_bulan2 as $bulan2) :
                      $jml_order2 = $bulan2['banyakord'];          
                    endforeach;
                    foreach ($mobil_bulan3 as $bulan3) :
                      $jml_order3 = $bulan3['banyakord'];             
                    endforeach;
                    foreach ($mobil_bulan4 as $bulan4) :
                      $jml_order4 = $bulan4['banyakord'];
                    endforeach;
                    foreach ($mobil_bulan5 as $bulan5) :
                      $jml_order5 = $bulan5['banyakord'];          
                    endforeach;
                    foreach ($mobil_bulan6 as $bulan6) :
                      $jml_order6 = $bulan6['banyakord'];          
                    endforeach;
                    foreach ($mobil_bulan7 as $bulan7) :
                      $jml_order7 = $bulan7['banyakord'];             
                    endforeach;
                    foreach ($mobil_bulan8 as $bulan8) :
                      $jml_order8 = $bulan8['banyakord'];
                    endforeach;
                    foreach ($mobil_bulan9 as $bulan9) :
                      $jml_order9 = $bulan9['banyakord'];          
                    endforeach;
                    foreach ($mobil_bulan10 as $bulan10) :
                      $jml_order10 = $bulan10['banyakord'];          
                    endforeach;
                    foreach ($mobil_bulan11 as $bulan11) :
                      $jml_order11 = $bulan11['banyakord'];             
                    endforeach;
                    foreach ($mobil_bulan12 as $bulan12) :
                      $jml_order12 = $bulan12['banyakord'];
                    endforeach;
                  ?>
                  <br>
                  <!-- Statistik Supir Teraktif -->
                  
                  <div class="row" <?php if($laporan == null){echo "hidden";} ?>>
                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><button id="savesupirchart" class="btn btn-success btn-sm">Download Grafik</button></h4>
                  <canvas id="supirChart"></canvas>
                </div>
              </div>
            </div>
                  <script>
		                  var ctx = document.getElementById("supirChart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'bar',
                        
			                  data: {
				                labels: [

                          <?php 
                              foreach ($statssupirlabel as $sprl) :
                                echo '"'.$sprl['namasupir'].'",';
                              endforeach;
                            ?>
                          
                          ],
				                datasets: [{
                          label: 'Total Order',
				              	    data: [
                              
                            <?php                         
                                foreach ($statssupir as $spr) :        
                                  echo '"'.$spr['jmlord'].'",';                              
                                endforeach;    
                              ?>
                                
                              ],
                              backgroundColor: [
                                '#bc4b4b',
                              '#78c633',
                              '#1ac9ed',
                              '#f94f82',
                            	'#009dff',
                            	'#21ff84',
                            	'#edde3b',
                            	'#ca2aea',
	                            '#ff9900',
	                            '#f44ef2',
                              '#2d49ed',
                              '#33e8b1',
                              '#68d32e',
                              '#1a60a3',
                              '#ffc96d',
                              '#b2ff00',
                              '#1ff2d6',
                              '#dd8949',
                              '#8556ea',
                              '#ed2191',
                              '#f49c84'
                                ],
                            
                              borderWidth: 1
                            }]
                          },
                          options: {
                              legend: {
                                position : 'bottom',
                                labels:{
                                  
                                }
                            },
                            title: {
                                    display: true,
                                    text: 'KLASIFIKASI ORDER SUPIR PERIODE <?php echo $labeltglawal;?> HINGGA <?php echo $labeltglakhir; ?>',
                                    padding: 30
                                },
                                scales: {
                              yAxes: [{
                                ticks: {
                                  beginAtZero:true,
                                  userCallback: function(label, index, labels) {
                                    if (Math.floor(label) === label) {
                                    return label;
                                      }
                                    },
                                    }
                                  }]
                                },plugins:{labels: {
                                    render: 'value',
                                    
                                  }
                              }
                              }
                            });
                            
                </script>
                    </div>
                    <!-- Statistik Kendaraan Terbanyak -->
                  
                  <div class="row" <?php if($laporan == null){echo "hidden";} ?>>
                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><button id="savekendaraanchart" class="btn btn-success btn-sm">Download Grafik</button></h4>
                  <canvas id="kendaraanChart"></canvas>
                </div>
              </div>
            </div>
                  <script>
		                  var ctx = document.getElementById("kendaraanChart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'bar',
			                  data: {
				                labels: [

                          <?php 
                              foreach ($statskendaraanlabel as $kndl) :
                                echo '"'.$kndl['idkend'].' - '.$kndl['kend'].'",';
                              endforeach;
                            ?>
                          
                          ],
				                datasets: [{
                          label: 'Total Order',
				              	    data: [
                              
                            <?php                         
                                foreach ($statskendaraan as $knd) :        
                                  echo '"'.$knd['jmlord'].'",';                              
                                endforeach;    
                              ?>
                                
                              ],
                              backgroundColor: [
                                '#bc4b4b',
                              '#78c633',
                              '#1ac9ed',
                              '#f94f82',
                            	'#009dff',
                            	'#21ff84',
                            	'#edde3b',
                            	'#ca2aea',
	                            '#ff9900',
	                            '#f44ef2',
                              '#2d49ed',
                              '#33e8b1',
                              '#68d32e',
                              '#1a60a3',
                              '#ffc96d',
                              '#b2ff00',
                              '#1ff2d6',
                              '#dd8949',
                              '#8556ea',
                              '#ed2191',
                              '#f49c84'
                                ],
                            
                              borderWidth: 1
                            }]
                          },
                          options: {
                            legend: {
                              position : 'bottom'
                            },
                            title:{
                              display: true,
                              text: 'KLASIFIKASI ORDER KENDARAAN PERIODE <?php echo $labeltglawal;?> HINGGA <?php echo $labeltglakhir; ?>',
                              padding: 30
                            },
                            scales: {
                              yAxes: [{
                                ticks: {
                                  beginAtZero:true,
                                  userCallback: function(label, index, labels) {
                                    if (Math.floor(label) === label) {
                                    return label;
                                      }
                                    },
                                    }
                                  }]
                                },plugins:{labels: {
                                    render: 'value',
                                  }
                              }
                              }
                            });
                </script>
                    </div>
                    <!-- Statistik Km Kendaraan Terbanyak -->
                  
                  <div class="row" <?php if($laporan == null){echo "hidden";} ?>>
                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title"><button id="savekmkendaraanchart" class="btn btn-success btn-sm">Download Grafik</button></h4>
                  <canvas id="kmkendaraanChart"></canvas>
                </div>
              </div>
            </div>
                  <script>
		                  var ctx = document.getElementById("kmkendaraanChart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'horizontalBar',
			                  data: {
				                labels: [

                          <?php 
                              foreach ($statskmkendaraanlabel as $kmkndl) :
                                echo '"'.$kmkndl['idkend'].' - '.$kmkndl['namakend'].'",';
                              endforeach;
                            ?>
                          
                          ],
				                datasets: [{
                          label: 'Jumlah Km Tempuh',
				              	    data: [
                              
                            <?php                         
                                foreach ($statskmkendaraan as $kmknd) :        
                                  echo '"'.$kmknd['jmlkm'].'",';                              
                                endforeach;    
                              ?>
                                
                              ],
                              backgroundColor: [
                                '#bc4b4b',
                              '#78c633',
                              '#1ac9ed',
                              '#f94f82',
                            	'#009dff',
                            	'#21ff84',
                            	'#edde3b',
                            	'#ca2aea',
	                            '#ff9900',
	                            '#f44ef2',
                              '#2d49ed',
                              '#33e8b1',
                              '#68d32e',
                              '#1a60a3',
                              '#ffc96d',
                              '#b2ff00',
                              '#1ff2d6',
                              '#dd8949',
                              '#8556ea',
                              '#ed2191',
                              '#f49c84'
                                ],
                            
                              borderWidth: 1
                            }]
                          },
                          options: {
                            legend:{
                              position: 'bottom'
                            },
                            title:{
                              display: true,
                              text: 'JUMLAH KM TEMPUH TIAP KENDARAAN PERIODE <?php echo $labeltglawal;?> HINGGA <?php echo $labeltglakhir; ?>',
                              padding : 30
                            },
                            scales: {
                              xAxes: [{
                                ticks: {
                                  beginAtZero:true,
                                  userCallback: function(label, index, labels) {
                                    if (Math.floor(label) === label) {
                                    return label;
                                      }
                                    },
                                    }
                                  }]
                                },plugins:{labels: {
                                    render: 'value',
                                  }
                              }
                              }
                            });
                </script>
                    </div>
                    <!-- Statistik Km Supir Terbanyak -->
                  
                  <div class="row" <?php if($laporan == null){echo "hidden";} ?>>
                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><button id="savekmsupirchart" class="btn btn-success btn-sm">Download Grafik</button></h4>
                  <canvas id="kmsupirChart"></canvas>
                </div>
              </div>
            </div>
                  <script>
		                  var ctx = document.getElementById("kmsupirChart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'bar',
			                  data: {
				                labels: [

                          <?php 
                              foreach ($statskmsupirlabel as $kmsprl) :
                                echo '"'.$kmsprl['namasupir'].'",';
                              endforeach;
                            ?>
                          
                          ],
				                datasets: [{
                          label: 'Jumlah Km Tempuh',
				              	    data: [
                              
                            <?php                         
                                foreach ($statskmsupir as $kmspr) :        
                                  echo '"'.$kmspr['jmlkm'].'",';                              
                                endforeach;    
                              ?>
                                
                              ],
                              backgroundColor: [
                                '#bc4b4b',
                              '#78c633',
                              '#1ac9ed',
                              '#f94f82',
                            	'#009dff',
                            	'#21ff84',
                            	'#edde3b',
                            	'#ca2aea',
	                            '#ff9900',
	                            '#f44ef2',
                              '#2d49ed',
                              '#33e8b1',
                              '#68d32e',
                              '#1a60a3',
                              '#ffc96d',
                              '#b2ff00',
                              '#1ff2d6',
                              '#dd8949',
                              '#8556ea',
                              '#ed2191',
                              '#f49c84'
                                ],
                            
                              borderWidth: 1
                            }]
                          },
                          options: {
                            legend : {
                              position: 'bottom'
                            },
                            title:{
                              display: true,
                              text: 'JUMLAH KM TEMPUH TIAP SUPIR PERIODE <?php echo $labeltglawal;?> HINGGA <?php echo $labeltglakhir; ?>',
                              padding : 30
                            },
                            scales: {
                              yAxes: [{
                                ticks: {
                                  beginAtZero:true,
                                  userCallback: function(label, index, labels) {
                                    if (Math.floor(label) === label) {
                                    return label;
                                      }
                                    },
                                    }
                                  }]
                                },plugins:{labels: {
                                    render: 'value',
                                  }
                              }
                              }
                            });
                </script>
                    </div>
                    <!-- Statistik Unit Kerja -->
                  
                  <div class="row" <?php if($laporan == null){echo "hidden";} ?>>
                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><button id="saveunitkerjachart" class="btn btn-success btn-sm">Download Grafik</button></h4>
                  <canvas id="unitkerjaChart"></canvas>
                </div>
              </div>
            </div>
                  <script>
		                  var ctx = document.getElementById("unitkerjaChart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'horizontalBar',
			                  data: {
				                labels: [
                        "Bagian Adm. Akademik & Kemahasiswaan",
                        "Bagian Adum./Sub. Bag. Sumber Daya/Kesekretariatan/Kerumahtanggaan",
                        "Bagian Adum./Sub. Bag. Umum",
                        "Bagian Keuangan",
 
                        
                        
                        "Jurusan Teknik Manufaktur",
                        "Jurusan Teknik Otomasi Manufaktur dan Mekatronika",
                        "Jurusan Teknik Pengecoran Logam",
                        "Jurusan Teknik Perancangan Manufaktur",
                        "Koperasi Pegawai POLMAN",
                        "Manajemen",
                        
                      
                      
                        
                        "SATPAM",
                        "Unit Pelayanan Masyarakat (UPM)",
                        "Unit Penelitian, Pengembangan dan Pemberdayaan Masyarakat (UP3M)",
                        "Unit Sosiomanufaktur",
                        "UPT. Logistik",
                        "UPT. P3",
                        "UPT. Puskomedia"],
				                datasets: [{
                          label: 'Jumlah Order',
				              	    data: [
                              
                            <?php                         
                                foreach ($statsunitkerja1 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;  
                                foreach ($statsunitkerja2 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja3 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja4 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                /*foreach ($statsunitkerja5 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;*/
                                /*foreach ($statsunitkerja6 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;*/
                                foreach ($statsunitkerja7 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja8 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja9 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja10 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja11 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja12 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                /*foreach ($statsunitkerja13 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;*/
                                /*foreach ($statsunitkerja14 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;*/
                                /*foreach ($statsunitkerja15 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;*/
                                /*foreach ($statsunitkerja16 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;*/
                                /*foreach ($statsunitkerja17 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;*/
                                foreach ($statsunitkerja18 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja19 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja20 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja21 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja22 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerja23 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsunitkerjalast as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;  
                              ?>
                                
                              ],
                              backgroundColor: [
                                '#bc4b4b',
                              '#78c633',
                              '#1ac9ed',
                              '#f94f82',
                            	'#009dff',
                            	'#21ff84',
                            	'#edde3b',
                            	'#ca2aea',
	                            '#ff9900',
	                            '#f44ef2',
                              '#2d49ed',
                              '#33e8b1',
                              '#68d32e',
                              '#1a60a3',
                              '#ffc96d',
                              '#b2ff00',
                              '#1ff2d6',
                              '#dd8949',
                              '#8556ea',
                              '#ed2191',
                              '#f49c84'
                                ],
                            
                              borderWidth: 1
                            }]
                          },
                          options: {
                            legend : {
                              position: 'bottom'
                            },
                            title:{
                              display:true,
                              text: 'KLASIFIKASI ORDER PER UNIT KERJA PERIODE <?php echo $labeltglawal;?> HINGGA <?php echo $labeltglakhir; ?>',
                              padding : 30
                            },
                            scales: {
                              xAxes: [{
                                ticks: {
                                  beginAtZero:true,
                                  userCallback: function(label, index, labels) {
                                    if (Math.floor(label) === label) {
                                    return label;
                                      }
                                    },
                                    }
                                  }]
                                },plugins:{labels: {
                                    render: 'value',
                                  }
                              }
                              }
                            });
                </script>
                    </div>
                  <!-- /Statistik Unit Kerja -->
                  
                  <!-- Statistik Alasan Peminjaman -->
                  
                  <div class="row" <?php if($laporan == null){echo "hidden";} ?>>
                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title"><button id="savealasanchart" class="btn btn-success btn-sm">Download Grafik</button></h4>
                  <canvas id="alasanChart"></canvas>
                </div>
              </div>
            </div>
                  <script>
		                  var ctx = document.getElementById("alasanChart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'bar',
			                  data: {
				                labels: ["Dinas Dalam Kota","Dinas Luar Kota","Pribadi"],
				                datasets: [{
                          label: 'Jumlah Order',
				              	    data: [
                              
                            <?php                         
                                foreach ($statsalasanpinjam1 as $ap1) :        
                                  echo '"'.$ap1['jmlord'].'",';                              
                                endforeach; 
                                foreach ($statsalasanpinjam2 as $ap2) :        
                                  echo '"'.$ap2['jmlord'].'",';                              
                                endforeach;
                                foreach ($statsalasanpinjam3 as $ap3) :        
                                  echo '"'.$ap3['jmlord'].'",';                              
                                endforeach;
                              ?>
                                
                              ],
                              backgroundColor: [
                                '#bc4b4b',
                              '#78c633',
                              '#1ac9ed',
                              '#f94f82',
                            	'#009dff',
                            	'#21ff84',
                            	'#edde3b',
                            	'#ca2aea',
	                            '#ff9900',
	                            '#f44ef2',
                              '#2d49ed',
                              '#33e8b1',
                              '#68d32e',
                              '#1a60a3',
                              '#ffc96d',
                              '#b2ff00',
                              '#1ff2d6',
                              '#dd8949',
                              '#8556ea',
                              '#ed2191',
                              '#f49c84'
                                ],
                            
                              borderWidth: 1
                            }]
                          },
                          options: {
                            legend:{
                              position: 'bottom'
                            },
                            title:{
                              display:true,
                              text: 'KLASIFIKASI ORDER ALASAN PINJAM PERIODE <?php echo $labeltglawal;?> HINGGA <?php echo $labeltglakhir; ?>',
                              padding: 30
                            },
                            scales: {
                              yAxes: [{
                                ticks: {
                                  beginAtZero:true,
                                  userCallback: function(label, index, labels) {
                                    if (Math.floor(label) === label) {
                                    return label;
                                      }
                                    },
                                    }
                                  }]
                                },plugins:{labels: {
                                    render: 'value',
                                  }
                              }
                              }
                            });
                </script>
                    </div>

                  <!-- Statistik Order Per Bulan -->
                  <div class="row" <?php if($laporan == null){echo "hidden";} ?>>
                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><button id="saveordertotalchart" class="btn btn-success btn-sm">Download Grafik</button></h4>
                  <canvas id="ordertotalChart"></canvas>
                </div>
              </div>
            </div>
                  <script>
		                  var ctx = document.getElementById("ordertotalChart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'bar',
			                  data: {
				                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
				                datasets: [{
					              label: 'Jumlah Order',
				              	    data: [
                                <?php echo $jml_order1; ?>,
                                <?php echo $jml_order2; ?>,
                                <?php echo $jml_order3; ?>,
                                <?php echo $jml_order4; ?>,
                                <?php echo $jml_order5; ?>,
                                <?php echo $jml_order6; ?>,
                                <?php echo $jml_order7; ?>,
                                <?php echo $jml_order8; ?>,
                                <?php echo $jml_order9; ?>,
                                <?php echo $jml_order10; ?>,
                                <?php echo $jml_order11; ?>,
                                <?php echo $jml_order12; ?>
                              ],
                              backgroundColor: [
                                '#bc4b4b',
                              '#78c633',
                              '#1ac9ed',
                              '#f94f82',
                            	'#009dff',
                            	'#21ff84',
                            	'#edde3b',
                            	'#ca2aea',
	                            '#ff9900',
	                            '#f44ef2',
                              '#2d49ed',
                              '#33e8b1',
                              '#68d32e',
                              '#1a60a3',
                              '#ffc96d',
                              '#b2ff00',
                              '#1ff2d6',
                              '#dd8949',
                              '#8556ea',
                              '#ed2191',
                              '#f49c84'
                                ],
                            
                              borderWidth: 1
                            }]
                          },
                          options: {
                            legend: {
                              position: 'bottom'
                            },
                            title:{
                              display: true,
                              text: 'JUMLAH ORDER PER BULAN TAHUN <?php echo date("Y"); ?>',
                              padding : 30
                            },
                            scales: {
                              yAxes: [{
                                ticks: {
                                  beginAtZero:true,
                                  userCallback: function(label, index, labels) {
                                    if (Math.floor(label) === label) {
                                    return label;
                                      }
                                    },
                                    }
                                  }]
                                },plugins:{labels: {
                                    render: 'value',
                                  }
                              }
                              }
                            });
                </script>
                    </div>
                    <!-- /Statistik Order Per Bulan -->
                </div>
              </div>
            </div>

          </div>
          
                    
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php $this->load->view('admin/_partials/footer'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- Include JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
  <script>
  // background untuk chart yang didownload
var backgroundColor = 'white';
Chart.plugins.register({
    beforeDraw: function(c) {
        var ctx = c.chart.ctx;
        ctx.fillStyle = backgroundColor;
        ctx.fillRect(0, 0, c.chart.width, c.chart.height);
    }
});

// save chart supir 
$('#savesupirchart').click(function() {
    var canvas = $('#supirChart').get(0);
    canvas.toBlob(function(blob) {
        saveAs(blob, "chart order supir.png");
    });
});

// save chart kendaraan 
$('#savekendaraanchart').click(function() {
    var canvas = $('#kendaraanChart').get(0);
    canvas.toBlob(function(blob) {
        saveAs(blob, "chart order kendaraan.png");
    });
});

// save chart km kendaraan 
$('#savekmkendaraanchart').click(function() {
    var canvas = $('#kmkendaraanChart').get(0);
    canvas.toBlob(function(blob) {
        saveAs(blob, "chart km kendaraan.png");
    });
});

// save chart km supir
$('#savekmsupirchart').click(function() {
    var canvas = $('#kmsupirChart').get(0);
    canvas.toBlob(function(blob) {
        saveAs(blob, "chart km supir.png");
    });
});

// save chart unit kerja
$('#saveunitkerjachart').click(function() {
    var canvas = $('#unitkerjaChart').get(0);
    canvas.toBlob(function(blob) {
        saveAs(blob, "chart unit kerja.png");
    });
});

// save chart alasan
$('#savealasanchart').click(function() {
    var canvas = $('#alasanChart').get(0);
    canvas.toBlob(function(blob) {
        saveAs(blob, "chart alasan.png");
    });
});

// save chart ordertotal
$('#saveordertotalchart').click(function() {
    var canvas = $('#ordertotalChart').get(0);
    canvas.toBlob(function(blob) {
        saveAs(blob, "chart ordertotal.png");
    });
});

</script>
  <?php $this->load->view('admin/_partials/js'); ?>
  
</body>

</html>

