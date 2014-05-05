<?php

/**
 * Unit test objek BulanRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class BulanRecordUnitTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new BulanRecord;
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers BulanRecord::setId()
     * @covers BulanRecord::getId()
     * @covers BulanRecord::unsetId()
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
     * @covers BulanRecord::setNama()
     * @covers BulanRecord::getNama()
     * @covers BulanRecord::unsetNama()
     */
    public function testSetGetUnsetNama() {
        $this->assertNull($this->object->getNama());

        $this->object->setNama("A");
        $this->assertEquals("A", $this->object->getNama());

        $this->object->unsetNama();
        $this->assertNull($this->object->getNama());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers BulanRecord::setLabel()
     * @covers BulanRecord::getLabel()
     * @covers BulanRecord::unsetLabel()
     */
    public function testSetGetUnsetLabel() {
        $this->assertNull($this->object->getLabel());

        $this->object->setLabel("A");
        $this->assertEquals("A", $this->object->getLabel());

        $this->object->unsetLabel();
        $this->assertNull($this->object->getLabel());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers BulanRecord::setAngka()
     * @covers BulanRecord::getAngka()
     * @covers BulanRecord::unsetAngka()
     */
    public function testSetGetUnsetAngka() {
        $this->assertNull($this->object->getAngka());

        $this->object->setAngka("A");
        $this->assertEquals("A", $this->object->getAngka());

        $this->object->unsetAngka();
        $this->assertNull($this->object->getAngka());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers BulanRecord::setUrutan()
     * @covers BulanRecord::getUrutan()
     * @covers BulanRecord::unsetUrutan()
     */
    public function testSetGetUnsetUrutan() {
        $this->assertNull($this->object->getUrutan());

        $this->object->setUrutan(1);
        $this->assertEquals(1, $this->object->getUrutan());

        $this->object->unsetUrutan();
        $this->assertNull($this->object->getUrutan());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers BulanRecord::setBagianPeriode()
     * @covers BulanRecord::getBagianPeriode()
     * @covers BulanRecord::unsetBagianPeriode()
     */
    public function testSetGetUnsetBagianPeriode() {
        $this->assertNull($this->object->getBagianPeriode());

        $this->object->setBagianPeriode(1);
        $this->assertEquals(1, $this->object->getBagianPeriode());

        $this->object->unsetBagianPeriode();
        $this->assertNull($this->object->getBagianPeriode());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers BulanRecord::setPDO()
     * @covers BulanRecord::getPDO()
     * @covers BulanRecord::unsetPDO()
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
     * @covers BulanRecord::persist()
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
     * @covers BulanRecord::persist()
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
     * @covers BulanRecord::persist()
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
     * @covers BulanRecord::persist()
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
     * @covers BulanRecord::persist()
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
     * @covers BulanRecord::persist()
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
     * @covers BulanRecord::persist()
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
     * @covers BulanRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaPdoTidakTerpasang() {
        $this->object->unsetPDO();
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers BulanRecord::retrieve()
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
     * @covers BulanRecord::retrieve()
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
     * @covers BulanRecord::retrieve()
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
     * @covers BulanRecord::retrieve()
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
     * @covers BulanRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaCloseCursorGagal() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor", "fetch"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare", "lastInsertId"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue(array("id" => 1, "nama" => "A", "label" => "A", "angka" => "A", "urutan" => 1, "bagian_periode" => 1)));

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
     * @covers BulanRecord::retrieve()
     */
    public function testOperasiRetrieveSukses() {
        $fetchReturnValue = array("id" => 1, "nama" => "A", "label" => "A", "angka" => "A", "urutan" => 1, "bagian_periode" => 1);

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
        $this->object->setNama("A");
        $this->object->setLabel("A");
        $this->object->setAngka("A");
        $this->object->setUrutan(1);
        $this->object->setBagianPeriode(1);
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetNama();
        $this->object->unsetLabel();
        $this->object->unsetAngka();
        $this->object->unsetUrutan();
        $this->object->unsetBagianPeriode();
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["nama"], $this->object->getNama());
        $this->assertEquals($expectedValues["label"], $this->object->getLabel());
        $this->assertEquals($expectedValues["angka"], $this->object->getAngka());
        $this->assertEquals($expectedValues["urutan"], $this->object->getUrutan());
        $this->assertEquals($expectedValues["bagian_periode"], $this->object->getBagianPeriode());
    }

}
