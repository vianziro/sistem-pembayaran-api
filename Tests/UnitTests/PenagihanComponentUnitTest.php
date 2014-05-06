<?php

/**
 * Unit test objek PenagihanComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class PenagihanComponentUnitTest extends PHPUnit_Framework_TestCase {

    protected $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new PenagihanComponent;
        $this->object->setPeninjauComponent($this->getMockPeninjauComponent(array()));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PenagihanComponent::setPeninjauComponent()
     * @covers PenagihanComponent::getPeninjauComponent()
     * @covers PenagihanComponent::unsetPeninjauComponent()
     */
    public function testSetGetUnsetKomponenPeninjau() {
        $mockPeninjauComponent = $this->getMock("PeninjauComponent");

        $this->object->unsetPeninjauComponent();
        $this->assertNull($this->object->getPeninjauComponent());

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $this->assertSame($mockPeninjauComponent, $this->object->getPeninjauComponent());

        $this->object->unsetPeninjauComponent();
        $this->assertNull($this->object->getPeninjauComponent());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PenagihanComponent::perolehTagihanSiswa()
     */
    public function testPerolehTagihanSiswaReturnFalseJikaKomponenPeninjauBelumTerpasang() {
        $mockUnit = $this->getMockUnitRecord();
        $mockJenisPembayaran = $this->getMockJenisPembayaranRecord();
        $mockSiswa = $this->getMockSiswaRecord();
        $mockTagihanObject = $this->getMockTagihanObject();

        $this->object->unsetPeninjauComponent();
        $this->assertFalse($this->object->perolehTagihanSiswa($mockUnit, $mockJenisPembayaran, $mockSiswa, $mockTagihanObject));
        $this->assertEquals("PENINJAU_TIDAK_TERPASANG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PenagihanComponent::perolehTagihanSiswa()
     */
    public function testPerolehTagihanSiswaReturnFalseJikaIdUnitKosong() {
        $mockUnit = $this->getMockUnitRecord(array("id" => NULL), FALSE, array("id" => NULL, "nama" => "", "label" => ""));
        $mockJenisPembayaran = $this->getMockJenisPembayaranRecord();
        $mockSiswa = $this->getMockSiswaRecord();
        $mockTagihanObject = $this->getMockTagihanObject();

        $this->assertFalse($this->object->perolehTagihanSiswa($mockUnit, $mockJenisPembayaran, $mockSiswa, $mockTagihanObject));
        $this->assertEquals("ID_UNIT_KOSONG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PenagihanComponent::perolehTagihanSiswa()
     */
    public function testPerolehTagihanSiswaReturnFalseJikaIdJenisPembayaranKosong() {
        $mockUnit = $this->getMockUnitRecord();
        $mockJenisPembayaran = $this->getMockJenisPembayaranRecord(array("id" => NULL), FALSE, array("id" => NULL, "nama" => "", "label" => ""));
        $mockSiswa = $this->getMockSiswaRecord();
        $mockTagihanObject = $this->getMockTagihanObject();

        $this->assertFalse($this->object->perolehTagihanSiswa($mockUnit, $mockJenisPembayaran, $mockSiswa, $mockTagihanObject));
        $this->assertEquals("ID_JENIS_PEMBAYARAN_KOSONG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PenagihanComponent::perolehTagihanSiswa()
     */
    public function testPerolehTagihanSiswaReturnFalseJikaIdSiswaKosong() {
        $mockUnit = $this->getMockUnitRecord();
        $mockJenisPembayaran = $this->getMockJenisPembayaranRecord();
        $mockSiswa = $this->getMockSiswaRecord(array("id" => NULL), FALSE, array("id" => NULL, "nama" => "", "nis" => ""));
        $mockTagihanObject = $this->getMockTagihanObject();

        $this->assertFalse($this->object->perolehTagihanSiswa($mockUnit, $mockJenisPembayaran, $mockSiswa, $mockTagihanObject));
        $this->assertEquals("ID_SISWA_KOSONG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PenagihanComponent::perolehTagihanSiswa()
     */
    public function testPerolehTagihanSiswaReturnFalseJikaWaktuObjekTagihanKosong() {
        $waktu = "";

        $mockUnit = $this->getMockUnitRecord();
        $mockJenisPembayaran = $this->getMockJenisPembayaranRecord();
        $mockSiswa = $this->getMockSiswaRecord();
        $mockTagihanObject = $this->getMockTagihanObject($waktu);

        $this->assertFalse($this->object->perolehTagihanSiswa($mockUnit, $mockJenisPembayaran, $mockSiswa, $mockTagihanObject));
        $this->assertEquals("WAKTU_TAGIHAN_KOSONG", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PenagihanComponent::perolehTagihanSiswa()
     */
    public function testPerolehTagihanSiswaReturnFalseJikaGagalRetrieveUnit() {
        $mockUnit = $this->getMockUnitRecord(array("id" => 1), FALSE, array("id" => 1, "nama" => "", "label" => ""));
        $mockJenisPembayaran = $this->getMockJenisPembayaranRecord();
        $mockSiswa = $this->getMockSiswaRecord();
        $mockTagihanObject = $this->getMockTagihanObject();

        $this->assertFalse($this->object->perolehTagihanSiswa($mockUnit, $mockJenisPembayaran, $mockSiswa, $mockTagihanObject));
        $this->assertEquals("GAGAL_RETRIEVE_UNIT", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PenagihanComponent::perolehTagihanSiswa()
     */
    public function testPerolehTagihanSiswaReturnFalseJikaGagalRetrieveJenisPembayaran() {
        $mockUnit = $this->getMockUnitRecord();
        $mockJenisPembayaran = $this->getMockJenisPembayaranRecord(array("id" => 1), FALSE, array("id" => 1, "nama" => "", "label" => ""));
        $mockSiswa = $this->getMockSiswaRecord();
        $mockTagihanObject = $this->getMockTagihanObject();

        $this->assertFalse($this->object->perolehTagihanSiswa($mockUnit, $mockJenisPembayaran, $mockSiswa, $mockTagihanObject));
        $this->assertEquals("GAGAL_RETRIEVE_JENIS_PEMBAYARAN", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PenagihanComponent::perolehTagihanSiswa()
     */
    public function testPerolehTagihanSiswaReturnFalseJikaGagalRetrieveSiswa() {
        $mockUnit = $this->getMockUnitRecord();
        $mockJenisPembayaran = $this->getMockJenisPembayaranRecord();
        $mockSiswa = $this->getMockSiswaRecord(array("id" => 1), FALSE, array("id" => 1, "nama" => "", "nis" => ""));
        $mockTagihanObject = $this->getMockTagihanObject();

        $this->assertFalse($this->object->perolehTagihanSiswa($mockUnit, $mockJenisPembayaran, $mockSiswa, $mockTagihanObject));
        $this->assertEquals("GAGAL_RETRIEVE_SISWA", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PenagihanComponent::perolehTagihanSiswa()
     */
    public function testPerolehTagihanSiswaSetObjekTagihan() {
        $jumlahTagihan = 100000.00000;

        $mockPeninjauComponent = $this->getMockPeninjauComponent(array("perolehJumlahTagihanSiswa" => $jumlahTagihan));
        $mockUnit = $this->getMockUnitRecord();
        $mockJenisPembayaran = $this->getMockJenisPembayaranRecord();
        $mockSiswa = $this->getMockSiswaRecord();

        $mockTagihanObject = $this->getMockTagihanObject();
        $mockTagihanObject->expects($this->atLeastOnce())->method("setUnitRecord")->with($this->equalTo($mockUnit));
        $mockTagihanObject->expects($this->atLeastOnce())->method("setJenisPembayaranRecord")->with($this->equalTo($mockJenisPembayaran));
        $mockTagihanObject->expects($this->atLeastOnce())->method("setSiswaRecord")->with($this->equalTo($mockSiswa));
        $mockTagihanObject->expects($this->atLeastOnce())->method("setJumlahTagihan")->with($this->equalTo($jumlahTagihan));

        $this->object->setPeninjauComponent($mockPeninjauComponent);
        $returnValue = $this->object->perolehTagihanSiswa($mockUnit, $mockJenisPembayaran, $mockSiswa, $mockTagihanObject);

        return $returnValue;
    }

    /**
     * @group unitTest
     * @group componentObject
     * @depends testPerolehTagihanSiswaSetObjekTagihan
     * @covers PenagihanComponent::perolehTagihanSiswa()
     */
    public function testPerolehTagihanSiswaReturnTrueJikaSukses($returnValue) {
        $this->assertTrue($returnValue);
        $this->assertNull($this->object->getErrorCode());
    }

    private function getMockTagihanObject($waktu = "2014-05-01 00:00:00") {
        /**
         * @todo Implementasi TagihanObject.
         */
        $mock = $this->getMock("TagihanObject", array("setUnitRecord", "setJenisPembayaranRecord", "setSiswaRecord", "setJumlahTagihan", "getWaktu"));
        $mock->expects($this->any())->method("getWaktu")->will($this->returnValue($waktu));

        return $mock;
    }

    private function getMockPeninjauComponent(array $setReturnValues) {
        $returnValues = $this->getReturnValuePeninjauComponent();
        $methods = array_keys($returnValues);

        foreach ($setReturnValues as $methodName => $returnValue) {
            if (array_key_exists($methodName, $returnValues)) {
                $returnValues[$methodName] = $returnValue;
            }
        }

        $mock = $this->getMock("PeninjauComponent", $methods);
        $mock->expects($this->any())->method("siswaAda")->with($this->anything())->will($this->returnValue($returnValues["siswaAda"]));
        $mock->expects($this->any())->method("jenisPembayaranAda")->with($this->anything())->will($this->returnValue($returnValues["jenisPembayaranAda"]));
        $mock->expects($this->any())->method("unitAda")->with($this->anything())->will($this->returnValue($returnValues["unitAda"]));
        $mock->expects($this->any())->method("perolehJumlahTagihanSiswa")->with($this->anything(), $this->anything(), $this->anything())->will($this->returnValue($returnValues["perolehJumlahTagihanSiswa"]));

        return $mock;
    }

    private function getReturnValuePeninjauComponent() {
        $returnValues["siswaAda"] = TRUE;
        $returnValues["jenisPembayaranAda"] = TRUE;
        $returnValues["unitAda"] = TRUE;
        $returnValues["perolehJumlahTagihanSiswa"] = 100000.00000;

        return $returnValues;
    }

    private function getMockUnitRecord(array $setValues = array(), $retrieveReturnValue = TRUE, array $retrieveSetValues = array()) {
        $mock = new MockUnitRecord;
        $values = $this->getValueUnit($setValues);
        $retrieveValues = $this->getRetrieveValueUnit($retrieveSetValues);

        $this->setMock($mock, $values, $retrieveValues, $retrieveReturnValue);

        return $mock;
    }

    private function getMockJenisPembayaranRecord(array $setValues = array(), $retrieveReturnValue = TRUE, array $retrieveSetValues = array()) {
        $mock = new MockJenisPembayaranRecord;
        $values = $this->getValueJenisPembayaran($setValues);
        $retrieveValues = $this->getRetrieveValueJenisPembayaran($retrieveSetValues);

        $this->setMock($mock, $values, $retrieveValues, $retrieveReturnValue);

        return $mock;
    }

    private function getMockSiswaRecord(array $setValues = array(), $retrieveReturnValue = TRUE, array $retrieveSetValues = array()) {
        $mock = new MockSiswaRecord;
        $values = $this->getValueSiswa($setValues);
        $retrieveValues = $this->getRetrieveValueSiswa($retrieveSetValues);

        $this->setMock($mock, $values, $retrieveValues, $retrieveReturnValue);

        return $mock;
    }

    private function setMock($mock, array $values = array(), array $retrieveValues = array(), $retrieveReturnValue = TRUE) {
        $mock->setMockValues($values);
        $mock->setMockRetrieveSetValues($retrieveValues);
        $mock->setMockRetrieveReturnValue($retrieveReturnValue);
    }

    private function getValueUnit(array $setValues = array()) {
        $values["id"] = 4;
        $values["nama"] = "";
        $values["label"] = "";

        $this->setValues($values, $setValues);

        return $values;
    }

    private function getRetrieveValueUnit(array $setValues = array()) {
        $values["id"] = 4;
        $values["nama"] = "SMA";
        $values["label"] = "SMA";

        $this->setValues($values, $setValues);

        return $values;
    }

    private function getValueJenisPembayaran(array $setValues = array()) {
        $values["id"] = 3;
        $values["nama"] = "";
        $values["label"] = "";

        $this->setValues($values, $setValues);

        return $values;
    }

    private function getRetrieveValueJenisPembayaran(array $setValues = array()) {
        $values["id"] = 3;
        $values["nama"] = "SPP";
        $values["label"] = "SPP";

        $this->setValues($values, $setValues);

        return $values;
    }

    private function getValueSiswa(array $setValues = array()) {
        $values["id"] = 1;
        $values["nama"] = "";
        $values["nis"] = "";

        $this->setValues($values, $setValues);

        return $values;
    }

    private function getRetrieveValueSiswa(array $setValues = array()) {
        $values["id"] = 1;
        $values["nama"] = "Andi";
        $values["nis"] = "1415000379";

        $this->setValues($values, $setValues);

        return $values;
    }

    private function setValues(&$values, $setValues) {
        foreach ($setValues as $propertyName => $setValue) {
            if (array_key_exists($propertyName, $values)) {
                $values[$propertyName] = $setValue;
            }
        }
    }

}
