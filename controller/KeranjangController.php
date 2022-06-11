<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

class KeranjangController
{
    private $keranjangDao;

    public function __construct()
    {
        $this->keranjangDao = new KeranjangDaoImpl();
    }
    public function index()
    {
        $deleteCommand = filter_input(INPUT_GET,  'delkcom');
        if (isset($deleteCommand) && $deleteCommand == 1) {
            $keranjangId = filter_input(INPUT_GET,  'kid');
            $result = $this->keranjangDao->deleteKeranjang($keranjangId);
            if ($result) {
                echo '<script>
        window.history.pushState("","Document","index.php?ahref=obat");
        </script>';
                $message = '<i class="fa-solid fa-circle-check"></i> Data successfully deleted';
                echo "<script> bootoast.toast({
            message: '" . $message . "',
            type: 'success',
            position: 'top'
        }); </script>";
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Error on delete data';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
                    position: 'top'
                }); </script>";
            }
        }

        $submitPressed = filter_input(INPUT_POST,  'btnKeranjang');
        if (isset($submitPressed)) {
            $idObat = filter_input(INPUT_POST,  'obatIdDet');
            $jumlah = filter_input(INPUT_POST,  'obatQuantity');
            $harga = filter_input(INPUT_POST,  'obatPrice');
            $total = (int)$jumlah * (int)$harga;
            $email = $_SESSION['email'];
            $trimIdObat = trim($idObat);
            $trimJumlah = trim($jumlah);
            $trimTotal = trim($total);
            $trimEmail = trim($email);
            $keranjang = new Keranjang();
            $keranjang->getObat()->setIdObat($trimIdObat);
            $keranjang->setJumlah($trimJumlah);
            $keranjang->setTotal($trimTotal);
            $keranjang->getUser()->setEmail($trimEmail);
            $result = $this->keranjangDao->insertNewKeranjang($keranjang);
            if ($result) {
                $message = '<i class="fa-solid fa-circle-check"></i> Data successfully added';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'success',
                    position: 'top'
                }); </script>";
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Error on add data';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
                    position: 'top'
                }); </script>";
            }
        }
    }

    public function fetchKeranjang($email) {
        if (isset($email) && $email != '') {
            $cart = $this->keranjangDao->fetchKeranjang($email);
            echo json_encode($cart);
        }
    }
}

if (isset($_POST['method']) && $_POST['method'] == "fetchKeranjang") {
    include_once '../entity/Keranjang.php';
    include_once '../entity/Obat.php';
    include_once '../entity/User.php';
    include_once '../dao/KeranjangDaoImpl.php';
    include_once '../dao/ObatDaoImpl.php';
    include_once '../dao/UserDaoImpl.php';
    include_once '../util/PDOUtil.php';
    $test = new KeranjangController();
    $test->fetchKeranjang($_POST['email']);
}
