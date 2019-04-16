
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-file"></em>
                </a></li>
            <li class="active">Preprocessing</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    Preprocessing
                </div>
                <div class="panel-body btn-margins">
                    <p>Klik tombol preprocessing untuk memulai proses.</p>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-lg btn-primary" onclick="preproses()">Preprocessing</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function preproses(){

            var preprosesx = "preproses";
            $.ajax({
                type : "POST",
                url : "fungsi.php",
                data: {preproses:preprosesx},
                error: function(){
                    $("#notif").prepend("gagal");
                },
                success: function(html){
                    $("#notif").prepend("Preprosesing berhasil dilakukan<br/>"+html);
                    alert('Prepocessing Sukses');
                },
            });
            return false;
        }
    </script>

