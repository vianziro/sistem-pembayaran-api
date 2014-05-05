<?php

/**
 * Objek BulanRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class BulanRecord extends RecordAbstract {

    protected $id = NULL;
    protected $nama = NULL;
    protected $label = NULL;
    protected $angka = NULL;
    protected $urutan = NULL;
    protected $bagianPeriode = NULL;

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

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getLabel() {
        return $this->label;
    }

    public function unsetLabel() {
        $this->label = NULL;
    }

    public function setAngka($angka) {
        $this->angka = $angka;
    }

    public function getAngka() {
        return $this->angka;
    }

    public function unsetAngka() {
        $this->angka = NULL;
    }

    public function setUrutan($urutan) {
        $this->urutan = $urutan;
    }

    public function getUrutan() {
        return $this->urutan;
    }

    public function unsetUrutan() {
        $this->urutan = NULL;
    }

    public function setBagianPeriode($bagianPeriode) {
        $this->bagianPeriode = $bagianPeriode;
    }

    public function getBagianPeriode() {
        return $this->bagianPeriode;
    }

    public function unsetBagianPeriode() {
        $this->bagianPeriode = NULL;
    }

    protected $sqlInsert = "INSERT INTO bulan (id, nama, label, angka, urutan, bagian_periode) VALUES (:id, :nama, :label, :angka, :urutan, :bagian_periode)";
    protected $sqlSelect = "SELECT id, nama, label, angka, urutan, bagian_periode FROM bulan WHERE id = :id";
    protected $sqlUpdate = "UPDATE bulan SET nama = :nama, label = :label, angka = :angka, urutan = :urutan, bagian_periode = :bagian_periode WHERE id = :id";
    protected $sqlDelete = "DELETE FROM bulan WHERE id = :id";

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
        $inputParameters[":label"] = $this->label;
        $inputParameters[":angka"] = $this->angka;
        $inputParameters[":urutan"] = $this->urutan;
        $inputParameters[":bagian_periode"] = $this->bagianPeriode;

        return $inputParameters;
    }

    protected function getSelectParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

    protected function getUpdateParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":nama"] = $this->nama;
        $inputParameters[":label"] = $this->label;
        $inputParameters[":angka"] = $this->angka;
        $inputParameters[":urutan"] = $this->urutan;
        $inputParameters[":bagian_periode"] = $this->bagianPeriode;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
