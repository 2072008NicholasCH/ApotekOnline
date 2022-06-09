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
        $deleteCommand = filter_input(type: INPUT_GET, var_name: 'delcom');
        if (isset($deleteCommand) && $deleteCommand == 1) {
            $suppId = filter_input(type: INPUT_GET, var_name: 'sid');
            $result = $this->supplierDao->deleteSupp($suppId);
            if ($result) {
                echo '<script>
        window.history.pushState("","Document","index.php?ahref=supplier");
        </script>';
                echo '<div class="bg-success">Data successfully deleted <i class="fa-solid fa-circle-check"></i></div>';
            } else {
                echo '<div class="bg-danger">Error on delete data</div>';
            }
        }

        $submitPressed = filter_input(type: INPUT_POST, var_name: 'btnSubmit');
        if (isset($submitPressed)) {
            $name = filter_input(type: INPUT_POST, var_name: 'txtName');
            $address = filter_input(type: INPUT_POST, var_name: 'txtAddress');
            $city = filter_input(type: INPUT_POST, var_name: 'txtCity');
            $phone = filter_input(type: INPUT_POST, var_name: 'txtPhone');
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
                echo '<div class="bg-success">Data added successfully <i class="fa-solid fa-circle-check"></i></div>';
            } else {
                echo '<div class="bg-danger">Error on add data</div>';
            }
        }
        $suppliers = $this->supplierDao->fetchAllSupp();
        include_once 'view/supplier-view.php';
    }

    public function updateSupp()
    {
        $suppId = filter_input(type: INPUT_GET, var_name: 'sid');
        if (isset($suppId) && $suppId != '') {
            $supp = $this->supplierDao->fetchSupp($suppId);
        }

        $submitPressed = filter_input(type: INPUT_POST, var_name: 'btnSubmit');
        if (isset($submitPressed)) {
            $name = filter_input(type: INPUT_POST, var_name: 'txtName');
            $address = filter_input(type: INPUT_POST, var_name: 'txtAddress');
            $city = filter_input(type: INPUT_POST, var_name: 'txtCity');
            $phone = filter_input(type: INPUT_POST, var_name: 'txtPhone');
            $trimName = trim($name);
            $trimAddress = trim($address);
            $trimCity = trim($city);
            $trimPhone = trim($phone);
            $supplier = new Supplier();
            $supplier->setNama($trimName);
            $supplier->setAlamat($trimAddress);
            $supplier->setKota($trimCity);
            $supplier->setPhone($trimPhone);
            $result = $this->supplierDao->updateSupp($supplier);
            if ($result) {
                header(header: 'location:index.php?ahref=supplier');
            } else {
                echo '<div class="bg-danger">Error on add data</div>';
            }
        }
        include_once 'view/supplier-update-view.php';
    }
}
