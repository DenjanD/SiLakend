<html><head>
</head><body>
    <style>
      th{
        padding: 10 20;
        background-color: khaki;
      }
      td{
        padding: 5 10;
      }
      table{
        border-collapse: collapse;
      }

    </style>
    <div>
      <center>
        <h3>LAPORAN PENGGUNAAN KENDARAAN DINAS</h3>
      <center>
        <br>
                <table border="1">    
                <tr>
                  <th style="padding :2 5;">No</th>
                  <th>Tanggal Pinjam</th>
                  <th>Nama Peminjam</th>
                  <th>Alasan Pinjam</th>
                  <th>Dari</th>
                  <th>Ke</th>
                  <th>Nama Pengemudi</th>
                  <th>Kendaraan</th>
                </tr>
                <?php $no = 1; foreach ($laporan as $lpr) : ?>
        
                  <tr>
                      <td><?php echo $no;?></td>
                      <td><?php echo $lpr['tgl_pinjam'];?></td>
                      <td><?php echo $lpr['nama_peminjam'];?></td>
                      <td><?php echo $lpr['alasan_pinjam'];?></td>
                      <td><?php echo $lpr['dari'];?></td>
                      <td><?php echo $lpr['ke'];?></td>
                      <td><?php echo $lpr['nama_supir'];?></td>
                      <td><?php echo $lpr['id_kendaraan']." - "; ?><?php echo $lpr['nama_kendaraan']; $no++;?></td>
                        
                  </tr>           
                <?php endforeach; ?>   
              </table>
              </div>
</body></html>