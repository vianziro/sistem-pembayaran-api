<?php

/**
 * Unit test objek TransaksiComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TransaksiComponentMethodBayarUnitTest extends TransaksiComponentUnitTestAbstract {

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarDefaultReturnTrue() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array());
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $this->assertTrue($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertNull($this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaKomponenPeninjauTidakTerpasang() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 1.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array("nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));

        $this->object->unsetPeninjauComponent();
        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("PENINJAU_TIDAK_TERPASANG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaIdTransaksiTidakNull() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("id" => 1));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("ID_TIDAK_NULL", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaIdAlokasiTidakNull() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array());
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array("id" => 1));

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("ID_TIDAK_NULL", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaNilaiTransaksiNol() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 0.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array("nilai" => 0.00000, "terdistribusi" => 0.00000, "sisa" => 0.00000));

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("NILAI_TIDAK_BENAR", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaNilaiTransaksiNegatif() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => -1.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array("nilai" => -1.00000, "terdistribusi" => 0.00000, "sisa" => -1.00000));

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("NILAI_TIDAK_BENAR", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaNilaiTransaksiLebihDari100Juta() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 100000001.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array("nilai" => 100000001.00000, "terdistribusi" => 0.00000, "sisa" => 100000001.00000));

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("NILAI_TIDAK_BENAR", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaNilaiAlokasiNol() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 1.00000));
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockAlokasiRecord2 = $this->getMockAlokasiRecord(array("nilai" => 0.00000, "terdistribusi" => 0.00000, "sisa" => 0.00000));

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1, $mockAlokasiRecord2)));
        $this->assertEquals("NILAI_TIDAK_BENAR", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaNilaiAlokasiNegatif() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 1.00000));
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("nilai" => 2.00000, "terdistribusi" => 0.00000, "sisa" => 2.00000));
        $mockAlokasiRecord2 = $this->getMockAlokasiRecord(array("nilai" => -1.00000, "terdistribusi" => 0.00000, "sisa" => -1.00000));

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1, $mockAlokasiRecord2)));
        $this->assertEquals("NILAI_TIDAK_BENAR", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaJumlahAlokasiTidakSamaDenganNilaiTransaksi() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 1.00000));
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockAlokasiRecord2 = $this->getMockAlokasiRecord(array("nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1, $mockAlokasiRecord2)));
        $this->assertEquals("NILAI_TIDAK_SEIMBANG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaNilaiAlokasiTidakSamaDenganSisa() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 2.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array("nilai" => 2.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("NILAI_TIDAK_SEIMBANG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaAlokasiTerdistribusi() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 1.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array("nilai" => 1.00000, "terdistribusi" => 1.00000, "sisa" => 1.00000));

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("NILAI_TIDAK_SEIMBANG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @dataProvider providerMetode
     */
    public function testBayarReturnFalseJikaMetodeBukanOnlineAtauBukanOffline($metode, $expected, $errorCode, $message) {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("metode" => $metode));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $this->assertSame($expected, $this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)), $message);
        $this->assertEquals($errorCode, $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaNomorTransaksiKosongDanMetodeOffline() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("metode" => "OFFLINE", "nomorTransaksi" => ""));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("NOMOR_TRANSAKSI_KOSONG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaNomorReferensiKosongDanMetodeOnline() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("metode" => "ONLINE", "nomorReferensi" => ""));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("NOMOR_REFERENSI_KOSONG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaJenisBukanTransaksi() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("jenis" => "PEMBATALAN"));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("JENIS_BUKAN_TRANSAKSI", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaKategoriBukanPembayaran() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("kategori" => "PENGEMBALIAN"));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("KATEGORI_BUKAN_PEMBAYARAN", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaTransaksiBatal() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("batal" => TRUE));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("BATAL_BUKAN_FALSE", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaNomorTransaksiSudahAda() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nomorTransaksi" => "T001", "metode" => "OFFLINE", "nomorReferensi" => ""));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());
        $mockPeninjauComponent = $this->getMockPeninjauComponent(array("nomorTransaksiAda" => TRUE));

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("NOMOR_TRANSAKSI_SUDAH_ADA", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaNomorReferensiSudahAda() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nomorReferensi" => "R001", "metode" => "ONLINE", "nomorTransaksi" => ""));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());
        $mockPeninjauComponent = $this->getMockPeninjauComponent(array("nomorReferensiAda" => TRUE));

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("NOMOR_REFERENSI_SUDAH_ADA", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaRekeningTidakAda() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array());
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());
        $mockPeninjauComponent = $this->getMockPeninjauComponent(array("rekeningAda" => FALSE));

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("REKENING_TIDAK_DIKETAHUI", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaKasirTidakAda() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array());
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());
        $mockPeninjauComponent = $this->getMockPeninjauComponent(array("kasirAda" => FALSE));

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("KASIR_TIDAK_DIKETAHUI", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaSiswaTidakAda() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 1.00000));
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("idSiswa" => 1, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockPeninjauComponent = $this->getMockPeninjauComponent(array("siswaAda" => FALSE));

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1)));
        $this->assertEquals("SISWA_TIDAK_DIKETAHUI", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaJenisPembayaranTidakAda() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 1.00000));
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("idJenisPembayaran" => 1, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockPeninjauComponent = $this->getMockPeninjauComponent(array("jenisPembayaranAda" => FALSE));

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1)));
        $this->assertEquals("JENIS_PEMBAYARAN_TIDAK_DIKETAHUI", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaUnitTidakAda() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 1.00000));
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("idJenisPembayaran" => 1, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockPeninjauComponent = $this->getMockPeninjauComponent(array("unitAda" => FALSE));

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1)));
        $this->assertEquals("UNIT_TIDAK_DIKETAHUI", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarTidakPeriksaRekeningJikaNull() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 2.00000, "idRekening" => NULL));
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockAlokasiRecord2 = $this->getMockAlokasiRecord(array("nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockPeninjauComponent = $this->getMockPeninjauComponent(array(), array("rekeningAda"));
        $mockPeninjauComponent->expects($this->never())->method("rekeningAda");

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1, $mockAlokasiRecord2));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @dataProvider providerTestSkipNull
     */
    public function testBayarTidakPeriksaSiswaJikaNull($id1, $id2, $id3, $callCount) {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 3.00000));

        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("idSiswa" => $id1, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockAlokasiRecord2 = $this->getMockAlokasiRecord(array("idSiswa" => $id2, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockAlokasiRecord3 = $this->getMockAlokasiRecord(array("idSiswa" => $id3, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));

        $mockPeninjauComponent = $this->getMockPeninjauComponent(array());
        $mockPeninjauComponent->expects($this->exactly($callCount))->method("siswaAda");

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1, $mockAlokasiRecord2, $mockAlokasiRecord3));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @dataProvider providerTestSkipNull
     */
    public function testBayarTidakPeriksaJenisPembayaranJikaNull($id1, $id2, $id3, $callCount) {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 3.00000));

        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("idJenisPembayaran" => $id1, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockAlokasiRecord2 = $this->getMockAlokasiRecord(array("idJenisPembayaran" => $id2, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockAlokasiRecord3 = $this->getMockAlokasiRecord(array("idJenisPembayaran" => $id3, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));

        $mockPeninjauComponent = $this->getMockPeninjauComponent(array());
        $mockPeninjauComponent->expects($this->exactly($callCount))->method("jenisPembayaranAda");

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1, $mockAlokasiRecord2, $mockAlokasiRecord3));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @dataProvider providerTestSkipNull
     */
    public function testBayarTidakPeriksaUnitJikaNull($id1, $id2, $id3, $callCount) {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 3.00000));

        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("idUnit" => $id1, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockAlokasiRecord2 = $this->getMockAlokasiRecord(array("idUnit" => $id2, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockAlokasiRecord3 = $this->getMockAlokasiRecord(array("idUnit" => $id3, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));

        $mockPeninjauComponent = $this->getMockPeninjauComponent(array());
        $mockPeninjauComponent->expects($this->exactly($callCount))->method("unitAda");

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1, $mockAlokasiRecord2, $mockAlokasiRecord3));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaDataTransaksiTidakTersimpan() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("persist" => FALSE));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertEquals("TRANSAKSI_TIDAK_TERSIMPAN", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarSetIdTransaksiPadaAlokasi() {
        $insertIdTransaksi = 7;
        $valueTransaksi = $this->getValueTransaksi();
        $valueAlokasi = $this->getValueAlokasi();

        $valueTransaksi["nilai"] = 2.00000;
        $valueAlokasi["nilai"] = 1.00000;
        $valueAlokasi["terdistribusi"] = 0.00000;
        $valueAlokasi["sisa"] = 1.00000;

        $mockTransaksiRecord = new MockTransaksiRecord;
        $mockTransaksiRecord->setMockValues($valueTransaksi);
        $mockTransaksiRecord->setMockInsertId($insertIdTransaksi);

        $mockAlokasiRecord1 = new MockAlokasiRecord;
        $mockAlokasiRecord1->setMockValues($valueAlokasi);

        $mockAlokasiRecord2 = new MockAlokasiRecord;
        $mockAlokasiRecord2->setMockValues($valueAlokasi);

        $bayarReturnValue = $this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1, $mockAlokasiRecord2));

        $this->assertEquals($insertIdTransaksi, $mockAlokasiRecord1->getIdTransaksi());
        $this->assertEquals($insertIdTransaksi, $mockAlokasiRecord2->getIdTransaksi());

        return $bayarReturnValue;
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnFalseJikaDataAlokasiTidakTersimpan() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord(array("nilai" => 2.00000));
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord(array("persist" => TRUE, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));
        $mockAlokasiRecord2 = $this->getMockAlokasiRecord(array("persist" => FALSE, "nilai" => 1.00000, "terdistribusi" => 0.00000, "sisa" => 1.00000));

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1, $mockAlokasiRecord2)));
        $this->assertEquals("ALOKASI_TIDAK_TERSIMPAN", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @depends testBayarSetIdTransaksiPadaAlokasi
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarReturnTrueJikaDataPembayaranBerhasilDisimpan($bayarReturnValue) {
        $this->assertTrue($bayarReturnValue);
        $this->assertNull($this->object->getErrorCode());
    }

}
