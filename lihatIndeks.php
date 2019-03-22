<?php
    include 'koneksi.php';
?>
<div class="row ">
    <div class="breadcrumb">
        <li><a href="">
                <em class="fa fa-list"></em>
            </a></li>
        <li class="active">Lihat Indeks</li>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="panel panel-heading">
                    Lihat Indeks Kata
                </div>
                <table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    <thead>
                    <tr>
                        <th data-field="id" data-sortable="true">No</th>
                        <th data-field="nomor_hadis"  data-sortable="true">Nomor Hadits</th>
                        <th data-field="term" data-sortable="true">Term</th>
                        <th data-field="count" data-sortable="true">Jumlah</th>
<!--                        <th data-field="bobot" data-sortable="true">Bobot</th>-->

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = mysqli_query($connect, "SELECT * FROM tb_index ORDER by id ASC") or die("Can't connect database");
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['nomor_hadis'];?></td>
                            <td><?php echo $row['term'];?></td>
                            <td><?php echo $row['count'];?></td>
<!--                            <td>--><?php //echo $row['bobot'];?><!--</td>-->
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
