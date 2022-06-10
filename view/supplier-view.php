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
<div class="mt-4 d-flex align-items-center justify-content-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSupplierModal">
        <i class="fa-solid fa-plus"></i> Add new supplier
    </button>
</div>

<?php
if (isset($_SESSION['updateMessage'])) {
    echo $_SESSION['updateMessage'];
    unset($_SESSION['updateMessage']);
}
?>
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Nama Supplier</p>
                        </blockquote>
                        <input type="text" class="form-control" name="txtName" placeholder="Nama Supplier" autofocus required id="nameSupp">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Alamat</p>
                        </blockquote>
                        <input type="text" class="form-control" name="txtAddress" placeholder="Alamat" required id="address">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Kota</p>
                        </blockquote>
                        <input type="text" class="form-control" name="txtCity" placeholder="Kota" required id="city">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>No. Telp</p>
                        </blockquote>
                        <input type="text" class="form-control" name="txtPhone" placeholder="No. Telp" required id="phone">
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Add Supplier" class="btn btn-primary my-2" name="btnSubmit">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Supplier Modal -->
<div class="modal fade" id="updateSupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>ID Supplier</p>
                        </blockquote>
                        <input type="text" class="form-control" name="updateId" placeholder="ID Supplier" readonly id="idUpdateSupp">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Nama Supplier</p>
                        </blockquote>
                        <input type="text" class="form-control" name="updateName" placeholder="Nama Supplier" autofocus required id="nameUpdateSupp">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Alamat</p>
                        </blockquote>
                        <input type="text" class="form-control" name="updateAddress" placeholder="Alamat" required id="updateAddress">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Kota</p>
                        </blockquote>
                        <input type="text" class="form-control" name="updateCity" placeholder="Kota" required id="updateCity">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>No. Telp</p>
                        </blockquote>
                        <input type="text" class="form-control" name="updatePhone" placeholder="No. Telp" required id="updatePhone">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary my-2" name="btnUpdateSubmit" id="btnUpdate">Update Supplier</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteSupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span style="color:black;">Are you sure want to delete this data?</span>
            </div>
            <div class="modal-footer">
                <button type="button" id="deleteConfirm" class="btn btn-primary">Delete supplier</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
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
            echo '<td> <button onclick="editSupp(\'' . $item->getIdSupplier() . '\')" data-toggle="modal" data-target="#updateSupplierModal" class="btn btn-warning"><i data-fa-symbol="edit" class="fas fa-edit fa-fw"></i></button>
                    <button onclick="deleteSupp(\'' . $item->getIdSupplier() . '\')" data-toggle="modal" data-target="#deleteSupplierModal" class="btn btn-danger"><i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i></button>
                    </td>';
            echo '</tr>';
        }

        ?>
    </tbody>
</table>

<script>
    function editSupp(id) {
        $.ajax({
            url: 'controller/SupplierController.php',
            type: 'post',
            data: {
                method: "fetchSupp",
                id: id
            },
            success: function(responsedata) {
                var response = $.parseJSON(responsedata);
                $('#idUpdateSupp').val(response.idSupplier);
                $('#nameUpdateSupp').val(response.nama);
                $('#updateAddress').val(response.alamat);
                $('#updateCity').val(response.kota);
                $('#updatePhone').val(response.phone);
            }
        })
    }
    
    function deleteSupp(id) {
        $('#deleteConfirm').click(function() {
            window.location = "index.php?ahref=supplier&delcom=1&sid=" + id;
        })
    }
</script>