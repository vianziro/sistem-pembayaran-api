<?php

/**
 * Objek DistribusiComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class DistribusiComponent {

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

    public function distribusikanAlokasi(AlokasiRecord $alokasiRecord, TagihanRecord $tagihanRecord, DistribusiRecord $distribusiRecord) {
        /**
         * Cegah update record distribusi yang memiliki ID.
         */
        $distribusiRecord->unsetId();

        if ($this->dataTidakBenar($alokasiRecord, $tagihanRecord)) {
            return FALSE;
        }

        $this->setDistribusi($alokasiRecord, $tagihanRecord, $distribusiRecord);

        if ($this->gagalMenyimpanDataPendistribusian($alokasiRecord, $tagihanRecord, $distribusiRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    public function pulangkanDistribusi(DistribusiRecord $distribusiRecord, AlokasiRecord $alokasiRecord) {
        if ($this->gagalPerolehDataUntukPemulanganDistribusi($distribusiRecord, $alokasiRecord)) {
            return FALSE;
        }

        $this->setPemulanganDistribusi($distribusiRecord, $alokasiRecord);

        if ($this->gagalMenyimpanDataPemulanganDistribusi($distribusiRecord, $alokasiRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    public function perolehTagihanTerlama(TagihanRecord $tagihanRecord) {
        if (!($this->peninjauComponent instanceof PeninjauComponent)) {
            $this->errorCode = "PENINJAU_TIDAK_TERPASANG";
            return FALSE;
        }

        $idTagihan = $this->peninjauComponent->perolehIdTagihanTerlama($tagihanRecord->getIdUnit(), $tagihanRecord->getIdJenisPembayaran(), $tagihanRecord->getIdSiswa());

        $tagihanRecord->setId($idTagihan);

        if ($tagihanRecord->retrieve() === FALSE) {
            $this->errorCode = "TAGIHAN_TIDAK_ADA";
            return FALSE;
        }

        return TRUE;
    }

    public function getErrorCode() {
        return $this->errorCode;
    }

    private function gagalPerolehDataUntukPemulanganDistribusi(DistribusiRecord $distribusiRecord, AlokasiRecord $alokasiRecord) {
        if ($distribusiRecord->retrieve() === FALSE) {
            $this->errorCode = "DISTRIBUSI_TIDAK_ADA";
            return TRUE;
        }

        $alokasiRecord->setId($distribusiRecord->getIdAlokasi());

        if ($alokasiRecord->retrieve() === FALSE) {
            $this->errorCode = "ALOKASI_TIDAK_ADA";
            return TRUE;
        }

        return FALSE;
    }

    private function setPemulanganDistribusi(DistribusiRecord $distribusiRecord, AlokasiRecord $alokasiRecord) {
        $nilaiDistribusi = $distribusiRecord->getNilai();
        $sisaAlokasi = $alokasiRecord->getSisa() + $nilaiDistribusi;
        $terdistribusiAlokasi = $alokasiRecord->getTerdistribusi() - $nilaiDistribusi;

        $alokasiRecord->setSisa($sisaAlokasi);
        $alokasiRecord->setTerdistribusi($terdistribusiAlokasi);
        $distribusiRecord->setNilai(0.00000);
    }

    private function gagalMenyimpanDataPemulanganDistribusi(DistribusiRecord $distribusiRecord, AlokasiRecord $alokasiRecord) {
        if ($distribusiRecord->persist() === FALSE) {
            $this->errorCode = "DISTRIBUSI_TIDAK_TERSIMPAN";
            return TRUE;
        }

        if ($alokasiRecord->persist() === FALSE) {
            $this->errorCode = "ALOKASI_TIDAK_TERSIMPAN";
            return TRUE;
        }

        return FALSE;
    }

    private function dataTidakBenar(AlokasiRecord $alokasiRecord, TagihanRecord $tagihanRecord) {
        if ($this->alokasiTidakAda($alokasiRecord)) {
            return TRUE;
        }

        if ($tagihanRecord->getId() !== NULL) {
            if ($this->tagihanTidakAda($tagihanRecord)) {
                return TRUE;
            }
        }

        return FALSE;
    }

    private function gagalMenyimpanDataPendistribusian(AlokasiRecord $alokasiRecord, TagihanRecord $tagihanRecord, DistribusiRecord $distribusiRecord) {
        if ($this->distribusiTidakTersimpan($distribusiRecord)) {
            return TRUE;
        }

        if ($this->alokasiTidakTersimpan($alokasiRecord)) {
            return TRUE;
        }

        if ($tagihanRecord->getId() !== NULL) {
            if ($this->tagihanTidakTersimpan($tagihanRecord)) {
                return TRUE;
            }
        }

        return FALSE;
    }

    private function alokasiTidakAda(AlokasiRecord $alokasiRecord) {
        if ($alokasiRecord->retrieve() === FALSE) {
            $this->errorCode = "ALOKASI_TIDAK_ADA";
            return TRUE;
        }

        return FALSE;
    }

    private function tagihanTidakAda(TagihanRecord $tagihanRecord) {
        if ($tagihanRecord->retrieve() === FALSE) {
            $this->errorCode = "TAGIHAN_TIDAK_ADA";
            return TRUE;
        }

        return FALSE;
    }

    private function alokasiTidakTersimpan(AlokasiRecord $alokasiRecord) {
        if ($alokasiRecord->persist() === FALSE) {
            $this->errorCode = "ALOKASI_TIDAK_TERSIMPAN";
            return TRUE;
        }

        return FALSE;
    }

    private function distribusiTidakTersimpan(DistribusiRecord $distribusiRecord) {
        if ($distribusiRecord->persist() === FALSE) {
            $this->errorCode = "DISTRIBUSI_TIDAK_TERSIMPAN";
            return TRUE;
        }

        return FALSE;
    }

    private function tagihanTidakTersimpan(TagihanRecord $tagihanRecord) {
        if ($tagihanRecord->persist() === FALSE) {
            $this->errorCode = "TAGIHAN_TIDAK_TERSIMPAN";
            return TRUE;
        }

        return FALSE;
    }

    private function setDistribusi(AlokasiRecord $alokasiRecord, TagihanRecord $tagihanRecord, DistribusiRecord $distribusiRecord) {
        if ($tagihanRecord->getId() === NULL) {
            $nilaiDistribusi = $alokasiRecord->getSisa();
        } else {
            $nilaiDistribusi = min(array($alokasiRecord->getSisa(), $tagihanRecord->getSisa()));

            $sisaTagihan = $tagihanRecord->getSisa() - $nilaiDistribusi;
            $terbayarTagihan = $tagihanRecord->getTerbayar() + $nilaiDistribusi;

            $tagihanRecord->setSisa($sisaTagihan);
            $tagihanRecord->setTerbayar($terbayarTagihan);
        }

        $sisaAlokasi = $alokasiRecord->getSisa() - $nilaiDistribusi;
        $terdistribusiAlokasi = $alokasiRecord->getTerdistribusi() + $nilaiDistribusi;

        $distribusiRecord->setIdAlokasi($alokasiRecord->getId());
        $distribusiRecord->setIdTagihan($tagihanRecord->getId());
        $distribusiRecord->setNilai($nilaiDistribusi);
        $alokasiRecord->setSisa($sisaAlokasi);
        $alokasiRecord->setTerdistribusi($terdistribusiAlokasi);
    }

}
