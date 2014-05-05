<?php

/**
 * Objek KelasRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class KelasRecord extends RecordAbstract {

    protected $id = NULL;
    protected $idTingkat = NULL;
    protected $nama = NULL;
    protected $label = NULL;

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

    public function setIdTingkat($idTingkat) {
        $this->idTingkat = $idTingkat;
    }

    public function getIdTingkat() {
        return $this->idTingkat;
    }

    public function unsetIdTingkat() {
        $this->idTingkat = NULL;
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

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getLabel() {
        return $this->label;
    }

    public function unsetLabel() {
        $this->label = NULL;
    }

    protected $sqlInsert = "INSERT INTO kelas (id, id_tingkat, nama, label) VALUES (:id, :id_tingkat, :nama, :label)";
    protected $sqlSelect = "SELECT id, id_tingkat, nama, label FROM kelas WHERE id = :id";
    protected $sqlUpdate = "UPDATE kelas SET id_tingkat = :id_tingkat, nama = :nama, label = :label WHERE id = :id";
    protected $sqlDelete = "DELETE FROM kelas WHERE id = :id";

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
        $inputParameters[":id_tingkat"] = $this->idTingkat;
        $inputParameters[":nama"] = $this->nama;
        $inputParameters[":label"] = $this->label;

        return $inputParameters;
    }

    protected function getSelectParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

    protected function getUpdateParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":id_tingkat"] = $this->idTingkat;
        $inputParameters[":nama"] = $this->nama;
        $inputParameters[":label"] = $this->label;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
