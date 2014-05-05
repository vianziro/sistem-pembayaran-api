<?php

/**
 * Objek SiswaRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class SiswaRecord extends RecordAbstract {

    protected $id = NULL;
    protected $nama = NULL;
    protected $nis = NULL;

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

    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function getNama() {
        return $this->nama;
    }

    public function unsetNama() {
        $this->nama = NULL;
    }

    public function setNis($nis) {
        $this->nis = $nis;
    }

    public function getNis() {
        return $this->nis;
    }

    public function unsetNis() {
        $this->nis = NULL;
    }

    protected $sqlInsert = "INSERT INTO siswa (id, nama, nis) VALUES (:id, :nama, :nis)";
    protected $sqlSelect = "SELECT id, nama, nis FROM siswa WHERE id = :id";
    protected $sqlUpdate = "UPDATE siswa SET nama = :nama, nis = :nis WHERE id = :id";
    protected $sqlDelete = "DELETE FROM siswa WHERE id = :id";

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
        $inputParameters[":nama"] = $this->nama;
        $inputParameters[":nis"] = $this->nis;

        return $inputParameters;
    }

    protected function getSelectParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

    protected function getUpdateParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":nama"] = $this->nama;
        $inputParameters[":nis"] = $this->nis;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
