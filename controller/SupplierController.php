<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

class SupplierController
{
    private $supplierDao;

    public function __construct()
    {
        $this->supplierDao = new SupplierDaoImpl();
    }
    public function index()
    {
        $deleteCommand = filter_input( INPUT_GET,  'delcom');
        if (isset($deleteCommand) && $deleteCommand == 1) {
            $suppId = filter_input( INPUT_GET,  'sid');
            $result = $this->supplierDao->deleteSupp($suppId);
            if ($result) {
                echo '<script>
        window.history.pushState("","Document","index.php?ahref=supplier");
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

        $submitPressed = filter_input( INPUT_POST,  'btnSubmit');
        if (isset($submitPressed)) {
            $name = filter_input( INPUT_POST,  'txtName');
            $address = filter_input( INPUT_POST,  'txtAddress');
            $city = filter_input( INPUT_POST,  'txtCity');
            $phone = filter_input( INPUT_POST,  'txtPhone');
            $trimName = trim($name);
            $trimAddress = trim($address);
            $trimCity = trim($city);
            $trimPhone = trim($phone);
            $supplier = new Supplier();
            $supplier->setNama($trimName);
            $supplier->setAlamat($trimAddress);
            $supplier->setKota($trimCity);
            $supplier->setPhone($trimPhone);
            $result = $this->supplierDao->insertNewSupp($supplier);
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
        $suppliers = $this->supplierDao->fetchAllSupp();
        include_once 'view/supplier-view.php';
    }

    public function updateSupp()
    {
        $submitPressed = filter_input( INPUT_POST,  'btnUpdateSubmit');
        if (isset($submitPressed)) {
            $suppId = filter_input( INPUT_POST,  'updateId');
            $name = filter_input( INPUT_POST,  'updateName');
            $address = filter_input( INPUT_POST,  'updateAddress');
            $city = filter_input( INPUT_POST,  'updateCity');
            $phone = filter_input( INPUT_POST,  'updatePhone');
            $trimName = trim($name);
            $trimAddress = trim($address);
            $trimCity = trim($city);
            $trimPhone = trim($phone);
            $supplier = new Supplier();
            $supplier->setIdSupplier($suppId);
            $supplier->setNama($trimName);
            $supplier->setAlamat($trimAddress);
            $supplier->setKota($trimCity);
            $supplier->setPhone($trimPhone);
            $result = $this->supplierDao->updateSupp($supplier);
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
                header('location:index.php?ahref=supplier');
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

    public function fetchSupp($suppId)
    {
        if (isset($suppId) && $suppId != '') {
            $supp = $this->supplierDao->fetchSupp($suppId);
            echo json_encode($supp);
        }
    }
}

if (isset($_POST['method']) && $_POST['method'] == "fetchSupp") {
    include_once '../entity/Supplier.php';
    include_once '../dao/SupplierDaoImpl.php';
    include_once '../util/PDOUtil.php';
    $test = new SupplierController();
    $test->fetchSupp($_POST['id']);
}
