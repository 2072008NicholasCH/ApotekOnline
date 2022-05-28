<?php

class Penjualan
{
    private $idPenjualan;
    private $tanggal;
    private $total;
    private $payment;
    private $user_email;

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    /**
     * @return mixed
     */
    public function getTransaksiIdTransaksi()
    {
        return $this->transaksi_idTransaksi;
    }

    /**
     * @param mixed $transaksi_idTransaksi
     */
    public function setTransaksiIdTransaksi($transaksi_idTransaksi)
    {
        $this->transaksi_idTransaksi = $transaksi_idTransaksi;
    }
    private $transaksi_idTransaksi;

    /**
     * @return mixed
     */
    public function getIdPenjualan()
    {
        return $this->idPenjualan;
    }

    /**
     * @param mixed $idPenjualan
     */
    public function setIdPenjualan($idPenjualan)
    {
        $this->idPenjualan = $idPenjualan;
    }

    /**
     * @return mixed
     */
    public function getTanggal()
    {
        return $this->tanggal;
    }

    /**
     * @param mixed $tanggal
     */
    public function setTanggal($tanggal)
    {
        $this->tanggal = $tanggal;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

}