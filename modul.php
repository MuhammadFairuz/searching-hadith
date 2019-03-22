<?php
$konten=$_GET['page']; //mengakses variable URL

if($konten==home){
    include("home.php");
}elseif ($konten==search){
    include("search.php");
}elseif($konten==training){
    include ("training.php");
}elseif($konten==preprocessing){
    include ("preprocessing.php");
}elseif($konten==lihatindeks){
    include ("lihatIndeks.php");
}elseif($konten==lihatvektor){
    include ("lihatVektor.php");
}elseif ($konten==report){
    include("report.php");
}elseif ($konten==login){
    include("login.php");
}
else{
    include ("home.php");
}
?>