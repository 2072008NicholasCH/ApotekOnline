<?php

class Obat_has_Penjualan
{
    private $obat_idObat;
    private $penjualan_idPenjualan;
    private $jumlah;
    private $harga;

    /**
     * @return mixed
     */
    public function getObatIdObat()
    {
        return $this->obat_idObat;
    }

    /**
     * @param mixed $obat_idObat
     */
    public function setObatIdObat($obat_idObat)
    {
        $this->obat_idObat = $obat_idObat;
    }

    /**
     * @return mixed
     */
    public function getPenjualanIdPenjualan()
    {
        return $this->penjualan_idPenjualan;
    }

    /**
     * @param mixed $penjualan_idPenjualan
     */
    public function setPenjualanIdPenjualan($penjualan_idPenjualan)
    {
        $this->penjualan_idPenjualan = $penjualan_idPenjualan;
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
    public function getHarga()
    {
        return $this->harga;
    }

    /**
     * @param mixed $harga
     */
    public function setHarga($harga)
    {
        $this->harga = $harga;
    }
}