<!DOCTYPE html>
<html lang="en">

<!-- Include Head -->
<?php $this->load->view('admin/_partials/head'); ?>
<?php
       $this->session->set_userdata('halaman', 'perbaikan');
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
                  <h4 class="font-weight-bold mb-0">Data Perbaikan/Penggantian Komponen Kendaraan Dinas</h4>
                </div>
                <div>
                <button type="button" class="btn btn-primary btn-icon-text btn-rounded" data-toggle="modal" data-target="#modaltambahperbaikan">
                      <i class="ti-plus btn-icon-prepend"></i>Tambah Perbaikan
                    </button>
                  <!-- Modal Tambah Perbaikan -->
      <div class="modal fade" id="modaltambahperbaikan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Input Data Perbaikan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/perbaikan/inputperbaikan'; ?>" method="post" onsubmit="return validasi_kosong()">
                <div class="form-group">
                    <label>Tanggal Perbaikan</label>
                    <input type="date" class="form-control" name="intglperbaikan" id="tglperbaikan" value="">
                </div>
                <div class="form-group">
                    <label>Jenis Perbaikan</label>
                    <select class="form-control" name="selperbaikan" id="jenisperbaikan">
                        <option>---Silakan Pilih---</option>
                        <option>Berkala</option>
                        <option>Insidental</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jenis Kendaraan</label>
                    <select class="form-control" name="selmobil" id="jeniskendaraan">
                        <option>---Silakan Pilih---</option>
                        <?php 
                            foreach($mobil as $kend):
                                echo "<option>".$kend['id_kendaraan'].' - '.$kend['nama_kendaraan']."</option>";
                            endforeach;
                        ?>            
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Perbaikan/Penggantian</label>
                    <input type="text" class="form-control" id="namaperbaikan" name="innamaperbaikan" placeholder="Contoh : Kanpas Rem, Oli Mesin,">
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="injumlah" placeholder="Jumlah Barang" onchange="nominus()">
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <select class="form-control" name="selsatuan" id="satuan">
                        <option>---Silakan Pilih---</option>
                        <option>Unit</option>
                        <option>Set</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" id="rupiah" name="inhargaperbaikan" placeholder="Rp. xxx" oninput="nominus2()">
                </div>
                  
            </div>
            <div class="modal-footer">
            <script>
              function nominus(){
                var val = document.getElementById('jumlah').value;
                if(val < 0){
                  swal('PERINGATAN','Jumlah tidak bisa minus!','warning');
                  document.getElementById('jumlah').value=1;
                }
                else if(val == 0){
                  swal('PERINGATAN','Jumlah tidak bisa nol!','warning');
                  document.getElementById('jumlah').value=1;
                }
              }
              function nominus2(){
                var val = document.getElementById('rupiah').value;
                if(val < 0){
                  swal('PERINGATAN','Harga tidak bisa minus!','warning');
                  document.getElementById('rupiah').value=0;
                }
              }

              function validasi_kosong(){
                            var tglperbaikan = document.getElementById('tglperbaikan');
                            var jenisperbaikan = document.getElementById('jenisperbaikan');
                            var jeniskendaraan = document.getElementById('jeniskendaraan');
                            var namaperbaikan = document.getElementById('namaperbaikan');
                            var jumlah = document.getElementById('jumlah');
                            var satuan = document.getElementById('satuan');
                            var harga = document.getElementById('rupiah');
                            
                            
                              if(harusDiisi(tglperbaikan, "Tanggal Perbaikan belum anda isi")){
                                if(harusDiisi(jenisperbaikan, "Jenis Perbaikan belum diisi")){
                                  if(harusDiisi(jeniskendaraan, "Jenis Kendaraan belum diisi")){
                                    if(harusDiisi(namaperbaikan, "Nama Perbaikan/Penggantian belum diisi")){
                                      if(harusDiisi(jumlah, "Jumlah barang perbaikan belum diisi")){
                                        if(harusDiisi(satuan, "Satuan perbaikan belum diisi")){
                                          if(harusDiisi(harga, "Harga per perbaikan/penggantian belum dipilih")){
                                            return true;
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
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <input type="submit" class="btn btn-primary" value="Simpan Data" name="buttmobilbaru">
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Modal Tambah Perbaikan -->
                </div>
              </div>
            </div>
          </div>
          
          <!-- Tampilan Tabel Order -->
          <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Cari Data Perbaikan/Penggantian</h4>
                  <!-- kolom search data -->       
                  <?php echo form_open('admin/perbaikan/cari'); ?>
                    <div class="row">
                      <div class="col-lg-6 col-md-5 col-xs-6">
                          <label style="margin-top: 10px;">Kata Kunci Perbaikan/Penggantian</label>
                            <input type="text" class="form-control" id="myInputTextField" placeholder="Masukan kata kunci" name="keyword" aria-label="search" aria-describedby="search">          
                      </div>
                      <div class="col-lg-6 col-md-5 col-xs-3">
                      <label style="margin-top: 10px;">Jenis Kendaraan</label>
                            <select class="form-control" name="selkendaraan">
                            <option>---Semua---</option>
                            <?php foreach ($mobil as $mobil):
                                echo "<option>".$mobil['id_kendaraan']." - ".$mobil['nama_kendaraan']."</option>";
                            endforeach;
                              ?>
                          </select>
                      </div>
                    </div> 
                    <div class="row" style="">
                    <div class="col-lg-6 col-md-5 col-xs-3">
                      <label style="margin-top: 10px;">Jenis Perbaikan</label>
                            <select class="form-control" name="selperbaikan">
                            <option>---Semua---</option>
                            <option>Berkala</option>
                            <option>Insidental</option>
                          </select>
                      </div>
                      <div class="col-lg-3 col-md-5 col-xs-3">
                      <label style="margin-top: 10px;">Tanggal Awal</label>
                            <input type="date" class="form-control" name="caritglawal" id="kolcaritglawal">
                      </div>
                      <div class="col-lg-3 col-md-5 col-xs-3">
                      <label style="margin-top: 10px;">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="caritglakhir" id="kolcaritglakhir">
                      </div>
                    </div>
                    <div class="row" style="; margin-top:20px; margin-bottom: 20px;">
                      <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary form-control" name="buttcari">Tampilkan Data</button>
                        <button class="btn btn-success form-control" name="buttexcel">Buat Laporan Excel</button>
                      </div>
                    </div>
                    
                  <?php echo form_close(); ?>
                  <div id='sembunyi' <?php if($statuscari == 0){echo "hidden";} ?>>
                  <p class="card-description">
                    LAPORAN PERBAIKAN/PENGGANTIAN KOMPONEN KENDARAAN DINAS
                  </p>
                  <div class="table-responsive">
                  <table id="tabelorder" class="table table-bordered table-hover">
                  <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Perbaikan</th>
                  <th>Kendaraan</th>
                  <th>Jenis Perbaikan</th>
                  <th>Perbaikan/Penggantian</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>Harga</th>               
                  <th>Total</th> 
                <?php if($this->session->userdata('status')=='Administrator' || $this->session->userdata('status')=='Sub Bagian Umum'){?>
                  <th>Edit</th>
                  <th>Hapus</th>
                <?php } ?> 
                </tr>
                </thead>
                <tbody>
                <?php $totalbiaya = 0; $no = 0; foreach ($kumpulanperbaikan as $datap) : $no++;?>
                <?php $idmodal = "a".$datap['id_perbaikan']; ?>
                  <tr>
                      <td><?php cetak($no) ;?></td>
                      <td><?php cetak(date("d-M-y", strtotime($datap['tgl_perbaikan']))) ;?></td>
                      <td><?php cetak($datap['id_kendaraan'].' - '.$datap['nama_kendaraan']) ;?></td>
                      <td><?php cetak($datap['jenis_perbaikan']) ;?></td>
                      <td><?php cetak($datap['nama_perbaikan']) ;?></td>
                      <td><?php cetak($datap['jumlah']) ;?></td>
                      <td><?php cetak($datap['satuan']) ;?></td>
                      <td>Rp <?php cetak($datap['harga']) ;?></td>    
                      <td>Rp <?php cetak($datap['total']) ;?></td>
                      <?php if($this->session->userdata('status')=='Administrator' || $this->session->userdata('status')=='Sub Bagian Umum'){?>
                      <td><a data-toggle="modal" data-target="#<?php echo $idmodal; ?>" class="badge badge-success"><i class="ti ti-marker-alt"></i></a></td>
                      <td><a onclick="deleteConfirm('<?php echo base_url('index.php/admin/hapusperbaikan/'.$datap['id_perbaikan']); ?>')" class='badge badge-danger' name='butthapus'><i class='ti ti-trash'></i></a></td>
                <?php } ?>                    
                  </tr>      
                  <!-- Modal EDIT data -->
      <div class="modal fade" id="<?php cetak($idmodal) ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Ubah Data Perbaikan/Penggantian</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/editperbaikan'; ?>" method="post" onsubmit="return validasi_kosong2()">
                <div class="form-group">
                    <label>Tanggal Perbaikan</label>
                    <input type="hidden" class="form-control" name="inidperbaikan" value="<?php cetak($datap['id_perbaikan']) ; ?>">
                    <input type="date" class="form-control" name="intglperbaikan" value="<?php cetak($datap['tgl_perbaikan']) ; ?>">
                </div>
                <div class="form-group">
                    <label>Kendaraan</label>
                    <input type="text" class="form-control" value="<?php cetak($datap['id_kendaraan'].' - '.$datap['nama_kendaraan']) ; ?>"readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Jenis Perbaikan</label>
                    <select class="form-control" name="injenisperbaikan">
                        <?php 
                        if($datap['jenis_perbaikan']=='Insidental'){?>
                          <option selected>Insidental</option>
                          <option>Berkala</option>
                        <?php } ?>
                        <?php 
                        if($datap['jenis_perbaikan']=='Berkala'){?>
                          <option>Insidental</option>
                          <option selected>Berkala</option>
                        <?php } ?>      
                    </select>
                </div>
                <div class="form-group">
                    <label>Perbaikan/Penggantian</label>
                    <label>Kendaraan</label>
                    <textarea class="form-control" name="innamaperbaikan" id="areanamaperbaikan"><?php cetak($datap['nama_perbaikan']);?></textarea>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" name="injumlah" id="koljumlah" value="<?php cetak($datap['jumlah']); ?>" oninput="nominus3()">
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <select class="form-control" name="insatuan">
                        <?php 
                        if($datap['satuan']=='Set'){?>
                          <option selected>Set</option>
                          <option>Unit</option>
                        <?php } ?>
                        <?php 
                        if($datap['satuan']=='Unit'){?>
                          <option>Set</option>
                          <option selected>Unit</option>
                        <?php } ?>      
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="inharga" id="kolharga" value="<?php cetak($datap['harga']); ?>" oninput="nominus4()">
                </div>
                
                  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <input type="submit" class="btn btn-primary" value="Simpan Data" name="buttmobilbaru">
            </div>
            </form>
          </div>
        </div>
      </div>
      <script>
      function validasi_kosong2(){
                            
                            var namaperbaikan = document.getElementById('areanamaperbaikan');
                            var jumlah = document.getElementById('koljumlah');
                            var harga = document.getElementById('kolharga');
                            
                           
                                    if(harusDiisi2(namaperbaikan, "Nama Perbaikan/Penggantian belum diisi")){
                                      if(harusDiisi2(jumlah, "Jumlah barang perbaikan belum diisi")){
                                        if(harusDiisi2(harga, "Harga per perbaikan/penggantian belum dipilih")){
                                          return true;
                                        };                             
                                      };
                                    };   
                            return false;
                        }

                        function harusDiisi2(att, msg){
                            if(att.value.length == 0 || att.value == '---Silakan Pilih---'){
                              swal("Peringatan",msg,"warning");
                              att.focus();
                              return false;
                            }
                            return true;
                        }
                        function nominus3(){
                var val = document.getElementById('koljumlah').value;
                if(val < 0){
                  swal('PERINGATAN','Jumlah tidak bisa minus!','warning');
                  document.getElementById('koljumlah').value=1;
                }
                else if(val == 0){
                  swal('PERINGATAN','Jumlah tidak bisa nol/kurang dari nol!','warning');
                  document.getElementById('koljumlah').value=1;
                }
              }
              function nominus4(){
                var val = document.getElementById('kolharga').value;
                if(val < 0){
                  swal('PERINGATAN','Harga tidak bisa minus!','warning');
                  document.getElementById('kolharga').value=0;
                }
              }
      </script>
      <!-- /Modal EDIT data -->     
                <?php
            $totalbiaya = $totalbiaya + $datap['total'];
            
            endforeach; ?>
                <td colspan="8"><b>Total Biaya Perbaikan/Penggantian Komponen</b></td><td>Rp <?php cetak($totalbiaya) ; ?></td>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              </div>
              <div class="row">
                    <div class="col">
                        
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
  <script>
  /*
  var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
     rupiah.value = formatRupiah(this.value, "Rp. ");
    });

/* Fungsi formatRupiah 
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
*/
  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  /*
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }
    
    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    
}*/
  </script>
  <?php $this->load->view('admin/_partials/js'); ?>
  
</body>

</html>

