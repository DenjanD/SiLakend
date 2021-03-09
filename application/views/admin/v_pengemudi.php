<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>
<?php
       $this->session->set_userdata('halaman', 'pengemudi');
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
                  <h4 class="font-weight-bold mb-0">Pengemudi Kendaraan Dinas</h4>
                </div>
                <div>
                <?php if($this->session->userdata('status')=='Administrator'){?>
                <button class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#modaltambahpengemudi"><i class="ti ti-plus"></i>&nbsp;Tambah Pengemudi</button>
                <?php }?>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal TAMBAH pengemudi -->
      <div class="modal fade" id="modaltambahpengemudi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Tambah Data Pengemudi Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/tambahpengemudi'; ?>" method="post" onsubmit="return cekpengemudi();">
                <div class="form-group">
                    <label>Nama Pengemudi</label>
                    <select class="form-control" id="innamapmd" name="innamapmd" onclick="autofill()">
                    <option>---Silakan Pilih Nama Pegawai---</option>
                      <?php foreach ($masterpegawai as $mst) : ?>
                          <?php echo "<option>".$mst['NAMA']."</option>"; ?>
                      <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kode Pengemudi</label>
                    <input type="text" class="form-control" name="inidpmd" id="inidpmd" readonly="readonly">
                    
                    <!-- AJAX mengambil id pegawai saat select pegawai diklik -->
                    <script type="text/javascript"> 
                      function autofill(){
                      var id = document.getElementById('innamapmd').value;
                      $.ajax({
                       url:"<?php echo base_url('index.php/admin/pengemudi/cari');?>",
                       data:'&id='+id,
                       success:function(data){
                           var hasil = JSON.parse(data);  								
			                     $.each(hasil, function(key,val){ 
                 
                             document.getElementById('inidpmd').value=val.ID;          
                  });               
			                      }
                              });
                              }
                </script>
                    <!-- /AJAX -->
                    <!-- Tambahan PS -->
                        <script>
                          function cekpengemudi(){
                            var peng = document.getElementById("innamapmd").value;
                            if(peng == "---Silakan Pilih Nama Pegawai---"){
                              swal("Peringatan","Anda belum memilih nama pengemudi","warning");
                              return false;
                            }
                            else{
                              return true;
                            }
                          }
                        </script>
                    <!-- /Tambahan PS -->
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <input type="submit" class="btn btn-primary" value="Simpan Data" name="buttpengemudibaru">
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Modal TAMBAH pengemudi -->
          <!-- Tampilan Tabel Order -->
          <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Pengemudi</h4>
                  <!-- kolom search data -->       
                  <?php echo form_open('admin/pengemudi/caridata'); ?>
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
                  <th>Kode Pengemudi</th>
                  <th>Nama Pengemudi</th>
                  <th>Status</th>
                  <?php if($this->session->userdata('status')=='Administrator'){?>
                  <th>Hapus Data</th>
                  <?php } ?>
                  
                </tr>
                </thead>
                <tbody>
                  
                <?php $no = 0; foreach ($pengemudi as $pmd) : $no++;?>
                <?php if($pmd['NAMA'] == "Membawa Sendiri"){continue;} ?>
                  <?php $idmodal = "a".$pmd['ID']; ?>
                  <tr>
                      <td><?php cetak($no) ;?></td> 
                      <td><?php cetak($pmd['ID']) ;?></td>
                      <td><?php cetak($pmd['NAMA']) ;?></td>
                      <td>
                          <?php 
                              if($pmd['STATUS'] == 'Tidak Bertugas'){
                                echo "<label class='badge badge-success'>";
                              }
                              else{
                                echo "<label class='badge badge-danger'>";
                              }
                              echo $pmd['STATUS']."</label>";
                          ?>
                      </td>
                      <?php if($this->session->userdata('status')=='Administrator'){?>
                      <td>
                          <?php if($pmd['STATUS'] != "Bertugas"){ ?>
                           <a onclick="deleteConfirm('<?php echo base_url('index.php/admin/hapuspengemudi/'.$pmd['ID']); ?>')" class="badge badge-danger" name="butthapus"><i class="ti ti-trash" style="color:white;"></i></a>
                          <?php } ?>
                      </td>
                      <?php }?>
                  </tr>
                  <!-- Modal EDIT pengemudi -->
      <div class="modal fade" id="<?php cetak($idmodal) ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Ubah Data Pengemudi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/editpengemudi'; ?>" method="post">
                <div class="form-group">
                    <label>Kode Pengemudi</label>
                    <input type="text" class="form-control" name="inidpmd" value="<?php cetak($pmd['ID']) ; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Nama Baru Pengemudi</label>
                    <input type="text" class="form-control" name="innamapmd" value="<?php cetak($pmd['NAMA']) ; ?>">
                </div>
       
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <input type="submit" class="btn btn-primary" value="Simpan Data" name="buttpengemudibaru">
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Modal EDIT pengemudi -->

                      
                <?php endforeach; ?>
                
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
              <script>
              function deleteConfirm(url){
	$('#btn-delete').attr('href', url);
	$('#deleteModal').modal();
}
</script>
              <!--Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin menghapus?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Tidak</button>
        <a id="btn-delete" class="btn btn-secondary" href="#">Ya</a>
      </div>
    </div>
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

