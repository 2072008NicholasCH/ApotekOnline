<?php
/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
class KeranjangDaoImpl
{
    public function fetchKeranjang($email)
    {
        $conn = PDOUtil::createConnection();
        $query = 'SELECT keranjang.* , obat.idObat, obat.nama as "namaObat" FROM keranjang JOIN obat ON keranjang.obat_idObat = obat.idObat WHERE user_email = ?';
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $email);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Keranjang');
        $stmt->execute();
        $conn = null;
        return $stmt->fetchAll();
    }

    public function insertNewKeranjang(Keranjang $keranjang)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "INSERT INTO keranjang(jumlah, total, user_email, obat_idObat) VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $keranjang->getJumlah());
        $stmt->bindValue(2, $keranjang->getTotal());
        $stmt->bindValue(3, $keranjang->getUser()->getEmail());
        $stmt->bindValue(4, $keranjang->getObat()->getIdObat());
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


    public function deleteKeranjang($idKeranjang)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "DELETE FROM keranjang WHERE idKeranjang = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idKeranjang);
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

    public function deleteAllKeranjang($email)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "DELETE FROM keranjang WHERE user_email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $email);
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
