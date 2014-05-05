<?php

/**
 * Unit test objek SiswaRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class SiswaRecordUnitTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new SiswaRecord;
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers SiswaRecord::setId()
     * @covers SiswaRecord::getId()
     * @covers SiswaRecord::unsetId()
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
     * @covers SiswaRecord::setNama()
     * @covers SiswaRecord::getNama()
     * @covers SiswaRecord::unsetNama()
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
     * @covers SiswaRecord::setNis()
     * @covers SiswaRecord::getNis()
     * @covers SiswaRecord::unsetNis()
     */
    public function testSetGetUnsetNis() {
        $this->assertNull($this->object->getNis());

        $this->object->setNis("A");
        $this->assertEquals("A", $this->object->getNis());

        $this->object->unsetNis();
        $this->assertNull($this->object->getNis());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers SiswaRecord::setPDO()
     * @covers SiswaRecord::getPDO()
     * @covers SiswaRecord::unsetPDO()
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
     * @covers SiswaRecord::persist()
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
     * @covers SiswaRecord::persist()
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
     * @covers SiswaRecord::persist()
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
     * @covers SiswaRecord::persist()
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
     * @covers SiswaRecord::persist()
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
     * @covers SiswaRecord::persist()
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
     * @covers SiswaRecord::persist()
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
     * @covers SiswaRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaPdoTidakTerpasang() {
        $this->object->unsetPDO();
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers SiswaRecord::retrieve()
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
     * @covers SiswaRecord::retrieve()
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
     * @covers SiswaRecord::retrieve()
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
     * @covers SiswaRecord::retrieve()
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
     * @covers SiswaRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaCloseCursorGagal() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor", "fetch"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare", "lastInsertId"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue(array("id" => 1, "nama" => "A", "nis" => "A")));

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
     * @covers SiswaRecord::retrieve()
     */
    public function testOperasiRetrieveSukses() {
        $fetchReturnValue = array("id" => 1, "nama" => "A", "nis" => "A");

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
        $this->object->setNis("A");
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetNama();
        $this->object->unsetNis();
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["nama"], $this->object->getNama());
        $this->assertEquals($expectedValues["nis"], $this->object->getNis());
    }

}
