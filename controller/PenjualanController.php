<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

class PenjualanController
{
    private $penjualanDao;
    private $keranjangDao;

    public function __construct()
    {
        $this->penjualanDao = new PenjualanDaoImpl();
        $this->keranjangDao = new KeranjangDaoImpl();
    }
    public function index()
    {
        $submitPressed = filter_input(INPUT_POST,  'btnConfirm');
        if (isset($submitPressed)) {
            $tanggal = date("Y-m-d");
            $total = filter_input(INPUT_POST,  'txtTotal');
            $payment = filter_input(INPUT_POST,  'radioPayment');
            $email = $_SESSION['email'];
            $trimTotal = trim($total);
            $trimPayment = trim($payment);
            $penjualan = new Penjualan();
            $penjualan->setTanggal($tanggal);
            $penjualan->setTotal($trimTotal);
            $penjualan->setPayment($trimPayment);
            $penjualan->getUser()->setEmail($email);
            $result = $this->penjualanDao->insertNewPenjualan($penjualan);
            if ($result) {
                if (!session_id()) {
                    session_start();
                }
                if (true) {
                    $emptyCart = $this->keranjangDao->deleteAllKeranjang($email);
                    $message = '<i class="fa-solid fa-circle-check"></i> Terimakasih telah berbelanja menggunakan Apotek Online ini. Silahkan tunggu email konfirmasi pengiriman dari kami.';
                    $_SESSION['paymentComplete'] = "<script> bootoast.toast({
                        message: '" . $message . "',
                        type: 'success',
                        position: 'top'
                    }); </script>";
                }
                header('location:index.php?ahref=obat');
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
    public function fetchPenjualan()
    {
        $penjualan = $this->penjualanDao->fetchAllPenjualan();
        include_once 'view/penjualan-view.php';
    }
}
