<?php

/**
 * Objek RekeningRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class RekeningRecord extends RecordAbstract {

    protected $id = NULL;
    protected $idBank = NULL;
    protected $nomor = NULL;
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

    public function setIdBank($idBank) {
        $this->idBank = $idBank;
    }

    public function getIdBank() {
        return $this->idBank;
    }

    public function unsetIdBank() {
        $this->idBank = NULL;
    }

    public function setNomor($nomor) {
        $this->nomor = $nomor;
    }

    public function getNomor() {
        return $this->nomor;
    }

    public function unsetNomor() {
        $this->nomor = NULL;
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

    protected $sqlInsert = "INSERT INTO rekening (id, id_bank, nomor, nama, label) VALUES (:id, :id_bank, :nomor, :nama, :label)";
    protected $sqlSelect = "SELECT id, id_bank, nomor, nama, label FROM rekening WHERE id = :id";
    protected $sqlUpdate = "UPDATE rekening SET id_bank = :id_bank, nomor = :nomor, nama = :nama, label = :label WHERE id = :id";
    protected $sqlDelete = "DELETE FROM rekening WHERE id = :id";

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
        $inputParameters[":id_bank"] = $this->idBank;
        $inputParameters[":nomor"] = $this->nomor;
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
        $inputParameters[":id_bank"] = $this->idBank;
        $inputParameters[":nomor"] = $this->nomor;
        $inputParameters[":nama"] = $this->nama;
        $inputParameters[":label"] = $this->label;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
