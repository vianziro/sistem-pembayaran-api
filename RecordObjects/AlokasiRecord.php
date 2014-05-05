<?php

/**
 * Objek AlokasiRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class AlokasiRecord extends RecordAbstract {

    protected $id = NULL;
    protected $idTransaksi = NULL;
    protected $idSiswa = NULL;
    protected $idUnit = NULL;
    protected $idJenisPembayaran = NULL;
    protected $nilai = NULL;
    protected $sisa = NULL;
    protected $terdistribusi = NULL;

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

    public function setIdTransaksi($idTransaksi) {
        $this->idTransaksi = $idTransaksi;
    }

    public function getIdTransaksi() {
        return $this->idTransaksi;
    }

    public function unsetIdTransaksi() {
        $this->idTransaksi = NULL;
    }

    public function setIdSiswa($idSiswa) {
        $this->idSiswa = $idSiswa;
    }

    public function getIdSiswa() {
        return $this->idSiswa;
    }

    public function unsetIdSiswa() {
        $this->idSiswa = NULL;
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

    public function setNilai($nilai) {
        $this->nilai = $nilai;
    }

    public function getNilai() {
        return $this->nilai;
    }

    public function unsetNilai() {
        $this->nilai = NULL;
    }

    public function setSisa($sisa) {
        $this->sisa = $sisa;
    }

    public function getSisa() {
        return $this->sisa;
    }

    public function unsetSisa() {
        $this->sisa = NULL;
    }

    public function setTerdistribusi($terdistribusi) {
        $this->terdistribusi = $terdistribusi;
    }

    public function getTerdistribusi() {
        return $this->terdistribusi;
    }

    public function unsetTerdistribusi() {
        $this->terdistribusi = NULL;
    }

    protected $sqlInsert = "INSERT INTO alokasi (id, id_transaksi, id_siswa, id_unit, id_jenis_pembayaran, nilai, sisa, terdistribusi) VALUES (:id, :id_transaksi, :id_siswa, :id_unit, :id_jenis_pembayaran, :nilai, :sisa, :terdistribusi)";
    protected $sqlSelect = "SELECT id, id_transaksi, id_siswa, id_unit, id_jenis_pembayaran, nilai, sisa, terdistribusi FROM alokasi WHERE id = :id";
    protected $sqlUpdate = "UPDATE alokasi SET id_transaksi = :id_transaksi, id_siswa = :id_siswa, id_unit = :id_unit, id_jenis_pembayaran = :id_jenis_pembayaran, nilai = :nilai, sisa = :sisa, terdistribusi = :terdistribusi WHERE id = :id";
    protected $sqlDelete = "DELETE FROM alokasi WHERE id = :id";

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
        $inputParameters[":id_transaksi"] = $this->idTransaksi;
        $inputParameters[":id_siswa"] = $this->idSiswa;
        $inputParameters[":id_unit"] = $this->idUnit;
        $inputParameters[":id_jenis_pembayaran"] = $this->idJenisPembayaran;
        $inputParameters[":nilai"] = $this->nilai;
        $inputParameters[":sisa"] = $this->sisa;
        $inputParameters[":terdistribusi"] = $this->terdistribusi;

        return $inputParameters;
    }

    protected function getSelectParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

    protected function getUpdateParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":id_transaksi"] = $this->idTransaksi;
        $inputParameters[":id_siswa"] = $this->idSiswa;
        $inputParameters[":id_unit"] = $this->idUnit;
        $inputParameters[":id_jenis_pembayaran"] = $this->idJenisPembayaran;
        $inputParameters[":nilai"] = $this->nilai;
        $inputParameters[":sisa"] = $this->sisa;
        $inputParameters[":terdistribusi"] = $this->terdistribusi;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
