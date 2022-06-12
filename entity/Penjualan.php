<?php

class Penjualan
{
    private $idPenjualan;
    private $tanggal;
    private $total;
    private $payment;
    private $user;

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
        switch ($name) {
            case 'email':
                $this->user->setEmail($value);
                break;
        }
    }


}