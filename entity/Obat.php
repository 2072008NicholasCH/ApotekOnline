<?php

class Obat
{
    private $idObat;
    private $nama;
    private $jenis;
    private $harga;
    private $stock;
    private $supplier_idSupplier;

    /**
     * @return mixed
     */
    public function getSupplierIdSupplier()
    {
        return $this->supplier_idSupplier;
    }

    /**
     * @param mixed $supplier_idSupplier
     */
    public function setSupplierIdSupplier($supplier_idSupplier)
    {
        $this->supplier_idSupplier = $supplier_idSupplier;
    }

    /**
     * @return mixed
     */
    public function getIdObat()
    {
        return $this->idObat;
    }

    /**
     * @param mixed $idObat
     */
    public function setIdObat($idObat)
    {
        $this->idObat = $idObat;
    }

    /**
     * @return mixed
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * @param mixed $nama
     */
    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    /**
     * @return mixed
     */
    public function getJenis()
    {
        return $this->jenis;
    }

    /**
     * @param mixed $jenis
     */
    public function setJenis($jenis)
    {
        $this->jenis = $jenis;
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

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }
}