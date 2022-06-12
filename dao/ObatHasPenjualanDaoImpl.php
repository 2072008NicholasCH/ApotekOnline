<?php
/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
class ObatHasPenjualanDaoImpl
{
    public function fetchObatHasPenjualan($idPenjualan)
    {
        $conn = PDOUtil::createConnection();
        $query = 'SELECT obat_has_penjualan.* , obat.idObat, obat.nama FROM apotekonline.obat_has_penjualan JOIN obat on obat_has_penjualan.obat_idObat = obat.idObat WHERE penjualan_idPenjualan = ?';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idPenjualan);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'ObatHasPenjualan');
        $stmt->execute();
        $conn = null;
        return $stmt->fetchAll();
    }


    public function insertNewObatHasPenjualan(ObatHasPenjualan $obatHasPenjualan)
    {
        $result = 0;
        $conn = PDOUtil::createConnection();

        $query = "INSERT INTO obat_has_penjualan(penjualan_idPenjualan, seq, obat_idObat, jumlah, harga) VALUES(?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(1, $obatHasPenjualan->getPenjualan()->getIdPenjualan());
        $stmt->bindValue(2, $obatHasPenjualan->getSeq());
        $stmt->bindValue(3, $obatHasPenjualan->getObat()->getIdObat());
        $stmt->bindValue(4, $obatHasPenjualan->getJumlah());
        $stmt->bindValue(5, $obatHasPenjualan->getHarga());
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
