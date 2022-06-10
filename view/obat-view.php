<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
?>

<div class="mt-4 d-flex align-items-center justify-content-center">
    <h1><a href="index.php?ahref=obat" style="color:white;">Obat</a></h1>
</div>
<div class="mb-4 d-flex align-items-center justify-content-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addObatModal">
        <i class="fa-solid fa-plus"></i> Add Obat
    </button>
</div>

<?php
if (isset($_SESSION['updateMessage'])) {
    echo $_SESSION['updateMessage'];
    unset($_SESSION['updateMessage']);
}
?>
<!-- Add Obat Modal -->
<div class="modal fade" id="addObatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>ID Obat</p>
                        </blockquote>
                        <input type="text" class="form-control" name="txtIdObat" placeholder="ID Obat" autofocus required id="idObat">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Nama Obat</p>
                        </blockquote>
                        <input type="text" class="form-control" name="txtName" placeholder="Nama Obat" required id="nameObat">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Jenis Obat</p>
                        </blockquote>
                        <input type="text" class="form-control" name="txtJenis" placeholder="Jenis Obat" required id="jenis">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Harga Obat</p>
                        </blockquote>
                        <input type="text" class="form-control" name="txtHarga" placeholder="Harga Obat" required id="obat">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Stock</p>
                        </blockquote>
                        <input type="text" class="form-control" name="txtStock" placeholder="Stock" required id="stock">
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Supplier</p>
                        </blockquote>
                        <select required id="select" class="form-control mx-2" name="optSupplier">
                            <option selected>--Please select supplier name--</option>';
                            <?php
                            foreach ($suppName as $item) {
                                echo '<option value="' . $item->getIdSupplier() . '">' . $item->getNama() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <blockquote class="blockquote">
                            <p>Photo</p>
                        </blockquote>
                        <input type="file" name="filePhoto" id="photoId" class="form-control" accept="image/png, image/jpeg">
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Add Obat" class="btn btn-primary my-2" name="btnSubmit">
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

<!-- Obat Detail -->
<div class="modal fade" id="obatDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Beli Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-auto">
                        <img style="width:15rem;" id="obatPhoto">
                    </div>
                    <div class="col-auto">
                        <h4 style="font-weight:bold; color:black;">Nama</h4>
                        <p style="color:black;" id="obatNama"></p>
                        <h4 style="font-weight:bold; color:black;">Jenis</h4>
                        <p style="color:black;" id="obatJenis"></p>
                        <h4 style="font-weight:bold; color:black;">Kuantitas</h4>
                        <div class="input-group number-spinner">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="down"><i class="fa-solid fa-minus"></i></button>
                            </span>
                            <input type="number" class="form-control text-center" value="1" id="quantity" style="width: 4em;">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="up"><i class="fa-solid fa-plus"></i></button>
                            </span>
                            <p style="color:black; margin-top:3px;">Stok:&nbsp;</p>
                            <p style="color:black; margin-top:3px;" id="obatStock"></p>
                        </div>
                        <h4 style="font-weight:bold; color:black;">Harga</h4>
                        <span style="color:black; font-weight:bold; font-size:x-large; color:#3e64ff">Rp</span>
                        <span style="color:black; font-weight:bold; font-size:x-large; color:#3e64ff" id="obatHarga"></span>
                    </div>
                    <div class="col-auto">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="deleteConfirm" class="btn btn-primary">Beli Obat</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row row-cols-1 d-flex align-items-center justify-content-center">
        <?php
        foreach ($obats as $item) {
            echo '<div class="col-xs-6 mb-4" style="width:15rem;">';
            if ($item->getStock() == 0) {
                echo '<div class="card-noHover h-100" style="color:black;">
                <img src="image/' . $item->getPhoto() . '" class="card-img-top" alt="Image" style="width:15rem;">
                    <div class="card-body">
                        <a>' . $item->getNama() . '</a>
                        <blockquote class="blockquote">
                        <p style="color:red; font-weight:bold;">Stock Habis</p>
                        </blockquote>
                    </div>
                    </div>
                </div>';
            } else {
                echo '<button type="button" onclick="viewObat(\'' . $item->getIdObat() . '\')" style="padding:0px; border:0px" data-toggle="modal" data-target="#obatDetailModal">
                <div class="card h-100" style="color:black;">
                <img src="image/' . $item->getPhoto() . '" class="card-img-top" alt="Image" style="width:15rem;">
                    <div class="card-body" style="text-align:left;">
                        <a>' . $item->getNama() . '</a>
                        <blockquote class="blockquote">
                        <p style="color:#3e64ff; font-weight:bold;">Rp ' . $item->getHarga() . '</p>
                        </blockquote>
                    </div>
                </div>
                </button>
            </div>';
            }
        }
        ?>
    </div>
</div>

<script>
    $('#up').click(function() {
        var val = $('#quantity').val();
        var max = $('#quantity').attr('max');
        val++;
        if (val > max) {
            val = max;
        }
        $('#quantity').val(val);
    });

    $('#down').click(function() {
        var val = $('#quantity').val();
        val--;
        if (val < 1) {
            val = 1;
        }
        $('#quantity').val(val);
    })

    $('#quantity').on('keyup', function() {
        var val = parseInt($('#quantity').val());
        var max = parseInt($('#quantity').attr('max'));
        if (val > max) {
            $('#quantity').val(max);
        } else if (val < 1) {
            $('#quantity').val(1);
        }
        
    });

    function viewObat(id) {
        $.ajax({
            url: 'controller/ObatController.php',
            type: 'post',
            data: {
                method: "fetchObat",
                id: id
            },
            success: function(responsedata) {
                var response = $.parseJSON(responsedata);
                $('#obatNama').text(response.nama);
                $('#obatJenis').text(response.jenis);
                $('#obatStock').text(response.stock);
                $('#obatHarga').text(response.harga);
                $("#obatPhoto").attr("src", "image/" + response.photo);
                $("#quantity").val("1");
                $('#quantity').attr('max', response.stock);
            }
        })
    }
</script>