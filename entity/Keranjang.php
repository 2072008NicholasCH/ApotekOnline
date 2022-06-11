<?php

class Keranjang implements JsonSerializable
{
    private $idKeranjang;
    private $jumlah;
    private $total;
    private $user;
    private $obat;

    /**
     * @return mixed
     */
    public function getIdKeranjang()
    {
        return $this->idKeranjang;
    }

    /**
     * @param mixed $idKeranjang
     */
    public function setIdKeranjang($idKeranjang)
    {
        $this->idKeranjang = $idKeranjang;
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

    // /**
    //  * @return mixed
    //  */
    // public function getUserEmail()
    // {
    //     return $this->user_email;
    // }

    // /**
    //  * @param mixed $user_email
    //  */
    // public function setUserEmail($user_email)
    // {
    //     $this->user_email = $user_email;
    // }

    /**
     * @return User
     */
    public function getUser()
    {
        if (!isset($this->user)) {
            $this->user = new user();
        }
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function __set($name, $value)
    {
        if (!isset($this->user)) {
            $this->user = new User();
        }
        if (!isset($this->obat)) {
            $this->obat = new Obat();
        }
        switch ($name) {
            case 'idObat':
                $this->obat->setIdObat($value);
                break;
            case 'namaObat':
                $this->obat->setNama($value);
                break;
            case 'email':
                $this->user->setEmail($value);
                break;
        }
    }

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

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
