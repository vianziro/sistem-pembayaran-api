<?php

/**
 * Unit test objek KelasRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class KelasRecordUnitTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new KelasRecord;
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers KelasRecord::setId()
     * @covers KelasRecord::getId()
     * @covers KelasRecord::unsetId()
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
     * @covers KelasRecord::setIdTingkat()
     * @covers KelasRecord::getIdTingkat()
     * @covers KelasRecord::unsetIdTingkat()
     */
    public function testSetGetUnsetIdTingkat() {
        $this->assertNull($this->object->getIdTingkat());

        $this->object->setIdTingkat(1);
        $this->assertEquals(1, $this->object->getIdTingkat());

        $this->object->unsetIdTingkat();
        $this->assertNull($this->object->getIdTingkat());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers KelasRecord::setNama()
     * @covers KelasRecord::getNama()
     * @covers KelasRecord::unsetNama()
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
     * @covers KelasRecord::setLabel()
     * @covers KelasRecord::getLabel()
     * @covers KelasRecord::unsetLabel()
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
     * @covers KelasRecord::setPDO()
     * @covers KelasRecord::getPDO()
     * @covers KelasRecord::unsetPDO()
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
     * @covers KelasRecord::persist()
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
     * @covers KelasRecord::persist()
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
     * @covers KelasRecord::persist()
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
     * @covers KelasRecord::persist()
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
     * @covers KelasRecord::persist()
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
     * @covers KelasRecord::persist()
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
     * @covers KelasRecord::persist()
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
     * @covers KelasRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaPdoTidakTerpasang() {
        $this->object->unsetPDO();
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers KelasRecord::retrieve()
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
     * @covers KelasRecord::retrieve()
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
     * @covers KelasRecord::retrieve()
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
     * @covers KelasRecord::retrieve()
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
     * @covers KelasRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaCloseCursorGagal() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor", "fetch"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare", "lastInsertId"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue(array("id" => 1, "id_tingkat" => 1, "nama" => "A", "label" => "A")));

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
     * @covers KelasRecord::retrieve()
     */
    public function testOperasiRetrieveSukses() {
        $fetchReturnValue = array("id" => 1, "id_tingkat" => 1, "nama" => "A", "label" => "A");

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
        $this->object->setIdTingkat(1);
        $this->object->setNama("A");
        $this->object->setLabel("A");
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetIdTingkat();
        $this->object->unsetNama();
        $this->object->unsetLabel();
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["id_tingkat"], $this->object->getIdTingkat());
        $this->assertEquals($expectedValues["nama"], $this->object->getNama());
        $this->assertEquals($expectedValues["label"], $this->object->getLabel());
    }

}
