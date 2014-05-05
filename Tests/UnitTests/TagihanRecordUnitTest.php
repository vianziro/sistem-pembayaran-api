<?php

/**
 * Unit test objek TagihanRecord.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TagihanRecordUnitTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new TagihanRecord;
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setId()
     * @covers TagihanRecord::getId()
     * @covers TagihanRecord::unsetId()
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
     * @covers TagihanRecord::setWaktuTagihan()
     * @covers TagihanRecord::getWaktuTagihan()
     * @covers TagihanRecord::unsetWaktuTagihan()
     */
    public function testSetGetUnsetWaktuTagihan() {
        $this->assertNull($this->object->getWaktuTagihan());

        $this->object->setWaktuTagihan("0000-00-00 00:00:00");
        $this->assertEquals("0000-00-00 00:00:00", $this->object->getWaktuTagihan());

        $this->object->unsetWaktuTagihan();
        $this->assertNull($this->object->getWaktuTagihan());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setIdTahunAjaran()
     * @covers TagihanRecord::getIdTahunAjaran()
     * @covers TagihanRecord::unsetIdTahunAjaran()
     */
    public function testSetGetUnsetIdTahunAjaran() {
        $this->assertNull($this->object->getIdTahunAjaran());

        $this->object->setIdTahunAjaran(1);
        $this->assertEquals(1, $this->object->getIdTahunAjaran());

        $this->object->unsetIdTahunAjaran();
        $this->assertNull($this->object->getIdTahunAjaran());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setIdSiswa()
     * @covers TagihanRecord::getIdSiswa()
     * @covers TagihanRecord::unsetIdSiswa()
     */
    public function testSetGetUnsetIdSiswa() {
        $this->assertNull($this->object->getIdSiswa());

        $this->object->setIdSiswa(1);
        $this->assertEquals(1, $this->object->getIdSiswa());

        $this->object->unsetIdSiswa();
        $this->assertNull($this->object->getIdSiswa());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setIdBulan()
     * @covers TagihanRecord::getIdBulan()
     * @covers TagihanRecord::unsetIdBulan()
     */
    public function testSetGetUnsetIdBulan() {
        $this->assertNull($this->object->getIdBulan());

        $this->object->setIdBulan(1);
        $this->assertEquals(1, $this->object->getIdBulan());

        $this->object->unsetIdBulan();
        $this->assertNull($this->object->getIdBulan());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setIdJenisPembayaran()
     * @covers TagihanRecord::getIdJenisPembayaran()
     * @covers TagihanRecord::unsetIdJenisPembayaran()
     */
    public function testSetGetUnsetIdJenisPembayaran() {
        $this->assertNull($this->object->getIdJenisPembayaran());

        $this->object->setIdJenisPembayaran(1);
        $this->assertEquals(1, $this->object->getIdJenisPembayaran());

        $this->object->unsetIdJenisPembayaran();
        $this->assertNull($this->object->getIdJenisPembayaran());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setNilai()
     * @covers TagihanRecord::getNilai()
     * @covers TagihanRecord::unsetNilai()
     */
    public function testSetGetUnsetNilai() {
        $this->assertNull($this->object->getNilai());

        $this->object->setNilai(1);
        $this->assertEquals(1, $this->object->getNilai());

        $this->object->unsetNilai();
        $this->assertNull($this->object->getNilai());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setTerbayar()
     * @covers TagihanRecord::getTerbayar()
     * @covers TagihanRecord::unsetTerbayar()
     */
    public function testSetGetUnsetTerbayar() {
        $this->assertNull($this->object->getTerbayar());

        $this->object->setTerbayar(1);
        $this->assertEquals(1, $this->object->getTerbayar());

        $this->object->unsetTerbayar();
        $this->assertNull($this->object->getTerbayar());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setSisa()
     * @covers TagihanRecord::getSisa()
     * @covers TagihanRecord::unsetSisa()
     */
    public function testSetGetUnsetSisa() {
        $this->assertNull($this->object->getSisa());

        $this->object->setSisa(1);
        $this->assertEquals(1, $this->object->getSisa());

        $this->object->unsetSisa();
        $this->assertNull($this->object->getSisa());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setIdUnit()
     * @covers TagihanRecord::getIdUnit()
     * @covers TagihanRecord::unsetIdUnit()
     */
    public function testSetGetUnsetIdUnit() {
        $this->assertNull($this->object->getIdUnit());

        $this->object->setIdUnit(1);
        $this->assertEquals(1, $this->object->getIdUnit());

        $this->object->unsetIdUnit();
        $this->assertNull($this->object->getIdUnit());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setIdProgram()
     * @covers TagihanRecord::getIdProgram()
     * @covers TagihanRecord::unsetIdProgram()
     */
    public function testSetGetUnsetIdProgram() {
        $this->assertNull($this->object->getIdProgram());

        $this->object->setIdProgram(1);
        $this->assertEquals(1, $this->object->getIdProgram());

        $this->object->unsetIdProgram();
        $this->assertNull($this->object->getIdProgram());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setIdJurusan()
     * @covers TagihanRecord::getIdJurusan()
     * @covers TagihanRecord::unsetIdJurusan()
     */
    public function testSetGetUnsetIdJurusan() {
        $this->assertNull($this->object->getIdJurusan());

        $this->object->setIdJurusan(1);
        $this->assertEquals(1, $this->object->getIdJurusan());

        $this->object->unsetIdJurusan();
        $this->assertNull($this->object->getIdJurusan());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setIdTingkat()
     * @covers TagihanRecord::getIdTingkat()
     * @covers TagihanRecord::unsetIdTingkat()
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
     * @covers TagihanRecord::setIdKelas()
     * @covers TagihanRecord::getIdKelas()
     * @covers TagihanRecord::unsetIdKelas()
     */
    public function testSetGetUnsetIdKelas() {
        $this->assertNull($this->object->getIdKelas());

        $this->object->setIdKelas(1);
        $this->assertEquals(1, $this->object->getIdKelas());

        $this->object->unsetIdKelas();
        $this->assertNull($this->object->getIdKelas());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::setPDO()
     * @covers TagihanRecord::getPDO()
     * @covers TagihanRecord::unsetPDO()
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
     * @covers TagihanRecord::persist()
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
     * @covers TagihanRecord::persist()
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
     * @covers TagihanRecord::persist()
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
     * @covers TagihanRecord::persist()
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
     * @covers TagihanRecord::persist()
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
     * @covers TagihanRecord::persist()
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
     * @covers TagihanRecord::persist()
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
     * @covers TagihanRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaPdoTidakTerpasang() {
        $this->object->unsetPDO();
        $this->object->setId(1);

        $this->assertFalse($this->object->retrieve());
    }

    /**
     * @group unitTest
     * @group recordObject
     * @covers TagihanRecord::retrieve()
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
     * @covers TagihanRecord::retrieve()
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
     * @covers TagihanRecord::retrieve()
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
     * @covers TagihanRecord::retrieve()
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
     * @covers TagihanRecord::retrieve()
     */
    public function testRetrieveReturnFalseJikaCloseCursorGagal() {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "closeCursor", "fetch"));
        $mockPDO = $this->getMock("MockPDO", array("setAttribute", "errorInfo", "prepare", "lastInsertId"));

        $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        $mockPDOStatement->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue(array("id" => 1, "waktu_tagihan" => "0000-00-00 00:00:00", "id_tahun_ajaran" => 1, "id_siswa" => 1, "id_bulan" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "terbayar" => 1, "sisa" => 1, "id_unit" => 1, "id_program" => 1, "id_jurusan" => 1, "id_tingkat" => 1, "id_kelas" => 1)));

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
     * @covers TagihanRecord::retrieve()
     */
    public function testOperasiRetrieveSukses() {
        $fetchReturnValue = array("id" => 1, "waktu_tagihan" => "0000-00-00 00:00:00", "id_tahun_ajaran" => 1, "id_siswa" => 1, "id_bulan" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1, "terbayar" => 1, "sisa" => 1, "id_unit" => 1, "id_program" => 1, "id_jurusan" => 1, "id_tingkat" => 1, "id_kelas" => 1);

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

}
