<?php

/**
 * Objek PenagihanComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class PenagihanComponent {

    protected $peninjauComponent = NULL;
    protected $errorCode = NULL;

    public function setPeninjauComponent(PeninjauComponent $peninjauComponent) {
        $this->peninjauComponent = $peninjauComponent;
    }

    public function getPeninjauComponent() {
        return $this->peninjauComponent;
    }

    public function unsetPeninjauComponent() {
        $this->peninjauComponent = NULL;
    }

    public function getErrorCode() {
        return $this->errorCode;
    }

    public function perolehTagihanSiswa(UnitRecord $unitRecord, JenisPembayaranRecord $jenisPembayaranRecord, SiswaRecord $siswaRecord, TagihanObject $tagihanObject) {
        if ($this->idNull($unitRecord, $jenisPembayaranRecord, $siswaRecord)) {
            return FALSE;
        }

        if ($this->gagalRetrieveRecord($unitRecord, $jenisPembayaranRecord, $siswaRecord)) {
            return FALSE;
        }

        if ($this->peninjauTidakTerpasang()) {
            return FALSE;
        }

        $this->setTagihanObject($unitRecord, $jenisPembayaranRecord, $siswaRecord, $tagihanObject);

        return TRUE;
    }

    private function setTagihanObject(UnitRecord $unitRecord, JenisPembayaranRecord $jenisPembayaranRecord, SiswaRecord $siswaRecord, TagihanObject $tagihanObject) {
        $jumlahTagihan = $this->peninjauComponent->perolehJumlahTagihanSiswa($unitRecord->getId(), $jenisPembayaranRecord->getId(), $siswaRecord->getId());

        $tagihanObject->setUnitRecord($unitRecord);
        $tagihanObject->setJenisPembayaranRecord($jenisPembayaranRecord);
        $tagihanObject->setSiswaRecord($siswaRecord);
        $tagihanObject->setJumlahTagihan($jumlahTagihan);
    }

    private function peninjauTidakTerpasang() {
        if ($this->peninjauTerpasang()) {
            return FALSE;
        }

        $this->errorCode = "PENINJAU_TIDAK_TERPASANG";
        return TRUE;
    }

    private function peninjauTerpasang() {
        if ($this->peninjauComponent instanceof PeninjauComponent) {
            return TRUE;
        }

        return FALSE;
    }

    private function gagalRetrieveRecord(UnitRecord $unitRecord, JenisPembayaranRecord $jenisPembayaranRecord, SiswaRecord $siswaRecord) {
        if ($this->berhasilRetrieveRecord($unitRecord, $jenisPembayaranRecord, $siswaRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    private function berhasilRetrieveRecord(UnitRecord $unitRecord, JenisPembayaranRecord $jenisPembayaranRecord, SiswaRecord $siswaRecord) {
        if ($unitRecord->retrieve() === FALSE) {
            $this->errorCode = "GAGAL_RETRIEVE_UNIT";
            return FALSE;
        }

        if ($jenisPembayaranRecord->retrieve() === FALSE) {
            $this->errorCode = "GAGAL_RETRIEVE_JENIS_PEMBAYARAN";
            return FALSE;
        }

        if ($siswaRecord->retrieve() === FALSE) {
            $this->errorCode = "GAGAL_RETRIEVE_SISWA";
            return FALSE;
        }

        return TRUE;
    }

    private function idNull(UnitRecord $unitRecord, JenisPembayaranRecord $jenisPembayaranRecord, SiswaRecord $siswaRecord) {
        if ($this->idTidakNull($unitRecord, $jenisPembayaranRecord, $siswaRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    private function idTidakNull(UnitRecord $unitRecord, JenisPembayaranRecord $jenisPembayaranRecord, SiswaRecord $siswaRecord) {
        if ($unitRecord->getId() === NULL) {
            $this->errorCode = "ID_UNIT_KOSONG";
            return FALSE;
        }

        if ($jenisPembayaranRecord->getId() === NULL) {
            $this->errorCode = "ID_JENIS_PEMBAYARAN_KOSONG";
            return FALSE;
        }

        if ($siswaRecord->getId() === NULL) {
            $this->errorCode = "ID_SISWA_KOSONG";
            return FALSE;
        }

        return TRUE;
    }

}
