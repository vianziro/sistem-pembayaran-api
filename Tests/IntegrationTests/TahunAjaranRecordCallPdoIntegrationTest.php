<?php

/**
 * Integration test objek TahunAjaranRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TahunAjaranRecordCallPdoIntegrationTest extends MyApp_Database_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();

        $this->object = new TahunAjaranRecord;
        $this->object->setPDO(self::$pdo);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers TahunAjaranRecord::persist()
     * @covers TahunAjaranRecord::retrieve()
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
     * @covers TahunAjaranRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistInsertCallPrepare() {
        $actual = $this->object->getPDO()->prepare("INSERT INTO tahun_ajaran (id, nama, label, waktu_mulai, waktu_selesai) VALUES (:id, :nama, :label, :waktu_mulai, :waktu_selesai)");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testCallSetAttribute
     * @covers TahunAjaranRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistUpdateCallPrepare() {
        $actual = $this->object->getPDO()->prepare("UPDATE tahun_ajaran SET nama = :nama, label = :label, waktu_mulai = :waktu_mulai, waktu_selesai = :waktu_selesai WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallPrepare
     * @covers TahunAjaranRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistInsertCallExecute($PDOStatement) {
        $this->mySetDataSet(array("tahun_ajaran" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":nama" => "A", ":label" => "A", ":waktu_mulai" => "0000-00-00 00:00:00", ":waktu_selesai" => "0000-00-00 00:00:00"));
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
     * @covers TahunAjaranRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistUpdateCallExecute($PDOStatement) {
        $this->mySetDataSet(array("tahun_ajaran" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":nama" => "A", ":label" => "A", ":waktu_mulai" => "0000-00-00 00:00:00", ":waktu_selesai" => "0000-00-00 00:00:00"));
        $this->myEnableForeignKeyChecks();

        $this->assertTrue($actual);
        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallExecute
     * @covers TahunAjaranRecord::persist()
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
     * @covers TahunAjaranRecord::persist()
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
     * @covers TahunAjaranRecord::persist()
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
     * @covers TahunAjaranRecord::retrieve()
     * @covers PDO::prepare()
     */
    public function testRetrieveCallPrepare() {
        $actual = $this->object->getPDO()->prepare("SELECT id, nama, label, waktu_mulai, waktu_selesai FROM tahun_ajaran WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallPrepare
     * @covers TahunAjaranRecord::retrieve()
     * @covers PDOStatement::execute()
     */
    public function testRetrieveCallExecute($PDOStatement) {
        $this->mySetDataSet(array("tahun_ajaran" => array(array("id" => 1, "nama" => "A", "label" => "A", "waktu_mulai" => "0000-00-00 00:00:00", "waktu_selesai" => "0000-00-00 00:00:00"))));
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
     * @covers TahunAjaranRecord::retrieve()
     * @covers PDOStatement::fetch()
     */
    public function testRetrieveCallFetch($PDOStatement) {
        $actual = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($actual, array("id" => 1, "nama" => "A", "label" => "A", "waktu_mulai" => "0000-00-00 00:00:00", "waktu_selesai" => "0000-00-00 00:00:00"));

        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallFetch
     * @covers TahunAjaranRecord::retrieve()
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
     * @covers TahunAjaranRecord::persist()
     */
    public function testPersistInsert() {
        $this->mySetDataSet(array("tahun_ajaran" => array()));
        $this->_setProperties();
        $this->object->unsetId();

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist());
        $this->myEnableForeignKeyChecks();

        $this->_assertIDValue(array("id" => 1));

        $this->mySetDataSet(array("tahun_ajaran" => array(array("id" => 1, "nama" => "A", "label" => "A", "waktu_mulai" => "0000-00-00 00:00:00", "waktu_selesai" => "0000-00-00 00:00:00"))));
        $queryTable = $this->getConnection()->createQueryTable("tahun_ajaran", "SELECT id, nama, label, waktu_mulai, waktu_selesai FROM tahun_ajaran");
        $expectedTable = $this->getDataSet()->getTable("tahun_ajaran");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers TahunAjaranRecord::retrieve()
     */
    public function testRetrieve() {
        $this->mySetDataSet(array("tahun_ajaran" => array(array("id" => 1, "nama" => "A", "label" => "A", "waktu_mulai" => "0000-00-00 00:00:00", "waktu_selesai" => "0000-00-00 00:00:00"))));
        $this->mySetup($this->getDataSet());

        $this->object->setId(1);
        $this->assertTrue($this->object->retrieve());
        $this->_assertPropertiesValue(array("id" => 1, "nama" => "A", "label" => "A", "waktu_mulai" => "0000-00-00 00:00:00", "waktu_selesai" => "0000-00-00 00:00:00"));
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieve
     * @covers TahunAjaranRecord::persist()
     */
    public function testPersistUpdate() {
        $this->mySetDataSet(array("tahun_ajaran" => array(array("id" => 1, "nama" => "A", "label" => "A", "waktu_mulai" => "0000-00-00 00:00:00", "waktu_selesai" => "0000-00-00 00:00:00"))));
        $this->mySetup($this->getDataSet());

        $this->mySetDataSet(array("tahun_ajaran" => array(array("id" => 1, "nama" => "U", "label" => "U", "waktu_mulai" => "2014-05-05 05:28:51", "waktu_selesai" => "2014-05-05 05:28:51"))));

        $this->object->setId(1);
        $this->object->retrieve();
        $this->_updatePropertiesValue(array("id" => 1, "nama" => "U", "label" => "U", "waktu_mulai" => "2014-05-05 05:28:51", "waktu_selesai" => "2014-05-05 05:28:51"));

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist(), $this->object->getErrorMessage());
        $this->myEnableForeignKeyChecks();

        $queryTable = $this->getConnection()->createQueryTable("tahun_ajaran", "SELECT id, nama, label, waktu_mulai, waktu_selesai FROM tahun_ajaran");
        $expectedTable = $this->getDataSet()->getTable("tahun_ajaran");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    private function _setProperties() {
        $this->object->setId(1);
        $this->object->setNama("A");
        $this->object->setLabel("A");
        $this->object->setWaktuMulai("0000-00-00 00:00:00");
        $this->object->setWaktuSelesai("0000-00-00 00:00:00");
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetNama();
        $this->object->unsetLabel();
        $this->object->unsetWaktuMulai();
        $this->object->unsetWaktuSelesai();
    }

    private function _updatePropertiesValue($newValues) {
        $this->object->setId($newValues["id"]);
        $this->object->setNama($newValues["nama"]);
        $this->object->setLabel($newValues["label"]);
        $this->object->setWaktuMulai($newValues["waktu_mulai"]);
        $this->object->setWaktuSelesai($newValues["waktu_selesai"]);
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["nama"], $this->object->getNama());
        $this->assertEquals($expectedValues["label"], $this->object->getLabel());
        $this->assertEquals($expectedValues["waktu_mulai"], $this->object->getWaktuMulai());
        $this->assertEquals($expectedValues["waktu_selesai"], $this->object->getWaktuSelesai());
    }

    private function _assertIDValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
    }

}
