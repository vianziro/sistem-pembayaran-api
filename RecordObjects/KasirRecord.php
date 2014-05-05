<?php

/**
 * Objek KasirRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class KasirRecord extends RecordAbstract {

    protected $id = NULL;
    protected $nama = NULL;

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

    protected $sqlInsert = "INSERT INTO kasir (id, nama) VALUES (:id, :nama)";
    protected $sqlSelect = "SELECT id, nama FROM kasir WHERE id = :id";
    protected $sqlUpdate = "UPDATE kasir SET nama = :nama WHERE id = :id";
    protected $sqlDelete = "DELETE FROM kasir WHERE id = :id";

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

        return $inputParameters;
    }

    protected function getSelectParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

    protected function getUpdateParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":nama"] = $this->nama;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
