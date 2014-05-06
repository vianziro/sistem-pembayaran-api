<?php

/**
 * Integration test PenagihanComponent dengan PeninjauComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class PenagihanComponentCallPeninjauComponentIntegrationTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;
    private $calledObject = NULL;
    private $seq = 1;

    public function setUp() {
        parent::setUp();
        $this->object = new PenagihanComponent;
        $this->calledObject = new PeninjauComponent;

        $this->object->setPeninjauComponent($this->calledObject);
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers PenagihanComponent::perolehTagihanSiswa()
     * @covers PeninjauComponent::perolehJumlahTagihanSiswa()
     */
    public function testPerolehTagihanSiswaMemperolehJumlahTagihanDariKomponenPeninjau() {
        $jumlahTagihan = 100000.00000;

        $mockUnit = $this->getMockUnitRecord();
        $mockJenisPembayaran = $this->getMockJenisPembayaranRecord();
        $mockSiswa = $this->getMockSiswaRecord();
        $mockTagihanObject = $this->getMockTagihanObject();
        $mockPDO = $this->getMockPDO(array("sum_result" => $jumlahTagihan));

        $mockTagihanObject->expects($this->atLeastOnce())->method("setJumlahTagihan")->with($this->equalTo($jumlahTagihan));

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);

        $returnValue = $this->object->perolehTagihanSiswa($mockUnit, $mockJenisPembayaran, $mockSiswa, $mockTagihanObject);
        $errorCode = $this->object->getErrorCode();

        return array("returnValue" => $returnValue, "errorCode" => $errorCode);
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @depends testPerolehTagihanSiswaMmeperolehJumlahTagihanDariKomponenPeninjau
     * @covers PenagihanComponent::perolehTagihanSiswa()
     * @covers PeninjauComponent::perolehJumlahTagihanSiswa()
     */
    public function testPerolehTagihanSiswaReturnTrueJikaSukses($data) {
        $this->assertTrue($data["returnValue"]);
        $this->assertNull($data["errorCode"]);
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

    private function getMockTagihanObject($waktu = "2014-05-01 00:00:00") {
        $mock = $this->getMock("TagihanObject", array("setUnitRecord", "setJenisPembayaranRecord", "setSiswaRecord", "setJumlahTagihan", "getWaktu"));
        $mock->expects($this->any())->method("getWaktu")->will($this->returnValue($waktu));

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

    private function getMockPDO($fetchReturnValue = array(), $failPoint = "") {
        $mockPDOStatement = $this->getMock("PDOStatement", array("execute", "fetch", "closeCursor"));
        $mockPDO = $this->getMock("MockPDO", array("prepare"));

        $this->expectsMockPDO($mockPDO, $mockPDOStatement, $fetchReturnValue, $failPoint);

        return $mockPDO;
    }

    private function expectsMockPDO($mockPDO, $mockPDOStatement, $fetchReturnValue = array(), $failPoint = "") {
        if ($failPoint == "execute") {
            $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(FALSE));
        } else {
            $mockPDOStatement->expects($this->any())->method("execute")->with($this->isType("array"))->will($this->returnValue(TRUE));
        }

        if ($failPoint == "fetch") {
            $mockPDOStatement->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue(FALSE));
        } else {
            $mockPDOStatement->expects($this->any())->method("fetch")->with($this->equalTo(PDO::FETCH_ASSOC))->will($this->returnValue($fetchReturnValue));
        }

        if ($failPoint == "closeCursor") {
            $mockPDOStatement->expects($this->any())->method("closeCursor")->will($this->returnValue(FALSE));
        } else {
            $mockPDOStatement->expects($this->any())->method("closeCursor")->will($this->returnValue(TRUE));
        }

        if ($failPoint == "prepare") {
            $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue(FALSE));
        } else {
            $mockPDO->expects($this->any())->method("prepare")->with($this->isType("string"))->will($this->returnValue($mockPDOStatement));
        }
    }

}
