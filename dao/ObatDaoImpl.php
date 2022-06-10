<?php
/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
class ObatDaoImpl
{
    public function fetchAllObat()
    {
        $conn = PDOUtil::createConnection();
        $query = 'SELECT * FROM obat ORDER BY idObat ASC';
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Obat');
        $stmt->execute();
        $conn = null;
        return $stmt->fetchAll();
    }

    public function fetchObat($idObat)
    {
        $conn = PDOUtil::createConnection();
        $query = 'SELECT * FROM obat WHERE idObat = ?';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idObat);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $conn = null;
        return $stmt->fetchObject('Obat');
    }

    public function insertNewObat(Obat $obat)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "INSERT INTO obat(idObat, nama, jenis, harga, stock, supplier_idSupplier, photo) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $obat->getIdObat());
        $stmt->bindValue(2, $obat->getNama());
        $stmt->bindValue(3, $obat->getJenis());
        $stmt->bindValue(4, $obat->getHarga());
        $stmt->bindValue(5, $obat->getStock());
        $stmt->bindValue(6, $obat->getSupplier()->getIdSupplier());
        $stmt->bindValue(7, $obat->getPhoto());
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

    public function updateObat(obat $obat)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "UPDATE obat SET idObat = ?, nama = ? , jenis = ?, harga = ?, stock = ? , supplier_idSupplier = ? WHERE idObat = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $obat->getIdObat());
        $stmt->bindValue(2, $obat->getNama());
        $stmt->bindValue(3, $obat->getJenis());
        $stmt->bindValue(4, $obat->getHarga());
        $stmt->bindValue(5, $obat->getStock());
        $stmt->bindValue(6, $obat->getSupplier()->getIdSupplier());
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

    public function deleteObat($idObat)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "DELETE FROM obat WHERE idObat = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idObat);
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
