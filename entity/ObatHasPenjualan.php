<?php

class ObatHasPenjualan implements JsonSerializable
{
    private $penjualan;
    private $seq;
    private $obat;
    private $jumlah;
    private $harga;

    // /**
    //  * @return mixed
    //  */
    // public function getObatIdObat()
    // {
    //     return $this->obat_idObat;
    // }

    // /**
    //  * @param mixed $obat_idObat
    //  */
    // public function setObatIdObat($obat_idObat)
    // {
    //     $this->obat_idObat = $obat_idObat;
    // }

    // /**
    //  * @return mixed
    //  */
    // public function getPenjualanIdPenjualan()
    // {
    //     return $this->penjualan_idPenjualan;
    // }

    // /**
    //  * @param mixed $penjualan_idPenjualan
    //  */
    // public function setPenjualanIdPenjualan($penjualan_idPenjualan)
    // {
    //     $this->penjualan_idPenjualan = $penjualan_idPenjualan;
    // }

    /**
     * @return Obat
     */
    public function getObat()
    {
        if (!isset($this->obat)) {
            $this->obat = new Obat();
        }
        return $this->obat;
    }

    /**
     * @param Obat $obat
     */
    public function setObat($obat)
    {
        $this->obat = $obat;
    }

    /**
     * @return Penjualan
     */
    public function getPenjualan()
    {
        if (!isset($this->penjualan)) {
            $this->penjualan = new Penjualan();
        }
        return $this->penjualan;
    }

    /**
     * @param Penjualan $penjualan
     */
    public function setPenjualan($penjualan)
    {
        $this->penjualan = $penjualan;
    }

    public function __set($name, $value)
    {
        if (!isset($this->obat)) {
            $this->obat = new Obat();
        }
        if (!isset($this->penjualan)) {
            $this->penjualan = new Penjualan();
        }
        switch ($name) {
            case 'idObat':
                $this->obat->setIdObat($value);
                break;
            case 'nama':
                $this->obat->setNama($value);
                break;
            case 'idPenjualan':
                $this->penjualan->setIdPenjualan($value);
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getSeq()
    {
        return $this->seq;
    }

    /**
     * @param mixed $seq
     */
    public function setSeq($seq)
    {
        $this->seq = $seq;
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

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
