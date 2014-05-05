<?php

/**
 * Objek TahunAjaranRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TahunAjaranRecord extends RecordAbstract {

    protected $id = NULL;
    protected $nama = NULL;
    protected $label = NULL;
    protected $waktuMulai = NULL;
    protected $waktuSelesai = NULL;

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

    public function setWaktuMulai($waktuMulai) {
        $this->waktuMulai = $waktuMulai;
    }

    public function getWaktuMulai() {
        return $this->waktuMulai;
    }

    public function unsetWaktuMulai() {
        $this->waktuMulai = NULL;
    }

    public function setWaktuSelesai($waktuSelesai) {
        $this->waktuSelesai = $waktuSelesai;
    }

    public function getWaktuSelesai() {
        return $this->waktuSelesai;
    }

    public function unsetWaktuSelesai() {
        $this->waktuSelesai = NULL;
    }

    protected $sqlInsert = "INSERT INTO tahun_ajaran (id, nama, label, waktu_mulai, waktu_selesai) VALUES (:id, :nama, :label, :waktu_mulai, :waktu_selesai)";
    protected $sqlSelect = "SELECT id, nama, label, waktu_mulai, waktu_selesai FROM tahun_ajaran WHERE id = :id";
    protected $sqlUpdate = "UPDATE tahun_ajaran SET nama = :nama, label = :label, waktu_mulai = :waktu_mulai, waktu_selesai = :waktu_selesai WHERE id = :id";
    protected $sqlDelete = "DELETE FROM tahun_ajaran WHERE id = :id";

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
        $inputParameters[":waktu_mulai"] = $this->waktuMulai;
        $inputParameters[":waktu_selesai"] = $this->waktuSelesai;

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
        $inputParameters[":waktu_mulai"] = $this->waktuMulai;
        $inputParameters[":waktu_selesai"] = $this->waktuSelesai;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
