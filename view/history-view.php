<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
?>
<script>
    $(document).ready(function() {
        document.querySelector('title').textContent = "Riwayat Pesanan | Apotek Online";
    })
</script>
<div class="mt-4 d-flex align-items-center justify-content-center">
    <h1><a href="index.php?ahref=history" style="color:white;">Riwayat Pesanan Obat</a></h1>
</div>

<!-- Penjualan Detail Modal -->
<div class="modal fade" id="penjualanDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penjualan Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tableDetail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<table id="tableId" class="display">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Payment</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        <?php
        /**
         * @var $item Penjualan
         */
        foreach ($penjualan as $item) {
            echo '<tr>';
            echo '<td>' . $item->getTanggal() . '</td>';
            echo '<td>' . $item->getTotal() . '</td>';
            echo '<td>' . $item->getPayment() . '</td>';
            echo '<td> <button onclick="viewPenjualanDet(\'' . $item->getIdPenjualan() . '\')" data-toggle="modal" data-target="#penjualanDetailModal" class="btn btn-info" style="
            width: 35px;
			height: 35px;
			border-radius: 30px;
			font-size: 15px;
			text-align: center;"><i class="fa-solid fa-info"></i></button>';
            echo '</tr>';
        }

        ?>
    </tbody>
</table>
<script>
    function viewPenjualanDet(idPenjualan) {
        $.ajax({
            url: 'controller/ObatHasPenjualanController.php',
            type: 'post',
            data: {
                method: "fetchPenjualanDet",
                idPenjualan: idPenjualan
            },
            success: function(responsedata) {
                var response = $.parseJSON(responsedata);
                console.log(response);
                $('#tableDetail').html('');
                var i = 1;
                var table = "<table class='table'>";
                table += '<thead>';
                table += '<tr>';
                table += '<th scope="col">No.</th>';
                table += '<th scope="col">Nama Obat</th>';
                table += '<th scope="col">Jumlah</th>';
                table += '<th scope="col">Harga</th>';
                table += '<tr>';
                table += '<thead>';
                table += '<tbody id="isiPenjualanDet">';
                $('#tableDetail').append(table);
                for (var item in response) {
                    var html = "<tr>";
                    html += '<td>' + response[item].seq + '</td>';
                    html += '<td>' + response[item].obat.nama + '</td>';
                    html += '<td>' + response[item].jumlah + '</td>';
                    html += '<td>' + response[item].harga + '</td>';
                    html += "</tr>";
                    $('#isiPenjualanDet').append(html);
                    i++;
                }
            }
        })
    }
</script>