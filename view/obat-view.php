<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */


if (!isset($_SESSION['web_user']) || $_SESSION['web_user'] == false) {
?>
    <div class="float-right p-2">
        <a class="btn btn-primary" href="?ahref=login">Login</a>
        <a class="btn btn-success" href="?ahref=signup">Sign Up</a>
    </div>
<?php
}

if (isset($_SESSION['paymentComplete'])) {
    echo $_SESSION['paymentComplete'];
    unset($_SESSION['paymentComplete']);
}
?>
<script>
    $(document).ready(function() {
        document.querySelector('title').textContent = "Obat | Apotek Online";
    })
</script>
<div class="mt-4 d-flex align-items-center justify-content-center">
    <h1><a href="index.php?ahref=obat" style="color:white;">Obat</a></h1>
</div>
<?php
if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
    echo '<div class="mb-4 d-flex align-items-center justify-content-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addObatModal">
        <i class="fa-solid fa-plus"></i> Add Obat
    </button>
</div>';
}
?>
<div class="mb-4 d-flex align-items-center justify-content-center">
    <form method="post">
        <input type="text" name="searchObat" placeholder="Cari obat" id="searchObat">
        <input type="submit" value="Search Obat" class="btn btn-primary my-2" name="btnSearch">
    </form>
</div>
<div class="mb-4 d-flex align-items-center justify-content-center">
    <?php
    if (isset($nama) && !empty($nama)) {
        echo '<h3 style="color:white;">Search for "' . $nama . '"</h3>';
    }
    ?>
</div>

<?php
if (isset($_SESSION['updateMessage'])) {
    echo $_SESSION['updateMessage'];
    unset($_SESSION['updateMessage']);
}
if (isset($_SESSION['email']) && isset($_SESSION['web_user'])) {
    echo '<button onclick="viewKeranjang(\'' . $_SESSION['email'] . '\')" class="btn btn-primary btn-card my-2" name="btnSearch" data-toggle="modal" data-target="#keranjangModal"><i class="fa-solid fa-cart-shopping fa-xl"></i></button>';
} else {
    echo '<a href="index.php?ahref=login"><button type="submit" name="loginAgain" class="btn btn-primary btn-card my-2"><i class="fa-solid fa-cart-shopping fa-xl"></i></button></a>';
    $message = '<i class="fa-solid fa-circle-info"></i> Kamu belum login. Yuk, login terlebih dahulu!';
    $_SESSION['loginMessage'] = "<script> bootoast.toast({
                        message: '" . $message . "',
                        type: 'success',
                        position: 'top'
                    }); </script>";
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
                        <span id='idObatMessage'></span>
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
                <input type="submit" value="Add Obat" class="btn btn-primary my-2" name="btnSubmit" id="addObat">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Obat Modal -->
