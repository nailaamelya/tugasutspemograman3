<!DOCTYPE html>
<html>
<head>
    <title>pemograman3.com</title>
</head>
<?php
//koneksi database
include 'koneksi.php';
//menangkap data yang di kirim dari form
if (!empty($_POST['save'])){

    $Nama = $_POST['Nama'];
    $Password = $_POST['Password'];
    $level = $_POST['level'];
    $status = $_POST['status'];
    //menginput data ke database
    $a=mysqli_query($koneksi,"insert into user values('','$Nama','$Password','$level','$status')");
    if($a){
        //mengalihkan halaman kembali
        header("location:tambah_user.php");
    }else{
        echo mysqli_error();
    }
}  

?>  
<body>
    <h2>pemograman3 2023</h2>
    <br/>
    <a href="http://localhost/keuangan/tampil_user.php">KEMBALI</a>
    <br/>
    <br/>
    <h3>TAMBAH DATA USER</h3>
    <form method="POST">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="Nama"></td>
            </tr>
            <tr>
             <td>Password</td>
             <td><input type="text" name="Password"></td>
        </tr>
        <tr>
            <td>level</td>
            <td><select name="level">
                <option value="">-----pilih</option>
                <option value="1">Admin</option>
                <option value="2">Staff</option>
                <option value="3">Spv</option>
                <option value="4">Mgr</option>
</select>
</td>
</tr>
<tr>
    <td>status</td>
    <td><select name="status">
        <option value="">-----pilih</option>
        <option value="1">Aktif</option>
        <option value="0">tdk aktif</option>
</select>
</td>
</tr>
<tr>
    <td><td>
        <td><input type="submit" name="save"></td>
</tr>
</table>
</form>
</body>
</html>

