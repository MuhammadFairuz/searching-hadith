<?php
///**
// * Created by PhpStorm.
// * User: fairuz
// * Date: 12/3/2017
// * Time: 11:27 PM
// */

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';


// melakukan koneksi ke database
$connect = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

// cek koneksi yang kita lakukan berhasil atau tidak
if ($connect->connect_error) {
    // jika terjadi error, matikan proses dengan die() atau exit();
    die('Maaf koneksi gagal: '. $connect->connect_error);
}
?>