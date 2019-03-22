<?php
include('koneksi.php');
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-list"></em>
            </a></li>
        <li class="active">Data Set</li>
    </ol>
</div><!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel panel-heading">DATA SET</div>
            <div class="panel-body">
                <table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    <thead>
                    <tr>
                        <th data-field="nomor_hadis" data-sortable="true">No_Hadith</th>
                        <th data-field="kitab" data-sortable="true">Kitab</th>
                        <th data-field="bab" data-sortable="true">Bab</th>
                        <th data-field="isi" data-sortable="true">Isi</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = mysqli_query($connect, "SELECT * FROM tb_hadis ORDER by nomor_hadis ASC") or die(("Can't Connect Database"));
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $row['kitab'];?></td>
                                <td><?php echo $row['bab'];?></td>
                                <td><?php echo $row['isi'];?></td>
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



