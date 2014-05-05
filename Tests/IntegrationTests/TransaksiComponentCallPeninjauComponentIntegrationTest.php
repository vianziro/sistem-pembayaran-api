<?php

/**
 * Integration test TransaksiComponent dengan PeninjauComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TransaksiComponentCallPeninjauComponentIntegrationTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;
    private $calledObject = NULL;
    private $seq = 1;

    public function setUp() {
        parent::setUp();
        $this->object = new TransaksiComponent;
        $this->calledObject = new PeninjauComponent;

        $this->object->setPeninjauComponent($this->calledObject);
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     */
    public function testBayarDefaultReturnTrue() {
        $mockTransaksiRecord = $this->getMockTransaksiRecord();
        $mockAlokasiRecord = $this->getMockAlokasiRecord();
        $mockPDO = $this->getMockPDO();

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $this->assertTrue($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord)));
        $this->assertNull($this->object->getErrorCode());
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @covers PeninjauComponent::nomorTransaksiAda()
     */
    public function testBayarReturnFalseJikaNomorTransaksiSudahAda() {
        $failPoint = "nomorTransaksiAda";

        $mockTransaksiRecord = $this->getMockTransaksiRecord();
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord();
        $mockPDO = $this->getMockPDO($failPoint);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1)));
        $this->assertEquals("NOMOR_TRANSAKSI_SUDAH_ADA", $this->object->getErrorCode());
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @covers PeninjauComponent::nomorReferensiAda()
     */
    public function testBayarReturnFalseJikaNomorReferensiSudahAda() {
        $failPoint = "nomorReferensiAda";

        $mockTransaksiRecord = $this->getMockTransaksiRecord();
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord();
        $mockPDO = $this->getMockPDO($failPoint);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1)));
        $this->assertEquals("NOMOR_REFERENSI_SUDAH_ADA", $this->object->getErrorCode());
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @covers PeninjauComponent::rekeningAda()
     */
    public function testBayarReturnFalseJikaRekeningTidakAda() {
        $failPoint = "rekeningAda";

        $mockTransaksiRecord = $this->getMockTransaksiRecord();
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord();
        $mockPDO = $this->getMockPDO($failPoint);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1)));
        $this->assertEquals("REKENING_TIDAK_DIKETAHUI", $this->object->getErrorCode());
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @covers PeninjauComponent::kasirAda()
     */
    public function testBayarReturnFalseJikaKasirTidakAda() {
        $failPoint = "kasirAda";

        $mockTransaksiRecord = $this->getMockTransaksiRecord();
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord();
        $mockPDO = $this->getMockPDO($failPoint);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1)));
        $this->assertEquals("KASIR_TIDAK_DIKETAHUI", $this->object->getErrorCode());
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @covers PeninjauComponent::siswaAda()
     */
    public function testBayarReturnFalseJikaSiswaTidakAda() {
        $failPoint = "siswaAda";

        $mockTransaksiRecord = $this->getMockTransaksiRecord();
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord();
        $mockPDO = $this->getMockPDO($failPoint);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1)));
        $this->assertEquals("SISWA_TIDAK_DIKETAHUI", $this->object->getErrorCode());
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @covers PeninjauComponent::jenisPembayaranAda()
     */
    public function testBayarReturnFalseJikaJenisPembayaranTidakAda() {
        $failPoint = "jenisPembayaranAda";

        $mockTransaksiRecord = $this->getMockTransaksiRecord();
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord();
        $mockPDO = $this->getMockPDO($failPoint);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1)));
        $this->assertEquals("JENIS_PEMBAYARAN_TIDAK_DIKETAHUI", $this->object->getErrorCode());
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers TransaksiComponent::bayar()
     * @covers PeninjauComponent::unitAda()
     */
    public function testBayarReturnFalseJikaUnitTidakAda() {
        $failPoint = "unitAda";

        $mockTransaksiRecord = $this->getMockTransaksiRecord();
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord();
        $mockPDO = $this->getMockPDO($failPoint);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $this->assertFalse($this->object->bayar($mockTransaksiRecord, array($mockAlokasiRecord1)));
        $this->assertEquals("UNIT_TIDAK_DIKETAHUI", $this->object->getErrorCode());
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     */
    public function testBatalDefaultReturnTrue() {
        $failPoint = "";

        $mockTransaksiRecord = $this->getMockTransaksiRecord();
        $mockTransaksiRecordPembatalan = $this->getMockTransaksiInputBatalEmpty();
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord();
        $arrayMockAlokasiRecordPembatalan = $this->getMockAlokasiInputBatalEmpty(1);
        $mockPDO = $this->getMockPDO($failPoint);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $this->assertTrue($this->object->batal($mockTransaksiRecord, array($mockAlokasiRecord1), $mockTransaksiRecordPembatalan, $arrayMockAlokasiRecordPembatalan), $this->object->getErrorCode());
        $this->assertNull($this->object->getErrorCode());
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers TransaksiComponent::batal()
     * @covers PeninjauComponent::hitungBanyaknyaAlokasi()
     */
    public function testBatalReturnFalseJikaBanyaknyaAlokasiSalah() {
        $failPoint = "hitungBanyaknyaAlokasi";

        $mockTransaksiRecord = $this->getMockTransaksiRecord();
        $mockTransaksiRecordPembatalan = $this->getMockTransaksiInputBatalEmpty();
        $mockAlokasiRecord1 = $this->getMockAlokasiRecord();
        $mockAlokasiRecordPembatalan1 = $this->getMockAlokasiInputBatalEmpty();
        $mockPDO = $this->getMockPDO($failPoint);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $this->assertFalse($this->object->batal($mockTransaksiRecord, array($mockAlokasiRecord1), $mockTransaksiRecordPembatalan, array($mockAlokasiRecordPembatalan1)));
        $this->assertEquals("BANYAKNYA_ALOKASI_SALAH", $this->object->getErrorCode());
    }

    private function getMockPDO($failPoint = "") {
        $mock = $this->getMock("MockPDO", array("prepare"));
        $mock->expects($this->any())->method("prepare")->will($this->returnValueMap($this->getPrepareReturnValueMap($failPoint)));

        return $mock;
    }

    private function getMockTransaksiRecord(array $setValues = array(), $insertId = 7) {
        $mock = new MockTransaksiRecord;
        $mock->setMockValues($this->getValueTransaksi($setValues));
        $mock->setMockInsertId($insertId);
        $mock->setMockPersistReturnValue(TRUE);

        return $mock;
    }

    private function getMockAlokasiRecord(array $setValues = array()) {
        $mock = new MockAlokasiRecord;
        $mock->setMockValues($this->getValueAlokasi($setValues));
        $mock->setMockInsertId($this->seq ++);
        $mock->setMockPersistReturnValue(TRUE);

        return $mock;
    }

    private function getPrepareReturnValueMap($failPoint = "") {
        $returnValueMap = array();
        $fetchReturnValues = $this->getHappySqlFetchReturnValues($failPoint);

        foreach ($this->getSqlStatement() as $methodName => $sql) {
            $returnValueMap[] = array(
                $sql, array(), $this->getMockPDOStatement($fetchReturnValues[$methodName])
            );
        }

        return $returnValueMap;
    }

    private function getMockPDOStatement($fetchReturnValue) {
        $mock = $this->getMock("PDOStatement", array("execute", "fetch", "closeCursor"));
        $mock->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mock->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue($fetchReturnValue));
        $mock->expects($this->any())->method("closeCursor")->will($this->returnValue(TRUE));

        return $mock;
    }

    private function getSqlStatement() {
        return array(
            "nomorTransaksiAda" => "SELECT COUNT(*) AS count_result FROM transaksi t INNER JOIN rekening r ON (t.id_rekening = r.id) WHERE t.nomor_transaksi LIKE :nomor_transaksi AND r.id_bank = (SELECT id_bank FROM rekening WHERE id = :id_rekening)",
            "nomorReferensiAda" => "SELECT COUNT(*) AS count_result FROM transaksi t INNER JOIN rekening r ON (t.id_rekening = r.id) WHERE t.nomor_referensi LIKE :nomor_referensi AND r.id_bank = (SELECT id_bank FROM rekening WHERE id = :id_rekening)",
            "rekeningAda" => "SELECT COUNT(*) AS count_result FROM rekening WHERE id = :id",
            "kasirAda" => "SELECT COUNT(*) AS count_result FROM kasir WHERE id = :id",
            "siswaAda" => "SELECT COUNT(*) AS count_result FROM siswa WHERE id = :id",
            "unitAda" => "SELECT COUNT(*) AS count_result FROM unit WHERE id = :id",
            "jenisPembayaranAda" => "SELECT COUNT(*) AS count_result FROM jenis_pembayaran WHERE id = :id",
            "hitungBanyaknyaAlokasi" => "SELECT COUNT(*) AS count_result FROM alokasi WHERE id_transaksi = :id_transaksi"
        );
    }

    private function getHappySqlFetchReturnValues($failPoint = "") {
        $fetchReturnValues["nomorTransaksiAda"] = array("count_result" => 0);
        $fetchReturnValues["nomorReferensiAda"] = array("count_result" => 0);
        $fetchReturnValues["rekeningAda"] = array("count_result" => 1);
        $fetchReturnValues["kasirAda"] = array("count_result" => 1);
        $fetchReturnValues["siswaAda"] = array("count_result" => 1);
        $fetchReturnValues["jenisPembayaranAda"] = array("count_result" => 1);
        $fetchReturnValues["unitAda"] = array("count_result" => 1);
        $fetchReturnValues["hitungBanyaknyaAlokasi"] = array("count_result" => 1);

        $this->setHappySqlFetchReturnValuesFailPoint($fetchReturnValues, $failPoint);

        return $fetchReturnValues;
    }

    private function setHappySqlFetchReturnValuesFailPoint(&$fetchReturnValues, $failPoint = "") {
        if ($failPoint == "nomorTransaksiAda") {
            $fetchReturnValues["nomorTransaksiAda"] = array("count_result" => 1);
        } elseif ($failPoint == "nomorReferensiAda") {
            $fetchReturnValues["nomorReferensiAda"] = array("count_result" => 1);
        } elseif ($failPoint == "rekeningAda") {
            $fetchReturnValues["rekeningAda"] = array("count_result" => 0);
        } elseif ($failPoint == "kasirAda") {
            $fetchReturnValues["kasirAda"] = array("count_result" => 0);
        } elseif ($failPoint == "siswaAda") {
            $fetchReturnValues["siswaAda"] = array("count_result" => 0);
        } elseif ($failPoint == "jenisPembayaranAda") {
            $fetchReturnValues["jenisPembayaranAda"] = array("count_result" => 0);
        } elseif ($failPoint == "unitAda") {
            $fetchReturnValues["unitAda"] = array("count_result" => 0);
        } elseif ($failPoint == "hitungBanyaknyaAlokasi") {
            $fetchReturnValues["hitungBanyaknyaAlokasi"] = array("count_result" => 2);
        }
    }

    private function getValueTransaksi(array $setValues = array()) {
        $values["id"] = NULL;
        $values["jenis"] = "TRANSAKSI";
        $values["kategori"] = "PEMBAYARAN";
        $values["metode"] = "ONLINE";
        $values["batal"] = FALSE;
        $values["waktuTransaksi"] = "2014-04-30 00:00:00";
        $values["waktuLaporan"] = "2014-04-30 00:00:00";
        $values["waktuEntri"] = "2014-04-30 00:00:00";
        $values["idRekening"] = 1;
        $values["idKasir"] = 1;
        $values["nomorTransaksi"] = "T001";
        $values["nomorReferensi"] = "R001";
        $values["nilai"] = 1.00000;

        $this->setValues($values, $setValues);

        return $values;
    }

    private function getValueAlokasi(array $setValues = array()) {
        $values["id"] = NULL;
        $values["idTransaksi"] = NULL;
        $values["idSiswa"] = 1;
        $values["idUnit"] = 1;
        $values["idJenisPembayaran"] = 1;
        $values["nilai"] = 1.00000;
        $values["sisa"] = 1.00000;
        $values["terdistribusi"] = 0.00000;

        $this->setValues($values, $setValues);

        return $values;
    }

    private function setValues(array &$values, array $setValues = array()) {
        foreach ($setValues as $propertyName => $setValue) {
            if (array_key_exists($propertyName, $values)) {
                $values[$propertyName] = $setValue;
            }
        }
    }

    protected function getMockTransaksiInputBatalEmpty(array $setValues = array()) {
        $mock = new MockTransaksiRecord;
        $values = array("waktuEntri" => "2014-05-03 00:00:00", "waktuLaporan" => "2014-05-03 00:00:00");

        foreach ($setValues as $propertyName => $setValue) {
            if (array_key_exists($propertyName, $values)) {
                $values[$propertyName] = $setValue;
            }
        }

        $mock->setMockValues($values);

        return $mock;
    }

    protected function getMockAlokasiInputBatalEmpty($count = 3) {
        $arrayMock = array();

        for ($i = 0; $i < $count; $i ++) {
            $arrayMock[] = new MockAlokasiRecord;
        }

        return $arrayMock;
    }

}
