<?php

/**
 * Unit test objek AlokasiRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class AlokasiRecordUnitTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new AlokasiRecord;
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers AlokasiRecord::setId()
     * @covers AlokasiRecord::getId()
     * @covers AlokasiRecord::unsetId()
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
     * @covers AlokasiRecord::setIdTransaksi()
     * @covers AlokasiRecord::getIdTransaksi()
     * @covers AlokasiRecord::unsetIdTransaksi()
     */
    public function testSetGetUnsetIdTransaksi() {
        $this->assertNull($this->object->getIdTransaksi());

        $this->object->setIdTransaksi(1);
        $this->assertEquals(1, $this->object->getIdTransaksi());

        $this->object->unsetIdTransaksi();
        $this->assertNull($this->object->getIdTransaksi());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers AlokasiRecord::setIdSiswa()
     * @covers AlokasiRecord::getIdSiswa()
     * @covers AlokasiRecord::unsetIdSiswa()
     */
    public function testSetGetUnsetIdSiswa() {
        $this->assertNull($this->object->getIdSiswa());

        $this->object->setIdSiswa(1);
        $this->assertEquals(1, $this->object->getIdSiswa());

        $this->object->unsetIdSiswa();
        $this->assertNull($this->object->getIdSiswa());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers AlokasiRecord::setIdUnit()
     * @covers AlokasiRecord::getIdUnit()
     * @covers AlokasiRecord::unsetIdUnit()
     */
    public function testSetGetUnsetIdUnit() {
        $this->assertNull($this->object->getIdUnit());

        $this->object->setIdUnit(1);
        $this->assertEquals(1, $this->object->getIdUnit());

        $this->object->unsetIdUnit();
        $this->assertNull($this->object->getIdUnit());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers AlokasiRecord::setIdJenisPembayaran()
     * @covers AlokasiRecord::getIdJenisPembayaran()
     * @covers AlokasiRecord::unsetIdJenisPembayaran()
     */
    public function testSetGetUnsetIdJenisPembayaran() {
        $this->assertNull($this->object->getIdJenisPembayaran());

        $this->object->setIdJenisPembayaran(1);
        $this->assertEquals(1, $this->object->getIdJenisPembayaran());

        $this->object->unsetIdJenisPembayaran();
        $this->assertNull($this->object->getIdJenisPembayaran());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers AlokasiRecord::setNilai()
     * @covers AlokasiRecord::getNilai()
     * @covers AlokasiRecord::unsetNilai()
     */
    public function testSetGetUnsetNilai() {
        $this->assertNull($this->object->getNilai());

        $this->object->setNilai(1);
        $this->assertEquals(1, $this->object->getNilai());

        $this->object->unsetNilai();
        $this->assertNull($this->object->getNilai());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers AlokasiRecord::setSisa()
     * @covers AlokasiRecord::getSisa()
     * @covers AlokasiRecord::unsetSisa()
     */
    public function testSetGetUnsetSisa() {
        $this->assertNull($this->object->getSisa());

        $this->object->setSisa(1);
        $this->assertEquals(1, $this->object->getSisa());

        $this->object->unsetSisa();
        $this->assertNull($this->object->getSisa());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers AlokasiRecord::setTerdistribusi()
     * @covers AlokasiRecord::getTerdistribusi()
     * @covers AlokasiRecord::unsetTerdistribusi()
     */
    public function testSetGetUnsetTerdistribusi() {
        $this->assertNull($this->object->getTerdistribusi());

        $this->object->setTerdistribusi(1);
        $this->assertEquals(1, $this->object->getTerdistribusi());

        $this->object->unsetTerdistribusi();
        $this->assertNull($this->object->getTerdistribusi());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers AlokasiRecord::setPDO()
     * @covers AlokasiRecord::getPDO()
     * @covers AlokasiRecord::unsetPDO()
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
     * @covers AlokasiRecord::persist()
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
     * @covers AlokasiRecord::persist()
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
     * @covers AlokasiRecord::persist()
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
     * @covers AlokasiRecord::persist()
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
     * @covers AlokasiRecord::persist()
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
     * @covers AlokasiRecord::persist()
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
     * @covers AlokasiRecord::persist()
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
     * @covers AlokasiRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaPdoTidakTerpasang() {
        $this->object->unsetPDO();
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers AlokasiRecord::retrieve()
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
     * @covers AlokasiRecord::retrieve()
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
     * @covers AlokasiRecord::retrieve()
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
     * @covers AlokasiRecord::retrieve()
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
     * @covers AlokasiRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaCloseCursorGagal() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor", "fetch"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare", "lastInsertId"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue(array("id" => 1, "id_transaksi" => 1, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "sisa" => 1, "terdistribusi" => 1)));

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
     * @covers AlokasiRecord::retrieve()
     */
    public function testOperasiRetrieveSukses() {
        $fetchReturnValue = array("id" => 1, "id_transaksi" => 1, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "sisa" => 1, "terdistribusi" => 1);

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
        $this->object->setIdTransaksi(1);
        $this->object->setIdSiswa(1);
        $this->object->setIdUnit(1);
        $this->object->setIdJenisPembayaran(1);
        $this->object->setNilai(1);
        $this->object->setSisa(1);
        $this->object->setTerdistribusi(1);
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetIdTransaksi();
        $this->object->unsetIdSiswa();
        $this->object->unsetIdUnit();
        $this->object->unsetIdJenisPembayaran();
        $this->object->unsetNilai();
        $this->object->unsetSisa();
        $this->object->unsetTerdistribusi();
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["id_transaksi"], $this->object->getIdTransaksi());
        $this->assertEquals($expectedValues["id_siswa"], $this->object->getIdSiswa());
        $this->assertEquals($expectedValues["id_unit"], $this->object->getIdUnit());
        $this->assertEquals($expectedValues["id_jenis_pembayaran"], $this->object->getIdJenisPembayaran());
        $this->assertEquals($expectedValues["nilai"], $this->object->getNilai());
        $this->assertEquals($expectedValues["sisa"], $this->object->getSisa());
        $this->assertEquals($expectedValues["terdistribusi"], $this->object->getTerdistribusi());
    }

}
