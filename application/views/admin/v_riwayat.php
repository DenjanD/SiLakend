<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>
<?php
       $this->session->set_userdata('halaman', 'riwayat');
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
                  <h4 class="font-weight-bold mb-0">Riwayat Order Peminjaman Kendaraan</h4>
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
                  <h4 class="card-title">Riwayat Seluruh Order Peminjaman</h4>
                  <!-- kolom search data -->       
                  <?php echo form_open('admin/riwayat/cari'); ?>
                    <div class="row">
                      <div class="col-lg-10 col-md-10 col-xs-10 col-10">
                          <input type="text" class="form-control" id="myInputTextField" placeholder="Cari data di sini" name="keyword" aria-label="search" aria-describedby="search">       
                      </div>
                      <div class="col-lg-1 col-md-1 col-xs-1 col-1">
                          <button class="btn btn-inverse-primary for inverse buttons btn-md" name="buttcari" style="margin-left:-30px;">Cari</button>
                      </div>
                    </div>
                  <?php echo form_close(); ?>
                  <p class="card-description">
                    
                  </p>
                  <div class="table-responsive">
                  <table id="tabelorder" class="table table-bordered table-hover">
                  <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Kembali</th>
                  <th>Nama Peminjam</th>
                  <th>Alasan Peminjaman</th>
                  <th>Dari</th>
                  <th>Ke</th>               
                  <th>Waktu Kembali</th>
                  <th>Keterangan</th>
                  <th>Supir</th>
                  <th>Kendaraan</th>
                  <th>Status</th>  
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; foreach ($orderan as $ord) : $no++;?>
        
                  <tr>
                      <td><?php cetak($no) ;?></td>
                      <td><?php cetak($ord['tgl_pinjam']) ;?></td>
                      <td><?php cetak($ord['tgl_kembali']) ;?></td>
                      <td><?php cetak($ord['Nama_Peminjam']) ;?></td>
                      <td><?php cetak($ord['alasan_pinjam']) ;?></td>
                      <td><?php cetak($ord['dari']) ;?></td>
                      <td><?php cetak($ord['ke']) ;?></td>
                      <td><?php cetak($ord['waktu_kembali']) ;?></td>
                      <td><?php cetak($ord['keterangan']) ;?></td>
                      <td><?php cetak($ord['Supir']) ;?></td>
                      <td><?php cetak($ord['id_kendaraan']." - ".$ord['Kendaraan']) ;?></td>
                      <td>   
                            <?php 
                                  if($ord['status'] == 'Ditolak' OR $ord['status'] == 'Dibatalkan'){
                                    echo "<label class='badge badge-danger'>";
                                  }
                                 else if($ord['status'] == 'Diajukan'){
                                   echo "<label class='badge badge-warning'>";
                                 }
                                 else if($ord['status'] == 'Diterima'){
                                   echo "<label class='badge badge-primary'>";
                                 }
                                 else if($ord['status'] == 'Selesai'){
                                   echo "<label class='badge badge-success'>";
                                 }
                                 else if($ord['status'] == 'Berangkat'){
                                   echo "<label class='badge badge-primary'>";
                                 }
                                 else{
                                    echo "<label class='badge badge-secondary'>";
                                  }
                                  echo $ord['status']."</label>";
                            ?>
                      </td>
                        
                  </tr>           
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
              <div class="row">
                    <div class="col">
                        <!--Tampilkan pagination-->
                          <?php if($statuscari != '1'){
                            echo $pagination;
                          }  ?>
                   </div>
              </div>
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
  <script>
$(function () {
    $('#tabelorder').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
  <?php $this->load->view('admin/_partials/js'); ?>
  
</body>

</html>

