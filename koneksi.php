<?php
///**
// * Created by PhpStorm.
// * User: fairuz
// * Date: 12/3/2017
// * Time: 11:27 PM
// */
//define("DB_SERVER", "localhost");
//define("DB_USERNAME", "root");
//define("DB_PASSWORD", "");
//define("DB_NAME", "plagiarism_detection");
//
//$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'qas_hadith';


// melakukan koneksi ke database
$connect = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

// cek koneksi yang kita lakukan berhasil atau tidak
if ($connect->connect_error) {
    // jika terjadi error, matikan proses dengan die() atau exit();
    die('Maaf koneksi gagal: '. $connect->connect_error);
}

?>