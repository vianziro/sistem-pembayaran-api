<?php

/**
 * Objek TagihanObject.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TagihanObject {

    protected $unitRecord = NULL;
    protected $jenisPembayaranRecord = NULL;
    protected $siswaRecord = NULL;
    protected $jumlahTagihan = 0.00000;

    public function setUnitRecord(UnitRecord $unitRecord) {
        $this->unitRecord = $unitRecord;
    }

    public function getUnitRecord() {
        return $this->unitRecord;
    }

    public function unsetUnitRecord() {
        $this->unitRecord = NULL;
    }

    public function setJenisPembayaranRecord(JenisPembayaranRecord $jenisPembayaranRecord) {
        $this->jenisPembayaranRecord = $jenisPembayaranRecord;
    }

    public function getJenisPembayaranRecord() {
        return $this->jenisPembayaranRecord;
    }

    public function unsetJenisPembayaranRecord() {
        $this->jenisPembayaranRecord = NULL;
    }

    public function setSiswaRecord(SiswaRecord $siswaRecord) {
        $this->siswaRecord = $siswaRecord;
    }

    public function getSiswaRecord() {
        return $this->siswaRecord;
    }

    public function unsetSiswaRecord() {
        $this->siswaRecord = NULL;
    }

    public function setJumlahTagihan($jumlahTagihan) {
        $this->jumlahTagihan = $jumlahTagihan;
    }

    public function getJumlahTagihan() {
        return $this->jumlahTagihan;
    }

    public function unsetJumlahTagihan() {
        $this->jumlahTagihan = NULL;
    }

}
