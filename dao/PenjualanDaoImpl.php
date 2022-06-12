<?php
/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
class PenjualanDaoImpl
{
    public function fetchAllPenjualan()
    {
        $conn = PDOUtil::createConnection();
        $query = 'SELECT penjualan.* , user.email FROM penjualan JOIN user ON penjualan.user_email = user.email ORDER BY idPenjualan ASC';
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Penjualan');
        $stmt->execute();
        $conn = null;
        return $stmt->fetchAll();
    }

    public function fetchAllPenjualanUser($email)
    {
        $conn = PDOUtil::createConnection();
        $query = 'SELECT penjualan.* FROM penjualan WHERE user_email = ? ORDER BY idPenjualan ASC';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'penjualan');
        $stmt->execute();
        $conn = null;
        return $stmt->fetchAll();
    }

    public function insertNewPenjualan(Penjualan $penjualan)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "INSERT INTO penjualan(tanggal, total, payment, user_email) VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $penjualan->getTanggal());
        $stmt->bindValue(2, $penjualan->getTotal());
        $stmt->bindValue(3, $penjualan->getPayment());
        $stmt->bindValue(4, $penjualan->getUser()->getEmail());
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

    public function fetchLastPenjualan() {
        $conn = PDOUtil::createConnection();
        $query = 'SELECT idPenjualan FROM penjualan ORDER BY idPenjualan DESC LIMIT 1';
        $stmt = $conn->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $conn = null;
        return $stmt->fetchObject('Penjualan');
    }

    public function deleteLastPenjualan($idPenjualan) {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "DELETE FROM penjualan WHERE idPenjualan = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idPenjualan);
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
