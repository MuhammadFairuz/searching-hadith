<?php
$preproses = $_POST['preproses'];
if($preproses == "preproses"){
    //mulai proses
    set_time_limit(0);
    buatindex();
    pembobotan();
//    panjangvektor();
}

//inisiasi stopword
function stopword($hadis){
    include 'koneksi.php';

    //memanggil tabel stopword
    $tbkatastop = mysqli_query($connect, "SELECT * FROM stopword");

    //merubah menjadi huruf kecil
    $hadis = strtolower($hadis);

    //list tanda baca
    $listtb = array("/", ".", ",", "?", "'", "\"", ";", ":", "-", "(", ")");

    //menghilangkan tanda baca
    foreach ($listtb as $i => $value){
        $hadis = str_replace($listtb[$i], " ", $hadis);
    }

    //memanggil stopword
    while ($data = mysqli_fetch_array($tbkatastop, MYSQLI_NUM)){
        $katastop[] = trim($data[1]);
    }

    //memisah kata
    $perkata = explode(" ", $hadis);

    //hitung jumlah kata
    $jmlkata = count($perkata);

    //hapus data yang sama dengan stopword
    for($i=0; $i < $jmlkata; $i++){
        if(in_array($perkata[$i], $tbkatastop)){
            unset($perkata[$i]);
        }
    }

    //menggabungkan perkata
    $hadis = implode(" ", $perkata);
    $hadis = trim($hadis);
    return $hadis;
}

function stemming2 ($hadis){
    include 'koneksi.php';
    include_once  'stemming.php';

    //memanggil stopword
    $hasilstopword = stopword($hadis);

    //hasil stiopword dipisah perkata
    $perkata = explode(" ", $hasilstopword);

    //hitung jumlah kata
    $jmlkata = count($perkata);

    //dirubah menjadi kata dasar
    for ($i=0; $i < $jmlkata ; $i++){
        $perkata[$i] = stemming($perkata[$i]);
    }

    //menggabungkan data
    $hadis = implode(" ", $perkata);
    $hadis = trim($hadis);
    return $hadis;
}
////....................................................................................................................

//fungsi untuk membuat index
function buatindex(){
    include 'koneksi.php';

    //hapus index sebelumnya
    mysqli_query($connect, "TRUNCATE TABLE tb_index");

    //test
    $panggilData = mysqli_query($connect, "SELECT *FROM tb_hadis ORDER BY nomor_hadis");

    //jumlahkan data
    $jmlData = mysqli_num_rows($panggilData);

    print("Mengindeks sebanyak".$jmlData."Data Training. <br />");

    while($dataHadis = mysqli_fetch_array($panggilData)){
//        $docId = $dataPlagiarim['id'];
//        $plagiarism = $dataPlagiarim['title'];

        //test
        $docId = $dataHadis['nomor_hadis'];
        $hadis = $dataHadis['isi'];

        //terapkan stemming dan stopword
        $hadis = stemming2($hadis);

        //simpan ke tb_index
        $hHadis = explode(" ", trim($hadis));

        foreach ($hHadis as $j => $value){
            //hanya jika term tidak null atau nil, tidak kosong
            if($hHadis[$j] != ""){

                //mengembalikan baris denganquery
                $hitungterm = mysqli_query($connect, "SELECT count FROM tb_index WHERE term = '$hHadis[$j]' AND nomor_hadis = $docId");

                //jumlahkan baris
                $jmlterm = mysqli_num_rows($hitungterm);

                //jika sudah ada DocId dan term tersebut, naikkan count
                if ($jmlterm >0){
                    $dataTerm = mysqli_fetch_array($hitungterm);
                    $count = $dataTerm['count'];
                    $count++;

                    mysqli_query($connect, "UPDATE tb_index SET count = $count WHERE term = '$hHadis[$j]' AND nomor_hadis = $docId");

                }
                //jika belum ada, langsung simpan ke tb_index
                else{
                    mysqli_query($connect, "INSERT INTO tb_index (term,nomor_hadis, count) VALUES ('$hHadis[$j]', $docId, 1)");

                }

            }
        }
    }
}
////....................................................................................................................
/*
 * fungsi pembobotan berikut ini menggunakan pendekatan TF IDF
 * */
//
//function pembobotan(){
//   include 'koneksi.php';
//
//   //brapa jumlah docID total? , n
//    $panggilidindex = mysqli_query($connect, "SELECT DISTINCT nomor_hadis FROM tb_index");
//    $n = mysqli_num_rows($panggilidindex);
//
//    //ambil record dalam setiap table tb_index
//    //hitung setiap term dalam setiap docID
//    $panggilindex = mysqli_query($connect, "SELECT * FROM tb_index ORDER BY id");
//    $jmlindex = mysqli_num_rows($panggilindex);
//
//    print ("Terdapat".$jmlindex."Term dari data training yang diberikan bobot.<br/>");
//
//    while ($dataindex = mysqli_fetch_array($panggilindex)){
//        $term = $dataindex['term'];
//        $tf = $dataindex['count'];
//        $id = $dataindex['id'];
//
//        //berapa jumlah yang mengandung term tersebut?
//        $hitungTerm = mysqli_query($connect,"SELECT count(*) as N FROM tb_index WHERE term = '$term'");
//        $dataTerm = mysqli_fetch_array($hitungTerm);
//        $Nterm = $dataTerm['N'];
//
//        //masukkan ke dalam perhitungan TFIDF
//        $w = $tf * log($n/$Nterm);
//
//        //update bobot dari term tersebut
//        $resupdateBobot =mysqli_query($connect, "UPDATE tb_index SET bobot= $w WHERE id= $id");
//    }
//}
//
//////...................................................................................................................
////fungsi panjangvektor, jarak euclidean
////akar(penjumlahan kuadrat dari bobot setiap Term)
//function panjangvektor() {
//    include 'koneksi.php';
//    //hapus isi tabel tb_vektor
//    mysqli_query($connect,"TRUNCATE TABLE tb_vektor");
//
//    //ambil setiap DocId dalam tbindex
//    //hitung panjang vektor untuk setiap DocId tersebut
//    //simpan ke dalam tabel tbvektor
//    $panggilidindex = mysqli_query($connect,"SELECT DISTINCT docId FROM tb_index");
//
//    $jmlindex = mysqli_num_rows($panggilidindex);
//    print("Terdapat " . $jmlindex . " ayat Al Quran yang dihitung panjang vektornya. <br />");
//
//    while($dataidindex = mysqli_fetch_array($panggilidindex)) {
//        $docId = $dataidindex['docId'];
//
//        $panggilbobotindex = mysqli_query($connect,"SELECT bobot FROM tb_index WHERE docId = $docId");
//
//        //jumlahkan semua bobot kuadrat
//        $panjangVektor = 0;
//        while($datavektor = mysqli_fetch_array($panggilbobotindex)) {
//            $panjangVektor = $panjangVektor + $datavektor['bobot']  *  $datavektor['bobot'];
//        }
//
//        //hitung akarnya
//        $panjangVektor = sqrt($panjangVektor);
//
//        //masukkan ke dalam tbvektor
//        $simpanvektor = mysqli_query($connect,"INSERT INTO tb_vektor (docId, panjang) VALUES ($docId, $panjangVektor)");
//    } //end while $rowDocId
//} //end function panjangvektor

?>