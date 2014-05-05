<?php

/**
 * Objek TagihanRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TagihanRecord extends RecordAbstract {

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

    protected $sqlInsert = "INSERT INTO tagihan (id, waktu_tagihan, id_tahun_ajaran, id_siswa, id_bulan, id_jenis_pembayaran, nilai, terbayar, sisa, id_unit, id_program, id_jurusan, id_tingkat, id_kelas) VALUES (:id, :waktu_tagihan, :id_tahun_ajaran, :id_siswa, :id_bulan, :id_jenis_pembayaran, :nilai, :terbayar, :sisa, :id_unit, :id_program, :id_jurusan, :id_tingkat, :id_kelas)";
    protected $sqlSelect = "SELECT id, waktu_tagihan, id_tahun_ajaran, id_siswa, id_bulan, id_jenis_pembayaran, nilai, terbayar, sisa, id_unit, id_program, id_jurusan, id_tingkat, id_kelas FROM tagihan WHERE id = :id";
    protected $sqlUpdate = "UPDATE tagihan SET waktu_tagihan = :waktu_tagihan, id_tahun_ajaran = :id_tahun_ajaran, id_siswa = :id_siswa, id_bulan = :id_bulan, id_jenis_pembayaran = :id_jenis_pembayaran, nilai = :nilai, terbayar = :terbayar, sisa = :sisa, id_unit = :id_unit, id_program = :id_program, id_jurusan = :id_jurusan, id_tingkat = :id_tingkat, id_kelas = :id_kelas WHERE id = :id";
    protected $sqlDelete = "DELETE FROM tagihan WHERE id = :id";

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
        $inputParameters[":waktu_tagihan"] = $this->waktuTagihan;
        $inputParameters[":id_tahun_ajaran"] = $this->idTahunAjaran;
        $inputParameters[":id_siswa"] = $this->idSiswa;
        $inputParameters[":id_bulan"] = $this->idBulan;
        $inputParameters[":id_jenis_pembayaran"] = $this->idJenisPembayaran;
        $inputParameters[":nilai"] = $this->nilai;
        $inputParameters[":terbayar"] = $this->terbayar;
        $inputParameters[":sisa"] = $this->sisa;
        $inputParameters[":id_unit"] = $this->idUnit;
        $inputParameters[":id_program"] = $this->idProgram;
        $inputParameters[":id_jurusan"] = $this->idJurusan;
        $inputParameters[":id_tingkat"] = $this->idTingkat;
        $inputParameters[":id_kelas"] = $this->idKelas;

        return $inputParameters;
    }

    protected function getSelectParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

    protected function getUpdateParameters() {
        $inputParameters[":id"] = $this->id;
        $inputParameters[":waktu_tagihan"] = $this->waktuTagihan;
        $inputParameters[":id_tahun_ajaran"] = $this->idTahunAjaran;
        $inputParameters[":id_siswa"] = $this->idSiswa;
        $inputParameters[":id_bulan"] = $this->idBulan;
        $inputParameters[":id_jenis_pembayaran"] = $this->idJenisPembayaran;
        $inputParameters[":nilai"] = $this->nilai;
        $inputParameters[":terbayar"] = $this->terbayar;
        $inputParameters[":sisa"] = $this->sisa;
        $inputParameters[":id_unit"] = $this->idUnit;
        $inputParameters[":id_program"] = $this->idProgram;
        $inputParameters[":id_jurusan"] = $this->idJurusan;
        $inputParameters[":id_tingkat"] = $this->idTingkat;
        $inputParameters[":id_kelas"] = $this->idKelas;

        return $inputParameters;
    }

    protected function getDeleteParameters() {
        $inputParameters[":id"] = $this->id;

        return $inputParameters;
    }

}
