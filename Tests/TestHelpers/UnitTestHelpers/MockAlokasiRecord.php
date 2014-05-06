<?php

if (!class_exists("AlokasiRecord")) {

    class AlokasiRecord {

    }

}

class MockAlokasiRecord extends AlokasiRecord {

    protected $mockInsertId = NULL;
    protected $mockPersistReturnValue = TRUE;
    protected $mockRetrieveReturnValue = TRUE;
    protected $mockRetrieveSetValues = array();

    public function setMockInsertId($id) {
        $this->mockInsertId = $id;
    }

    public function setMockPersistReturnValue($persistReturnValue) {
        $this->mockPersistReturnValue = $persistReturnValue;
    }

    public function setMockRetrieveReturnValue($retrieveReturnValue) {
        $this->mockRetrieveReturnValue = $retrieveReturnValue;
    }

    public function setMockRetrieveSetValues($retrieveSetValues) {
        $this->mockRetrieveSetValues = $retrieveSetValues;
    }

    public function setMockValues(array $values) {
        foreach ($values as $propertyName => $value) {
            if (property_exists($this, $propertyName)) {
                $this->$propertyName = $value;
            }
        }
    }

    public function persist() {
        $this->id = $this->mockInsertId;
        return $this->mockPersistReturnValue;
    }

    public function retrieve() {
        $this->setMockValues($this->mockRetrieveSetValues);
        return $this->mockRetrieveReturnValue;
    }

    protected $id = NULL;
    protected $idTransaksi = NULL;
    protected $idSiswa = NULL;
    protected $idUnit = NULL;
    protected $idJenisPembayaran = NULL;
    protected $nilai = NULL;
    protected $sisa = NULL;
    protected $terdistribusi = NULL;

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

}
