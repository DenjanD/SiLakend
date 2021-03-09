<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="<?php echo base_url('index.php/admin/order'); ?>"><img src="<?php echo base_url('logopolman.png'); ?>" style="width:50px;height:50px;">&nbsp;&nbsp;&nbsp;Si<b>LaKend</b></a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url('index.php/admin/order'); ?>">S<b>LK</b></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
         
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown mr-1">
            
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <?php echo $this->session->userdata('nama'); ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <?php if($this->session->userdata('namalevel') == 'Administrator' OR $this->session->userdata('namalevel') == 'Satpam'){   
             }
               else{ ?>
              <a class="dropdown-item" data-toggle="modal" data-target="#modalgantipass">
                <i class="ti-key text-primary"></i>
                Ubah Password
              </a>
            <?php }?>
              <a class="dropdown-item" href="<?php echo base_url().'index.php/logout'; ?>">
                <i class="ti-shift-left text-primary"></i>
                Logout
              </a>
              
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <!-- Modal EDIT pass -->
    <div class="modal fade" id="modalgantipass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Ubah Password Anda</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo base_url().'index.php/admin/gantipassuser'; ?>" method="post" onsubmit="return cekkolomkosong()">
            <input type="hidden" class="form-control" name="idpassganti" value="<?php echo $this->session->userdata("userid"); ?>">
                
                <div class="form-group">
                    <label>Ketikkan Password Lama Anda</label>
                    <input type="password" class="form-control" id="passlama" name="inpasslama" placeholder="Isi dengan password sebelumnya">
                </div>
                <div class="form-group">
                    <label>Ketikkan Password Baru Anda</label>
                    <input type="password" class="form-control" id="passbaru" name="inpassbaru" placeholder="Isi dengan password baru">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password Baru Anda</label>
                    <input type="password" class="form-control" id="passkonf" name="inpassbarukonfirmasi" placeholder="Isi kembali password baru Anda">
                </div>

                <!-- Konfirmasi pass baru--> 
                <script>
                    function cekkolomkosong(){
                      var passlama = document.getElementById('passlama').value;
                      var passbaru = document.getElementById('passbaru').value;
                      var passkonf = document.getElementById('passkonf').value;
                      if(passlama == ''){
                          swal('Peringatan','Anda belum mengisi Password lama Anda','warning');
                          return false;
                      }
                      else if(passbaru == ''){
                          swal('Peringatan','Anda belum mengisi Password baru Anda','warning');
                          return false;
                      }
                      else if(passkonf == ''){
                          swal('Peringatan','Anda belum mengisi kembali Password baru Anda','warning');
                          return false;
                      }
                      else if(passbaru != passkonf){
                          swal("Peringatan",'Password baru Anda tidak sama, silakan periksa kembali','warning');
                          return false;
                    }
                    }
                    function cekpassbaru(){
                    var passbaru = document.getElementById('passbaru').value;
                    var passkonf = document.getElementById('passkonf').value;
                    if(passbaru != passkonf){
                      swal("Peringatan",'Password baru Anda tidak sama, silakan periksa kembali','warning');
                      return false;
                    }
                    else{
                      return true;
                    }
                  }
                </script>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <input type="submit" class="btn btn-primary" value="Ubah Password" name="buttpassbaru">
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Modal edit pass -->