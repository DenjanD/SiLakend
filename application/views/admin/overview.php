<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>
<?php
       $this->session->set_userdata('halaman', 'user');
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
                  <h4 class="font-weight-bold mb-0">Data Pengguna Aplikasi</h4>
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
                  <h4 class="card-title">DATA USER</h4>
                  <!-- kolom search data -->       
                  <?php echo form_open('admin/overview/cari'); ?>
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
                  <th>User_Id</th>
                  <th>Nama</th>
                  <th>Level User</th>
                  <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; foreach ($user as $usr) :  $no++;?>
                  <?php $idmodal = "a".$usr['user_id']; ?>
                  <tr>
                    
                      <td><?php cetak($usr['user_id']) ;?></td>
                      <td><?php cetak($usr['nama']) ;?></td>
                      <td><?php cetak($usr['nama_level']) ;?></td>
                      <td>
                      <?php 
                            if($usr['nama_level'] == "Administrator"){
                                echo "";
                            }
                            else{
                      ?>
                        <a data-toggle="modal" data-target="#<?php echo $idmodal; ?>" class="badge badge-success"><i class="ti ti-marker-alt"></i></a>
                            <?php } ?>
                      </td>
                      <!--<td>
                          <?php 
                          if($usr['nama_level'] == "Administrator"){
                            echo "";
                          }
                          else{
                            //echo "<a onclick=\"deleteConfirm('".base_url('index.php/admin/hapususer/'.$usr['user_id'])."')\" class='badge badge-danger' name='butthapus'><i class='ti ti-trash'></i></a>";
                          }
                          
                          ?>
                      
                      </td>-->
                  </tr>
                  <!-- Modal EDIT user -->
      <div class="modal fade" id="<?php cetak($idmodal) ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Ubah Data User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/edituser'; ?>" method="post" onsubmit="return ceknama();">
                <div class="form-group">
                    <label>User Id</label>
                    <input type="text" class="form-control" name="iniduser" value="<?php cetak($usr['user_id']) ; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Nama User Baru</label>
                    <input type="text" class="form-control" id="kolnam" name="innamauser" value="<?php cetak($usr['nama']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Password User Baru</label>
                    <input type="text" class="form-control" name="inpassuser" placeholder="Bisa diisi dengan password baru">
                </div>
                <div class="form-group">
                    <label>Level User Baru</label>
                    <select class="form-control" name="pilihlevelbaru">
                          <option>---Silakan Pilih Level User---</option>
                      <?php foreach ($level as $lvl) : ?>
                          <?php if($lvl['nama_level'] == 'Administrator'){
                            continue;
                          } ?>
                        <option><?php cetak($lvl['level']." - ".$lvl['nama_level']) ; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
              <!-- Tambahan PS -->
                <script>
                  function ceknama(){
                      var nama = document.getElementById("kolnam").value;
                      if(nama == ""){
                          swal("Peringatan","Kolom Nama User tidak boleh kosong!","warning");
                          return false;
                      }
                      else{
                          return true;
                      }
                  }
                </script>
              <!-- /Tambahan PS -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <input type="submit" class="btn btn-primary" value="Simpan Data" name="buttmobilbaru">
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Modal TAMBAH user -->

                      
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
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
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
  <?php $this->load->view('admin/_partials/js'); ?>
  <script>
$(function () {
    $('#tabelordesr').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true
    })
  })
</script>
  
  
</body>

</html>

