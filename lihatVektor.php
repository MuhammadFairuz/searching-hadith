<?php
    include 'koneksi.php';
?>

<div class="row">
    <div class="breadcrumb">
        <li><a href="">
                <em class="fa fa-list"></em>
            </a></li>
        <li class="active">Lihat Vektor</li>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="panel panel-heading">
                    Lihat Vektor Dokumen
                </div>
                <table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    <thead>
                    <tr>
                        <th data-field="id" data-sortable="true">No</th>
                        <th data-field="panjangvektor"  data-sortable="true">Panjang Vektor</th>
                        <th data-field="dokumen" data-sortable="true">Dokumen</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = mysqli_query($connect, "SELECT * FROM tb_vektor ORDER by docId ASC") or die("Can't connect database");
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['panjang'];?></td>
                            <td><?php echo $row['docId'];?></td>
                        </tr>
                        <?PHP
                        $no++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

