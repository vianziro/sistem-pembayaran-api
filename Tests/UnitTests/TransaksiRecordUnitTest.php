<?php

/**
 * Unit test objek TransaksiRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TransaksiRecordUnitTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new TransaksiRecord;
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setId()
     * @covers TransaksiRecord::getId()
     * @covers TransaksiRecord::unsetId()
     */
    public function testSetGetUnsetId() {
        $this->assertNull($this->object->getId());

        $this->object->setId(1);
        $this->assertEquals(1, $this->object->getId());

        $this->object->unsetId();
        $this->assertNull($this->object->getId());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setJenis()
     * @covers TransaksiRecord::getJenis()
     * @covers TransaksiRecord::unsetJenis()
     */
    public function testSetGetUnsetJenis() {
        $this->assertNull($this->object->getJenis());

        $this->object->setJenis("TRANSAKSI");
        $this->assertEquals("TRANSAKSI", $this->object->getJenis());

        $this->object->unsetJenis();
        $this->assertNull($this->object->getJenis());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setKategori()
     * @covers TransaksiRecord::getKategori()
     * @covers TransaksiRecord::unsetKategori()
     */
    public function testSetGetUnsetKategori() {
        $this->assertNull($this->object->getKategori());

        $this->object->setKategori("PEMBAYARAN");
        $this->assertEquals("PEMBAYARAN", $this->object->getKategori());

        $this->object->unsetKategori();
        $this->assertNull($this->object->getKategori());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setMetode()
     * @covers TransaksiRecord::getMetode()
     * @covers TransaksiRecord::unsetMetode()
     */
    public function testSetGetUnsetMetode() {
        $this->assertNull($this->object->getMetode());

        $this->object->setMetode("ONLINE");
        $this->assertEquals("ONLINE", $this->object->getMetode());

        $this->object->unsetMetode();
        $this->assertNull($this->object->getMetode());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setBatal()
     * @covers TransaksiRecord::getBatal()
     * @covers TransaksiRecord::unsetBatal()
     */
    public function testSetGetUnsetBatal() {
        $this->assertEquals(0, $this->object->getBatal());

        $this->object->setBatal(1);
        $this->assertEquals(1, $this->object->getBatal());

        $this->object->unsetBatal();
        $this->assertNull($this->object->getBatal());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setWaktuTransaksi()
     * @covers TransaksiRecord::getWaktuTransaksi()
     * @covers TransaksiRecord::unsetWaktuTransaksi()
     */
    public function testSetGetUnsetWaktuTransaksi() {
        $this->assertNull($this->object->getWaktuTransaksi());

        $this->object->setWaktuTransaksi("0000-00-00 00:00:00");
        $this->assertEquals("0000-00-00 00:00:00", $this->object->getWaktuTransaksi());

        $this->object->unsetWaktuTransaksi();
        $this->assertNull($this->object->getWaktuTransaksi());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setWaktuLaporan()
     * @covers TransaksiRecord::getWaktuLaporan()
     * @covers TransaksiRecord::unsetWaktuLaporan()
     */
    public function testSetGetUnsetWaktuLaporan() {
        $this->assertNull($this->object->getWaktuLaporan());

        $this->object->setWaktuLaporan("0000-00-00 00:00:00");
        $this->assertEquals("0000-00-00 00:00:00", $this->object->getWaktuLaporan());

        $this->object->unsetWaktuLaporan();
        $this->assertNull($this->object->getWaktuLaporan());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setWaktuEntri()
     * @covers TransaksiRecord::getWaktuEntri()
     * @covers TransaksiRecord::unsetWaktuEntri()
     */
    public function testSetGetUnsetWaktuEntri() {
        $this->assertNull($this->object->getWaktuEntri());

        $this->object->setWaktuEntri("0000-00-00 00:00:00");
        $this->assertEquals("0000-00-00 00:00:00", $this->object->getWaktuEntri());

        $this->object->unsetWaktuEntri();
        $this->assertNull($this->object->getWaktuEntri());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setIdRekening()
     * @covers TransaksiRecord::getIdRekening()
     * @covers TransaksiRecord::unsetIdRekening()
     */
    public function testSetGetUnsetIdRekening() {
        $this->assertNull($this->object->getIdRekening());

        $this->object->setIdRekening(1);
        $this->assertEquals(1, $this->object->getIdRekening());

        $this->object->unsetIdRekening();
        $this->assertNull($this->object->getIdRekening());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setIdKasir()
     * @covers TransaksiRecord::getIdKasir()
     * @covers TransaksiRecord::unsetIdKasir()
     */
    public function testSetGetUnsetIdKasir() {
        $this->assertNull($this->object->getIdKasir());

        $this->object->setIdKasir(1);
        $this->assertEquals(1, $this->object->getIdKasir());

        $this->object->unsetIdKasir();
        $this->assertNull($this->object->getIdKasir());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setNomorTransaksi()
     * @covers TransaksiRecord::getNomorTransaksi()
     * @covers TransaksiRecord::unsetNomorTransaksi()
     */
    public function testSetGetUnsetNomorTransaksi() {
        $this->assertNull($this->object->getNomorTransaksi());

        $this->object->setNomorTransaksi("A");
        $this->assertEquals("A", $this->object->getNomorTransaksi());

        $this->object->unsetNomorTransaksi();
        $this->assertNull($this->object->getNomorTransaksi());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setNomorReferensi()
     * @covers TransaksiRecord::getNomorReferensi()
     * @covers TransaksiRecord::unsetNomorReferensi()
     */
    public function testSetGetUnsetNomorReferensi() {
        $this->assertNull($this->object->getNomorReferensi());

        $this->object->setNomorReferensi("A");
        $this->assertEquals("A", $this->object->getNomorReferensi());

        $this->object->unsetNomorReferensi();
        $this->assertNull($this->object->getNomorReferensi());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setNilai()
     * @covers TransaksiRecord::getNilai()
     * @covers TransaksiRecord::unsetNilai()
     */
    public function testSetGetUnsetNilai() {
        $this->assertEquals(0.00000, $this->object->getNilai());

        $this->object->setNilai(1);
        $this->assertEquals(1, $this->object->getNilai());

        $this->object->unsetNilai();
        $this->assertNull($this->object->getNilai());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::setPDO()
     * @covers TransaksiRecord::getPDO()
     * @covers TransaksiRecord::unsetPDO()
     */
    public function testSetGetUnsetPdo() {
        $mockPDO = $this->getMock("MockPDO");
        $this->assertNull($this->object->getPDO());

        $this->object->setPDO($mockPDO);
        $this->assertSame($mockPDO, $this->object->getPDO());

        $this->object->unsetPDO();
        $this->assertNull($this->object->getPDO());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::persist()
     */
    public function testPersistReturnFalseJikaPdoTidakTerpasang() {
        $this->object->unsetPDO();
        $this->_setProperties();
        $this->object->unsetId();

        $this->assertFalse($this->object->persist());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::persist()
     */
    public function testPersistReturnFalseJikaSetAttributePdoGagal() {
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo"));
        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(FALSE));

        $this->object->setPDO($mockPDO);
        $this->_setProperties();
        $this->object->unsetId();

        $this->assertFalse($this->object->persist());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::persist()
     */
    public function testPersistReturnFalseJikaPrepareStatementGagal() {
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare"));
        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(TRUE));
        $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue(FALSE));

        $this->object->setPDO($mockPDO);
        $this->_setProperties();
        $this->object->unsetId();

        $this->assertFalse($this->object->persist());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::persist()
     */
    public function testPersistReturnFalseJikaEksekusiStatementGagal() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(FALSE));
        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(TRUE));
        $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue($mockPDOStatement));

        $this->object->setPDO($mockPDO);
        $this->_setProperties();
        $this->object->unsetId();

        $this->assertFalse($this->object->persist());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::persist()
     */
    public function testPersistReturnFalseJikaCloseCursorGagal() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare", "lastInsertId"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("closeCursor")->will($this->returnValue(FALSE));

        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(TRUE));
        $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue($mockPDOStatement));

        $this->object->setPDO($mockPDO);
        $this->_setProperties();
        $this->object->unsetId();

        $this->assertFalse($this->object->persist());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::persist()
     */
    public function testPersistReturnFalseJikaLastInsertIdReturn0() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare", "lastInsertId"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("closeCursor")->will($this->returnValue(TRUE));

        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(TRUE));
        $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue($mockPDOStatement));
        $mockPDO->expects($this->any())->method("lastInsertId")->will($this->returnValue("0"));

        $this->object->setPDO($mockPDO);
        $this->_setProperties();
        $this->object->unsetId();

        $this->assertFalse($this->object->persist());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::persist()
     */
    public function testOperasiPersistSukses() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare", "lastInsertId"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("closeCursor")->will($this->returnValue(TRUE));

        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(TRUE));
        $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue($mockPDOStatement));
        $mockPDO->expects($this->any())->method("lastInsertId")->will($this->returnValue("1"));

        $this->object->setPDO($mockPDO);
        $this->_setProperties();
        $this->object->unsetId();

        $this->assertTrue($this->object->persist());
        $this->assertEquals("1", $this->object->getId());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaPdoTidakTerpasang() {
        $this->object->unsetPDO();
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaSetAttributePdoGagal() {
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo"));
        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(FALSE));

        $this->object->setPDO($mockPDO);
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaPrepareStatementGagal() {
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare"));
        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(TRUE));
        $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue(FALSE));

        $this->object->setPDO($mockPDO);
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaEksekusiStatementGagal() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(FALSE));
        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(TRUE));
        $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue($mockPDOStatement));

        $this->object->setPDO($mockPDO);
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaFetchGagal() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor", "fetch"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue(FALSE));

        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(TRUE));
        $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue($mockPDOStatement));

        $this->object->setPDO($mockPDO);
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaCloseCursorGagal() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor", "fetch"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare", "lastInsertId"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue(array("id" => 1, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 1, "waktu_transaksi" => "0000-00-00 00:00:00", "waktu_laporan" => "0000-00-00 00:00:00", "waktu_entri" => "0000-00-00 00:00:00", "id_rekening" => 1, "id_kasir" => 1, "nomor_transaksi" => "A", "nomor_referensi" => "A", "nilai" => 1)));

        $mockPDOStatement->expects($this->any())->method("closeCursor")->will($this->returnValue(FALSE));

        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(TRUE));
        $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue($mockPDOStatement));

        $this->object->setPDO($mockPDO);
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TransaksiRecord::retrieve()
     */
    public function testOperasiRetrieveSukses() {
        $fetchReturnValue = array("id" => 1, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 1, "waktu_transaksi" => "0000-00-00 00:00:00", "waktu_laporan" => "0000-00-00 00:00:00", "waktu_entri" => "0000-00-00 00:00:00", "id_rekening" => 1, "id_kasir" => 1, "nomor_transaksi" => "A", "nomor_referensi" => "A", "nilai" => 1);

        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor", "fetch"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare", "lastInsertId"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue($fetchReturnValue));

        $mockPDOStatement->expects($this->any())->method("closeCursor")->will($this->returnValue(TRUE));

        $mockPDO->expects($this->any())->method("setAttribute")->with($this->equalTo(PDO::ATTR_ERRMODE), $this->equalTo(PDO::ERRMODE_EXCEPTION))->will($this->returnValue(TRUE));
        $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue($mockPDOStatement));

        $this->object->setPDO($mockPDO);
        $this->object->setId(1);

        $this->assertTrue($this->object->retrieve());
        $this->_assertPropertiesValue($fetchReturnValue);
    }

    private function _setProperties() {
        $this->object->setId(1);
        $this->object->setJenis("TRANSAKSI");
        $this->object->setKategori("PEMBAYARAN");
        $this->object->setMetode("ONLINE");
        $this->object->setBatal(1);
        $this->object->setWaktuTransaksi("0000-00-00 00:00:00");
        $this->object->setWaktuLaporan("0000-00-00 00:00:00");
        $this->object->setWaktuEntri("0000-00-00 00:00:00");
        $this->object->setIdRekening(1);
        $this->object->setIdKasir(1);
        $this->object->setNomorTransaksi("A");
        $this->object->setNomorReferensi("A");
        $this->object->setNilai(1);
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetJenis();
        $this->object->unsetKategori();
        $this->object->unsetMetode();
        $this->object->unsetBatal();
        $this->object->unsetWaktuTransaksi();
        $this->object->unsetWaktuLaporan();
        $this->object->unsetWaktuEntri();
        $this->object->unsetIdRekening();
        $this->object->unsetIdKasir();
        $this->object->unsetNomorTransaksi();
        $this->object->unsetNomorReferensi();
        $this->object->unsetNilai();
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["jenis"], $this->object->getJenis());
        $this->assertEquals($expectedValues["kategori"], $this->object->getKategori());
        $this->assertEquals($expectedValues["metode"], $this->object->getMetode());
        $this->assertEquals($expectedValues["batal"], $this->object->getBatal());
        $this->assertEquals($expectedValues["waktu_transaksi"], $this->object->getWaktuTransaksi());
        $this->assertEquals($expectedValues["waktu_laporan"], $this->object->getWaktuLaporan());
        $this->assertEquals($expectedValues["waktu_entri"], $this->object->getWaktuEntri());
        $this->assertEquals($expectedValues["id_rekening"], $this->object->getIdRekening());
        $this->assertEquals($expectedValues["id_kasir"], $this->object->getIdKasir());
        $this->assertEquals($expectedValues["nomor_transaksi"], $this->object->getNomorTransaksi());
        $this->assertEquals($expectedValues["nomor_referensi"], $this->object->getNomorReferensi());
        $this->assertEquals($expectedValues["nilai"], $this->object->getNilai());
    }

}
