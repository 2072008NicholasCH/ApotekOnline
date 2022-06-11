<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

class ObatController
{
    private $obatDao;

    public function __construct()
    {
        $this->obatDao = new ObatDaoImpl();
        $this->supplierDao = new SupplierDaoImpl();
    }
    public function index()
    {
        $deleteCommand = filter_input(INPUT_GET,  'delcom');
        if (isset($deleteCommand) && $deleteCommand == 1) {
            $obatId = filter_input(INPUT_GET,  'oid');
            $result = $this->obatlierDao->deleteObat($obatId);
            if ($result) {
                echo '<script>
        window.history.pushState("","Document","index.php?ahref=obat");
        </script>';
                $message = '<i class="fa-solid fa-circle-check"></i> Data successfully deleted';
                echo "<script> bootoast.toast({
            message: '" . $message . "',
             'success',
            position: 'top'
        }); </script>";
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Error on delete data';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                     'danger',
                    position: 'top'
                }); </script>";
            }
        }

        $submitPressed = filter_input(INPUT_POST,  'btnSubmit');
        if (isset($submitPressed)) {
            $idObat = filter_input(INPUT_POST,  'txtIdObat');
            $name = filter_input(INPUT_POST,  'txtName');
            $jenis = filter_input(INPUT_POST,  'txtJenis');
            $price = filter_input(INPUT_POST,  'txtHarga');
            $stock = filter_input(INPUT_POST,  'txtStock');
            $supplier = filter_input(INPUT_POST,  'optSupplier');
            $trimIdObat = trim($idObat);
            $trimName = trim($name);
            $trimJenis = trim($jenis);
            $trimPrice = trim($price);
            $trimStock = trim($stock);
            $obat = new Obat();
            $obat->setIdObat($trimIdObat);
            $obat->setNama($trimName);
            $obat->setJenis($trimJenis);
            $obat->setHarga($trimPrice);
            $obat->setStock($trimStock);
            $obat->getSupplier()->setIdSupplier($supplier);

            if (empty($_FILES['filePhoto']['name'])) {
                $result = $this->obatDao->insertNewObat($obat);
            } else {
                $directory = 'image/';
                $fileExtension = pathinfo($_FILES['filePhoto']['name'], flags: PATHINFO_EXTENSION);
                $newFileName = $trimIdObat . '.' . $fileExtension;
                $targetFile = $directory . $newFileName;
                if ($_FILES['filePhoto']['size'] > 1024 * 2048) {
                    echo '<div>Upload error. File size exceed 2MB.</div>';
                    $result = $this->obatDao->insertNewObat($obat);
                } else {
                    move_uploaded_file($_FILES['filePhoto']['tmp_name'], $targetFile);
                    $obat->setPhoto($newFileName);
                    $result = $this->obatDao->insertNewObat($obat);
                }
            }

            if ($result) {
                $message = '<i class="fa-solid fa-circle-check"></i> Data successfully added';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                     'success',
                    position: 'top'
                }); </script>";
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Error on add data';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                     'danger',
                    position: 'top'
                }); </script>";
            }
        }
        $suppName = $this->supplierDao->fetchAllSupp();
        $obats = $this->obatDao->fetchAllObat();
        include_once 'view/obat-view.php';
    }

    public function updateobat()
    {
        $submitPressed = filter_input(INPUT_POST,  'btnUpdateSubmit');
        if (isset($submitPressed)) {
            $idObat = filter_input(INPUT_POST,  'txtIdObat');
            $name = filter_input(INPUT_POST,  'txtName');
            $jenis = filter_input(INPUT_POST,  'txtJenis');
            $price = filter_input(INPUT_POST,  'txtPrice');
            $stock = filter_input(INPUT_POST,  'txtStock');
            $photo = filter_input(INPUT_POST,  'txtPhoto');
            $supplier = filter_input(INPUT_POST,  'optSupplier');
            $trimIdObat = trim($idObat);
            $trimName = trim($name);
            $trimJenis = trim($jenis);
            $trimPrice = trim($price);
            $trimStock = trim($stock);
            $trimPhoto = trim($photo);
            $obat = new Obat();
            $obat->setIdObat($idObat);
            $obat->setNama($trimName);
            $obat->setNama($trimName);
            $obat->setJenis($trimJenis);
            $obat->setHarga($trimPrice);
            $obat->setStock($trimStock);
            $obat->setPhoto($trimPhoto);
            $obat->getSupplier()->setIdSupplier($supplier);
            $result = $this->obatDao->updateObat($obat);
            if ($result) {
                if (!session_id()) {
                    session_start();
                }
                if (true) {
                    $message = '<i class="fa-solid fa-circle-check"></i> Data successfully updated';
                    $_SESSION['updateMessage'] = "<script> bootoast.toast({
                        message: '" . $message . "',
                         'success',
                        position: 'top'
                    }); </script>";
                }
                header('location:index.php?ahref=obat');
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Error on update data';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                     'danger',
                    position: 'top'
                }); </script>";
            }
        }
    }

    public function fetchObat($idObat)
    {
        if (isset($idObat) && $idObat != '') {
            $obat = $this->obatDao->fetchObat($idObat);
            echo json_encode($obat);
        }
    }
}

if (isset($_POST['method']) && $_POST['method'] == "fetchObat") {
    include_once '../entity/Obat.php';
    include_once '../entity/Supplier.php';
    include_once '../dao/ObatDaoImpl.php';
    include_once '../dao/SupplierDaoImpl.php';
    include_once '../util/PDOUtil.php';
    $test = new ObatController();
    $test->fetchObat($_POST['id']);
}
