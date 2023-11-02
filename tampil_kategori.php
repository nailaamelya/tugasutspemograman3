<!DOCTYPE html>
<html>
<head>
     <title>tampil kategori</title>
</head>
<body>
     <h2>pemograman 1 2023</h2>
     <br>
     <a href="tambah_kategori.php">+Tambah kategori</a>
     <br>
     <table border="1">
          <tr> 
             <th>Id</th>
             <th>Nama kategori</th>
             <th>Diskon</th>
             <th>opsi</th>
          </tr> 
          <?php
              include 'koneksi.php';
              $no = 1;
              $data = mysqli_query($koneksi,"select * from kategori");
              while($d = mysqli_fetch_array($data)){
               ?>
          <tr>
               <td><?php echo $no++; ?></td>
               <td><?php echo $d['nama_kategori']; ?></td>
               <td><?php echo $d['diskon']; ?></td>
               <td>
               <a href="edit_kategori.php?id=<?php echo $d['id_kategori']; ?>">Edit</a>
               <a href="hapus_kategori.php?id=<?php echo $d['id_kategori']; ?>">Hapus</a>
              </td>
          </tr>
          <?php
              }
              ?>
     </table>
          </body>
          </html>