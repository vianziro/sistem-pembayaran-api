<?php

/**
 * Integration test objek TagihanRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TagihanRecordCallPdoIntegrationTest extends MyApp_Database_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();

        $this->object = new TagihanRecord;
        $this->object->setPDO(self::$pdo);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers TagihanRecord::persist()
     * @covers TagihanRecord::retrieve()
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
     * @covers TagihanRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistInsertCallPrepare() {
        $actual = $this->object->getPDO()->prepare("INSERT INTO tagihan (id, waktu_tagihan, id_tahun_ajaran, id_siswa, id_bulan, id_jenis_pembayaran, nilai, terbayar, sisa, id_unit, id_program, id_jurusan, id_tingkat, id_kelas) VALUES (:id, :waktu_tagihan, :id_tahun_ajaran, :id_siswa, :id_bulan, :id_jenis_pembayaran, :nilai, :terbayar, :sisa, :id_unit, :id_program, :id_jurusan, :id_tingkat, :id_kelas)");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testCallSetAttribute
     * @covers TagihanRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistUpdateCallPrepare() {
        $actual = $this->object->getPDO()->prepare("UPDATE tagihan SET waktu_tagihan = :waktu_tagihan, id_tahun_ajaran = :id_tahun_ajaran, id_siswa = :id_siswa, id_bulan = :id_bulan, id_jenis_pembayaran = :id_jenis_pembayaran, nilai = :nilai, terbayar = :terbayar, sisa = :sisa, id_unit = :id_unit, id_program = :id_program, id_jurusan = :id_jurusan, id_tingkat = :id_tingkat, id_kelas = :id_kelas WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallPrepare
     * @covers TagihanRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistInsertCallExecute($PDOStatement) {
        $this->mySetDataSet(array("tagihan" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":waktu_tagihan" => "0000-00-00 00:00:00", ":id_tahun_ajaran" => 1, ":id_siswa" => 1, ":id_bulan" => 1, ":id_jenis_pembayaran" => 1, ":nilai" => 1, ":terbayar" => 1, ":sisa" => 1, ":id_unit" => 1, ":id_program" => 1, ":id_jurusan" => 1, ":id_tingkat" => 1, ":id_kelas" => 1));
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
     * @covers TagihanRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistUpdateCallExecute($PDOStatement) {
        $this->mySetDataSet(array("tagihan" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":waktu_tagihan" => "0000-00-00 00:00:00", ":id_tahun_ajaran" => 1, ":id_siswa" => 1, ":id_bulan" => 1, ":id_jenis_pembayaran" => 1, ":nilai" => 1, ":terbayar" => 1, ":sisa" => 1, ":id_unit" => 1, ":id_program" => 1, ":id_jurusan" => 1, ":id_tingkat" => 1, ":id_kelas" => 1));
        $this->myEnableForeignKeyChecks();

        $this->assertTrue($actual);
        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallExecute
     * @covers TagihanRecord::persist()
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
     * @covers TagihanRecord::persist()
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
     * @covers TagihanRecord::persist()
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
     * @covers TagihanRecord::retrieve()
     * @covers PDO::prepare()
     */
    public function testRetrieveCallPrepare() {
        $actual = $this->object->getPDO()->prepare("SELECT id, waktu_tagihan, id_tahun_ajaran, id_siswa, id_bulan, id_jenis_pembayaran, nilai, terbayar, sisa, id_unit, id_program, id_jurusan, id_tingkat, id_kelas FROM tagihan WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallPrepare
     * @covers TagihanRecord::retrieve()
     * @covers PDOStatement::execute()
     */
    public function testRetrieveCallExecute($PDOStatement) {
        $this->mySetDataSet(array("tagihan" => array(array("id" => 1, "waktu_tagihan" => "0000-00-00 00:00:00", "id_tahun_ajaran" => 1, "id_siswa" => 1, "id_bulan" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "terbayar" => 1, "sisa" => 1, "id_unit" => 1, "id_program" => 1, "id_jurusan" => 1, "id_tingkat" => 1, "id_kelas" => 1))));
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
     * @covers TagihanRecord::retrieve()
     * @covers PDOStatement::fetch()
     */
    public function testRetrieveCallFetch($PDOStatement) {
        $actual = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($actual, array("id" => 1, "waktu_tagihan" => "0000-00-00 00:00:00", "id_tahun_ajaran" => 1, "id_siswa" => 1, "id_bulan" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "terbayar" => 1, "sisa" => 1, "id_unit" => 1, "id_program" => 1, "id_jurusan" => 1, "id_tingkat" => 1, "id_kelas" => 1));

        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallFetch
     * @covers TagihanRecord::retrieve()
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
     * @covers TagihanRecord::persist()
     */
    public function testPersistInsert() {
        $this->mySetDataSet(array("tagihan" => array()));
        $this->_setProperties();
        $this->object->unsetId();

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist());
        $this->myEnableForeignKeyChecks();

        $this->_assertIDValue(array("id" => 1));

        $this->mySetDataSet(array("tagihan" => array(array("id" => 1, "waktu_tagihan" => "0000-00-00 00:00:00", "id_tahun_ajaran" => 1, "id_siswa" => 1, "id_bulan" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "terbayar" => 1, "sisa" => 1, "id_unit" => 1, "id_program" => 1, "id_jurusan" => 1, "id_tingkat" => 1, "id_kelas" => 1))));
        $queryTable = $this->getConnection()->createQueryTable("tagihan", "SELECT id, waktu_tagihan, id_tahun_ajaran, id_siswa, id_bulan, id_jenis_pembayaran, nilai, terbayar, sisa, id_unit, id_program, id_jurusan, id_tingkat, id_kelas FROM tagihan");
        $expectedTable = $this->getDataSet()->getTable("tagihan");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers TagihanRecord::retrieve()
     */
    public function testRetrieve() {
        $this->mySetDataSet(array("tagihan" => array(array("id" => 1, "waktu_tagihan" => "0000-00-00 00:00:00", "id_tahun_ajaran" => 1, "id_siswa" => 1, "id_bulan" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "terbayar" => 1, "sisa" => 1, "id_unit" => 1, "id_program" => 1, "id_jurusan" => 1, "id_tingkat" => 1, "id_kelas" => 1))));
        $this->mySetup($this->getDataSet());

        $this->object->setId(1);
        $this->assertTrue($this->object->retrieve());
        $this->_assertPropertiesValue(array("id" => 1, "waktu_tagihan" => "0000-00-00 00:00:00", "id_tahun_ajaran" => 1, "id_siswa" => 1, "id_bulan" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "terbayar" => 1, "sisa" => 1, "id_unit" => 1, "id_program" => 1, "id_jurusan" => 1, "id_tingkat" => 1, "id_kelas" => 1));
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieve
     * @covers TagihanRecord::persist()
     */
    public function testPersistUpdate() {
        $this->mySetDataSet(array("tagihan" => array(array("id" => 1, "waktu_tagihan" => "0000-00-00 00:00:00", "id_tahun_ajaran" => 1, "id_siswa" => 1, "id_bulan" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "terbayar" => 1, "sisa" => 1, "id_unit" => 1, "id_program" => 1, "id_jurusan" => 1, "id_tingkat" => 1, "id_kelas" => 1))));
        $this->mySetup($this->getDataSet());

        $this->mySetDataSet(array("tagihan" => array(array("id" => 1, "waktu_tagihan" => "2014-05-05 05:28:51", "id_tahun_ajaran" => 0, "id_siswa" => 0, "id_bulan" => 0, "id_jenis_pembayaran" => 0, "nilai" => 0, "terbayar" => 0, "sisa" => 0, "id_unit" => 0, "id_program" => 0, "id_jurusan" => 0, "id_tingkat" => 0, "id_kelas" => 0))));

        $this->object->setId(1);
        $this->object->retrieve();
        $this->_updatePropertiesValue(array("id" => 1, "waktu_tagihan" => "2014-05-05 05:28:51", "id_tahun_ajaran" => 0, "id_siswa" => 0, "id_bulan" => 0, "id_jenis_pembayaran" => 0, "nilai" => 0, "terbayar" => 0, "sisa" => 0, "id_unit" => 0, "id_program" => 0, "id_jurusan" => 0, "id_tingkat" => 0, "id_kelas" => 0));

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist(), $this->object->getErrorMessage());
        $this->myEnableForeignKeyChecks();

        $queryTable = $this->getConnection()->createQueryTable("tagihan", "SELECT id, waktu_tagihan, id_tahun_ajaran, id_siswa, id_bulan, id_jenis_pembayaran, nilai, terbayar, sisa, id_unit, id_program, id_jurusan, id_tingkat, id_kelas FROM tagihan");
        $expectedTable = $this->getDataSet()->getTable("tagihan");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    private function _setProperties() {
        $this->object->setId(1);
        $this->object->setWaktuTagihan("0000-00-00 00:00:00");
        $this->object->setIdTahunAjaran(1);
        $this->object->setIdSiswa(1);
        $this->object->setIdBulan(1);
        $this->object->setIdJenisPembayaran(1);
        $this->object->setNilai(1);
        $this->object->setTerbayar(1);
        $this->object->setSisa(1);
        $this->object->setIdUnit(1);
        $this->object->setIdProgram(1);
        $this->object->setIdJurusan(1);
        $this->object->setIdTingkat(1);
        $this->object->setIdKelas(1);
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetWaktuTagihan();
        $this->object->unsetIdTahunAjaran();
        $this->object->unsetIdSiswa();
        $this->object->unsetIdBulan();
        $this->object->unsetIdJenisPembayaran();
        $this->object->unsetNilai();
        $this->object->unsetTerbayar();
        $this->object->unsetSisa();
        $this->object->unsetIdUnit();
        $this->object->unsetIdProgram();
        $this->object->unsetIdJurusan();
        $this->object->unsetIdTingkat();
        $this->object->unsetIdKelas();
    }

    private function _updatePropertiesValue($newValues) {
        $this->object->setId($newValues["id"]);
        $this->object->setWaktuTagihan($newValues["waktu_tagihan"]);
        $this->object->setIdTahunAjaran($newValues["id_tahun_ajaran"]);
        $this->object->setIdSiswa($newValues["id_siswa"]);
        $this->object->setIdBulan($newValues["id_bulan"]);
        $this->object->setIdJenisPembayaran($newValues["id_jenis_pembayaran"]);
        $this->object->setNilai($newValues["nilai"]);
        $this->object->setTerbayar($newValues["terbayar"]);
        $this->object->setSisa($newValues["sisa"]);
        $this->object->setIdUnit($newValues["id_unit"]);
        $this->object->setIdProgram($newValues["id_program"]);
        $this->object->setIdJurusan($newValues["id_jurusan"]);
        $this->object->setIdTingkat($newValues["id_tingkat"]);
        $this->object->setIdKelas($newValues["id_kelas"]);
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["waktu_tagihan"], $this->object->getWaktuTagihan());
        $this->assertEquals($expectedValues["id_tahun_ajaran"], $this->object->getIdTahunAjaran());
        $this->assertEquals($expectedValues["id_siswa"], $this->object->getIdSiswa());
        $this->assertEquals($expectedValues["id_bulan"], $this->object->getIdBulan());
        $this->assertEquals($expectedValues["id_jenis_pembayaran"], $this->object->getIdJenisPembayaran());
        $this->assertEquals($expectedValues["nilai"], $this->object->getNilai());
        $this->assertEquals($expectedValues["terbayar"], $this->object->getTerbayar());
        $this->assertEquals($expectedValues["sisa"], $this->object->getSisa());
        $this->assertEquals($expectedValues["id_unit"], $this->object->getIdUnit());
        $this->assertEquals($expectedValues["id_program"], $this->object->getIdProgram());
        $this->assertEquals($expectedValues["id_jurusan"], $this->object->getIdJurusan());
        $this->assertEquals($expectedValues["id_tingkat"], $this->object->getIdTingkat());
        $this->assertEquals($expectedValues["id_kelas"], $this->object->getIdKelas());
    }

    private function _assertIDValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
    }

}
