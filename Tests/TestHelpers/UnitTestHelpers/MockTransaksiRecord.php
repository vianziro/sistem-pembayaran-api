<?php

if (!class_exists("TransaksiRecord")) {

    class TransaksiRecord {

    }

}

class MockTransaksiRecord extends TransaksiRecord {

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
    protected $jenis = NULL;
    protected $kategori = NULL;
    protected $metode = NULL;
    protected $batal = 0;
    protected $waktuTransaksi = NULL;
    protected $waktuLaporan = NULL;
    protected $waktuEntri = NULL;
    protected $idRekening = NULL;
    protected $idKasir = NULL;
    protected $nomorTransaksi = NULL;
    protected $nomorReferensi = NULL;
    protected $nilai = 0.00000;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function unsetId() {
        $this->id = NULL;
    }

    public function setJenis($jenis) {
        $this->jenis = $jenis;
    }

    public function getJenis() {
        return $this->jenis;
    }

    public function unsetJenis() {
        $this->jenis = NULL;
    }

    public function setKategori($kategori) {
        $this->kategori = $kategori;
    }

    public function getKategori() {
        return $this->kategori;
    }

    public function unsetKategori() {
        $this->kategori = NULL;
    }

    public function setMetode($metode) {
        $this->metode = $metode;
    }

    public function getMetode() {
        return $this->metode;
    }

    public function unsetMetode() {
        $this->metode = NULL;
    }

    public function setBatal($batal) {
        $this->batal = $batal;
    }

    public function getBatal() {
        return $this->batal;
    }

    public function unsetBatal() {
        $this->batal = NULL;
    }

    public function setWaktuTransaksi($waktuTransaksi) {
        $this->waktuTransaksi = $waktuTransaksi;
    }

    public function getWaktuTransaksi() {
        return $this->waktuTransaksi;
    }

    public function unsetWaktuTransaksi() {
        $this->waktuTransaksi = NULL;
    }

    public function setWaktuLaporan($waktuLaporan) {
        $this->waktuLaporan = $waktuLaporan;
    }

    public function getWaktuLaporan() {
        return $this->waktuLaporan;
    }

    public function unsetWaktuLaporan() {
        $this->waktuLaporan = NULL;
    }

    public function setWaktuEntri($waktuEntri) {
        $this->waktuEntri = $waktuEntri;
    }

    public function getWaktuEntri() {
        return $this->waktuEntri;
    }

    public function unsetWaktuEntri() {
        $this->waktuEntri = NULL;
    }

    public function setIdRekening($idRekening) {
        $this->idRekening = $idRekening;
    }

    public function getIdRekening() {
        return $this->idRekening;
    }

    public function unsetIdRekening() {
        $this->idRekening = NULL;
    }

    public function setIdKasir($idKasir) {
        $this->idKasir = $idKasir;
    }

    public function getIdKasir() {
        return $this->idKasir;
    }

    public function unsetIdKasir() {
        $this->idKasir = NULL;
    }

    public function setNomorTransaksi($nomorTransaksi) {
        $this->nomorTransaksi = $nomorTransaksi;
    }

    public function getNomorTransaksi() {
        return $this->nomorTransaksi;
    }

    public function unsetNomorTransaksi() {
        $this->nomorTransaksi = NULL;
    }

    public function setNomorReferensi($nomorReferensi) {
        $this->nomorReferensi = $nomorReferensi;
    }

    public function getNomorReferensi() {
        return $this->nomorReferensi;
    }

    public function unsetNomorReferensi() {
        $this->nomorReferensi = NULL;
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

}
