<?php
/**
 * Created by PhpStorm.
 * User: fairuz
 * Date: 12/6/2017
 * Time: 1:35 PM
 */
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$panggil = mysqli_query($connect, "SELECT * FROM user");

while ($data = mysqli_fetch_array($panggil)){
    $user = $data['username'];
    $pass = $data['password'];
    $id = $data['id'];

    if($user==$username && $pass==$password){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id'] = $id;

    }else{
        echo "Username atau password salah";
    }
}
?>