<div class="modal fade" id="editObatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow:auto;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-auto">
                            <img style="width:15rem;" id="updatePhoto">
                        </div>
                        <div class="col-auto">
                            <input type="hidden" id="oldPhoto" name="oldPhoto">
                            <div class="form-group">
                                <blockquote class="blockquote">
                                    <p>ID Obat</p>
                                </blockquote>
                                <input type="text" class="form-control" name="updateId" placeholder="ID Obat" readonly id="idUpdateObat">
                            </div>
                            <div class="form-group">
                                <blockquote class="blockquote">
                                    <p>Nama Obat</p>
                                </blockquote>
                                <input type="text" class="form-control" name="updateName" placeholder="Nama Obat" autofocus required id="nameUpdateObat">
                            </div>
                            <div class="form-group">
                                <blockquote class="blockquote">
                                    <p>Jenis</p>
                                </blockquote>
                                <input type="text" class="form-control" name="updateJenis" placeholder="Jenis" required id="updateJenis">
                            </div>
                            <div class="form-group">
                                <blockquote class="blockquote">
                                    <p>Stock</p>
                                </blockquote>
                                <input type="text" class="form-control" name="updateStock" placeholder="Stock" required id="updateStock">
                            </div>
                            <div class="form-group">
                                <blockquote class="blockquote">
                                    <p>Harga</p>
                                </blockquote>
                                <input type="text" class="form-control" name="updateHarga" placeholder="Harga" required id="updateHarga">
                            </div>
                            <div class="form-group">
                                <blockquote class="blockquote">
                                    <p>Supplier</p>
                                </blockquote>
                                <select required id="selectUpdate" class="form-control mx-2" name="optSupplier">
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary my-2" name="btnUpdateSubmit" id="btnUpdate">Update obat</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteObatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button type="button" id="deleteConfirm" class="btn btn-primary">Delete obat</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Obat Detail -->
<div class="modal fade" id="obatDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Beli obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-auto">
                            <img style="width:15rem;" id="obatPhoto">
                        </div>
                        <input type="hidden" id="obatIdDet" name="obatIdDet">
                        <div class="col-auto">
                            <h4 style="font-weight:bold; color:black;">Nama</h4>
                            <p style="color:black;" id="obatNama"></p>
                            <h4 style="font-weight:bold; color:black;">Jenis</h4>
                            <p style="color:black;" id="obatJenis"></p>
                            <h4 style="font-weight:bold; color:black;">Kuantitas</h4>
                            <div class="input-group number-spinner">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" id="down"><i class="fa-solid fa-minus"></i></button>
                                </span>
                                <input type="number" name="obatQuantity" class="form-control text-center" value="1" id="quantity" style="width: 4em;">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" id="up"><i class="fa-solid fa-plus"></i></button>
                                </span>
                                <p style="color:black; margin-top:3px;">Stok:&nbsp;</p>
                                <p style="color:black; margin-top:3px;" id="obatStock"></p>
                            </div>
                            <input type="hidden" id="obatPrice" name="obatPrice">
                            <h4 style="font-weight:bold; color:black;">Harga</h4>
                            <span style="color:black; font-weight:bold; font-size:x-large; color:#3e64ff">Rp</span>
                            <span style="color:black; font-weight:bold; font-size:x-large; color:#3e64ff" id="obatHarga"></span>
                        </div>
                        <?php
                        if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
                            echo '<div class="col-auto">
                        <h4 style="font-weight:bold; color:black;">ID Obat</h4>
                        <p style="color:black; margin-top:3px;" id="idObatAdmin"></p>
                        <h4 style="font-weight:bold; color:black;">Supplier</h4>
                        <p style="color:black; margin-top:3px;" id="namaSupplier"></p>
                        <button id="editObat" data-dismiss="modal" data-toggle="modal" data-target="#editObatModal" class="btn btn-warning"><i data-fa-symbol="edit" class="fas fa-edit fa-fw"></i></button>
                        <button data-dismiss="modal" data-toggle="modal" data-target="#deleteObatModal" class="btn btn-danger"><i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i></button>
                    </div>';
                        }
                        ?>
                    </div>
            </div>
            <div class="modal-footer">
                <?php
                if (isset($_SESSION['web_user']) && isset($_SESSION['role'])) {
                    echo '<button type="submit" id="keranjangConfirm" name="btnKeranjang" class="btn btn-primary">Masuk keranjang</button>';
                } else {
                    echo '<a href="index.php?ahref=login"><button type="button" class="btn btn-primary">Masuk keranjang</button></a>';
                }
                ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Keranjang Modal -->
