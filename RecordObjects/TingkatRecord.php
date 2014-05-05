<?php

/**
 * Objek TingkatRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TingkatRecord extends RecordAbstract {

    protected $id = NULL;
    protected $idUnit = NULL;
    protected $nama = NULL;
    protected $label = NULL;
    protected $tingkatan = NULL;

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

    public function setIdUnit($idUnit) {
        $this->idUnit = $idUnit;
    }

    public function getIdUnit() {
        return $this->idUnit;
    }

    public function unsetIdUnit() {
        $this->idUnit = NULL;
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

    public function setTingkatan($tingkatan) {
        $this->tingkatan = $tingkatan;
    }

    public function getTingkatan() {
        return $this->tingkatan;
    }

    public function unsetTingkatan() {
        $this->tingkatan = NULL;
    }

    protected $sqlInsert = "INSERT INTO tingkat (id, id_unit, nama, label, tingkatan) VALUES (:id, :id_unit, :nama, :label, :tingkatan)";
    protected $sqlSelect = "SELECT id, id_unit, nama, label, tingkatan FROM tingkat WHERE id = :id";
    protected $sqlUpdate = "UPDATE tingkat SET id_unit = :id_unit, nama = :nama, label = :label, tingkatan = :tingkatan WHERE id = :id";
    protected $sqlDelete = "DELETE FROM tingkat WHERE id = :id";

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
        $inputParameters[":id_unit"] = $this->idUnit;
        $inputParameters[":nama"] = $this->nama;
        $inputParameters[":label"] = $this->label;
        $inputParameters[":tingkatan"] = $this->tingkatan;

        return $inputParameters;
    }

    protected function getSelectParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

    protected function getUpdateParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":id_unit"] = $this->idUnit;
        $inputParameters[":nama"] = $this->nama;
        $inputParameters[":label"] = $this->label;
        $inputParameters[":tingkatan"] = $this->tingkatan;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
