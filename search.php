<script type="text/javascript">
    function checkplagiarism(){
        var keyx = $("#keyword").val();
        $.ajax({
           type: "POST",
           url: "checkPlagiarism.php",
           data: {keyword : keyx},
           error: function (html) {
                $("#hasil").prepend("gagal");
            },
            success: function (html) {
//                $("#hasil").prepend("<br>Pencarian Berhasil Dilkukan<br>"+html);
                $("#hasil").prepend(html);
                alert("Pencarian Selesai dilakukan");
            },
        });
    }
</script>

<link href="css/toggle_style.css" rel="stylesheet">
<?php
    $file = $_FILES['file']['name'];
    $isiOpen = fopen($file, "r");
    $isi .= fgets($isiOpen);
?>
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-search"></em>
                </a></li>
            <li class="active">QAS-Hadith</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Search Hadith</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form>
                <div class="input-group input-group-lg">
                    <input id="keyword" type="text" placeholder="search" class="form-control">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default" tabindex="-1" onclick="checkplagiarism()"><i class="fa fa-search"></i></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-6">
            <form role="form">
            <div class="form-group">
                Query Expansion
                &nbsp;
                <label id="query_expansion" class="switch" id="switch_button">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            </form>
            </div>
        </div>
    </div>
    <div id="hasil"></div>


