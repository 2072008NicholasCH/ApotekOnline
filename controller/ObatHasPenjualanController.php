<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

class ObatHasPenjualanController
{
    private $obatHasPenjualanDao;

    public function __construct()
    {
        $this->obatHasPenjualanDao = new ObatHasPenjualanDaoImpl();
    }
    public function index($idPenjualan)
    {
        $penjualanDet = $this->obatHasPenjualanDao->fetchObatHasPenjualan($idPenjualan);
        echo json_encode($penjualanDet);
    }

}

if (isset($_POST['method']) && $_POST['method'] == "fetchPenjualanDet") {
    include_once '../entity/ObatHasPenjualan.php';
    include_once '../entity/Penjualan.php';
    include_once '../entity/Obat.php';
    include_once '../dao/ObatHasPenjualanDaoImpl.php';
    include_once '../util/PDOUtil.php';
    $test = new ObatHasPenjualanController();
    $test->index($_POST['idPenjualan']);
}