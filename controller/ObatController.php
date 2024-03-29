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
            $oldPhoto = filter_input(INPUT_GET,  'photo');
            unlink('image/' . $oldPhoto);
            $result = $this->obatDao->deleteObat($obatId);
            if ($result) {
                echo '<script>
        window.history.pushState("","Document","index.php?ahref=obat");
        </script>';
                $message = '<i class="fa-solid fa-circle-check"></i> Data successfully deleted';
                echo "<script> bootoast.toast({
            message: '" . $message . "',
            type: 'success',
            position: 'top'
        }); </script>";
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Error on delete data';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
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
                    type: 'success',
                    position: 'top'
                }); </script>";
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Error on add data';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
                    position: 'top'
                }); </script>";
            }
        }
        $suppName = $this->supplierDao->fetchAllSupp();
        $searchPressed = filter_input(INPUT_POST, 'btnSearch');
        if ($searchPressed) {
            $nama = filter_input(INPUT_POST,  'searchObat');
            $obats = $this->obatDao->searchObat($nama);
        } else {
            $obats = $this->obatDao->fetchAllObat();
        }
        include_once 'view/obat-view.php';
    }

    public function updateObat()
    {
        $submitPressed = filter_input(INPUT_POST,  'btnUpdateSubmit');
        if (isset($submitPressed)) {
            $idObat = filter_input(INPUT_POST,  'updateId');
            $name = filter_input(INPUT_POST,  'updateName');
            $jenis = filter_input(INPUT_POST,  'updateJenis');
            $price = filter_input(INPUT_POST,  'updateHarga');
            $stock = filter_input(INPUT_POST,  'updateStock');
            $supplier = filter_input(INPUT_POST,  'optSupplier');
            $trimIdObat = trim($idObat);
            $trimName = trim($name);
            $trimJenis = trim($jenis);
            $trimPrice = trim($price);
            $trimStock = trim($stock);
            $updateObat = new Obat();
            $updateObat->setIdObat($trimIdObat);
            $updateObat->setNama($trimName);
            $updateObat->setNama($trimName);
            $updateObat->setJenis($trimJenis);
            $updateObat->setHarga($trimPrice);
            $updateObat->setStock($trimStock);
            $updateObat->getSupplier()->setIdSupplier($supplier);
            if (empty($_FILES['filePhoto']['name'])) {
                $newFileName = filter_input(INPUT_POST,  'oldPhoto');
                $updateObat->setPhoto($newFileName);
                $result = $this->obatDao->updateObat($updateObat);
            } else {
                $oldPhoto = filter_input(INPUT_POST,  'oldPhoto');
                unlink('image/' . $oldPhoto);
                $directory = 'image/';
                $fileExtension = pathinfo($_FILES['filePhoto']['name'], flags: PATHINFO_EXTENSION);
                $newFileName = $trimIdObat . '.' . $fileExtension;
                $targetFile = $directory . $newFileName;
                if ($_FILES['filePhoto']['size'] > 1024 * 2048) {
                    $message = '<i class="fa-solid fa-circle-xmark"></i>Photo size is too large. Please upload photo size below 2 mb';
                    echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
                    position: 'top'
                }); </script>";
                } else {
                    move_uploaded_file($_FILES['filePhoto']['tmp_name'], $targetFile);
                    $updateObat->setPhoto($newFileName);
                    $result = $this->obatDao->updateObat($updateObat);
                }
            }
            if ($result) {
                if (!session_id()) {
                    session_start();
                }
                if (true) {
                    $message = '<i class="fa-solid fa-circle-check"></i> Data successfully updated';
                    $_SESSION['updateMessage'] = "<script> bootoast.toast({
                        message: '" . $message . "',
                        type: 'success',
                        position: 'top'
                    }); </script>";
                }
                header('location:index.php?ahref=obat');
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Error on update data';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
                    position: 'top'
                }); </script>";
            }
        }
    }

    public function checkIdObat($idObat)
    {
        if (isset($idObat) && $idObat != '') {
            $obat = $this->obatDao->checkIdObat($idObat);
            echo $obat;
        }
    }

    public function fetchObat($idObat)
    {
        if (isset($idObat) && $idObat != '') {
            $obat = $this->obatDao->fetchObat($idObat);
            $photo = $obat->getPhoto();
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

if (isset($_POST['method']) && $_POST['method'] == "checkIdObat") {
    include_once '../entity/Obat.php';
    include_once '../entity/Supplier.php';
    include_once '../dao/ObatDaoImpl.php';
    include_once '../dao/SupplierDaoImpl.php';
    include_once '../util/PDOUtil.php';
    $test = new ObatController();
    $test->checkIdObat($_POST['id']);
}

if (isset($_POST['method']) && $_POST['method'] == "searchObat") {
    include_once '../entity/Obat.php';
    include_once '../entity/Supplier.php';
    include_once '../dao/ObatDaoImpl.php';
    include_once '../dao/SupplierDaoImpl.php';
    include_once '../util/PDOUtil.php';
    $test = new ObatController();
    $test->index($_POST['name']);
}
