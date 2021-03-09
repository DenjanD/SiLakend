<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>
<?php
       $this->session->set_userdata('halaman', 'validasi');
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
                  <h4 class="font-weight-bold mb-0">Validasi Order Masuk</h4>
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
                  <h4 class="card-title">Silakan Validasi Order di bawah</h4>
                  <p class="card-description">
                    
                  </p>
                  <div class="table-responsive">
                  <table id="tabelorder" class="table table-bordered table-hover">
                  <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pengaju</th>
                  <th>Tanggal Pinjam</th>
                  <th>Alasan Peminjaman</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th>Rincian</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; foreach ($orderan as $ord) : $no++;?>
                  <?php 
                  $valsupir = $ord['supir'];
                  $valkend = $ord['kendaraan'];
                  if($this->session->userdata('status') == "Kepala Bagian Kepeg"){
                      if($ord['status'] == "Diteruskan" AND $ord['nama_level'] != "Sub Bagian Umum"){continue;} 
                  } 
                  $idlist = "a".$ord['id_peminjaman'];    
                  ?>
                  <tr>
                      <td><?php cetak($no) ;?></td>
                      <td><?php cetak($ord['NAMA']) ;?></td>
                      <td><?php cetak($ord['tgl_pin']) ;?></td>
                      <td><?php cetak($ord['alasan_pinjam']) ;?></td>
                      <td><?php cetak($ord['keterangan']) ;?></td>
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
                      <td>
                      
                      <a data-toggle="modal" data-target="#<?php cetak($idlist) ; ?>" class="badge badge-primary"><i class="ti ti-menu-alt" style="color:white;"></i></a>
    
      
                      </td>
                  </tr>        
                  <!-- Modal Detail Order -->   
                  <div class="modal fade" id="<?php cetak($idlist) ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">      
              <h4 class="modal-title" id="myModalLabel">Detail Order Peminjaman</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/validorder'; ?>" method="post">
            <div class="form-group">
                    <label hidden>id_peminjaman</label>
                    <input type="hidden" class="form-control" name="inidorder" value="<?php cetak($ord['id_peminjaman']) ; ?>">
                    <input type="hidden" class="form-control" name="instatusorder" value="<?php cetak($ord['status']) ; ?>">
                </div>
            <div class="form-group">
                    <label>Nama Pengaju Order</label>
                    <input type="text" class="form-control" name="innamaorder" value="<?php cetak($ord['NAMA']) ; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>No. Akun/Order</label>
                    <input type="text" class="form-control" name="innoorder" value="<?php cetak($ord['no_order']) ; ?>" <?php if($this->session->userdata('status') != "Kepala Bagian Kepeg" OR $this->session->userdata('status') != "Sub Bagian Umum" OR $this->session->userdata('status') != "Kepala Bagian"){echo "";} else{ echo"readonly='readonly'";} ?>>
                </div>
                <div class="row">
                <div class="form-group col-xs-6">
                    <label style="margin-left:12px;">Perjalanan</label>
                    <input style="margin-left:12px;" type="text" class="form-control" name="indari" placeholder="Dari" value="<?php cetak($ord['dari']) ; ?>" readonly="readonly">
                </div>
                <div class="form-group col-xs-6">
                    <label>Ke</label>
                    <input type="text" class="form-control" name="inke" placeholder="Ke" value="<?php cetak($ord['ke']) ; ?>" readonly="readonly">
                </div>
                </div>
                <div class="row">
                <div class="form-group col-xs-6">
                    <label style="margin-left:12px;">Tanggal Pinjam</label>
                    <input style="margin-left:12px;" type="text" class="form-control" name="intglpinjam" value="<?php cetak($ord['tgl_pin']) ; ?>" readonly="readonly">
                </div>
                <div class="form-group col-xs-6">
                <label>Lama Pinjam (Hari)</label><input type="number" class="form-control" name="inlamap" value="<?php cetak($ord['lama_pinjam']) ; ?>" readonly="readonly">
                </div>
                </div>
                <div class="form-group">
                    <label>Alasan Peminjaman</label>
                    <select class="form-control" id="selalasan" name="inalasanp" disabled>

                      <?php 
                      if($ord['alasan_pinjam'] == 'Dinas Dalam Kota'){
                        echo "
                        <option selected>Dinas Dalam Kota</option>
                        <option>Dinas Luar Kota</option>
                        <option>Pribadi</option>";
                      }
                      if($ord['alasan_pinjam'] == 'Dinas Luar Kota'){
                        echo "
                        <option>Dinas Dalam Kota</option>
                        <option selected>Dinas Luar Kota</option>
                        <option>Pribadi</option>";
                      } 
                      if($ord['alasan_pinjam'] == 'Pribadi'){
                        echo "
                        <option>Dinas Dalam Kota</option>
                        <option>Dinas Luar Kota</option>
                        <option selected>Pribadi</option>";
                      }   
                      ?>
                      
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Personil</label>
                    <input type="number" class="form-control" name="injmlp" value="<?php cetak($ord['jumlah_personil']) ; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="inket" readonly="readonly"><?php cetak($ord['keterangan']) ; ?></textarea>
                </div>
                <!-- Kolom rahasia : untuk mengecek apakah pengorder subbagum atau bukan -->
                <?php if($this->session->userdata('status') == 'Kepala Bagian Kepeg'){ ?>
                <input type="hidden" class="form-control" name="inlevelorder" value="<?php cetak($ord['nama_level']) ; ?>">
                <?php } ?>
                <?php if($this->session->userdata('status') == 'Sub Bagian Umum' OR $ord['nama_level'] == 'Sub Bagian Umum' OR $this->session->userdata('status') == 'Administrator'){ ?>
                <div class="form-group">
                    <label>Kendaraan yang dipinjamkan</label>
                    <select name="pilihkendaraan" class="form-control" id="kolkend">
                        <option disabled selected>---Silakan Pilih Kendaraannya---</option>
                        <?php foreach ($kendaraan as $knd) : ?>
                          <option><?php cetak($knd['id_kendaraan']) ; ?> - <?php cetak($knd['nama_kendaraan']) ; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Supir yang ditugaskan</label>
                    <select name="pilihsupir" class="form-control" id="kolsupir">
                        <option disabled selected>---Silakan Pilih Supirnya---</option>
                        <?php foreach ($supir as $spr) : ?>
                          <option><?php cetak($spr['ID']) ; ?> - <?php cetak($spr['NAMA']) ; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> 
                <?php } ?>   
                <div align="right">
                <!-- Script pengecekan kolom yg masih kosong -->
                <script>
                        function validasi_kosong(){
                            var kend = document.getElementById('kolkend');
                            var supir = document.getElementById('kolsupir');
                            
                                        if(harusDiisi(kend, "Kendaraan belum diisi")){
                                          if(harusDiisi2(supir, "Supir belum diisi")){
                                              return true;
                                          };
                                        };
                                      
                            return false;
                        }

                        function harusDiisi(att, msg){
                            if(att.value == "---Silakan Pilih Kendaraannya---"){
                              alert(msg);
                              att.focus();
                              return false;
                            }
                            return true;
                        }
                        function harusDiisi2(att, msg){
                            if(att.value == "---Silakan Pilih Supirnya---"){
                              alert(msg);
                              att.focus();
                              return false;
                            }
                            return true;
                        }

                  </script>
                <input type="submit" class="btn btn-primary" value="Setujui" name="buttterima">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              </form>
              <?php if($valkend != '' OR $valsupir != ''){ echo "";}else{ echo '<input type="submit" class="btn btn-danger" value="Tolak" name="butttolak" onclick="tolakConfirm();">';} ?>
                </div>    
            </div>
            </div>
            <div class="modal-footer">
              
            </div>
          </div>
        </div>
      </div>
      <!-- Modal DETAIL order -->
                <?php endforeach; ?>
                
                </tbody>
                <tfoot>
               
                </tfoot>
              </table>
              <script>
function tolakConfirm(){
	$('#tolakModal').modal();
}
function tolakOrder(url){
  $('#btn-delete').attr('href', url = url.concat(document.getElementById("areatolak").value));
}
</script>
              <!--Delete Confirmation-->
<div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: red;">PERINGATAN</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      Anda yakin ingin menolak order?<br>
      <label>Alasan Penolakan : </label>
      <textarea class="form-control" id="areatolak" placeholder="Ketikan alasan di sini"></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-delete" class="btn btn-danger" href="#" onclick="cektolak();">Tolak</a>
      <!-- Tambahan PS -->
        <script>
          function cektolak(){
              var alasanT = document.getElementById("areatolak").value;
              if(alasanT == ""){
                  swal("Peringatan","Alasan Penolakan Belum Diisi!","warning");
              }else{
                tolakOrder('<?php echo base_url('index.php/admin/tolakorder/'.$ord['id_peminjaman']); ?>/');
              }
          }
        </script>
      <!-- /Tambahan PS -->
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

