<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SiLaKend | Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('vendors/base/vendor.bundle.base.css'); ?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
  <!-- BS DropSelect -->
  <link rel="stylesheet" href="<?php echo base_url('bootstrap-select-1.13.9/dist/css/bootstrap-select.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css'); ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url('images/favicon.png'); ?>" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo" align="center" style="margin-bottom :-35px;">
                <img src="<?php echo base_url('logopolman.png'); ?>" alt="logo" style="width:250px;height:250px;">
              </div>
              <h2 align="center">SILaKend</h2>
              <h4 class="" align="center">Sistem Informasi Layanan Kendaraan</h4><br>
              
                <div class="form-group">
                  <label for="exampleInputEmail">Nama</label>
                  <form action="<?php echo base_url("index.php/login"); ?>" method="post">
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-white border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                    </div><!--class="form-control form-control-lg border-left-0"-->
                    <select class="selectpicker form-control" data-live-search="true" id="listpegawai" name="userid">
                    <option>---Silakan Pilih Nama Anda---</option>
                          <?php
                              foreach ($daftarpegawai as $dftp) :
                              echo "<option>".$dftp['ID']." - ".$dftp['NAMA']."</option>";
                              endforeach;
                          ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-white border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                    </div>
                    <style>
                      a:hover{
                        cursor: pointer;
                      }
                      </style>
                    <input type="password" style="z-index:0;" class="form-control form-control-lg border-left-0" id="InputPassword" placeholder="Password" name="userpass">
                    <a style="margin-top:18px;margin-left:-30px;position:relative;z-index:1;" onmousedown="liatpass();" onmouseup="balikpass();"><i class="ti ti-eye"></i></a>
                  </div>
                 
                  <!--<div class="form-check form-check-warning" style="margin-left: 180px;">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" onclick="liatpass()">
                              Lihat Password
                            <i class="input-helper"></i></label>
                          </div> -->
                  <div class="form-check form-check-primary" style="">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="checkingat">
                              Remember me
                            <i class="input-helper"></i></label>
                          </div>
                    <script> 
                        function liatpass() {
                          var x = document.getElementById("InputPassword");                     
                              x.type = "text";  
                          }
                          function balikpass() {
                          var x = document.getElementById("InputPassword");                     
                              x.type = "password";  
                          }                  
                    </script>
                </div>
                
                <div class="my-3">
                <center>
                  <input type="submit" class="btn btn-primary btn-md font-weight-medium auth-form-btn" value="Login" name="buttlogin" style="width:190px;"></button>
                  </form><br>
                  <a class="btn btn-primary btn-md font-weight-medium auth-form-btn" href="<?php echo base_url('index.php/v_petunjukpeng/1'); ?>" target="_blank" style="margin-top:5px;width:190px;margin-left:-4px;">Petunjuk Penggunaan</a>
                          </center>
                </div>
                        
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Developed by <a href="https://www.instagram.com/denjand/" target="_blank" style="color:cyan;">Muammar Alfien Zaidan</a>, &copy; 2019.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo base_url('vendors/base/vendor.bundle.base.js'); ?>"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <!-- BS DropSelect -->
<script src="<?php echo base_url('bootstrap-select-1.13.9/dist/js/bootstrap-select.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js'); ?>"></script>
<script>
$(function() {
 $('#listpegawai').selectpicker();
})
</script>
  <script src="<?php echo base_url('js/off-canvas.js'); ?>"></script>
  <script src="<?php echo base_url('js/hoverable-collapse.js'); ?>"></script>
  <script src="<?php echo base_url('js/template.js'); ?>"></script>
  <script src="<?php echo base_url('js/todolist.js'); ?>"></script>
  <!-- endinject -->
</body>

</html>
