<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
?>
<script>
    $(document).ready(function() {
        document.querySelector('title').textContent = "Penjualan | Apotek Online";
    })
</script>
<div class="mt-4 d-flex align-items-center justify-content-center">
    <h1><a href="index.php?ahref=penjualan" style="color:white;">Penjualan Obat</a></h1>
</div>

<table id="tableId" class="display">
    <thead>
        <tr>
            <th>ID Penjualan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Payment</th>
            <th>User Email</th>
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
            echo '<td>' . $item->getIdPenjualan() . '</td>';
            echo '<td>' . $item->getTanggal() . '</td>';
            echo '<td>' . $item->getTotal() . '</td>';
            echo '<td>' . $item->getPayment() . '</td>';
            echo '<td>' . $item->getUser()->getEmail() . '</td>';
            echo '<td> <button onclick="viewPenjualan(\'' . $item->getIdPenjualan() . '\')" data-toggle="modal" data-target="#updateSupplierModal" class="btn btn-info" style="
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