<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Petunjuk Penggunaan SiLaKend</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('style.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('images/favicon.png'); ?>" />
    <style>
        a{
            cursor: pointer;
        }
    </style>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <center><img src="<?php echo base_url('logopolman.png'); ?>" style="width: 100px;height: 100px;">
                <h6>Petunjuk Penggunaan SiLaKend</h6></center>
            </div>

            <ul class="list-unstyled components">
            <li class="link"><a>Diagram Alir Aplikasi</a></li>
                    <li class="link"><a>Login Aplikasi</a></li>
                
                <li class="link"><a>Tampilan User (Pegawai)</a></li>
                <li class="link"><a>Tampilan Verifikator (Atasan Langsung)</a></li>
                
                <li>
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="">Tampilan Validator (Ka. Sub. Bag. Umum)<i class="fa fa-angle-double-down" style="margin-left:65px;"></i></a>
                    <ul class="collapse list-unstyled" id="pageSubmenu2">
                        <li class="link"><a>Penentuan pengemudi dan kendaraan</a></li>
                        <li class="link"><a>Rekaman order kendaraan</a></li>
                        <li class="link"><a>Status Tugas Pengemudi</a></li>
                        <li class="link"><a>Data kendaraan</a></li>
                        <li class="link"><a>Laporan data order</a></li>
                    </ul>
                </li>
                    <li class="link"><a>Tampilan Pengemudi</a></li>
                    <li class="link"><a>Tampilan Input Kilometer (Satpam)</a></li>
                    <li>
                    <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="">Aksi pada Order<i class="fa fa-angle-double-down" style="margin-left:65px;"></i></a>
                    <ul class="collapse list-unstyled" id="pageSubmenu3">
                        <li class="link"><a>Membatalkan Order</a></li>
                        <li class="link"><a>Menolak Order</a></li>
                        <li class="link"><a>Melaksanakan Order Sendiri</a></li>
                    </ul>
                </li>
                    
            </ul>

            
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Akses Modul</span>
                    </button>
                </div>
            </nav>
            
    <div id="isi">
            <h3>Silakan pilih modul yang akan dibaca pada menu di samping kiri.</h3>
            
        </div>
    </div>
    </div>

    <!-- jQuery CDN-->
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script>
    $('.link').on('click', function(){
    $('.link').removeClass('active');
    $(this).addClass('active');

let judul = $(this).html();
console.log(judul);
$.getJSON('<?php echo base_url('konten.json');?>', function (data){
    let menu = data.menu;
    let content = '';
    let nama = '';
    
    $.each(menu, function (i, data){
        if(data.judul == judul){
            nama += data.nama;
            content += data.isi;
            
        }
    });
    $('#judul').html(nama);
    $('#isi').html(content);
}); 

});
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                console.log('a');
            });
        });
    </script>
</body>

</html>