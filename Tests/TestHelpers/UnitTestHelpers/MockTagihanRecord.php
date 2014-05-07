<?php

if (!class_exists("TagihanRecord")) {

    class TagihanRecord {

    }

}

class MockTagihanRecord extends TagihanRecord {

    protected $mockInsertId = NULL;
    protected $mockPersistReturnValue = TRUE;
    protected $mockRetrieveReturnValue = TRUE;
    protected $mockRetrieveSetValues = array();
    protected $persistInsertCallCount = 0;
    protected $persistUpdateCallCount = 0;

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

    public function getMockPersistInsertCallCount() {
        return $this->persistInsertCallCount;
    }

    public function getMockPersistUpdateCallCount() {
        return $this->persistUpdateCallCount;
    }

    public function persist() {
        if ($this->id === NULL) {
            $this->persistInsertCallCount ++;
            $this->id = $this->mockInsertId;
        } else {
            $this->persistUpdateCallCount ++;
        }

        return $this->mockPersistReturnValue;
    }

    public function retrieve() {
        $this->setMockValues($this->mockRetrieveSetValues);
        return $this->mockRetrieveReturnValue;
    }

    protected $id = NULL;
    protected $waktuTagihan = NULL;
    protected $idTahunAjaran = NULL;
    protected $idSiswa = NULL;
    protected $idBulan = NULL;
    protected $idJenisPembayaran = NULL;
    protected $nilai = NULL;
    protected $terbayar = NULL;
    protected $sisa = NULL;
    protected $idUnit = NULL;
    protected $idProgram = NULL;
    protected $idJurusan = NULL;
    protected $idTingkat = NULL;
    protected $idKelas = NULL;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function unsetId() {
        $this->id = NULL;
    }

    public function setWaktuTagihan($waktuTagihan) {
        $this->waktuTagihan = $waktuTagihan;
    }

    public function getWaktuTagihan() {
        return $this->waktuTagihan;
    }

    public function unsetWaktuTagihan() {
        $this->waktuTagihan = NULL;
    }

    public function setIdTahunAjaran($idTahunAjaran) {
        $this->idTahunAjaran = $idTahunAjaran;
    }

    public function getIdTahunAjaran() {
        return $this->idTahunAjaran;
    }

    public function unsetIdTahunAjaran() {
        $this->idTahunAjaran = NULL;
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

    public function setIdBulan($idBulan) {
        $this->idBulan = $idBulan;
    }

    public function getIdBulan() {
        return $this->idBulan;
    }

    public function unsetIdBulan() {
        $this->idBulan = NULL;
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

    public function setTerbayar($terbayar) {
        $this->terbayar = $terbayar;
    }

    public function getTerbayar() {
        return $this->terbayar;
    }

    public function unsetTerbayar() {
        $this->terbayar = NULL;
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

    public function setIdUnit($idUnit) {
        $this->idUnit = $idUnit;
    }

    public function getIdUnit() {
        return $this->idUnit;
    }

    public function unsetIdUnit() {
        $this->idUnit = NULL;
    }

    public function setIdProgram($idProgram) {
        $this->idProgram = $idProgram;
    }

    public function getIdProgram() {
        return $this->idProgram;
    }

    public function unsetIdProgram() {
        $this->idProgram = NULL;
    }

    public function setIdJurusan($idJurusan) {
        $this->idJurusan = $idJurusan;
    }

    public function getIdJurusan() {
        return $this->idJurusan;
    }

    public function unsetIdJurusan() {
        $this->idJurusan = NULL;
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

    public function setIdKelas($idKelas) {
        $this->idKelas = $idKelas;
    }

    public function getIdKelas() {
        return $this->idKelas;
    }

    public function unsetIdKelas() {
        $this->idKelas = NULL;
    }

}
