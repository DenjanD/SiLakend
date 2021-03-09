<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>
<?php
       $this->session->set_userdata('halaman', 'satpam');
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
    <h4 class="font-weight-bold mb-0"><?php if($this->session->userdata('status') == 'Administrator'){ echo "Edit Kilometer Kendaraan";}else{ ?>Input Kilometer Kendaraan<?php } ?></h4>
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
                  <h4 class="card-title">Daftar Order</h4>
                  <!-- kolom search data -->       
                  <?php echo form_open('admin/satpam/cari'); ?>
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
                  <th><?php if($this->session->userdata('status') == 'Administrator'){ echo "Edit Kilometer";}else{ ?>Input Kilometer Kendaraan<?php } ?></th>
                  <th>Kendaraan</th>
                  <th>Peminjam</th>
                 
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; $counter=1;foreach ($order as $ord) :  $no++;$counter++;?>
                <?php $idmodal = "a".$ord['id_peminjaman']; ?>
                  <tr>
                  <td><?php cetak($no) ;?></td>
                  <td><a data-toggle="modal" data-target="#<?php cetak($idmodal) ; ?>" class="badge badge-primary"><i class="ti ti-marker-alt" style="color:white;"></i></a></td>
                  <td><?php cetak($ord['kendaraan']." - ".$ord['nama_kendaraan']) ;?></td>
                  <td><?php cetak($ord['NAMA']) ;?></td>   
                  </tr>           
                  <!-- Modal Detail Order -->   
                  <div class="modal fade" id="<?php cetak($idmodal) ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Detail Order</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/satpaminput'; ?>" method="post" onsubmit="">
                <div class="form-group">
                    <input readonly="readonly" type="hidden" class="form-control" name="inidorder" value="<?php cetak($ord['id_peminjaman']) ; ?>">
                    <input readonly="readonly" type="hidden" class="form-control" name="inidsupir" value="<?php cetak($ord['supir']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Nama Peminjam</label>
                    <input readonly="readonly" type="text" class="form-control" name="innamapem" value="<?php cetak($ord['NAMA']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Asal Berangkat</label>
                    <input readonly="readonly" type="text" class="form-control" name="indari" value="<?php cetak($ord['dari']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Tujuan</label>
                    <input readonly="readonly" type="text" class="form-control" name="inke" value="<?php cetak($ord['ke']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Kendaraan yang digunakan</label>
                    <input type="hidden" name="idkendnya" value="<?php cetak($ord['kendaraan']) ; ?>">
                    <input readonly="readonly" type="text" class="form-control" name="inkendnya" value="<?php cetak($ord['kendaraan']) ; cetak(" - ") ; cetak($ord['nama_kendaraan']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Masukkan Jumlah Kilometer(Km) Kendaraan</label>
                    <input type="hidden" name="idkendnya" value="<?php cetak($ord['kendaraan']) ; ?>">
                    <input type="number" class="form-control" name="inkmpulang" id="<?php cetak("kolkm".$counter) ; ?>" placeholder="Contoh : 5000, 10500">
                    <br>
                    <div align="right">
                     <!-- Script pengecekan kolom yg masih kosong -->
                  <script>
                        function validasi_kosong(){
                            var km = document.getElementById('<?php cetak("kolkm".$counter) ; ?>');
                            
                                          if(harusDiisi(km, "Jumlah Kilometer belum diisi")){
                                              return true;
                                          };
                                      
                            return false;
                        }

                        function harusDiisi(att, msg){
                            if(att.value == ""){
                              alert(msg);
                              att.focus();
                              return false;
                            }
                            return true;
                        }                   

                  </script>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <input type="submit" class="btn btn-primary" value="Masukan Data" name="buttlaksana">
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
      <!-- /Modal DETAIL Order -->
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