<div class="modal fade" id="keranjangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keranjang Belanja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="isiKeranjang" style="text-align:center;">
            </div>
            <div class="modal-footer" id="buttonFooter">
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row row-cols-1 d-flex align-items-center justify-content-center">
        <?php
        if (count($obats) == 0) {
            echo '<p style="text-align:center;font-size:x-large">Maaf, obat tidak ditemukan :(</p>';
        } else {
            foreach ($obats as $item) {
                echo '<div class="col-xs-6 mb-4" style="width:15rem;">';
                if ($item->getStock() == 0) {
                    if ($_SESSION['role'] == "user") {
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
                    <p style="color:red; font-weight:bold;">Stock Habis</p>
                    </blockquote>
                    </div>
                </div>
                </button>
            </div>';
                    }
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
        }
        ?>
    </div>
</div>
<script>
    $('#up').click(function() {
        var val = parseInt($('#quantity').val());
        var max = parseInt($('#quantity').attr('max'));
        val++;
        if (val > max) {
            val = max;
        }
        $('#quantity').val(val);
    });

    $('#down').click(function() {
        var val = parseInt($('#quantity').val());
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
                $('#obatIdDet').val(response.idObat);
                $('#idObatAdmin').text(response.idObat);
                $('#obatNama').text(response.nama);
                $('#obatJenis').text(response.jenis);
                $('#obatStock').text(response.stock);
                $('#obatHarga').text(response.harga);
                $('#obatPrice').val(response.harga);
                $("#obatPhoto").attr("src", "image/" + response.photo);
                $("#namaSupplier").text(response.supplier.nama);
                $("#oldPhoto").val(response.photo);
                $("#quantity").val("1");
                $('#quantity').attr('max', response.stock);
            }
        })
        $('#editObat').click(function() {
            $.ajax({
                url: 'controller/ObatController.php',
                type: 'post',
                data: {
                    method: "fetchObat",
                    id: id
                },
                success: function(responsedata) {
                    var response = $.parseJSON(responsedata);
                    $('#idUpdateObat').val(response.idObat);
                    $('#nameUpdateObat').val(response.nama);
                    $('#updateJenis').val(response.jenis);
                    $('#updateStock').val(response.stock);
                    $('#updateHarga').val(response.harga);
                    $("#updatePhoto").attr("src", "image/" + response.photo);
                    $("#selectUpdate").val(response.supplier.idSupplier).change();
                }
            })
        });
        $('#deleteConfirm').click(function() {
            window.location = "index.php?ahref=obat&delcom=1&oid=" + id + "&photo=" + $('#oldPhoto').val();
        })
    }

    function viewKeranjang(email) {
        $.ajax({
            url: 'controller/KeranjangController.php',
            type: 'post',
            data: {
                method: "fetchKeranjang",
                email: email
            },
            success: function(responsedata) {
                var response = $.parseJSON(responsedata);
                var i = 1;
                $('#isiKeranjang').html('');
                if (response.length == 0) {
                    var html = "";
                    html += '<img src="empty cart.png">';
                    html += '<h4 style="font-weight:bold; color:black;">Wah, keranjang belanjamu kosong</h4>';
                    html += '<p style="color:black;">Yuk, isi dengan obat!</p>';
                    html += '<a href="index.php?ahref=obat">';
                    html += '<button type="button" id="checkoutKeranjang" class="btn btn-success">Mulai belanja</button>';
                    html += '</a>';
                    $('#isiKeranjang').append(html);
                } else {
                    var table = "<table class='table'>";
                    table += '<thead>';
                    table += '<tr>';
                    table += '<th scope="col">No.</th>';
                    table += '<th scope="col">Nama Obat</th>';
                    table += '<th scope="col">Jumlah</th>';
                    table += '<th scope="col">Total Harga</th>';
                    table += '<th scope="col">Action</th>';
                    table += '<tr>';
                    table += '<thead>';
                    table += '<tbody id="isiKeranjangDet">';
                    $('#isiKeranjang').append(table);
                    for (var keranjang in response) {
                        var html = "<tr>";
                        html += '<td>' + i + '</td>';
                        html += '<td>' + response[keranjang].obat.nama + '</td>';
                        html += '<td>' + response[keranjang].jumlah + '</td>';
                        html += '<td>' + response[keranjang].total + '</td>';
                        html += '<td><button onclick="deleteKeranjang(\'' + response[keranjang].idKeranjang + '\')" class="btn btn-danger"><i data-fa-symbol="delete" class="fas fa-trash fa-fw"></i></button></td>';
                        html += "</tr>";
                        $('#isiKeranjangDet').append(html);
                        i++;
                    }
                    $('#buttonFooter').html('');
                    var footer = "";
                    footer += '<a href="index.php?ahref=checkout"><button type="button" id="tambahKeranjang" class="btn btn-primary">Checkout</button></a>';
                    footer += '<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>';
                    $('#buttonFooter').append(footer);
                }
            }
        })
    }

    $('#idObat').on('keyup', function() {
        $.ajax({
            url: 'controller/ObatController.php',
            type: 'post',
            data: {
                method: "checkIdObat",
                id: $('#idObat').val()
            },
            success: function(responsedata) {
                if (responsedata == 1) {
                    document.getElementById('addObat').disabled = true;
                    document.getElementById('idObatMessage').innerHTML = '<i class="fa-solid fa-xmark"></i> ID Obat has already been used';
                    document.getElementById('idObatMessage').style.color = 'red';
                } else {
                    document.getElementById('addObat').disabled = false;
                    document.getElementById('idObatMessage').innerHTML = '';
                }
            }
        })
    })

    function deleteKeranjang(id) {
        const confirmation = window.confirm("Are you sure want to delete this data?");
        if (confirmation) {
            window.location = "index.php?ahref=obat&delkcom=1&kid=" + id;
        }
    }
</script>