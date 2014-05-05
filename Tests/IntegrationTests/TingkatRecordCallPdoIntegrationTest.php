<?php

/**
 * Integration test objek TingkatRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TingkatRecordCallPdoIntegrationTest extends MyApp_Database_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();

        $this->object = new TingkatRecord;
        $this->object->setPDO(self::$pdo);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers TingkatRecord::persist()
     * @covers TingkatRecord::retrieve()
     * @covers PDO::setAttribute()
     */
    public function testCallSetAttribute() {
        $this->assertTrue($this->object->getPDO()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testCallSetAttribute
     * @covers TingkatRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistInsertCallPrepare() {
        $actual = $this->object->getPDO()->prepare("INSERT INTO tingkat (id, id_unit, nama, label, tingkatan) VALUES (:id, :id_unit, :nama, :label, :tingkatan)");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testCallSetAttribute
     * @covers TingkatRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistUpdateCallPrepare() {
        $actual = $this->object->getPDO()->prepare("UPDATE tingkat SET id_unit = :id_unit, nama = :nama, label = :label, tingkatan = :tingkatan WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallPrepare
     * @covers TingkatRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistInsertCallExecute($PDOStatement) {
        $this->mySetDataSet(array("tingkat" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":id_unit" => 1, ":nama" => "A", ":label" => "A", ":tingkatan" => 1));
        $pdoLastInsertId = $this->object->getPDO()->lastInsertId();
        $this->myEnableForeignKeyChecks();

        $this->assertTrue($actual);
        return array($PDOStatement, $pdoLastInsertId);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistUpdateCallPrepare
     * @covers TingkatRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistUpdateCallExecute($PDOStatement) {
        $this->mySetDataSet(array("tingkat" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":id_unit" => 1, ":nama" => "A", ":label" => "A", ":tingkatan" => 1));
        $this->myEnableForeignKeyChecks();

        $this->assertTrue($actual);
        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallExecute
     * @covers TingkatRecord::persist()
     * @covers PDOStatement::closeCursor()
     */
    public function testPersistInsertCallCloseCursor($PDOStatementAndLastInsertId) {
        $actual = $PDOStatementAndLastInsertId[0]->closeCursor();
        $this->assertTrue($actual);

        return $PDOStatementAndLastInsertId[1];
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistUpdateCallExecute
     * @covers TingkatRecord::persist()
     * @covers PDOStatement::closeCursor()
     */
    public function testPersistUpdateCallCloseCursor($PDOStatement) {
        $actual = $PDOStatement->closeCursor();
        $this->assertTrue($actual);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallCloseCursor
     * @covers TingkatRecord::persist()
     * @covers PDO::lastInsertId()
     */
    public function testPersistInsertCallLastInsertId($lastInsertId) {
        $this->assertNotEquals("0", $lastInsertId);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testCallSetAttribute
     * @covers TingkatRecord::retrieve()
     * @covers PDO::prepare()
     */
    public function testRetrieveCallPrepare() {
        $actual = $this->object->getPDO()->prepare("SELECT id, id_unit, nama, label, tingkatan FROM tingkat WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallPrepare
     * @covers TingkatRecord::retrieve()
     * @covers PDOStatement::execute()
     */
    public function testRetrieveCallExecute($PDOStatement) {
        $this->mySetDataSet(array("tingkat" => array(array("id" => 1, "id_unit" => 1, "nama" => "A", "label" => "A", "tingkatan" => 1))));
        $this->mySetup($this->getDataSet());

        $actual = $PDOStatement->execute(array(":id" => 1));
        $this->assertTrue($actual);

        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallExecute
     * @covers TingkatRecord::retrieve()
     * @covers PDOStatement::fetch()
     */
    public function testRetrieveCallFetch($PDOStatement) {
        $actual = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($actual, array("id" => 1, "id_unit" => 1, "nama" => "A", "label" => "A", "tingkatan" => 1));

        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallFetch
     * @covers TingkatRecord::retrieve()
     * @covers PDOStatement::closeCursor()
     */
    public function testRetrieveCallCloseCursor($PDOStatement) {
        $this->assertTrue($PDOStatement->closeCursor());
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallLastInsertId
     * @covers TingkatRecord::persist()
     */
    public function testPersistInsert() {
        $this->mySetDataSet(array("tingkat" => array()));
        $this->_setProperties();
        $this->object->unsetId();

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist());
        $this->myEnableForeignKeyChecks();

        $this->_assertIDValue(array("id" => 1));

        $this->mySetDataSet(array("tingkat" => array(array("id" => 1, "id_unit" => 1, "nama" => "A", "label" => "A", "tingkatan" => 1))));
        $queryTable = $this->getConnection()->createQueryTable("tingkat", "SELECT id, id_unit, nama, label, tingkatan FROM tingkat");
        $expectedTable = $this->getDataSet()->getTable("tingkat");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers TingkatRecord::retrieve()
     */
    public function testRetrieve() {
        $this->mySetDataSet(array("tingkat" => array(array("id" => 1, "id_unit" => 1, "nama" => "A", "label" => "A", "tingkatan" => 1))));
        $this->mySetup($this->getDataSet());

        $this->object->setId(1);
        $this->assertTrue($this->object->retrieve());
        $this->_assertPropertiesValue(array("id" => 1, "id_unit" => 1, "nama" => "A", "label" => "A", "tingkatan" => 1));
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieve
     * @covers TingkatRecord::persist()
     */
    public function testPersistUpdate() {
        $this->mySetDataSet(array("tingkat" => array(array("id" => 1, "id_unit" => 1, "nama" => "A", "label" => "A", "tingkatan" => 1))));
        $this->mySetup($this->getDataSet());

        $this->mySetDataSet(array("tingkat" => array(array("id" => 1, "id_unit" => 0, "nama" => "U", "label" => "U", "tingkatan" => 0))));

        $this->object->setId(1);
        $this->object->retrieve();
        $this->_updatePropertiesValue(array("id" => 1, "id_unit" => 0, "nama" => "U", "label" => "U", "tingkatan" => 0));

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist(), $this->object->getErrorMessage());
        $this->myEnableForeignKeyChecks();

        $queryTable = $this->getConnection()->createQueryTable("tingkat", "SELECT id, id_unit, nama, label, tingkatan FROM tingkat");
        $expectedTable = $this->getDataSet()->getTable("tingkat");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    private function _setProperties() {
        $this->object->setId(1);
        $this->object->setIdUnit(1);
        $this->object->setNama("A");
        $this->object->setLabel("A");
        $this->object->setTingkatan(1);
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetIdUnit();
        $this->object->unsetNama();
        $this->object->unsetLabel();
        $this->object->unsetTingkatan();
    }

    private function _updatePropertiesValue($newValues) {
        $this->object->setId($newValues["id"]);
        $this->object->setIdUnit($newValues["id_unit"]);
        $this->object->setNama($newValues["nama"]);
        $this->object->setLabel($newValues["label"]);
        $this->object->setTingkatan($newValues["tingkatan"]);
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["id_unit"], $this->object->getIdUnit());
        $this->assertEquals($expectedValues["nama"], $this->object->getNama());
        $this->assertEquals($expectedValues["label"], $this->object->getLabel());
        $this->assertEquals($expectedValues["tingkatan"], $this->object->getTingkatan());
    }

    private function _assertIDValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
    }

}
