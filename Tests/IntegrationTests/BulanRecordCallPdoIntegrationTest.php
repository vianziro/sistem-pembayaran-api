<?php

/**
 * Integration test objek BulanRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class BulanRecordCallPdoIntegrationTest extends MyApp_Database_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();

        $this->object = new BulanRecord;
        $this->object->setPDO(self::$pdo);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers BulanRecord::persist()
     * @covers BulanRecord::retrieve()
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
     * @covers BulanRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistInsertCallPrepare() {
        $actual = $this->object->getPDO()->prepare("INSERT INTO bulan (id, nama, label, angka, urutan, bagian_periode) VALUES (:id, :nama, :label, :angka, :urutan, :bagian_periode)");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testCallSetAttribute
     * @covers BulanRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistUpdateCallPrepare() {
        $actual = $this->object->getPDO()->prepare("UPDATE bulan SET nama = :nama, label = :label, angka = :angka, urutan = :urutan, bagian_periode = :bagian_periode WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallPrepare
     * @covers BulanRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistInsertCallExecute($PDOStatement) {
        $this->mySetDataSet(array("bulan" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":nama" => "A", ":label" => "A", ":angka" => "A", ":urutan" => 1, ":bagian_periode" => 1));
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
     * @covers BulanRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistUpdateCallExecute($PDOStatement) {
        $this->mySetDataSet(array("bulan" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":nama" => "A", ":label" => "A", ":angka" => "A", ":urutan" => 1, ":bagian_periode" => 1));
        $this->myEnableForeignKeyChecks();

        $this->assertTrue($actual);
        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallExecute
     * @covers BulanRecord::persist()
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
     * @covers BulanRecord::persist()
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
     * @covers BulanRecord::persist()
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
     * @covers BulanRecord::retrieve()
     * @covers PDO::prepare()
     */
    public function testRetrieveCallPrepare() {
        $actual = $this->object->getPDO()->prepare("SELECT id, nama, label, angka, urutan, bagian_periode FROM bulan WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallPrepare
     * @covers BulanRecord::retrieve()
     * @covers PDOStatement::execute()
     */
    public function testRetrieveCallExecute($PDOStatement) {
        $this->mySetDataSet(array("bulan" => array(array("id" => 1, "nama" => "A", "label" => "A", "angka" => "A", "urutan" => 1, "bagian_periode" => 1))));
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
     * @covers BulanRecord::retrieve()
     * @covers PDOStatement::fetch()
     */
    public function testRetrieveCallFetch($PDOStatement) {
        $actual = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($actual, array("id" => 1, "nama" => "A", "label" => "A", "angka" => "A", "urutan" => 1, "bagian_periode" => 1));

        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallFetch
     * @covers BulanRecord::retrieve()
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
     * @covers BulanRecord::persist()
     */
    public function testPersistInsert() {
        $this->mySetDataSet(array("bulan" => array()));
        $this->_setProperties();
        $this->object->unsetId();

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist());
        $this->myEnableForeignKeyChecks();

        $this->_assertIDValue(array("id" => 1));

        $this->mySetDataSet(array("bulan" => array(array("id" => 1, "nama" => "A", "label" => "A", "angka" => "A", "urutan" => 1, "bagian_periode" => 1))));
        $queryTable = $this->getConnection()->createQueryTable("bulan", "SELECT id, nama, label, angka, urutan, bagian_periode FROM bulan");
        $expectedTable = $this->getDataSet()->getTable("bulan");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers BulanRecord::retrieve()
     */
    public function testRetrieve() {
        $this->mySetDataSet(array("bulan" => array(array("id" => 1, "nama" => "A", "label" => "A", "angka" => "A", "urutan" => 1, "bagian_periode" => 1))));
        $this->mySetup($this->getDataSet());

        $this->object->setId(1);
        $this->assertTrue($this->object->retrieve());
        $this->_assertPropertiesValue(array("id" => 1, "nama" => "A", "label" => "A", "angka" => "A", "urutan" => 1, "bagian_periode" => 1));
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieve
     * @covers BulanRecord::persist()
     */
    public function testPersistUpdate() {
        $this->mySetDataSet(array("bulan" => array(array("id" => 1, "nama" => "A", "label" => "A", "angka" => "A", "urutan" => 1, "bagian_periode" => 1))));
        $this->mySetup($this->getDataSet());

        $this->mySetDataSet(array("bulan" => array(array("id" => 1, "nama" => "U", "label" => "U", "angka" => "U", "urutan" => 0, "bagian_periode" => 0))));

        $this->object->setId(1);
        $this->object->retrieve();
        $this->_updatePropertiesValue(array("id" => 1, "nama" => "U", "label" => "U", "angka" => "U", "urutan" => 0, "bagian_periode" => 0));

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist(), $this->object->getErrorMessage());
        $this->myEnableForeignKeyChecks();

        $queryTable = $this->getConnection()->createQueryTable("bulan", "SELECT id, nama, label, angka, urutan, bagian_periode FROM bulan");
        $expectedTable = $this->getDataSet()->getTable("bulan");

        $this->assertTablesEqual($expectedTable, $queryTable);
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

    private function _updatePropertiesValue($newValues) {
        $this->object->setId($newValues["id"]);
        $this->object->setNama($newValues["nama"]);
        $this->object->setLabel($newValues["label"]);
        $this->object->setAngka($newValues["angka"]);
        $this->object->setUrutan($newValues["urutan"]);
        $this->object->setBagianPeriode($newValues["bagian_periode"]);
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["nama"], $this->object->getNama());
        $this->assertEquals($expectedValues["label"], $this->object->getLabel());
        $this->assertEquals($expectedValues["angka"], $this->object->getAngka());
        $this->assertEquals($expectedValues["urutan"], $this->object->getUrutan());
        $this->assertEquals($expectedValues["bagian_periode"], $this->object->getBagianPeriode());
    }

    private function _assertIDValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
    }

}
