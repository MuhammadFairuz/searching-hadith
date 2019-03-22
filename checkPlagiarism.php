<?php
    error_reporting(0);
    set_time_limit(0);
    include 'koneksi.php';
    include_once 'fungsi.php';
    include 'queryInput.php';

    $keyword = $_POST["keyword"];

    if($keyword){
        $keyword = stemming2($keyword);
        ?>
        <CENTER><H3> Hasil Similarity :<B><?php echo $_POST["keyword"]?></B></H3><hr></CENTER>
    <?php
        panggilcache($keyword);
    }
?>
