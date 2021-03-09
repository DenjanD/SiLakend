<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>

<?php
       $this->session->set_userdata('halaman', 'dashboard');
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
                  <h4 class="font-weight-bold mb-0">Sistem Informasi Layanan Kendaraan | Dashboard</h4>
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
                  <h4 class="card-title">Order 7 hari ke depan</h4>
                  <!-- kolom search data     
                  <?php echo form_open('admin/riwayat/cari'); ?>
                    <div class="row">
                      <div class="col-lg-10 col-md-10 col-xs-10 col-10">
                          <input type="text" class="form-control" id="myInputTextField" placeholder="Cari data di sini" name="keyword" aria-label="search" aria-describedby="search">       
                      </div>
                      <div class="col-lg-1 col-md-1 col-xs-1 col-1">
                          <button class="btn btn-inverse-primary for inverse buttons btn-md" name="buttcari" style="margin-left:-30px;">Cari</button>
                      </div>
                    </div>
                  <?php echo form_close(); ?> -->  
                  <p class="card-description">
                    
                  </p>
                  <div class="table-responsive">
                  <table id="tabelorder" class="table table-bordered">
                  <thead>
                <tr class="table-primary">
                  <th>Tanggal Pinjam</th>
                  <th>Nama Peminjam</th>
                  <th>Kendaraan</th>
                  <th>Dari</th>
                  <th>Ke</th>
                  <th>Pengemudi</th>
                
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orderan as $ord) : ?>
        
                  <tr>
                      <td><?php echo $ord['tgl_pinjam'];?></td>
                      <td><?php echo $ord['NAMA'];?></td>
                      <td><?php echo $ord['id_kendaraan']." - ".$ord['nama_kendaraan'];?></td>
                      <td><?php echo $ord['dari'];?></td>
                      <td><?php echo $ord['ke'];?></td>
                      <td><?php echo $ord['supir'];?></td>
                      
                        
                  </tr>           
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Jumlah Order Kendaraan Tahun <?php echo date("Y"); ?></h4>
                <canvas id="kmkendChart"></canvas>
                     <!-- Statistik Km Kendaraan Terbanyak -->
                  
                  <script>
		                  var ctx = document.getElementById("kmkendChart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'pie',
			                  data: {
				                labels: [

                          <?php 
                              foreach ($labelkend2 as $kmsprl) :
                                echo '"'.$kmsprl['idkend']." - ".$kmsprl['namakend'].'",';
                              endforeach;
                            ?>
                          
                          ],
				                datasets: [{
					              label: 'Jumlah Kilometer (Km)',
				              	    data: [
                              
                            <?php                         
                                foreach ($statskend2 as $kmspr) :        
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
                            plugins:{
                              labels:{
                                render: 'value',
                                fontSize: 14,
                                fontColor: '#000',
                                fontFamily: '"Tw Cen MT"',
                                position: 'outside',
                                arc: true,
                              }
                            }
                            
                              }
                            });
                </script>
                    </div>
                 
                </div>          
              </div>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Jumlah Kilometer Tempuh Kendaraan Tahun <?php echo date("Y"); ?></h4>
                <canvas id="kmkend2Chart"></canvas>
                     <!-- Statistik Km Kendaraan Terbanyak -->
                  
                  <script>
		                  var ctx = document.getElementById("kmkend2Chart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'pie',
			                  data: {
				                labels: [

                          <?php 
                              foreach ($labelkend as $kmsprl) :
                                echo '"'.$kmsprl['idkend']." - ".$kmsprl['namakend'].'",';
                              endforeach;
                            ?>
                          
                          ],
				                datasets: [{
					              label: 'Jumlah Kilometer (Km)',
				              	    data: [
                              
                            <?php                         
                                foreach ($statskend as $kmspr) :        
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
                            plugins:{
                              labels:{
                                render: 'value',
                                fontSize: 14,
                                fontColor: '#000',
                                fontFamily: '"Tw Cen MT"',
                                position: 'outside',
                                arc: true,
                              }
                            }
                            
                              }
                            });
                </script>
                    </div>
                 
                </div>          
              </div>
            </div>
            <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">JUMLAH ORDER SUPIR Tahun <?php echo date("Y"); ?></h4>
                <canvas id="supirChart"></canvas>
                     <!-- Statistik Tugas Supir Terbanyak -->
                  
                  <script>
		                  var ctx = document.getElementById("supirChart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'pie',
			                  data: {
				                labels: [

                          <?php 
                              foreach ($labelsupir as $kmsprl) :
                                echo '"'.$kmsprl['namasupir'].'",';
                              endforeach;
                            ?>
                          
                          ],
				                datasets: [{
					              label: 'Jumlah Kilometer (Km)',
				              	    data: [
                              
                            <?php                         
                                foreach ($statssupir as $kmspr) :        
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
                            plugins:{
                              labels:{
                                render: 'value',
                                fontSize: 12,
                                fontColor: '#000',
                                fontFamily: '"Tw Cen MT"',
                                position: 'outside',
                                arc: true,
                              }
                            }
                            
                              }
                            });
                </script>
                 
                </div>          
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">JUMLAH KILOMETER TEMPUH SUPIR Tahun <?php echo date("Y"); ?></h4>
                <canvas id="supir2Chart"></canvas>
                     <!-- Statistik Tugas Supir Terbanyak -->
                  
                  <script>
		                  var ctx = document.getElementById("supir2Chart").getContext('2d');
		                  var myChart = new Chart(ctx, {
			                  type: 'pie',
			                  data: {
				                labels: [

                          <?php 
                              foreach ($labelsupir2 as $kmsprl) :
                                echo '"'.$kmsprl['namasupir'].'",';
                              endforeach;
                            ?>
                          
                          ],
				                datasets: [{
					              label: 'Jumlah Kilometer (Km)',
				              	    data: [
                              
                            <?php                         
                                foreach ($statssupir2 as $kmspr) :        
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
                            plugins:{
                              labels:{
                                render: 'value',
                                fontSize: 12,
                                fontColor: '#000',
                                fontFamily: '"Tw Cen MT"',
                                position: 'outside',
                                arc: true,
                              }
                            }
                            
                              }
                            });
                </script>
                 
                </div>          
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">JUMLAH ORDER PER UNIT KERJA Tahun <?php echo date("Y"); ?></h4>
                <canvas id="unit1Chart"></canvas>
                     <!-- Statistik Tugas Supir Terbanyak -->
                  
                  <script>
		                  var ctx = document.getElementById("unit1Chart").getContext('2d');
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
                        "UPT. Puskomedia"               
                          ],
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
                            legend:{
                              position: 'bottom',
                              labels: {
                              boxWidth: 0,
                            }
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
                                },
                            plugins:{
                              labels:{
                                render: 'value',
                                fontSize: 12,
                                fontColor: '#000',
                                fontFamily: '"Tw Cen MT"',
                                position: 'outside',
                                arc: true,
                              }
                            }
                            
                              }
                            });
                </script>
                 
                </div>          
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">JUMLAH KILOMETER ORDER PER UNIT KERJA Tahun <?php echo date("Y"); ?></h4>
                <canvas id="unitkmChart"></canvas>
                     <!-- Statistik Tugas Supir Terbanyak -->
                  
                  <script>
		                  var ctx = document.getElementById("unitkmChart").getContext('2d');
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
                        "UPT. Puskomedia"               
                          ],
				                datasets: [{
					              label: 'Jumlah Tempuh Kilometer (Km)',
				              	    data: [
                              
                              <?php                         
                                foreach ($statskmunitkerja1 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;  
                                foreach ($statskmunitkerja2 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja3 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja4 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                /*foreach ($statsunitkerja5 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;*/
                                /*foreach ($statsunitkerja6 as $uk) :        
                                  echo '"'.$uk['jmlord'].'",';                              
                                endforeach;*/
                                foreach ($statskmunitkerja7 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja8 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja9 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja10 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja11 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja12 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
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
                                foreach ($statskmunitkerja18 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja19 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja20 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja21 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja22 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerja23 as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
                                endforeach;
                                foreach ($statskmunitkerjalast as $uk) :        
                                  echo '"'.$uk['jmlkm'].'",';                              
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
                              position: 'bottom',
                              labels: {
                              boxWidth: 0,
                            }
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
                                },
                            plugins:{
                              labels:{
                                render: 'value',
                                fontSize: 12,
                                fontColor: '#000',
                                fontFamily: '"Tw Cen MT"',
                                position: 'outside',
                                arc: true,
                              }
                            }
                            
                              }
                            });
                </script>
                 
                </div>          
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
  <?php $this->load->view('admin/_partials/js'); ?>
  
</body>

</html>

