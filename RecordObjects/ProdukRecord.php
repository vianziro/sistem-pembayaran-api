<?php

/**
 * Objek ProdukRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class ProdukRecord extends RecordAbstract {

    protected $id = NULL;
    protected $kodeProduk = NULL;
    protected $idUnit = NULL;
    protected $idJenisPembayaran = NULL;

    public function __construct() {
        $this->setPrimaryKeyPropertyName("id");
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function unsetId() {
        $this->id = NULL;
    }

    public function setKodeProduk($kodeProduk) {
        $this->kodeProduk = $kodeProduk;
    }

    public function getKodeProduk() {
        return $this->kodeProduk;
    }

    public function unsetKodeProduk() {
        $this->kodeProduk = NULL;
    }

    public function setIdUnit($idUnit) {
        $this->idUnit = $idUnit;
    }

    public function getIdUnit() {
        return $this->idUnit;
    }

    public function unsetIdUnit() {
        $this->idUnit = NULL;
    }

    public function setIdJenisPembayaran($idJenisPembayaran) {
        $this->idJenisPembayaran = $idJenisPembayaran;
    }

    public function getIdJenisPembayaran() {
        return $this->idJenisPembayaran;
    }

    public function unsetIdJenisPembayaran() {
        $this->idJenisPembayaran = NULL;
    }

    protected $sqlInsert = "INSERT INTO produk (id, kode_produk, id_unit, id_jenis_pembayaran) VALUES (:id, :kode_produk, :id_unit, :id_jenis_pembayaran)";
    protected $sqlSelect = "SELECT id, kode_produk, id_unit, id_jenis_pembayaran FROM produk WHERE id = :id";
    protected $sqlUpdate = "UPDATE produk SET kode_produk = :kode_produk, id_unit = :id_unit, id_jenis_pembayaran = :id_jenis_pembayaran WHERE id = :id";
    protected $sqlDelete = "DELETE FROM produk WHERE id = :id";

    protected function getSqlInsert() {
        return $this->sqlInsert;
    }

    protected function getSqlSelect() {
        return $this->sqlSelect;
    }

    protected function getSqlUpdate() {
        return $this->sqlUpdate;
    }

    protected function getSqlDelete() {
        return $this->sqlDelete;
    }

    protected function getInsertParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":kode_produk"] = $this->kodeProduk;
        $inputParameters[":id_unit"] = $this->idUnit;
        $inputParameters[":id_jenis_pembayaran"] = $this->idJenisPembayaran;

        return $inputParameters;
    }

    protected function getSelectParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

    protected function getUpdateParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":kode_produk"] = $this->kodeProduk;
        $inputParameters[":id_unit"] = $this->idUnit;
        $inputParameters[":id_jenis_pembayaran"] = $this->idJenisPembayaran;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
