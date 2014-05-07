<?php

/**
 * Objek DistribusiRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class DistribusiRecord extends RecordAbstract {

    protected $id = NULL;
    protected $idAlokasi = NULL;
    protected $idTagihan = NULL;
    protected $nilai = NULL;

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

    public function setIdAlokasi($idAlokasi) {
        $this->idAlokasi = $idAlokasi;
    }

    public function getIdAlokasi() {
        return $this->idAlokasi;
    }

    public function unsetIdAlokasi() {
        $this->idAlokasi = NULL;
    }

    public function setIdTagihan($idTagihan) {
        $this->idTagihan = $idTagihan;
    }

    public function getIdTagihan() {
        return $this->idTagihan;
    }

    public function unsetIdTagihan() {
        $this->idTagihan = NULL;
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

    protected $sqlInsert = "INSERT INTO distribusi (id, id_alokasi, id_tagihan, nilai) VALUES (:id, :id_alokasi, :id_tagihan, :nilai)";
    protected $sqlSelect = "SELECT id, id_alokasi, id_tagihan, nilai FROM distribusi WHERE id = :id";
    protected $sqlUpdate = "UPDATE distribusi SET id_alokasi = :id_alokasi, id_tagihan = :id_tagihan, nilai = :nilai WHERE id = :id";
    protected $sqlDelete = "DELETE FROM distribusi WHERE id = :id";

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
        $inputParameters[":id_alokasi"] = $this->idAlokasi;
        $inputParameters[":id_tagihan"] = $this->idTagihan;
        $inputParameters[":nilai"] = $this->nilai;

        return $inputParameters;
    }

    protected function getSelectParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

    protected function getUpdateParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":id_alokasi"] = $this->idAlokasi;
        $inputParameters[":id_tagihan"] = $this->idTagihan;
        $inputParameters[":nilai"] = $this->nilai;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
