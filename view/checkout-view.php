<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
?>
<script>
    $(document).ready(function() {
        document.querySelector('title').textContent = "Checkout | Apotek Online";
    })
</script>

<section class="payment-form dark">
    <div class="container">
        <form method="post" id="checkout">
            <div class="products" style="margin-top:40px">
                <h3 class="title" style="color:black; font-size:x-large;">Checkout</h3>
                <?php
                $total = 0;
                foreach ($cartItem as $item) {
                    echo '<div class="item">';
                    echo '<span class="price">Rp ' . $item->getTotal() . '</span>';
                    echo '<p class="item-name">' . $item->getObat()->getNama() . '</p>';
                    echo '<p class="item-description">Quantity: ' . $item->getJumlah() . '</p>';
                    echo '</div>';
                    $total += $item->getTotal();
                }
                echo '<div class="total" style="font-size:x-large;">Total<span class="price">Rp ' . $total . '</span></div>';
                echo '<input type="hidden" name="txtTotal" value="' . $total . '">';
                ?>

            </div>
            <div class="card-details">
                <h3 class="title" style="color:black; font-size:x-large;">Payment</h3>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioPayment" id="flexRadioDefault1" value="E-Money" required>
                    <label class="form-check-label" for="flexRadioDefault1">
                        <p>e-money</p>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioPayment" id="flexRadioDefault2" value="Transfer Bank" required>
                    <label class="form-check-label" for="flexRadioDefault2">
                        <p>transfer bank</p>
                    </label>
                </div>
            </div>
            <div class="form-group col-sm-12" style="padding: 0px 40px 40px;">
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#paymentModal" id="btnProceed" disabled>Proceed</button>
            </div>
            <!-- Payment Modal -->
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Payment Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="text-align:center; color:black;">
                            <p>Untuk kemudahan konfirmasi, Anda bisa menuliskan berita transfer INV55926 atau jika tidak memungkinkan Anda bisa mentransfer dengan angka/jumlah transfer yang unik. Misalnya Rp 2886926</p>
                            <img id="qrImage">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="btnConfirm" id="paymentConfirm" class="btn btn-primary" value="Sudah bayar">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>



<script>
    $('#checkout input[type="radio"]').on("change", function() {
        var checked = $("#checkout input[type='radio']:checked").val();
        if (checked == "E-Money") {
            $('#qrImage').attr('src', 'saweria.png');
            $('#btnProceed').prop('disabled', false);
        } else if (checked == "Transfer Bank") {
            $('#qrImage').attr('src', 'QR_BCA_NCH.jpeg');
            $('#btnProceed').prop('disabled', false);
        } else {
            $('#qrImage').attr('src', 'QR_BCA_NCH.jpeg');
            $('#btnProceed').prop('disabled', false);
        }
    })
</script>