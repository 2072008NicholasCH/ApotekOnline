<?php
/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
class SupplierDaoImpl
{
    public function fetchAllSupp()
    {
        $conn = PDOUtil::createConnection();
        $query = 'SELECT * FROM supplier ORDER BY idSupplier ASC';
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Supplier');
        $stmt->execute();
        $conn = null;
        return $stmt->fetchAll();
    }

    public function fetchSupp($idSupplier)
    {
        $conn = PDOUtil::createConnection();
        $query = 'SELECT * FROM supplier WHERE idSupplier = ?';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idSupplier);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $conn = null;
        return $stmt->fetchObject(class:'Supplier');
    }

    public function insertNewSupp(Supplier $supplier)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "INSERT INTO supplier(nama, alamat, kota, phone) VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $supplier->getNama());
        $stmt->bindValue(2, $supplier->getAlamat());
        $stmt->bindValue(3, $supplier->getKota());
        $stmt->bindValue(4, $supplier->getPhone());
        $conn->beginTransaction();
        if ($stmt->execute()) {
            $conn->commit();
            $result = 1;
        } else {
            $conn->rollBack();
        }
        $conn = null;
        return $result;
    }

    public function updateSupp(Supplier $supplier)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "UPDATE supplier SET nama = ? , alamat = ?, kota = ?, phone = ? WHERE idSupplier = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $supplier->getNama());
        $stmt->bindValue(2, $supplier->getAlamat());
        $stmt->bindValue(3, $supplier->getKota());
        $stmt->bindValue(4, $supplier->getPhone());
        $conn->beginTransaction();
        if ($stmt->execute()) {
            $conn->commit();
            $result = 1;
        } else {
            $conn->rollBack();
        }
        $conn = null;
        return $result;
    }

    public function deleteSupp($id)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "DELETE FROM supplier WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $id);
        $conn->beginTransaction();
        if ($stmt->execute()) {
            $conn->commit();
            $result = 1;
        } else {
            $conn->rollBack();
        }
        $conn = null;
        return $result;
    }
}
