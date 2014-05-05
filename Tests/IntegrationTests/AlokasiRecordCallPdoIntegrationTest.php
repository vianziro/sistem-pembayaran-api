<?php

/**
 * Integration test objek AlokasiRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class AlokasiRecordCallPdoIntegrationTest extends MyApp_Database_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();

        $this->object = new AlokasiRecord;
        $this->object->setPDO(self::$pdo);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers AlokasiRecord::persist()
     * @covers AlokasiRecord::retrieve()
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
     * @covers AlokasiRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistInsertCallPrepare() {
        $actual = $this->object->getPDO()->prepare("INSERT INTO alokasi (id, id_transaksi, id_siswa, id_unit, id_jenis_pembayaran, nilai, sisa, terdistribusi) VALUES (:id, :id_transaksi, :id_siswa, :id_unit, :id_jenis_pembayaran, :nilai, :sisa, :terdistribusi)");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testCallSetAttribute
     * @covers AlokasiRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistUpdateCallPrepare() {
        $actual = $this->object->getPDO()->prepare("UPDATE alokasi SET id_transaksi = :id_transaksi, id_siswa = :id_siswa, id_unit = :id_unit, id_jenis_pembayaran = :id_jenis_pembayaran, nilai = :nilai, sisa = :sisa, terdistribusi = :terdistribusi WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallPrepare
     * @covers AlokasiRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistInsertCallExecute($PDOStatement) {
        $this->mySetDataSet(array("alokasi" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":id_transaksi" => 1, ":id_siswa" => 1, ":id_unit" => 1, ":id_jenis_pembayaran" => 1, ":nilai" => 1, ":sisa" => 1, ":terdistribusi" => 1));
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
     * @covers AlokasiRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistUpdateCallExecute($PDOStatement) {
        $this->mySetDataSet(array("alokasi" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":id_transaksi" => 1, ":id_siswa" => 1, ":id_unit" => 1, ":id_jenis_pembayaran" => 1, ":nilai" => 1, ":sisa" => 1, ":terdistribusi" => 1));
        $this->myEnableForeignKeyChecks();

        $this->assertTrue($actual);
        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallExecute
     * @covers AlokasiRecord::persist()
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
     * @covers AlokasiRecord::persist()
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
     * @covers AlokasiRecord::persist()
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
     * @covers AlokasiRecord::retrieve()
     * @covers PDO::prepare()
     */
    public function testRetrieveCallPrepare() {
        $actual = $this->object->getPDO()->prepare("SELECT id, id_transaksi, id_siswa, id_unit, id_jenis_pembayaran, nilai, sisa, terdistribusi FROM alokasi WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallPrepare
     * @covers AlokasiRecord::retrieve()
     * @covers PDOStatement::execute()
     */
    public function testRetrieveCallExecute($PDOStatement) {
        $this->mySetDataSet(array("alokasi" => array(array("id" => 1, "id_transaksi" => 1, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "sisa" => 1, "terdistribusi" => 1))));
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
     * @covers AlokasiRecord::retrieve()
     * @covers PDOStatement::fetch()
     */
    public function testRetrieveCallFetch($PDOStatement) {
        $actual = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($actual, array("id" => 1, "id_transaksi" => 1, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "sisa" => 1, "terdistribusi" => 1));

        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallFetch
     * @covers AlokasiRecord::retrieve()
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
     * @covers AlokasiRecord::persist()
     */
    public function testPersistInsert() {
        $this->mySetDataSet(array("alokasi" => array()));
        $this->_setProperties();
        $this->object->unsetId();

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist());
        $this->myEnableForeignKeyChecks();

        $this->_assertIDValue(array("id" => 1));

        $this->mySetDataSet(array("alokasi" => array(array("id" => 1, "id_transaksi" => 1, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "sisa" => 1, "terdistribusi" => 1))));
        $queryTable = $this->getConnection()->createQueryTable("alokasi", "SELECT id, id_transaksi, id_siswa, id_unit, id_jenis_pembayaran, nilai, sisa, terdistribusi FROM alokasi");
        $expectedTable = $this->getDataSet()->getTable("alokasi");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers AlokasiRecord::retrieve()
     */
    public function testRetrieve() {
        $this->mySetDataSet(array("alokasi" => array(array("id" => 1, "id_transaksi" => 1, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "sisa" => 1, "terdistribusi" => 1))));
        $this->mySetup($this->getDataSet());

        $this->object->setId(1);
        $this->assertTrue($this->object->retrieve());
        $this->_assertPropertiesValue(array("id" => 1, "id_transaksi" => 1, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "sisa" => 1, "terdistribusi" => 1));
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieve
     * @covers AlokasiRecord::persist()
     */
    public function testPersistUpdate() {
        $this->mySetDataSet(array("alokasi" => array(array("id" => 1, "id_transaksi" => 1, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "sisa" => 1, "terdistribusi" => 1))));
        $this->mySetup($this->getDataSet());

        $this->mySetDataSet(array("alokasi" => array(array("id" => 1, "id_transaksi" => 0, "id_siswa" => 0, "id_unit" => 0, "id_jenis_pembayaran" => 0, "nilai" => 0, "sisa" => 0, "terdistribusi" => 0))));

        $this->object->setId(1);
        $this->object->retrieve();
        $this->_updatePropertiesValue(array("id" => 1, "id_transaksi" => 0, "id_siswa" => 0, "id_unit" => 0, "id_jenis_pembayaran" => 0, "nilai" => 0, "sisa" => 0, "terdistribusi" => 0));

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist(), $this->object->getErrorMessage());
        $this->myEnableForeignKeyChecks();

        $queryTable = $this->getConnection()->createQueryTable("alokasi", "SELECT id, id_transaksi, id_siswa, id_unit, id_jenis_pembayaran, nilai, sisa, terdistribusi FROM alokasi");
        $expectedTable = $this->getDataSet()->getTable("alokasi");

        $this->assertTablesEqual($expectedTable, $queryTable);
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

    private function _updatePropertiesValue($newValues) {
        $this->object->setId($newValues["id"]);
        $this->object->setIdTransaksi($newValues["id_transaksi"]);
        $this->object->setIdSiswa($newValues["id_siswa"]);
        $this->object->setIdUnit($newValues["id_unit"]);
        $this->object->setIdJenisPembayaran($newValues["id_jenis_pembayaran"]);
        $this->object->setNilai($newValues["nilai"]);
        $this->object->setSisa($newValues["sisa"]);
        $this->object->setTerdistribusi($newValues["terdistribusi"]);
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

    private function _assertIDValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
    }

}
