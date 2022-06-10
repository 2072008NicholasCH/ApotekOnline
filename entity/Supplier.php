<?php

class Supplier implements JsonSerializable
{
    private $idSupplier;
    private $nama;
    private $alamat;
    private $kota;
    private $phone;

    /**
     * @return mixed
     */
    public function getIdSupplier()
    {
        return $this->idSupplier;
    }

    /**
     * @param mixed $idSupplier
     */
    public function setIdSupplier($idSupplier)
    {
        $this->idSupplier = $idSupplier;
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
    public function getAlamat()
    {
        return $this->alamat;
    }

    /**
     * @param mixed $alamat
     */
    public function setAlamat($alamat)
    {
        $this->alamat = $alamat;
    }

    /**
     * @return mixed
     */
    public function getKota()
    {
        return $this->kota;
    }

    /**
     * @param mixed $kota
     */
    public function setKota($kota)
    {
        $this->kota = $kota;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}