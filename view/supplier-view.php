<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
?>
<div class="mt-4 d-flex align-items-center justify-content-center">
    <h1><a href="index.php?ahref=supplier" style="color:white;">Supplier Obat</a></h1>
</div>
<div class="container">
    <form method="post">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nameSupp" class="form-label">Nama Supplier</label>
                    <input type="text" class="form-control" name="txtName" placeholder="Nama Supplier" autofocus required id="nameSupp">
                </div>
                <div class="form-group">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="txtAddress" placeholder="Alamat" required id="address">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="city" class="form-label">Kota</label>
                    <input type="text" class="form-control" name="txtCity" placeholder="Kota" required id="city">
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">No. Telp</label>
                    <input type="text" class="form-control" name="txtPhone" placeholder="No. Telp" required id="phone">
                </div>
            </div>
        </div>
        <input type="submit" value="Add Supplier" class="btn btn-primary my-2" name="btnSubmit">
    </form>
</div>


<table id="tableId" class="display">
    <thead>
        <tr>
            <th>ID Supplier</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>No. Telp</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>anjing</td>
            <td>anjing</td>
            <td>anjing</td>
            <td>anjing</td>
            <td>anjing</td>
            <td>anjing</td>
        </tr>
        <tr>
            <td>kucing</td>
            <td>kucing</td>
            <td>kucing</td>
            <td>kucing</td>
            <td>kucing</td>
            <td>kucing</td>
        </tr>
        <?php
        /**
         * @var $item Supplier
         */
        foreach ($suppliers as $item) {
            echo '<tr>';
            echo '<td>' . $item->getIdSupplier() . '</td>';
            echo '<td>' . $item->getNama() . '</td>';
            echo '<td>' . $item->getAlamat() . '</td>';
            echo '<td>' . $item->getKota() . '</td>';
            echo '<td>' . $item->getPhone() . '</td>';
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
                echo '<td>
                    <button onclick="editSupp(\'' . $item->getIdSupplier() . '\')" class="btn btn-warning"><i data-fa-symbol="edit" class="fas fa-edit fa-fw"></i></button>
                    <button onclick="deleteSupp(\'' . $item->getIdSupplier() . '\')" class="btn btn-danger"><i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i></button>
                    </td>';
            }
            echo '</tr>';
        }

        ?>
    </tbody>
</table>

<script>
    function editSupp(id) {
        window.location = "index.php?ahref=upsupp&sid=" + id;
    }

    function deleteSupp(id) {
        const confirmation = window.confirm("Are you sure want to delete this data?");
        if (confirmation) {
            window.location = "index.php?ahref=supplier&delcom=1&sid=" + id;
        }
    }
</script>