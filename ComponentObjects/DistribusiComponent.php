<?php

/**
 * Objek DistribusiComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class DistribusiComponent {

    protected $errorCode = NULL;

    public function distribusikanAlokasi(AlokasiRecord $alokasiRecord, TagihanRecord $tagihanRecord, DistribusiRecord $distribusiRecord) {
        /**
         * Cegah update record distribusi yang memiliki ID.
         */
        $distribusiRecord->unsetId();

        if ($this->dataTidakBenar($alokasiRecord, $tagihanRecord)) {
            return FALSE;
        }

        $this->setDistribusi($alokasiRecord, $tagihanRecord, $distribusiRecord);

        if ($this->gagalMenyimpanData($alokasiRecord, $tagihanRecord, $distribusiRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    public function getErrorCode() {
        return $this->errorCode;
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

    private function gagalMenyimpanData(AlokasiRecord $alokasiRecord, TagihanRecord $tagihanRecord, DistribusiRecord $distribusiRecord) {
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
