<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>
<?php
       $this->session->set_userdata('halaman', 'tugass');
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
                  <h4 class="font-weight-bold mb-0">Tugas Masuk Supir</h4>
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
                  <h4 class="card-title">DAFTAR TUGAS</h4>
                  <p class="card-description">
                    
                  </p>
                  <div class="table-responsive">
                  <table id="tabelorder" class="table table-bordered table-hover">
                  <thead>
                <tr>
                  <th>Nama Peminjam</th>
                  <th>Asal Berangkat (Dari)</th>
                  <th>Tujuan (Ke)</th>
                  <th>Tgl Berangkat</th>
                  <th>Detail Tugas</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tugass as $tgs) : ?>
                  <?php $idmodal = "a".$tgs['id_peminjaman']; ?>
                  <tr>
                      <td><?php cetak($tgs['NAMA']) ;?></td>
                      <td><?php cetak($tgs['dari']) ;?></td>
                      <td><?php cetak($tgs['ke']) ;?></td>
                      <td><?php cetak($tgs['tgl_pinjam']) ;?></td>
                      <td><a data-toggle="modal" data-target="#<?php cetak($idmodal) ; ?>" class="badge badge-primary"><i class="ti ti-menu-alt" style="color:white;"></i></a></td>
                  </tr>           
                  <!-- Modal Detail Tugas -->   
                  <div class="modal fade" id="<?php cetak($idmodal) ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">     
              <h4 class="modal-title" id="myModalLabel">Detail Tugas Supir</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/supirberangkat'; ?>" method="post">
                <div class="form-group">
                    <input readonly="readonly" type="hidden" class="form-control" name="inidorder" value="<?php cetak($tgs['id_peminjaman']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Nama Peminjam</label>
                    <input readonly="readonly" type="text" class="form-control" name="innamapem" value="<?php cetak($tgs['NAMA']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Asal Berangkat</label>
                    <input readonly="readonly" type="text" class="form-control" name="indari" value="<?php cetak($tgs['dari']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Tujuan</label>
                    <input readonly="readonly" type="text" class="form-control" name="inke" value="<?php cetak($tgs['ke']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Tanggal berangkat</label>
                    <input readonly="readonly" type="date" class="form-control" name="intglber" value="<?php cetak($tgs['tgl_pinjam']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Waktu Berangkat</label>
                    <input readonly="readonly" type="time" class="form-control" name="inwaktuber" value="<?php cetak($tgs['waktu_berangkat']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Lama Pinjam (Hari)</label>
                    <input readonly="readonly" type="number" class="form-control" name="inlamapin" value="<?php cetak($tgs['lama_pinjam']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input readonly="readonly" type="text" class="form-control" name="inasal" value="<?php cetak($tgs['keterangan']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Kendaraan yang digunakan</label>
                    <input type="hidden" name="idkendnya" value="<?php cetak($tgs['kendaraan']) ; ?>">
                    <input readonly="readonly" type="text" class="form-control" name="inkendnya" value="<?php cetak($tgs['kendaraan']." - ".$tgs['nama_kendaraan']) ; ?>">
                    <br><div align="right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <input type="submit" class="btn btn-primary" value="Laksanakan Keberangkatan" name="buttlaksana">
                  </div>
                  </div>        
            </div>
            </div>
            <div class="modal-footer">
              
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal DETAIL Tugas -->
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

