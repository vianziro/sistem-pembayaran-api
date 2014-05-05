<?php

/**
 * Integration test objek KasirRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class KasirRecordCallPdoIntegrationTest extends MyApp_Database_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();

        $this->object = new KasirRecord;
        $this->object->setPDO(self::$pdo);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers KasirRecord::persist()
     * @covers KasirRecord::retrieve()
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
     * @covers KasirRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistInsertCallPrepare() {
        $actual = $this->object->getPDO()->prepare("INSERT INTO kasir (id, nama) VALUES (:id, :nama)");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testCallSetAttribute
     * @covers KasirRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistUpdateCallPrepare() {
        $actual = $this->object->getPDO()->prepare("UPDATE kasir SET nama = :nama WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallPrepare
     * @covers KasirRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistInsertCallExecute($PDOStatement) {
        $this->mySetDataSet(array("kasir" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":nama" => "A"));
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
     * @covers KasirRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistUpdateCallExecute($PDOStatement) {
        $this->mySetDataSet(array("kasir" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":nama" => "A"));
        $this->myEnableForeignKeyChecks();

        $this->assertTrue($actual);
        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallExecute
     * @covers KasirRecord::persist()
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
     * @covers KasirRecord::persist()
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
     * @covers KasirRecord::persist()
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
     * @covers KasirRecord::retrieve()
     * @covers PDO::prepare()
     */
    public function testRetrieveCallPrepare() {
        $actual = $this->object->getPDO()->prepare("SELECT id, nama FROM kasir WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallPrepare
     * @covers KasirRecord::retrieve()
     * @covers PDOStatement::execute()
     */
    public function testRetrieveCallExecute($PDOStatement) {
        $this->mySetDataSet(array("kasir" => array(array("id" => 1, "nama" => "A"))));
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
     * @covers KasirRecord::retrieve()
     * @covers PDOStatement::fetch()
     */
    public function testRetrieveCallFetch($PDOStatement) {
        $actual = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($actual, array("id" => 1, "nama" => "A"));

        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallFetch
     * @covers KasirRecord::retrieve()
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
     * @covers KasirRecord::persist()
     */
    public function testPersistInsert() {
        $this->mySetDataSet(array("kasir" => array()));
        $this->_setProperties();
        $this->object->unsetId();

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist());
        $this->myEnableForeignKeyChecks();

        $this->_assertIDValue(array("id" => 1));

        $this->mySetDataSet(array("kasir" => array(array("id" => 1, "nama" => "A"))));
        $queryTable = $this->getConnection()->createQueryTable("kasir", "SELECT id, nama FROM kasir");
        $expectedTable = $this->getDataSet()->getTable("kasir");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers KasirRecord::retrieve()
     */
    public function testRetrieve() {
        $this->mySetDataSet(array("kasir" => array(array("id" => 1, "nama" => "A"))));
        $this->mySetup($this->getDataSet());

        $this->object->setId(1);
        $this->assertTrue($this->object->retrieve());
        $this->_assertPropertiesValue(array("id" => 1, "nama" => "A"));
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieve
     * @covers KasirRecord::persist()
     */
    public function testPersistUpdate() {
        $this->mySetDataSet(array("kasir" => array(array("id" => 1, "nama" => "A"))));
        $this->mySetup($this->getDataSet());

        $this->mySetDataSet(array("kasir" => array(array("id" => 1, "nama" => "U"))));

        $this->object->setId(1);
        $this->object->retrieve();
        $this->_updatePropertiesValue(array("id" => 1, "nama" => "U"));

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist(), $this->object->getErrorMessage());
        $this->myEnableForeignKeyChecks();

        $queryTable = $this->getConnection()->createQueryTable("kasir", "SELECT id, nama FROM kasir");
        $expectedTable = $this->getDataSet()->getTable("kasir");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    private function _setProperties() {
        $this->object->setId(1);
        $this->object->setNama("A");
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetNama();
    }

    private function _updatePropertiesValue($newValues) {
        $this->object->setId($newValues["id"]);
        $this->object->setNama($newValues["nama"]);
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["nama"], $this->object->getNama());
    }

    private function _assertIDValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
    }

}
