<?php

/**
 * Integration test objek RekeningRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class RekeningRecordCallPdoIntegrationTest extends MyApp_Database_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();

        $this->object = new RekeningRecord;
        $this->object->setPDO(self::$pdo);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers RekeningRecord::persist()
     * @covers RekeningRecord::retrieve()
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
     * @covers RekeningRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistInsertCallPrepare() {
        $actual = $this->object->getPDO()->prepare("INSERT INTO rekening (id, id_bank, nomor, nama, label) VALUES (:id, :id_bank, :nomor, :nama, :label)");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testCallSetAttribute
     * @covers RekeningRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistUpdateCallPrepare() {
        $actual = $this->object->getPDO()->prepare("UPDATE rekening SET id_bank = :id_bank, nomor = :nomor, nama = :nama, label = :label WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallPrepare
     * @covers RekeningRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistInsertCallExecute($PDOStatement) {
        $this->mySetDataSet(array("rekening" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":id_bank" => 1, ":nomor" => "A", ":nama" => "A", ":label" => "A"));
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
     * @covers RekeningRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistUpdateCallExecute($PDOStatement) {
        $this->mySetDataSet(array("rekening" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":id_bank" => 1, ":nomor" => "A", ":nama" => "A", ":label" => "A"));
        $this->myEnableForeignKeyChecks();

        $this->assertTrue($actual);
        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallExecute
     * @covers RekeningRecord::persist()
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
     * @covers RekeningRecord::persist()
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
     * @covers RekeningRecord::persist()
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
     * @covers RekeningRecord::retrieve()
     * @covers PDO::prepare()
     */
    public function testRetrieveCallPrepare() {
        $actual = $this->object->getPDO()->prepare("SELECT id, id_bank, nomor, nama, label FROM rekening WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallPrepare
     * @covers RekeningRecord::retrieve()
     * @covers PDOStatement::execute()
     */
    public function testRetrieveCallExecute($PDOStatement) {
        $this->mySetDataSet(array("rekening" => array(array("id" => 1, "id_bank" => 1, "nomor" => "A", "nama" => "A", "label" => "A"))));
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
     * @covers RekeningRecord::retrieve()
     * @covers PDOStatement::fetch()
     */
    public function testRetrieveCallFetch($PDOStatement) {
        $actual = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($actual, array("id" => 1, "id_bank" => 1, "nomor" => "A", "nama" => "A", "label" => "A"));

        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallFetch
     * @covers RekeningRecord::retrieve()
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
     * @covers RekeningRecord::persist()
     */
    public function testPersistInsert() {
        $this->mySetDataSet(array("rekening" => array()));
        $this->_setProperties();
        $this->object->unsetId();

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist());
        $this->myEnableForeignKeyChecks();

        $this->_assertIDValue(array("id" => 1));

        $this->mySetDataSet(array("rekening" => array(array("id" => 1, "id_bank" => 1, "nomor" => "A", "nama" => "A", "label" => "A"))));
        $queryTable = $this->getConnection()->createQueryTable("rekening", "SELECT id, id_bank, nomor, nama, label FROM rekening");
        $expectedTable = $this->getDataSet()->getTable("rekening");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers RekeningRecord::retrieve()
     */
    public function testRetrieve() {
        $this->mySetDataSet(array("rekening" => array(array("id" => 1, "id_bank" => 1, "nomor" => "A", "nama" => "A", "label" => "A"))));
        $this->mySetup($this->getDataSet());

        $this->object->setId(1);
        $this->assertTrue($this->object->retrieve());
        $this->_assertPropertiesValue(array("id" => 1, "id_bank" => 1, "nomor" => "A", "nama" => "A", "label" => "A"));
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieve
     * @covers RekeningRecord::persist()
     */
    public function testPersistUpdate() {
        $this->mySetDataSet(array("rekening" => array(array("id" => 1, "id_bank" => 1, "nomor" => "A", "nama" => "A", "label" => "A"))));
        $this->mySetup($this->getDataSet());

        $this->mySetDataSet(array("rekening" => array(array("id" => 1, "id_bank" => 0, "nomor" => "U", "nama" => "U", "label" => "U"))));

        $this->object->setId(1);
        $this->object->retrieve();
        $this->_updatePropertiesValue(array("id" => 1, "id_bank" => 0, "nomor" => "U", "nama" => "U", "label" => "U"));

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist(), $this->object->getErrorMessage());
        $this->myEnableForeignKeyChecks();

        $queryTable = $this->getConnection()->createQueryTable("rekening", "SELECT id, id_bank, nomor, nama, label FROM rekening");
        $expectedTable = $this->getDataSet()->getTable("rekening");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    private function _setProperties() {
        $this->object->setId(1);
        $this->object->setIdBank(1);
        $this->object->setNomor("A");
        $this->object->setNama("A");
        $this->object->setLabel("A");
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetIdBank();
        $this->object->unsetNomor();
        $this->object->unsetNama();
        $this->object->unsetLabel();
    }

    private function _updatePropertiesValue($newValues) {
        $this->object->setId($newValues["id"]);
        $this->object->setIdBank($newValues["id_bank"]);
        $this->object->setNomor($newValues["nomor"]);
        $this->object->setNama($newValues["nama"]);
        $this->object->setLabel($newValues["label"]);
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["id_bank"], $this->object->getIdBank());
        $this->assertEquals($expectedValues["nomor"], $this->object->getNomor());
        $this->assertEquals($expectedValues["nama"], $this->object->getNama());
        $this->assertEquals($expectedValues["label"], $this->object->getLabel());
    }

    private function _assertIDValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
    }

}
