<?php

/**
 * Objek TransaksiComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TransaksiComponent {

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

    public function bayar(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        if ($this->dataUntukPembayaranSalah($transaksiRecord, $arrayAlokasiRecord)) {
            return FALSE;
        }

        if ($this->gagalMenyimpanDataPembayaran($transaksiRecord, $arrayAlokasiRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    public function batal(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord, TransaksiRecord $transaksiRecordPembatalan, array $arrayAlokasiRecordPembatalan) {
        if ($this->dataUntukPembatalanSalah($transaksiRecord, $arrayAlokasiRecord, $transaksiRecordPembatalan, $arrayAlokasiRecordPembatalan)) {
            return FALSE;
        }

        if ($this->gagalMemperbaruiDataPembayaran($transaksiRecord)) {
            return FALSE;
        }

        $this->setDataTransaksiPembatalan($transaksiRecordPembatalan, $transaksiRecord);

        if ($this->gagalMenyimpanPembatalanPembayaran($transaksiRecordPembatalan, $transaksiRecord)) {
            return FALSE;
        }

        if ($this->gagalMenyimpanAlokasiPembatalan($arrayAlokasiRecordPembatalan, $arrayAlokasiRecord, $transaksiRecordPembatalan)) {
            return FALSE;
        }

        return TRUE;
    }

    private function dataUntukPembatalanSalah(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord, TransaksiRecord $transaksiRecordPembatalan, array $arrayAlokasiRecordPembatalan) {
        if ($this->dataUntukPembatalanBenar($transaksiRecord, $arrayAlokasiRecord, $transaksiRecordPembatalan, $arrayAlokasiRecordPembatalan)) {
            return FALSE;
        }

        return TRUE;
    }

    private function gagalMemperbaruiDataPembayaran(TransaksiRecord $transaksiRecord) {
        if ($this->berhasilMemperbaruiDataPembayaran($transaksiRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    private function setDataTransaksiPembatalan(TransaksiRecord $transaksiRecordPembatalan, TransaksiRecord $transaksiRecord) {
        $transaksiRecordPembatalan->setJenis("PEMBATALAN");
        $transaksiRecordPembatalan->setKategori($transaksiRecord->getKategori());
        $transaksiRecordPembatalan->setMetode($transaksiRecord->getMetode());
        $transaksiRecordPembatalan->setBatal(0);
        $transaksiRecordPembatalan->setWaktuTransaksi($transaksiRecord->getWaktuTransaksi());
        $transaksiRecordPembatalan->setIdRekening($transaksiRecord->getIdRekening());
        $transaksiRecordPembatalan->setIdKasir($transaksiRecord->getIdKasir());
        $transaksiRecordPembatalan->setNomorTransaksi($transaksiRecord->getNomorTransaksi());
        $transaksiRecordPembatalan->setNomorReferensi($transaksiRecord->getNomorReferensi());
        $transaksiRecordPembatalan->setNilai($transaksiRecord->getNilai());
    }

    private function gagalMenyimpanPembatalanPembayaran(TransaksiRecord $transaksiRecordPembatalan, TransaksiRecord $transaksiRecord) {
        if ($transaksiRecordPembatalan->persist() === FALSE) {
            $this->errorCode = "PERSIST_PEMBATALAN_GAGAL";
            return TRUE;
        }

        return FALSE;
    }

    private function gagalMenyimpanAlokasiPembatalan(array $arrayAlokasiRecordPembatalan, array $arrayAlokasiRecord, TransaksiRecord $transaksiRecordPembatalan) {
        if ($this->berhasilMenyimpanAlokasiPembatalan($arrayAlokasiRecordPembatalan, $arrayAlokasiRecord, $transaksiRecordPembatalan)) {
            return FALSE;
        }

        return TRUE;
    }

    private function berhasilMenyimpanAlokasiPembatalan(array $arrayAlokasiRecordPembatalan, array $arrayAlokasiRecord, TransaksiRecord $transaksiRecordPembatalan) {
        foreach ($arrayAlokasiRecord as $index => $alokasiRecord) {
            $arrayAlokasiRecordPembatalan[$index]->setIdTransaksi($transaksiRecordPembatalan->getId());
            $arrayAlokasiRecordPembatalan[$index]->setIdSiswa($alokasiRecord->getIdSiswa());
            $arrayAlokasiRecordPembatalan[$index]->setIdUnit($alokasiRecord->getIdUnit());
            $arrayAlokasiRecordPembatalan[$index]->setIdJenisPembayaran($alokasiRecord->getIdJenisPembayaran());
            $arrayAlokasiRecordPembatalan[$index]->setNilai($alokasiRecord->getNilai());
            $arrayAlokasiRecordPembatalan[$index]->setSisa($alokasiRecord->getNilai());
            $arrayAlokasiRecordPembatalan[$index]->setTerdistribusi(0.00000);

            if ($arrayAlokasiRecordPembatalan[$index]->persist() === FALSE) {
                $this->errorCode = "PERSIST_ALOKASI_PEMBATALAN_GAGAL";
                return FALSE;
            }
        }

        return TRUE;
    }

    private function berhasilMemperbaruiDataPembayaran(TransaksiRecord $transaksiRecord) {
        $transaksiRecord->setBatal(TRUE);

        if ($transaksiRecord->persist() === FALSE) {
            $this->errorCode = "PERSIST_TRANSAKSI_GAGAL";
            return FALSE;
        }

        return TRUE;
    }

    private function dataUntukPembatalanBenar(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord, TransaksiRecord $transaksiRecordPembatalan, array $arrayAlokasiRecordPembatalan) {
        if (!$this->peninjauTerpasang()) {
            $this->errorCode = "PENINJAU_TIDAK_TERPASANG";
            return FALSE;
        }

        if (!$this->transaksiAda($transaksiRecord)) {
            $this->errorCode = "TRANSAKSI_TIDAK_ADA";
            return FALSE;
        }

        if (!$this->transaksiBukanPembatalan($transaksiRecord)) {
            return FALSE;
        }

        if (!$this->transaksiBelumDibatalkan($transaksiRecord)) {
            return FALSE;
        }

        if (!$this->banyaknyaAlokasiBenar($transaksiRecord, $arrayAlokasiRecord)) {
            $this->errorCode = "BANYAKNYA_ALOKASI_SALAH";
            return FALSE;
        }

        if (count($arrayAlokasiRecord) != count($arrayAlokasiRecordPembatalan)) {
            $this->errorCode = "BANYAKNYA_PENAMPUNG_ALOKASI_PEMBATALAN_SALAH";
            return FALSE;
        }

        foreach ($arrayAlokasiRecord as $alokasiRecord) {
            if (!$alokasiRecord->retrieve()) {
                $this->errorCode = "ALOKASI_TIDAK_ADA";
                return FALSE;
            }

            if ($alokasiRecord->getIdTransaksi() != $transaksiRecord->getId()) {
                $this->errorCode = "ALOKASI_SALAH";
                return FALSE;
            }
        }

        if (strlen($transaksiRecordPembatalan->getWaktuEntri()) < 1) {
            $this->errorCode = "WAKTU_ENTRI_PEMBATALAN_KOSONG";
            return FALSE;
        }

        if (strlen($transaksiRecordPembatalan->getWaktuLaporan()) < 1) {
            $this->errorCode = "WAKTU_LAPORAN_PEMBATALAN_KOSONG";
            return FALSE;
        }

        return TRUE;
    }

    private function transaksiAda(TransaksiRecord $transaksiRecord) {
        if (!$transaksiRecord->retrieve()) {
            return FALSE;
        }

        return TRUE;
    }

    private function transaksiBukanPembatalan(TransaksiRecord $transaksiRecord) {
        if ($transaksiRecord->getJenis() === "PEMBATALAN") {
            $this->errorCode = "TRANSAKSI_ADALAH_PEMBATALAN";
            return FALSE;
        }

        return TRUE;
    }

    private function transaksiBelumDibatalkan(TransaksiRecord $transaksiRecord) {
        if ($transaksiRecord->getBatal()) {
            $this->errorCode = "TRANSAKSI_SUDAH_DIBATALKAN";
            return FALSE;
        }

        return TRUE;
    }

    private function banyaknyaAlokasiBenar(TransaksiRecord $transaksiRecord, $arrayAlokasiRecord) {
        if ($this->peninjauComponent->hitungBanyaknyaAlokasi($transaksiRecord->getId()) != count($arrayAlokasiRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    private function dataUntukPembayaranSalah(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        if ($this->dataUntukPembayaranBenar($transaksiRecord, $arrayAlokasiRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    private function gagalMenyimpanDataPembayaran(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        if ($this->suksesMenyimpanDataPembayaran($transaksiRecord, $arrayAlokasiRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    private function suksesMenyimpanDataPembayaran(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        if (!$this->simpanDataTransaksi($transaksiRecord)) {
            $this->errorCode = "TRANSAKSI_TIDAK_TERSIMPAN";
            return FALSE;
        }

        $this->setIdTransaksiPadaAlokasi($transaksiRecord, $arrayAlokasiRecord);

        if (!$this->simpanDataAlokasi($arrayAlokasiRecord)) {
            $this->errorCode = "ALOKASI_TIDAK_TERSIMPAN";
            return FALSE;
        }

        return TRUE;
    }

    private function simpanDataTransaksi(TransaksiRecord $transaksiRecord) {
        if (!$transaksiRecord->persist()) {
            return FALSE;
        }

        return TRUE;
    }

    private function setIdTransaksiPadaAlokasi(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        foreach ($arrayAlokasiRecord as $alokasiRecord) {
            $alokasiRecord->setIdTransaksi($transaksiRecord->getId());
        }
    }

    private function simpanDataAlokasi(array $arrayAlokasiRecord) {
        foreach ($arrayAlokasiRecord as $alokasiRecord) {
            if (!$alokasiRecord->persist()) {
                return FALSE;
            }
        }

        return TRUE;
    }

    private function dataUntukPembayaranBenar(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        if (!$this->tinjauLangsungDataPembayaran($transaksiRecord, $arrayAlokasiRecord)) {
            return FALSE;
        }

        if (!$this->tinjauDatabaseUntukDataPembayaran($transaksiRecord, $arrayAlokasiRecord)) {
            return FALSE;
        }

        return TRUE;
    }

    private function tinjauLangsungDataPembayaran(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        if (!$this->idNull($transaksiRecord, $arrayAlokasiRecord)) {
            $this->errorCode = "ID_TIDAK_NULL";
            return FALSE;
        }

        if (!$this->nilaiBenar($transaksiRecord, $arrayAlokasiRecord)) {
            $this->errorCode = "NILAI_TIDAK_BENAR";
            return FALSE;
        }

        if (!$this->nilaiSeimbang($transaksiRecord, $arrayAlokasiRecord)) {
            $this->errorCode = "NILAI_TIDAK_SEIMBANG";
            return FALSE;
        }

        if (!$this->metodeBenarDanNomorTerisi($transaksiRecord)) {
            return FALSE;
        }

        if (!$this->jenisDanKategoriBenar($transaksiRecord)) {
            return FALSE;
        }

        if (!$this->tidakBatal($transaksiRecord)) {
            $this->errorCode = "BATAL_BUKAN_FALSE";
            return FALSE;
        }

        return TRUE;
    }

    private function tinjauDatabaseUntukDataPembayaran(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        if (!$this->peninjauTerpasang()) {
            $this->errorCode = "PENINJAU_TIDAK_TERPASANG";
            return FALSE;
        }

        if (!$this->nomorBelumAda($transaksiRecord)) {
            return FALSE;
        }

        if (!$this->rekeningAda($transaksiRecord)) {
            $this->errorCode = "REKENING_TIDAK_DIKETAHUI";
            return FALSE;
        }

        if (!$this->kasirAda($transaksiRecord)) {
            $this->errorCode = "KASIR_TIDAK_DIKETAHUI";
            return FALSE;
        }

        if (!$this->siswaAda($arrayAlokasiRecord)) {
            $this->errorCode = "SISWA_TIDAK_DIKETAHUI";
            return FALSE;
        }

        if (!$this->jenisPembayaranAda($arrayAlokasiRecord)) {
            $this->errorCode = "JENIS_PEMBAYARAN_TIDAK_DIKETAHUI";
            return FALSE;
        }

        if (!$this->unitAda($arrayAlokasiRecord)) {
            $this->errorCode = "UNIT_TIDAK_DIKETAHUI";
            return FALSE;
        }

        return TRUE;
    }

    private function peninjauTerpasang() {
        if (!$this->peninjauComponent instanceof PeninjauComponent) {
            return FALSE;
        }

        return TRUE;
    }

    private function idNull(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        if ($transaksiRecord->getId() !== NULL) {
            return FALSE;
        }

        foreach ($arrayAlokasiRecord as $alokasiRecord) {
            if ($alokasiRecord->getId() !== NULL) {
                return FALSE;
            }
        }

        return TRUE;
    }

    private function nilaiBenar(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        if ($transaksiRecord->getNilai() <= 0.00000) {
            return FALSE;
        }

        if ($transaksiRecord->getNilai() > 100000000.00000) {
            return FALSE;
        }

        foreach ($arrayAlokasiRecord as $alokasiRecord) {
            if ($alokasiRecord->getNilai() <= 0.00000) {
                return FALSE;
            }
        }

        return TRUE;
    }

    private function nilaiSeimbang(TransaksiRecord $transaksiRecord, array $arrayAlokasiRecord) {
        $jumlahAlokasi = 0.00000;

        foreach ($arrayAlokasiRecord as $alokasiRecord) {
            $jumlahAlokasi += $alokasiRecord->getNilai();

            if ($alokasiRecord->getNilai() != $alokasiRecord->getSisa()) {
                return FALSE;
            }

            if ($alokasiRecord->getTerdistribusi() != 0.00000) {
                return FALSE;
            }
        }

        if ($transaksiRecord->getNilai() != $jumlahAlokasi) {
            return FALSE;
        }

        return TRUE;
    }

    private function metodeBenarDanNomorTerisi(TransaksiRecord $transaksiRecord) {
        if (!in_array($transaksiRecord->getMetode(), array("OFFLINE", "ONLINE"))) {
            $this->errorCode = "METODE_TIDAK_DIKETAHUI";
            return FALSE;
        }

        if (($transaksiRecord->getMetode() == "OFFLINE") and ( strlen($transaksiRecord->getNomorTransaksi()) < 1)) {
            $this->errorCode = "NOMOR_TRANSAKSI_KOSONG";
            return FALSE;
        } elseif (($transaksiRecord->getMetode() == "ONLINE") and ( strlen($transaksiRecord->getNomorReferensi()) < 1)) {
            $this->errorCode = "NOMOR_REFERENSI_KOSONG";
            return FALSE;
        }

        return TRUE;
    }

    private function jenisDanKategoriBenar(TransaksiRecord $transaksiRecord) {
        if (!($transaksiRecord->getJenis() === "TRANSAKSI")) {
            $this->errorCode = "JENIS_BUKAN_TRANSAKSI";
            return FALSE;
        }

        if (!($transaksiRecord->getKategori() === "PEMBAYARAN")) {
            $this->errorCode = "KATEGORI_BUKAN_PEMBAYARAN";
            return FALSE;
        }

        return TRUE;
    }

    private function tidakBatal(TransaksiRecord $transaksiRecord) {
        if (!$transaksiRecord->getBatal() === FALSE) {
            return FALSE;
        }

        return TRUE;
    }

    private function nomorBelumAda(TransaksiRecord $transaksiRecord) {
        if ($this->peninjauComponent->nomorTransaksiAda($transaksiRecord->getNomorTransaksi(), $transaksiRecord->getIdRekening())) {
            $this->errorCode = "NOMOR_TRANSAKSI_SUDAH_ADA";
            return FALSE;
        }

        if ($this->peninjauComponent->nomorReferensiAda($transaksiRecord->getNomorReferensi(), $transaksiRecord->getIdRekening())) {
            $this->errorCode = "NOMOR_REFERENSI_SUDAH_ADA";
            return FALSE;
        }

        return TRUE;
    }

    private function rekeningAda(TransaksiRecord $transaksiRecord) {
        if ($transaksiRecord->getIdRekening() === NULL) {
            return TRUE;
        } elseif ($this->peninjauComponent->rekeningAda($transaksiRecord->getIdRekening())) {
            return TRUE;
        }

        return FALSE;
    }

    private function kasirAda(TransaksiRecord $transaksiRecord) {
        if ($this->peninjauComponent->kasirAda($transaksiRecord->getIdKasir())) {
            return TRUE;
        }

        return FALSE;
    }

    private function siswaAda(array $arrayAlokasiRecord) {
        foreach ($arrayAlokasiRecord as $alokasiRecord) {
            if ($alokasiRecord->getIdSiswa() == NULL) {
                continue;
            }

            if (!$this->peninjauComponent->siswaAda($alokasiRecord->getIdSiswa())) {
                return FALSE;
            }
        }

        return TRUE;
    }

    private function jenisPembayaranAda(array $arrayAlokasiRecord) {
        foreach ($arrayAlokasiRecord as $alokasiRecord) {
            if ($alokasiRecord->getIdJenisPembayaran() == NULL) {
                continue;
            }

            if (!$this->peninjauComponent->jenisPembayaranAda($alokasiRecord->getIdJenisPembayaran())) {
                return FALSE;
            }
        }

        return TRUE;
    }

    private function unitAda(array $arrayAlokasiRecord) {
        foreach ($arrayAlokasiRecord as $alokasiRecord) {
            if ($alokasiRecord->getIdUnit() == NULL) {
                continue;
            }

            if (!$this->peninjauComponent->unitAda($alokasiRecord->getIdUnit())) {
                return FALSE;
            }
        }

        return TRUE;
    }

}
