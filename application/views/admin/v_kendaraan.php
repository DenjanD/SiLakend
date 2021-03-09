<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>
<?php
       $this->session->set_userdata('halaman', 'mobil');
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
                  <h4 class="font-weight-bold mb-0">Daftar Kendaraan Dinas Polman</h4>
                </div>
                <div>
                <?php if($this->session->userdata('status')=='Administrator'){?>
                    <button type="button" class="btn btn-primary btn-icon-text btn-rounded" data-toggle="modal" data-target="#modaltambahkendaraan">
                      <i class="ti-plus btn-icon-prepend"></i>Tambah Kendaraan
                    </button>
                <?php }?>
                    <!-- Modal TAMBAH kendaraan -->
      <div class="modal fade" id="modaltambahkendaraan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Tambah Data Kendaraan Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/tambahkendaraan'; ?>" method="post" onsubmit="return cekinput();">
                <div class="form-group">
                    <label>Kode Kendaraan</label>
                    <input type="text" class="form-control" name="inidkend" value="<?php cetak($kodekendaraan) ; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <input type="text" class="form-control" name="innamakend" id="namakend">
                </div>
                <div class="form-group">
                    <label>Jenis Kendaraan</label>
                    <select class="form-control" id="seljenis" name="injeniskend">
                      <option>SUV</option>
                      <option>Sedan</option>
                      <option>MPV</option>
                      <option>Minibus</option>
                      <option>Truck</option>
                      <option>Sepeda Motor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun Pembuatan</label>
                    <input type="text" class="form-control" name="inthnkend" id="thnkend">
                </div>
                <div class="form-group">
                    <label>No. Polisi</label>
                    <input type="text" class="form-control" name="innopolkend" id="nopolkend">
                </div>
                <div class="form-group">
                    <label>Tanggal Pajak STNK Tahunan</label>
                    <input type="date" class="form-control" name="intglpajak" id="pajakkend">
                </div>
                <div class="form-group">
                    <label>Tanggal Masa Berlaku STNK</label>
                    <input type="date" class="form-control" name="intglberlaku" id="stnkkend">
                </div>
                <div class="form-group">
                    <label>Jumlah Kilometer Tempuh Kendaraan</label>
                    <input type="number" class="form-control" name="inkmkend" placeholder="Dalam satuan KM" id="kmkend">
                </div>    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <input type="submit" class="btn btn-primary" value="Simpan Data" name="buttmobilbaru">
            </div>
            </form>
          </div>
          <!-- Tambahan PS -->
              <script>
                function cekinput(){
                  var namakend = document.getElementById("namakend").value;
                  var thnkend = document.getElementById("thnkend").value;
                  var nopol = document.getElementById("nopolkend").value;
                  var pajak = document.getElementById("pajakkend").value;
                  var stnk = document.getElementById("stnkkend").value;
                  var km = document.getElementById("kmkend").value;

                  if(namakend == ""){
                    swal("Peringatan","Nama Kendaraan belum diisi!","warning");
                    return false;
                  }
                  else if(thnkend == ""){
                    swal("Peringatan","Tahun Pembuatan Kendaraan belum diisi!","warning");
                    return false;
                  }
                  else if(nopol == ""){
                    swal("Peringatan","Nomor Polisi belum diisi!","warning");
                    return false; 
                  }
                  else if(pajak == "dd/mm/yyyy"){
                    swal("Peringatan","Tanggal Pajak belum diisi!","warning");
                    return false;  
                  }
                  else if(stnk == "dd/mm/yyyy"){
                    swal("Peringatan","Tanggal Masa Berlaku STNK belum diisi!","warning");
                    return false;
                  }
                  else if(km == ""){
                    swal("Peringatan","Jumlah Kilometer belum diisi!","warning");
                    return false;
                  }
                  else{
                    return true
                  }
                }
              </script>
          <!-- /Tambahan PS -->
        </div>
      </div>
      <!-- /Modal TAMBAH kendaraan -->
                </div>
              </div>
            </div>
          </div>
          <!-- Tampilan Tabel Order -->
          <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Kendaraan</h4>
                  <!-- kolom search data -->       
                  <?php echo form_open('admin/kendaraan/cari'); ?>
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
                  <th>Kode Kendaraan</th>
                  <th>Nama Kendaraan</th>
                  <th>No Polisi</th>
                  <th>Jumlah Kilometer Tempuh</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <?php if($this->session->userdata('status')=='Administrator'){?>
                  <th>Hapus</th>
                  <?php }?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($kendaraan as $kend) : ?>
        
                  <tr>
                      <td><?php cetak($kend['id_kendaraan']) ;?></td>
                      <td><?php cetak($kend['nama_kendaraan']) ;?></td>
                      <td><?php cetak($kend['no_polisi']) ;?></td>
                      <td><?php cetak($kend['jumlah_km']." km") ;?></td>
                      <td>
                            <?php
                                  if($kend['status'] == 'Tersedia'){
                                    echo "<label class='badge badge-success'>";
                                  }
                                  else{
                                    echo "<badge class='badge badge-danger'>";
                                  }
                                  echo $kend['status']."</badge>"; 
                            ?>
                      </td>
                      <td><a data-toggle="modal" data-target="#<?php cetak($kend['id_kendaraan']) ; ?>" class="badge badge-info"><i class="ti ti-pencil" style="color:white;"></i></a></td>
                      <?php if($this->session->userdata('status')=='Administrator'){?>
                      <td>
                          <?php if($kend['status'] != "Tidak Tersedia"){ ?>
                            <a onclick="deleteConfirm('<?php echo base_url('index.php/admin/hapuskendaraan/'.$kend['id_kendaraan']); ?>')" class="badge badge-danger" name="butthapus"><i class="ti ti-trash" style="color:white;"></i></a>
                          <?php } ?>
                      </td>
                      <?php }?>
                  </tr>
                  <!-- Modal EDIT kendaraan -->
      <div class="modal fade" id="<?php cetak($kend['id_kendaraan']) ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Ubah Data Kendaraan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/editkendaraan'; ?>" method="post">
                <div class="form-group">
                    <label>Kode Kendaraan</label>
                    <input type="text" class="form-control" name="inidkend" value="<?php cetak($kend['id_kendaraan']) ; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Nama Baru Kendaraan</label>
                    <input type="text" class="form-control" name="innamakend" value="<?php cetak($kend['nama_kendaraan']);?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Jenis Kendaraan</label>
                    <select class="form-control" id="seljenis" name="injeniskend" disabled>
                      <?php
                        if($kend['jenis_kendaraan'] == "SUV"){
                          echo "
                          <option selected>SUV</option>
                          <option>Sedan</option>
                          <option>MPV</option>
                          <option>Minibus</option>
                          <option>Truck</option>
                          <option>Sepeda Motor</option>                         
                          ";
                        }
                        if($kend['jenis_kendaraan'] == "SEDAN"){
                          echo "
                          <option>SUV</option>
                          <option selected>Sedan</option>
                          <option>MPV</option>
                          <option>Minibus</option>
                          <option>Truck</option>
                          <option>Sepeda Motor</option>                         
                          ";
                        }
                        if($kend['jenis_kendaraan'] == "MPV"){
                          echo "
                          <option>SUV</option>
                          <option>Sedan</option>
                          <option selected>MPV</option>
                          <option>Minibus</option>
                          <option>Truck</option>
                          <option>Sepeda Motor</option>                         
                          ";
                        }
                        if($kend['jenis_kendaraan'] == "MINIBUS"){
                          echo "
                          <option>SUV</option>
                          <option>Sedan</option>
                          <option>MPV</option>
                          <option selected>Minibus</option>
                          <option>Truck</option>
                          <option>Sepeda Motor</option>                         
                          ";
                        }
                        if($kend['jenis_kendaraan'] == "TRUCK"){
                          echo "
                          <option>SUV</option>
                          <option>Sedan</option>
                          <option>MPV</option>
                          <option>Minibus</option>
                          <option selected>Truck</option>
                          <option>Sepeda Motor</option>                         
                          ";
                        }
                        if($kend['jenis_kendaraan'] == "SEPEDA MOTOR"){
                          echo "
                          <option>SUV</option>
                          <option>Sedan</option>
                          <option>MPV</option>
                          <option>Minibus</option>
                          <option>Truck</option>
                          <option selected>Sepeda Motor</option>                         
                          ";
                        }                       
                      ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun Pembuatan</label>
                    <input type="text" class="form-control" name="inthnkend" value="<?php cetak($kend['thn_keluaran']) ; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>No. Polisi</label>
                    <input type="text" class="form-control" name="innopolkend" value="<?php cetak($kend['no_polisi']) ; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Tanggal Pajak STNK Tahunan</label>
                    <input type="date" class="form-control" name="intglpajak" value="<?php cetak($kend['tgl_pajak']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Tanggal Masa Berlaku STNK</label>
                    <input type="date" class="form-control" name="intglberlaku" value="<?php cetak($kend['tgl_masaberlaku']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Jumlah Kilometer Tempuh Kendaraan</label>
                    <input type="number" class="form-control" name="inkmkend" value="<?php cetak($kend['jumlah_km']) ; ?>" readonly="readonly">
                </div>    
       
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <input type="submit" class="btn btn-primary" value="Ubah Data" name="buttmobilbaru">
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Modal TAMBAH kendaraan -->

                      
                <?php endforeach; ?>
                
                </tbody>
                <tfoot>
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
        <h5 class="modal-title" id="exampleModalLabel">Menghapus data Kendaraan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Anda yakin ingin menghapus data kendaraan ini?</div>
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

