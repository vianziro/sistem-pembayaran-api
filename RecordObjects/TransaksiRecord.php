<?php

/**
 * Objek TransaksiRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TransaksiRecord extends RecordAbstract {

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

    protected $sqlInsert = "INSERT INTO transaksi (id, jenis, kategori, metode, batal, waktu_transaksi, waktu_laporan, waktu_entri, id_rekening, id_kasir, nomor_transaksi, nomor_referensi, nilai) VALUES (:id, :jenis, :kategori, :metode, :batal, :waktu_transaksi, :waktu_laporan, :waktu_entri, :id_rekening, :id_kasir, :nomor_transaksi, :nomor_referensi, :nilai)";
    protected $sqlSelect = "SELECT id, jenis, kategori, metode, batal, waktu_transaksi, waktu_laporan, waktu_entri, id_rekening, id_kasir, nomor_transaksi, nomor_referensi, nilai FROM transaksi WHERE id = :id";
    protected $sqlUpdate = "UPDATE transaksi SET jenis = :jenis, kategori = :kategori, metode = :metode, batal = :batal, waktu_transaksi = :waktu_transaksi, waktu_laporan = :waktu_laporan, waktu_entri = :waktu_entri, id_rekening = :id_rekening, id_kasir = :id_kasir, nomor_transaksi = :nomor_transaksi, nomor_referensi = :nomor_referensi, nilai = :nilai WHERE id = :id";
    protected $sqlDelete = "DELETE FROM transaksi WHERE id = :id";

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
        $inputParameters[":jenis"] = $this->jenis;
        $inputParameters[":kategori"] = $this->kategori;
        $inputParameters[":metode"] = $this->metode;
        $inputParameters[":batal"] = $this->batal;
        $inputParameters[":waktu_transaksi"] = $this->waktuTransaksi;
        $inputParameters[":waktu_laporan"] = $this->waktuLaporan;
        $inputParameters[":waktu_entri"] = $this->waktuEntri;
        $inputParameters[":id_rekening"] = $this->idRekening;
        $inputParameters[":id_kasir"] = $this->idKasir;
        $inputParameters[":nomor_transaksi"] = $this->nomorTransaksi;
        $inputParameters[":nomor_referensi"] = $this->nomorReferensi;
        $inputParameters[":nilai"] = $this->nilai;

        return $inputParameters;
    }

    protected function getSelectParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

    protected function getUpdateParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":jenis"] = $this->jenis;
        $inputParameters[":kategori"] = $this->kategori;
        $inputParameters[":metode"] = $this->metode;
        $inputParameters[":batal"] = $this->batal;
        $inputParameters[":waktu_transaksi"] = $this->waktuTransaksi;
        $inputParameters[":waktu_laporan"] = $this->waktuLaporan;
        $inputParameters[":waktu_entri"] = $this->waktuEntri;
        $inputParameters[":id_rekening"] = $this->idRekening;
        $inputParameters[":id_kasir"] = $this->idKasir;
        $inputParameters[":nomor_transaksi"] = $this->nomorTransaksi;
        $inputParameters[":nomor_referensi"] = $this->nomorReferensi;
        $inputParameters[":nilai"] = $this->nilai;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
