<?php

/**
 * Integration test objek TransaksiRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TransaksiRecordCallPdoIntegrationTest extends MyApp_Database_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();

        $this->object = new TransaksiRecord;
        $this->object->setPDO(self::$pdo);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers TransaksiRecord::persist()
     * @covers TransaksiRecord::retrieve()
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
     * @covers TransaksiRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistInsertCallPrepare() {
        $actual = $this->object->getPDO()->prepare("INSERT INTO transaksi (id, jenis, kategori, metode, batal, waktu_transaksi, waktu_laporan, waktu_entri, id_rekening, id_kasir, nomor_transaksi, nomor_referensi, nilai) VALUES (:id, :jenis, :kategori, :metode, :batal, :waktu_transaksi, :waktu_laporan, :waktu_entri, :id_rekening, :id_kasir, :nomor_transaksi, :nomor_referensi, :nilai)");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testCallSetAttribute
     * @covers TransaksiRecord::persist()
     * @covers PDO::prepare()
     */
    public function testPersistUpdateCallPrepare() {
        $actual = $this->object->getPDO()->prepare("UPDATE transaksi SET jenis = :jenis, kategori = :kategori, metode = :metode, batal = :batal, waktu_transaksi = :waktu_transaksi, waktu_laporan = :waktu_laporan, waktu_entri = :waktu_entri, id_rekening = :id_rekening, id_kasir = :id_kasir, nomor_transaksi = :nomor_transaksi, nomor_referensi = :nomor_referensi, nilai = :nilai WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallPrepare
     * @covers TransaksiRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistInsertCallExecute($PDOStatement) {
        $this->mySetDataSet(array("transaksi" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":jenis" => "TRANSAKSI", ":kategori" => "PEMBAYARAN", ":metode" => "ONLINE", ":batal" => 1, ":waktu_transaksi" => "0000-00-00 00:00:00", ":waktu_laporan" => "0000-00-00 00:00:00", ":waktu_entri" => "0000-00-00 00:00:00", ":id_rekening" => 1, ":id_kasir" => 1, ":nomor_transaksi" => "A", ":nomor_referensi" => "A", ":nilai" => 1));
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
     * @covers TransaksiRecord::persist()
     * @covers PDOStatement::execute()
     */
    public function testPersistUpdateCallExecute($PDOStatement) {
        $this->mySetDataSet(array("transaksi" => array()));

        $this->myDisableForeignKeyChecks();
        $actual = $PDOStatement->execute(array(":id" => 1, ":jenis" => "TRANSAKSI", ":kategori" => "PEMBAYARAN", ":metode" => "ONLINE", ":batal" => 1, ":waktu_transaksi" => "0000-00-00 00:00:00", ":waktu_laporan" => "0000-00-00 00:00:00", ":waktu_entri" => "0000-00-00 00:00:00", ":id_rekening" => 1, ":id_kasir" => 1, ":nomor_transaksi" => "A", ":nomor_referensi" => "A", ":nilai" => 1));
        $this->myEnableForeignKeyChecks();

        $this->assertTrue($actual);
        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testPersistInsertCallExecute
     * @covers TransaksiRecord::persist()
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
     * @covers TransaksiRecord::persist()
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
     * @covers TransaksiRecord::persist()
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
     * @covers TransaksiRecord::retrieve()
     * @covers PDO::prepare()
     */
    public function testRetrieveCallPrepare() {
        $actual = $this->object->getPDO()->prepare("SELECT id, jenis, kategori, metode, batal, waktu_transaksi, waktu_laporan, waktu_entri, id_rekening, id_kasir, nomor_transaksi, nomor_referensi, nilai FROM transaksi WHERE id = :id");
        $this->assertInstanceOf("PDOStatement", $actual);

        return $actual;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallPrepare
     * @covers TransaksiRecord::retrieve()
     * @covers PDOStatement::execute()
     */
    public function testRetrieveCallExecute($PDOStatement) {
        $this->mySetDataSet(array("transaksi" => array(array("id" => 1, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 1, "waktu_transaksi" => "0000-00-00 00:00:00", "waktu_laporan" => "0000-00-00 00:00:00", "waktu_entri" => "0000-00-00 00:00:00", "id_rekening" => 1, "id_kasir" => 1, "nomor_transaksi" => "A", "nomor_referensi" => "A", "nilai" => 1))));
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
     * @covers TransaksiRecord::retrieve()
     * @covers PDOStatement::fetch()
     */
    public function testRetrieveCallFetch($PDOStatement) {
        $actual = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($actual, array("id" => 1, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 1, "waktu_transaksi" => "0000-00-00 00:00:00", "waktu_laporan" => "0000-00-00 00:00:00", "waktu_entri" => "0000-00-00 00:00:00", "id_rekening" => 1, "id_kasir" => 1, "nomor_transaksi" => "A", "nomor_referensi" => "A", "nilai" => 1));

        return $PDOStatement;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieveCallFetch
     * @covers TransaksiRecord::retrieve()
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
     * @covers TransaksiRecord::persist()
     */
    public function testPersistInsert() {
        $this->mySetDataSet(array("transaksi" => array()));
        $this->_setProperties();
        $this->object->unsetId();

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist());
        $this->myEnableForeignKeyChecks();

        $this->_assertIDValue(array("id" => 1));

        $this->mySetDataSet(array("transaksi" => array(array("id" => 1, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 1, "waktu_transaksi" => "0000-00-00 00:00:00", "waktu_laporan" => "0000-00-00 00:00:00", "waktu_entri" => "0000-00-00 00:00:00", "id_rekening" => 1, "id_kasir" => 1, "nomor_transaksi" => "A", "nomor_referensi" => "A", "nilai" => 1))));
        $queryTable = $this->getConnection()->createQueryTable("transaksi", "SELECT id, jenis, kategori, metode, batal, waktu_transaksi, waktu_laporan, waktu_entri, id_rekening, id_kasir, nomor_transaksi, nomor_referensi, nilai FROM transaksi");
        $expectedTable = $this->getDataSet()->getTable("transaksi");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @covers TransaksiRecord::retrieve()
     */
    public function testRetrieve() {
        $this->mySetDataSet(array("transaksi" => array(array("id" => 1, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 1, "waktu_transaksi" => "0000-00-00 00:00:00", "waktu_laporan" => "0000-00-00 00:00:00", "waktu_entri" => "0000-00-00 00:00:00", "id_rekening" => 1, "id_kasir" => 1, "nomor_transaksi" => "A", "nomor_referensi" => "A", "nilai" => 1))));
        $this->mySetup($this->getDataSet());

        $this->object->setId(1);
        $this->assertTrue($this->object->retrieve());
        $this->_assertPropertiesValue(array("id" => 1, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 1, "waktu_transaksi" => "0000-00-00 00:00:00", "waktu_laporan" => "0000-00-00 00:00:00", "waktu_entri" => "0000-00-00 00:00:00", "id_rekening" => 1, "id_kasir" => 1, "nomor_transaksi" => "A", "nomor_referensi" => "A", "nilai" => 1));
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group recordObject
     * @depends testRetrieve
     * @covers TransaksiRecord::persist()
     */
    public function testPersistUpdate() {
        $this->mySetDataSet(array("transaksi" => array(array("id" => 1, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 1, "waktu_transaksi" => "0000-00-00 00:00:00", "waktu_laporan" => "0000-00-00 00:00:00", "waktu_entri" => "0000-00-00 00:00:00", "id_rekening" => 1, "id_kasir" => 1, "nomor_transaksi" => "A", "nomor_referensi" => "A", "nilai" => 1))));
        $this->mySetup($this->getDataSet());

        $this->mySetDataSet(array("transaksi" => array(array("id" => 1, "jenis" => "PEMBATALAN", "kategori" => "PENGEMBALIAN", "metode" => "OFFLINE", "batal" => 0, "waktu_transaksi" => "2014-05-01 19:27:04", "waktu_laporan" => "2014-05-01 19:27:04", "waktu_entri" => "2014-05-01 19:27:04", "id_rekening" => 0, "id_kasir" => 0, "nomor_transaksi" => "U", "nomor_referensi" => "U", "nilai" => 0))));

        $this->object->setId(1);
        $this->object->retrieve();
        $this->_updatePropertiesValue(array("id" => 1, "jenis" => "PEMBATALAN", "kategori" => "PENGEMBALIAN", "metode" => "OFFLINE", "batal" => 0, "waktu_transaksi" => "2014-05-01 19:27:04", "waktu_laporan" => "2014-05-01 19:27:04", "waktu_entri" => "2014-05-01 19:27:04", "id_rekening" => 0, "id_kasir" => 0, "nomor_transaksi" => "U", "nomor_referensi" => "U", "nilai" => 0));

        $this->myDisableForeignKeyChecks();
        $this->assertTrue($this->object->persist(), $this->object->getErrorMessage());
        $this->myEnableForeignKeyChecks();

        $queryTable = $this->getConnection()->createQueryTable("transaksi", "SELECT id, jenis, kategori, metode, batal, waktu_transaksi, waktu_laporan, waktu_entri, id_rekening, id_kasir, nomor_transaksi, nomor_referensi, nilai FROM transaksi");
        $expectedTable = $this->getDataSet()->getTable("transaksi");

        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    private function _setProperties() {
        $this->object->setId(1);
        $this->object->setJenis("TRANSAKSI");
        $this->object->setKategori("PEMBAYARAN");
        $this->object->setMetode("ONLINE");
        $this->object->setBatal(1);
        $this->object->setWaktuTransaksi("0000-00-00 00:00:00");
        $this->object->setWaktuLaporan("0000-00-00 00:00:00");
        $this->object->setWaktuEntri("0000-00-00 00:00:00");
        $this->object->setIdRekening(1);
        $this->object->setIdKasir(1);
        $this->object->setNomorTransaksi("A");
        $this->object->setNomorReferensi("A");
        $this->object->setNilai(1);
    }

    private function _unsetProperties() {
        $this->object->unsetId();
        $this->object->unsetJenis();
        $this->object->unsetKategori();
        $this->object->unsetMetode();
        $this->object->unsetBatal();
        $this->object->unsetWaktuTransaksi();
        $this->object->unsetWaktuLaporan();
        $this->object->unsetWaktuEntri();
        $this->object->unsetIdRekening();
        $this->object->unsetIdKasir();
        $this->object->unsetNomorTransaksi();
        $this->object->unsetNomorReferensi();
        $this->object->unsetNilai();
    }

    private function _updatePropertiesValue($newValues) {
        $this->object->setId($newValues["id"]);
        $this->object->setJenis($newValues["jenis"]);
        $this->object->setKategori($newValues["kategori"]);
        $this->object->setMetode($newValues["metode"]);
        $this->object->setBatal($newValues["batal"]);
        $this->object->setWaktuTransaksi($newValues["waktu_transaksi"]);
        $this->object->setWaktuLaporan($newValues["waktu_laporan"]);
        $this->object->setWaktuEntri($newValues["waktu_entri"]);
        $this->object->setIdRekening($newValues["id_rekening"]);
        $this->object->setIdKasir($newValues["id_kasir"]);
        $this->object->setNomorTransaksi($newValues["nomor_transaksi"]);
        $this->object->setNomorReferensi($newValues["nomor_referensi"]);
        $this->object->setNilai($newValues["nilai"]);
    }

    private function _assertPropertiesValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
        $this->assertEquals($expectedValues["jenis"], $this->object->getJenis());
        $this->assertEquals($expectedValues["kategori"], $this->object->getKategori());
        $this->assertEquals($expectedValues["metode"], $this->object->getMetode());
        $this->assertEquals($expectedValues["batal"], $this->object->getBatal());
        $this->assertEquals($expectedValues["waktu_transaksi"], $this->object->getWaktuTransaksi());
        $this->assertEquals($expectedValues["waktu_laporan"], $this->object->getWaktuLaporan());
        $this->assertEquals($expectedValues["waktu_entri"], $this->object->getWaktuEntri());
        $this->assertEquals($expectedValues["id_rekening"], $this->object->getIdRekening());
        $this->assertEquals($expectedValues["id_kasir"], $this->object->getIdKasir());
        $this->assertEquals($expectedValues["nomor_transaksi"], $this->object->getNomorTransaksi());
        $this->assertEquals($expectedValues["nomor_referensi"], $this->object->getNomorReferensi());
        $this->assertEquals($expectedValues["nilai"], $this->object->getNilai());
    }

    private function _assertIDValue($expectedValues) {
        $this->assertEquals($expectedValues["id"], $this->object->getId());
    }

}
