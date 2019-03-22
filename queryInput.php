<?php
set_time_limit(0);

function cosinesim($query){
    include 'koneksi.php';
    include_once 'fungsi.php';

    $termn = mysqli_query($connect, "SELECT count(*) as n from tb_vektor");
    $jmltermn = mysqli_fetch_array($termn);
    $n = $jmltermn['n'];

    $tquery = explode(" ", $query);

    $panjangvektorquery = 0;
    $bobotquery = array();

    for ($i=0; $i<count($tquery); $i++) {
        $sNTerm = mysqli_query($connect, "SELECT count(*) as N from tb_index WHERE term = '$tquery[$i]'");
        $dataNTerm = mysqli_fetch_array($sNTerm);
        $NTerm = $dataNTerm['N'];

        if($NTerm > 0){
            $idf = log($n/$NTerm);
        }else{
            $idf = 0;
        }
        $bobotquery[] = $idf;

        $panjangvektorquery = $panjangvektorquery + $idf * $idf;

    }//endfor

    $panjangvektorquery = sqrt($panjangvektorquery);

    $jmlsim = 0;

    $panggildocId = mysqli_query($connect,"SELECT * FROM tb_vektor ORDER BY docId");
    while ($datadocId = mysqli_fetch_array($panggildocId)) {
        $dotproduk = 0;
        $docId = $datadocId['docId'];
        $pvdocId = $datadocId['panjang'];


        $panggilTerm = mysqli_query($connect,"SELECT * FROM tb_index WHERE docId = $docId");
        while ($dataTerm = mysqli_fetch_array($panggilTerm)) {
            for ($i=0; $i<count($tquery); $i++) {
                if($dataTerm['term'] == $tquery[$i]){
                    $dotproduk = $dotproduk + $dataTerm['bobot'] * $bobotquery[$i];
                }//endif
            }//endfor
        }//endwhile dataTerm

        if($dotproduk > 0){
            $similarity = $dotproduk / ($panjangvektorquery * $pvdocId);
            $persentase = $similarity *100;
            $persen = number_format($persentase,2);
            $ket ="";

            if($persentase>=100){
                $ket="Plagiat";
            }else if($persentase>=70){
                $ket="Plagiat Sedang";
            }else if($persentase>=50){
                $ket="Plagiat Ringan";
            }else{
                $ket="Tidak Plagiat";
            }

                $simpanCache = mysqli_query($connect, "INSERT INTO tb_checkplagiat (query, docId, similarity, persentase, keterangan)
                                      VALUES ('$query', $docId, $similarity, $persen , '$ket')");
            $jmlsim++;
        }//endfor
    }//endwhile docId

    if($jmlsim == 0){
                $simpanCache = mysqli_query($connect, "INSERT INTO tb_checkplagiat (query, docId, similarity, persentase, keterangan)
                                      VALUES ('$query',0,0,0,'-')");
    }
}



function highlightKeywords($text, $keyword) {
    $wordsAry = explode(" ", $keyword);
    $wordsCount = count($wordsAry);

    for($i=0;$i<$wordsCount;$i++) {
        $highlighted_text = "<mark style='background-color:yellow'>$wordsAry[$i]</mark>";
        $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
    }

    return $text;
}
function panggilcache($query){
    include 'koneksi.php';
    mysqli_query($connect, "TRUNCATE TABLE tb_checkplagiat");
    cosinesim($query);

    $filterbobot = mysqli_query($connect, "SELECT similarity from tb_checkplagiat GROUP BY similarity HAVING (count(similarity)>1)");
    $jumlahfilter = mysqli_num_rows($filterbobot);

    //bentuk kondisi
    if($jumlahfilter>0){
        while ($datafilter = mysqli_fetch_array($filterbobot)){
            $valuefilter = $datafilter['similarity'];
//            tambahbobot($valuefilter);
        }
    }
    $panggilCache = mysqli_query($connect, "SELECT * FROM tb_checkplagiat WHERE query='$query' ORDER BY similarity DESC");
    $jumlahCache = mysqli_num_rows($panggilCache);

    $a=1;
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">Showing 4 Results</div>
        <div class="panel-body">
            <div class="search-result-item col-md-12">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3 class="search-result-title"><a href="#">Search Result 1</a></h3>
                            <p class="text-muted">Category</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut maximus, odio a imperdiet rhoncus, nunc metus luctus mi, at dignissim sem orci ut massa. Morbi a magna risus. Nunc vestibulum, nibh sit amet dictum pharetra, augue quam faucibus neque, et ultrices dui arcu ac ligula.</p>
                        </div>
                        <div class="col-sm-3 text-center">
                            <h3>$499</h3>
                            <a class="btn btn-primary btn-info btn-md" href="#">View Details</a>
                        </div>
                    </div>
            </div>
            <div class="search-result-item col-md-12">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3 class="search-result-title"><a href="#">Search Result 2</a></h3>
                            <p class="text-muted">Category</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut maximus, odio a imperdiet rhoncus, nunc metus luctus mi, at dignissim sem orci ut massa. Morbi a magna risus. Nunc vestibulum, nibh sit amet dictum pharetra, augue quam faucibus neque, et ultrices dui arcu ac ligula.</p>
                        </div>
                        <div class="col-sm-3 text-center">
                            <h4>$499</h4>
                            <a class="btn btn-primary btn-info btn-md" href="#">View Details</a>
                        </div>
                    </div>
            </div>
            <div class="search-result-item col-md-12">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3 class="search-result-title"><a href="#">Search Result 3</a></h3>
                            <p class="text-muted">Category</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut maximus, odio a imperdiet rhoncus, nunc metus luctus mi, at dignissim sem orci ut massa. Morbi a magna risus. Nunc vestibulum, nibh sit amet dictum pharetra, augue quam faucibus neque, et ultrices dui arcu ac ligula.</p>
                        </div>
                        <div class="col-sm-3 text-center">
                            <h4>$499</h4>
                            <a class="btn btn-primary btn-info btn-md" href="#">View Details</a>
                        </div>
                    </div>
            </div>
            <div class="search-result-item col-md-12">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3 class="search-result-title"><a href="#">Search Result 4</a></h3>
                            <p class="text-muted">Category</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut maximus, odio a imperdiet rhoncus, nunc metus luctus mi, at dignissim sem orci ut massa. Morbi a magna risus. Nunc vestibulum, nibh sit amet dictum pharetra, augue quam faucibus neque, et ultrices dui arcu ac ligula.</p>
                        </div>
                        <div class="col-sm-3 text-center">
                            <h4>$499</h4>
                            <a class="btn btn-primary btn-info btn-md" href="#">View Details</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <div class="btn-group">
            <button type="button" class="btn btn-default"><span class="fa fa-arrow-left"></span></button>
            <button type="button" class="btn btn-default">Previous</button>
            <button type="button" class="btn btn-default">1</button>
            <button type="button" class="btn btn-default">2</button>
            <button type="button" class="btn btn-default">3</button>
            <button type="button" class="btn btn-default">4</button>
            <button type="button" class="btn btn-default">5</button>
            <button type="button" class="btn btn-default">6</button>
            <button type="button" class="btn btn-default">Next</button>
            <button type="button" class="btn btn-default"><span class="fa fa-arrow-right"></span></button>
        </div>
    </div>
    <br>
<!--    <div class="row">-->
<!--        <div class="col-lg-12">-->
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">Striped Table</div>-->
<!--                <div class="panel-body btn-margins">-->
<!--                    <div class="col-md-12">-->
<!--                        <table class="table table-striped table-bordered">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>No</th>-->
<!--                                <th>Dokumen</th>-->
<!--                                <th>DocId</th>-->
<!--                                <th>Similarity</th>-->
<!--                                <th>Persentase</th>-->
<!--                                <th>Keterangan</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            --><?php
//                            while ($dataCache = mysqli_fetch_array($panggilCache)){
//                                $docId = $dataCache['docId'];
//                                $sim = $dataCache['similarity'];
//                                $persentase = $dataCache['persentase'];
//                                $keterangan = $dataCache['keterangan'];
//
//                                if($docId>0){
////                                    $panggilDataTraining = mysqli_query($connect, "SELECT * FROM data_training WHERE id='$docId'");
//                                    //test
//                                    $panggilDataTraining = mysqli_query($connect, "SELECT * FROM data_training2 WHERE id='$docId'");
//
//                                    $dataTraining = mysqli_fetch_array($panggilDataTraining);
////                                    $dokumen = $dataTraining['title'];
//                                    //Test
//                                    $dokumen = $dataTraining['isi_berita'];
//
//                                    $qw = explode(" ", $query);
//
//                                    $ck = explode(" ", strtolower($dokumen));
//                                    $tx ="";
//
////                                    $tx = $dataTraining['title'];
//                                    //Test
//                                    $tx = $dataTraining['isi_berita'];
//                                    if(!empty($query)){
//                                        $tx = highlightKeywords($dataTraining['isi_berita'], $query);
//                                    }
//
//                                    ?>
<!--                                    <tr>-->
<!--                                        <td>--><?php //echo $a;?><!--</td>-->
<!--                                        <td>--><?php //echo $tx;?><!--</td>-->
<!--                                        <td>--><?php //echo $docId;?><!--</td>-->
<!--                                        <td>--><?php //echo $sim;?><!--</td>-->
<!--                                        <td>--><?php //echo $persentase;?><!--</td>-->
<!--                                        <td>--><?php //echo $keterangan;?><!--</td>-->
<!--                                    </tr>-->
<!--                                    --><?php
//                                    $a++;
//                                }else{
//                                    print("<b>Tidak ada data yang sama</b><hr>");
//                                }
//                            }
//                            ?>
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<?php
}
?>