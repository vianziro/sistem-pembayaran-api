<?php

/**
 * Unit test objek TransaksiComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TransaksiComponentMethodBatalUnitTest extends TransaksiComponentUnitTestAbstract {

    private $seq = 1;

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalDefaultReturnTrue() {
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $this->assertTrue($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord))), $this->object->getErrorCode());
        $this->assertNull($this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaKomponenPeninjauTidakTerpasang() {
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $this->object->unsetPeninjauComponent();
        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord))));
        $this->assertEquals("PENINJAU_TIDAK_TERPASANG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaTransaksiTidakAda() {
        $idTransaksi = 7;
        $retrieveTransaksiReturnValue = FALSE;

        $mockTransaksiRecord = $this->getMockTransaksiInputBatal(array("id" => $idTransaksi), array("id" => $idTransaksi), $retrieveTransaksiReturnValue);
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord))));
        $this->assertEquals("TRANSAKSI_TIDAK_ADA", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaBanyaknyaAlokasiSalah() {
        $mockPeninjauComponent = $this->getMockPeninjauComponent(array("hitungBanyaknyaAlokasi" => 2));
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord))));
        $this->assertEquals("BANYAKNYA_ALOKASI_SALAH", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaBanyaknyaPenampungAlokasiPembatalanTidakSamaDenganBanyaknyaAlokasiTransaksi() {
        $mockPeninjauComponent = $this->getMockPeninjauComponent(array("hitungBanyaknyaAlokasi" => 3));
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count(2))));
        $this->assertEquals("BANYAKNYA_PENAMPUNG_ALOKASI_PEMBATALAN_SALAH", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaAlokasiTidakAda() {
        $idTransaksi = 7;

        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal($idTransaksi);
        $arrayMockAlokasiRecord[] = $this->getMockAlokasiInputBatal(array("id" => 19), array("id" => 19, "idTransaksi" => $idTransaksi));
        $arrayMockAlokasiRecord[] = $this->getMockAlokasiInputBatal(array("id" => 20), array("id" => 20, "idTransaksi" => $idTransaksi));
        $arrayMockAlokasiRecord[] = $this->getMockAlokasiInputBatal(array("id" => 21), array("id" => 21, "idTransaksi" => $idTransaksi), FALSE);

        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord))));
        $this->assertEquals("ALOKASI_TIDAK_ADA", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaIdTransaksiAlokasiTidakBenar() {
        $idTransaksi = 7;

        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal($idTransaksi);
        $arrayMockAlokasiRecord[] = $this->getMockAlokasiInputBatal(array("id" => 19), array("id" => 19, "idTransaksi" => $idTransaksi));
        $arrayMockAlokasiRecord[] = $this->getMockAlokasiInputBatal(array("id" => 20), array("id" => 20, "idTransaksi" => $idTransaksi));
        $arrayMockAlokasiRecord[] = $this->getMockAlokasiInputBatal(array("id" => 21), array("id" => 21, "idTransaksi" => 9));

        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord))));
        $this->assertEquals("ALOKASI_SALAH", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaJenisTransaksiAdalahPembatalan() {
        $idTransaksi = 7;

        $mockTransaksiRecord = $this->getMockTransaksiInputBatal(array("id" => $idTransaksi), array("id" => $idTransaksi, "jenis" => "PEMBATALAN"));
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord))));
        $this->assertEquals("TRANSAKSI_ADALAH_PEMBATALAN", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaJenisTransaksiSudahDibatalkan() {
        $idTransaksi = 7;

        $mockTransaksiRecord = $this->getMockTransaksiInputBatal(array("id" => $idTransaksi), array("id" => $idTransaksi, "batal" => TRUE));
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord))));
        $this->assertEquals("TRANSAKSI_SUDAH_DIBATALKAN", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaWaktuEntriPenampungTransaksiPembatalanKosong() {
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $mockTransaksiRecordPembatalan = $this->getMockTransaksiInputBatalEmpty(array("waktuEntri" => NULL));
        $arrayMockAlokasiRecordPembatalan = $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord));

        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $mockTransaksiRecordPembatalan, $arrayMockAlokasiRecordPembatalan, $this->object->getErrorCode()));
        $this->assertEquals("WAKTU_ENTRI_PEMBATALAN_KOSONG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaWaktuLaporanPenampungTransaksiPembatalanKosong() {
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $mockTransaksiRecordPembatalan = $this->getMockTransaksiInputBatalEmpty(array("waktuLaporan" => NULL));
        $arrayMockAlokasiRecordPembatalan = $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord));

        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $mockTransaksiRecordPembatalan, $arrayMockAlokasiRecordPembatalan, $this->object->getErrorCode()));
        $this->assertEquals("WAKTU_LAPORAN_PEMBATALAN_KOSONG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalSetBatalTrue() {
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $this->assertEquals(0, $mockTransaksiRecord->getBatal());
        $this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord)));
        $this->assertEquals(1, $mockTransaksiRecord->getBatal());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaPerubahanDataTransaksiGagalDisimpan() {
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $idTransaksi = $mockTransaksiRecord->getId();
        $mockTransaksiRecord->setMockInsertId($idTransaksi);
        $mockTransaksiRecord->setMockPersistReturnValue(FALSE);

        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $this->getMockTransaksiInputBatalEmpty(), $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord))));
        $this->assertEquals("PERSIST_TRANSAKSI_GAGAL", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalSetTransaksiPembatalan() {
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $mockTransaksiRecordPembatalan = $this->getMockTransaksiInputBatalEmpty();
        $arrayMockAlokasiRecordPembatalan = $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord));

        $this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $mockTransaksiRecordPembatalan, $arrayMockAlokasiRecordPembatalan);

        $this->assertEquals("PEMBATALAN", $mockTransaksiRecordPembatalan->getJenis());
        $this->assertEquals($mockTransaksiRecord->getKategori(), $mockTransaksiRecordPembatalan->getKategori());
        $this->assertEquals($mockTransaksiRecord->getMetode(), $mockTransaksiRecordPembatalan->getMetode());
        $this->assertEquals(0, $mockTransaksiRecordPembatalan->getBatal());
        $this->assertEquals($mockTransaksiRecord->getWaktuTransaksi(), $mockTransaksiRecordPembatalan->getWaktuTransaksi());
        $this->assertEquals($mockTransaksiRecord->getIdRekening(), $mockTransaksiRecordPembatalan->getIdRekening());
        $this->assertEquals($mockTransaksiRecord->getIdKasir(), $mockTransaksiRecordPembatalan->getIdKasir());
        $this->assertEquals($mockTransaksiRecord->getNomorTransaksi(), $mockTransaksiRecordPembatalan->getNomorTransaksi());
        $this->assertEquals($mockTransaksiRecord->getNomorReferensi(), $mockTransaksiRecordPembatalan->getNomorReferensi());
        $this->assertEquals($mockTransaksiRecord->getNilai(), $mockTransaksiRecordPembatalan->getNilai());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaTransaksiPembatalanGagalDisimpan() {
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $mockTransaksiRecordPembatalan = $this->getMockTransaksiInputBatalEmpty();
        $mockTransaksiRecordPembatalan->setMockInsertId(NULL);
        $mockTransaksiRecordPembatalan->setMockPersistReturnValue(FALSE);
        $arrayMockAlokasiRecordPembatalan = $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord));

        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $mockTransaksiRecordPembatalan, $arrayMockAlokasiRecordPembatalan));
        $this->assertEquals("PERSIST_PEMBATALAN_GAGAL", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalSetPenampungAlokasiPembatalan() {
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $mockTransaksiRecordPembatalan = $this->getMockTransaksiInputBatalEmpty();
        $arrayMockAlokasiRecordPembatalan = $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord));

        $this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $mockTransaksiRecordPembatalan, $arrayMockAlokasiRecordPembatalan);

        foreach ($arrayMockAlokasiRecord as $index => $mockAlokasiRecord) {
            $this->assertEquals($mockTransaksiRecordPembatalan->getId(), $arrayMockAlokasiRecordPembatalan[$index]->getIdTransaksi());
            $this->assertEquals($mockAlokasiRecord->getIdSiswa(), $arrayMockAlokasiRecordPembatalan[$index]->getIdSiswa());
            $this->assertEquals($mockAlokasiRecord->getIdUnit(), $arrayMockAlokasiRecordPembatalan[$index]->getIdUnit());
            $this->assertEquals($mockAlokasiRecord->getIdJenisPembayaran(), $arrayMockAlokasiRecordPembatalan[$index]->getIdJenisPembayaran());
            $this->assertEquals($mockAlokasiRecord->getNilai(), $arrayMockAlokasiRecordPembatalan[$index]->getNilai());
            $this->assertEquals(0.00000, $arrayMockAlokasiRecordPembatalan[$index]->getTerdistribusi());
            $this->assertEquals($mockAlokasiRecord->getNilai(), $arrayMockAlokasiRecordPembatalan[$index]->getSisa());
        }
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalReturnFalseJikaAlokasiPembatalanGagalDisimpan() {
        $mockTransaksiRecord = $this->getQualifiedMockTransaksiRecordInputBatal();
        $arrayMockAlokasiRecord = $this->getQualifiedMockAlokasiInputBatal();

        $mockTransaksiRecordPembatalan = $this->getMockTransaksiInputBatalEmpty();
        $arrayMockAlokasiRecordPembatalan = $this->getMockAlokasiInputBatalEmpty(count($arrayMockAlokasiRecord));
        $arrayMockAlokasiRecordPembatalan[count($arrayMockAlokasiRecord) - 1]->setMockInsertId(NULL);
        $arrayMockAlokasiRecordPembatalan[count($arrayMockAlokasiRecord) - 1]->setMockPersistReturnValue(FALSE);

        $this->assertFalse($this->object->batal($mockTransaksiRecord, $arrayMockAlokasiRecord, $mockTransaksiRecordPembatalan, $arrayMockAlokasiRecordPembatalan));
        $this->assertEquals("PERSIST_ALOKASI_PEMBATALAN_GAGAL", $this->object->getErrorCode());
    }

}
