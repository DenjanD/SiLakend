<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>
<?php
       $this->session->set_userdata('halaman', 'order');
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
                  <h4 class="font-weight-bold mb-0">Order Peminjaman</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-primary btn-icon-text btn-rounded" data-toggle="modal" data-target="#modaltambahorder">
                      <i class="ti-clipboard btn-icon-prepend"></i>Buat Order
                    </button>
                    <!-- Modal TAMBAH Order -->
      <div class="modal fade" id="modaltambahorder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Order Peminjaman Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/tambahorder'; ?>" method="post" onsubmit="return validasi_kosong()">
                <div class="form-group">
                    
                    <input type="hidden" class="form-control" name="inidorder" value="<?php cetak($idinputp) ; ?>" readonly="readonly">
                </div>
                <div class="form-group">                    
                        <label>Jenis Kegiatan : </label>
                        <input type="radio" name="pilihunit" value="Non-P2KR" checked onclick="innoorder.setAttribute('readonly','readonly');innoorder.value='<?php cetak($noacc.'-241') ; ?>'">Non-P2KR &nbsp;
                        <input type="radio" name="pilihunit" value="P2KR" onclick="innoorder.removeAttribute('readonly');innoorder.value='';">P2KR<br><br>
                    <label>No. Akun/Order</label><br>

                    <!-- Kolom No.Akun/Order -->
                    <input type="text" class="form-control" name="innoorder" id="kolnoacc" value="<?php cetak($noacc."-241") ; ?>" readonly>
                </div>
                <div class="row">

                <!-- Kolom Perjalanan -->
                <div class="form-group col-xs-6">
                    <label style="margin-left:12px;">Perjalanan</label>
                    <input type="text" class="form-control" name="indari" id="koldari" placeholder="Dari" style="margin-left:12px;">
                </div>
                <div class="form-group col-xs-6">
                    <label><font color="white">.</font></label>
                    <input type="text" class="form-control" name="inke" id="kolke" placeholder="Ke">
                </div>
                </div>
                <div class="row">

                <!-- Kolom Tgl Pinjam -->
                <div class="form-group col-xs-6">
                    <label style="margin-left:12px;">Tanggal Pinjam</label>
                    <input type="date" class="form-control" name="intglpinjam" id="koltglpinjam" onchange="cektgl();cektgl2()" style="margin-left:12px;">
                    <p style="background: #3C8DBC; color:white; padding-left: 5px; padding-right: 5px;" id="tglygada"></p>
      
                    <!-- AJAX untuk mengecek tgl pinjam yg sudah ada -->
                   
                    <script type="text/javascript"> 
                      function cektgl(){
                      var tgl = document.getElementById('koltglpinjam').value;
                      $.ajax({
                       url:"<?php echo base_url('index.php/admin/order/cektgl');?>",
                       data:'&tgl='+tgl,
                       success:function(data){

                           var hasil = JSON.parse(data);  
                           if(hasil == ''){
                            console.log("NO");
                             document.getElementById('tglygada').innerHTML= '';
                               console.log(hasil);
                            }							
                            else{	
			                     $.each(hasil, function(key,val){ 
                            console.log("YES");
                             //document.getElementById('tglygada').innerHTML= "Tanggal "+val.tgl_pinjam+" sudah terdapat order dengan keterangan : <br><br> Berangkat Dari : "+val.dari+" <br>Pergi Ke : "+val.ke+" <br>Jumlah Personil : "+val.jumlah_personil+"";
                             document.getElementById('tglygada').innerHTML= "Order di tanggal yang sama : <br>"+val.nama_kendaraan+" ; "+val.dari+"-"+val.ke+" ; "+val.NAMA+" ; "+val.waktu_berangkat;          
                             
                              }); }              
			                      }
                          });
                
                        }
                        function cektgl2(){
                          var today = new Date();
                          var dd = String(today.getDate()).padStart(2, '0');
                          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                          var yyyy = today.getFullYear();

                          today = yyyy + '-' + mm + '-' + dd;
                          var tgl = document.getElementById('koltglpinjam').value;
                          if(tgl < today){
                              swal("Peringatan","Tanggal pinjam tidak bisa mundur!","warning");
                              document.getElementById('koltglpinjam').value=today;
                          }
                        }
                    </script>
                  
                  <!-- /AJAX -->
                </div>
                <div class="form-group col-xs-6">
                <!-- Kolom Lama Pinjam -->
                <label>Lama Pinjam (Hari)</label><input type="number" class="form-control" name="inlamap" id="kollamapinjam">
                </div>
                </div>
                <div class="form-group">
                      <label>Jam Berangkat</label>
                      <!-- Kolom Jam Berangkat -->
                      <input type="time" class="form-control" name="inwaktupergi" id="koljamber">
                </div>
                <div class="form-group">
                <!-- Kolom Alasan -->
                    <label>Alasan Peminjaman</label>
                    <select class="form-control" id="selalasan" name="inalasanp">
                      <option>---Silakan Pilih---</option>
                      <option>Dinas Dalam Kota</option>
                      <option>Dinas Luar Kota</option>
                      <option>Pribadi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Personil</label>
                    <!-- Kolom Jumlah Personil -->
                    <input type="number" class="form-control" name="injmlp" id="koljumlah">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="inket" id="kolket" placeholder="alamat tujuan, nama tujuan, keterangan lainnya."></textarea>
                </div>  
            </div>
            <div class="modal-footer">
            <!-- Script pengecekan kolom yg masih kosong -->
                  <script>
                        function validasi_kosong(){
                            var noacc = document.getElementById('kolnoacc');
                            var dari = document.getElementById('koldari');
                            var ke = document.getElementById('kolke');
                            var tglpinjam = document.getElementById('koltglpinjam');
                            var lamapinjam = document.getElementById('kollamapinjam');
                            var jam = document.getElementById('koljamber');
                            var alasanpinjam = document.getElementById('selalasan');
                            var jumlah = document.getElementById('koljumlah');
                            var keterangan = document.getElementById('kolket');
                            
                              if(harusDiisi(noacc, "No Akun/Order belum anda isi")){
                                if(harusDiisi(dari, "Asal berangkat belum diisi")){
                                  if(harusDiisi(ke, "Tujuan berangkat belum diisi")){
                                    if(harusDiisi(tglpinjam, "Tanggal pinjam belum diisi")){
                                      if(harusDiisi(lamapinjam, "Lama pinjam belum diisi")){
                                        if(harusDiisi(jam, "Jam berangkat belum diisi")){
                                          if(harusDiisi(alasanpinjam, "Alasan Peminjaman belum dipilih")){
                                            if(harusDiisi(jumlah, "Jumlah orang belum diisi")){
                                              if(harusDiisi(keterangan, "Keterangan Perjalanan wajib diisi")){
                                                return true;
                                              };
                                            };
                                          };
                                        };
                                      };
                                    };
                                  };
                                };
                              };
                            return false;
                        }

                        function harusDiisi(att, msg){
                            if(att.value.length == 0 || att.value == '---Silakan Pilih---'){
                              swal("Peringatan",msg,"warning");
                              att.focus();
                              return false;
                            }
                            return true;
                        }

                  </script>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <input type="submit" class="btn btn-primary" value="Order" name="buttorderbaru">
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Modal TAMBAH Order -->
                </div>
              </div>
            </div>
          </div>
          <!-- Tampilan Tabel Order -->
          <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Riwayat Order Anda</h4>     
                  <!-- kolom search data -->       
                  <?php echo form_open('admin/order/cari'); ?>
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
                  <th>Alasan Peminjaman</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th>Rincian</th>
                  <th>Pengemudi</th>
                  <th>Kendaraan</th>
                  <th>Batal/Berangkat</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; foreach ($orderan as $ord) : $no++;?>
        
                  <tr>
                      <td><?php cetak($no) ;?></td>
                      <td><?php cetak($ord['tgl_pinjam']) ;?></td>
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
                                 cetak($ord['status']) ."</label>";
                            ?>
                      </td>
                      <td><?php cetak($ord['alasan_tolak']) ;?></td>
                      <td><?php cetak($ord['NAMA']) ;?></td>
                      <td><?php cetak($ord['id_kendaraan']." - ".$ord['nama_kendaraan']) ;?></td>
                      <?php if($ord['status'] == 'Selesai' OR $ord['status'] == 'Berangkat' OR $ord['status'] == 'Dibatalkan' OR $ord['status'] == 'Ditolak'){ echo "<td></td>"; continue; } ?>
                      <td>

                           <a onclick="deleteConfirm('<?php echo base_url('index.php/admin/batalorder/'.$ord['id_peminjaman']); ?>')" class="badge badge-danger" name="butthapus"><i class="ti ti-trash" style="color:white;"></i></a>
                          <?php if($ord['supir'] == 'Membawa-Sendiri'){
                          ?><a onclick="berangkatConfirm('<?php echo base_url('index.php/admin/supirberangkat2/'.$ord['id_peminjaman']).'/'.$ord['id_kendaraan']; ?>')" class="badge badge-success" name="buttberangkat"><i class="ti ti-share" style="color:white;"></i></a>
                          <?php } ?>
                      </td>
                  </tr>           
                  <!-- Modal Detail Order -->   
                
                  
                  <!-- Modal DETAIL order -->
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
function berangkatConfirm(url){
	$('#btn-berangkat').attr('href', url);
	$('#berangkatModal').modal();
}
</script>
              <!--Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Membatalkan Order</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Anda yakin ingin membatalkan order?</div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Tidak</button>
        <a id="btn-delete" class="btn btn-secondary" href="#">Ya</a>
      </div>
    </div>
  </div>
</div>
<!--Berangkat Confirmation-->
<div class="modal fade" id="berangkatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Keberangkatan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pastikan Anda benar-benar akan berangkat.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Belum</button>
        <a id="btn-berangkat" class="btn btn-primary" href="#">Berangkat</a>
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
</script>

  
</body>

</html>

