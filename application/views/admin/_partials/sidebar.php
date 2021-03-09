<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
        <?php 
            if($this->session->userdata('status') != 'Satpam'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'dashboard'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin/dashboard')."'>";
            echo "<i class='ti-desktop menu-icon'></i> <span class='menu-title'>Dashboard</span>
                </a>
                </li>";
            }
        ?>
          <?php 
            if($this->session->userdata('status') != 'Satpam'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'order'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin/order')."'>";
            echo "<i class='ti-pencil-alt menu-icon'></i> <span class='menu-title'>Order Peminjaman</span>
                </a>
                </li>";
            }
        ?>
          <?php 
            if($this->session->userdata('status') == 'Supir' OR $this->session->userdata('status') == 'Administrator'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'tugass'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin/tugassupir')."'>";
            echo "<i class='ti-menu-alt menu-icon'></i> <span class='menu-title'>Tugas Masuk</span>
                </a>
                </li>";
            }
        ?>
         <?php 
            if($this->session->userdata('status') == 'Satpam' OR $this->session->userdata('status') == 'Administrator'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'satpam'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin/satpam')."'>";
            echo "<i class='ti-pencil-alt menu-icon'></i> <span class='menu-title'>";if($this->session->userdata('status') == 'Administrator'){ echo "Edit Kilometer Kendaraan";}else{ echo "Input Kilometer Kendaraan";} echo "</span>
                </a>
                </li>";
            }
        ?>
         <?php 
            if($this->session->userdata('status') == 'Administrator' OR $this->session->userdata('namalevel') == 'Kepala Bagian Kepeg' OR $this->session->userdata('namalevel') == 'Sub Bagian Umum' OR $this->session->userdata('namalevel') == 'Kepala Unit' OR $this->session->userdata('namalevel') == 'Sekdir'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'validasi'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin/validasi')."'>";
            echo "<i class='ti-check-box menu-icon'></i> <span class='menu-title'>Validasi Order Masuk</span>
                </a>
                </li>";
            }
        ?>
         <?php 
            if($this->session->userdata('status') == 'Administrator' OR $this->session->userdata('namalevel') == 'Sub Bagian Umum'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'riwayat'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin/riwayat')."'>";
            echo "<i class='ti-book menu-icon'></i> <span class='menu-title'>Rekaman Order</span>
                </a>
                </li>";
            }
        ?>
        <?php 
            if($this->session->userdata('status') == 'Administrator' OR $this->session->userdata('namalevel') == 'Sub Bagian Umum'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'perbaikan'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin/perbaikan')."'>";
            echo "<i class='ti-book menu-icon'></i> <span class='menu-title'>Perbaikan Kendaraan</span>
                </a>
                </li>";
            }
        ?>
          <?php 
            if($this->session->userdata('status') == 'Administrator'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'user'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin')."'>";
            echo "<i class='ti-user menu-icon'></i> <span class='menu-title'>Data User</span>
                </a>
                </li>";
            }
        ?>
         <?php 
            if($this->session->userdata('status') == 'Administrator' OR $this->session->userdata('namalevel') == 'Sub Bagian Umum'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'pengemudi'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin/pengemudi')."'>";
            echo "<i class='ti-hand-drag menu-icon'></i> <span class='menu-title'>Data Pengemudi</span>
                </a>
                </li>";
            }
        ?>
          <?php 
            if($this->session->userdata('status') == 'Administrator' OR $this->session->userdata('namalevel') == 'Sub Bagian Umum'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'mobil'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin/mobil')."'>";
            echo "<i class='ti-car menu-icon'></i> <span class='menu-title'>Data Kendaraan</span>
                </a>
                </li>";
            }
        ?>
        <?php 
            if($this->session->userdata('status') == 'Administrator' OR $this->session->userdata('namalevel') == 'Sub Bagian Umum'){
            echo "<li class='nav-item ";if($this->session->userdata('halaman') == 'laporan'){ echo "active'";}
            echo "'> <a class='nav-link' href='";echo base_url('index.php/admin/laporan')."'>";
            echo "<i class='ti-bookmark-alt menu-icon'></i> <span class='menu-title'>Laporan</span>
                </a>
                </li>";
            }
        ?>
        </ul>
      </nav>