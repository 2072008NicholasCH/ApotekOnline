<?php

class Transaksi
{
    private $idTransaksi;

    /**
     * @return mixed
     */
    public function getIdTransaksi()
    {
        return $this->idTransaksi;
    }

    /**
     * @param mixed $idTransaksi
     */
    public function setIdTransaksi($idTransaksi)
    {
        $this->idTransaksi = $idTransaksi;
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
    public function getJumlah()
    {
        return $this->jumlah;
    }

    /**
     * @param mixed $jumlah
     */
    public function setJumlah($jumlah)
    {
        $this->jumlah = $jumlah;
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
    private $tanggal;
    private $jumlah;
    private $payment;
}