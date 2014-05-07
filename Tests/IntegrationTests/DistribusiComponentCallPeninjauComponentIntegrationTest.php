<?php

/**
 * Integration test PenagihanComponent dengan PeninjauComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class DistribusiComponentCallPeninjauComponentIntegrationTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;
    private $calledObject = NULL;
    private $seq = 1;

    public function setUp() {
        parent::setUp();
        $this->object = new DistribusiComponent;
        $this->calledObject = new PeninjauComponent;

        $this->object->setPeninjauComponent($this->calledObject);
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers DistribusiComponent::perolehTagihanTerlama()
     * @covers PeninjauComponent::perolehIdTagihanTerlama()
     */
    public function testPerolehTagihanTerlamaMenerimaIdTagihanTerlamaDariKomponenPeninjau() {
        $id = 7;
        $idUnit = 4;
        $idJenisPembayaran = 3;
        $idSiswa = 1;
        $fetchReturnValue = array("id" => $id);
        $mockTagihanRecordRetrieveValues = $this->getMockTagihanRecordValues(array("id" => $id, "idUnit" => $idUnit, "idJenisPembayaran" => $idJenisPembayaran, "idSiswa" => $idSiswa));

        $mockPDO = $this->getMockPDO($fetchReturnValue);
        $mockTagihanRecord = $this->getMockTagihanRecord(array("id" => NULL, "idUnit" => $idUnit, "idJenisPembayaran" => $idJenisPembayaran, "idSiswa" => $idSiswa));
        $mockTagihanRecord->setMockRetrieveSetValues($mockTagihanRecordRetrieveValues);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);
        $returnValue = $this->object->perolehTagihanTerlama($mockTagihanRecord);

        $this->assertEquals($id, $mockTagihanRecord->getId());
        $this->assertTrue($returnValue);
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers DistribusiComponent::perolehDistribusiSisaTerlama()
     * @covers PeninjauComponent::perolehIdDistribusiSisaTerlama()
     */
    public function testPerolehDistribusiSisaTerlamaMenerimaIdDistribusiSisaTerlamaDariKomponenPeninjau() {
        $id = 7;
        $idUnit = 4;
        $idJenisPembayaran = 3;
        $idSiswa = 1;
        $fetchReturnValue = array("id" => $id);
        $mockDistribusiRecordRetrieveValues = array("id" => $id, "idAlokasi" => 1, "idTagihan" => NULL, "nilai" => 100.00000);

        $mockPDO = $this->getMockPDO($fetchReturnValue);
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array("id" => 1, "idUnit" => $idUnit, "idJenisPembayaran" => $idJenisPembayaran, "idSiswa" => $idSiswa));
        $mockDistribusiRecord = $this->getMockDistribusiRecord(array("id" => NULL));
        $mockDistribusiRecord->setMockRetrieveSetValues($mockDistribusiRecordRetrieveValues);

        $this->calledObject->setPDO($mockPDO);
        $this->object->setPeninjauComponent($this->calledObject);
        $returnValue = $this->object->perolehDistribusiSisaTerlama($mockAlokasiRecord, $mockDistribusiRecord);

        $this->assertEquals($id, $mockDistribusiRecord->getId());
        $this->assertTrue($returnValue);
    }

    private function getMockTagihanRecord(array $values = array()) {
        $mock = new MockTagihanRecord;
        $mock->setMockInsertId(1);
        $mock->setMockPersistReturnValue(TRUE);
        $mock->setMockValues($values);

        return $mock;
    }

    private function getMockDistribusiRecord(array $values = array()) {
        $mock = new MockDistribusiRecord;
        $mock->setMockInsertId(1);
        $mock->setMockPersistReturnValue(TRUE);
        $mock->setMockValues($values);

        return $mock;
    }

    private function getMockAlokasiRecord(array $values = array()) {
        $mock = new MockAlokasiRecord;
        $mock->setMockInsertId(1);
        $mock->setMockPersistReturnValue(TRUE);
        $mock->setMockValues($values);

        return $mock;
    }

    private function getMockTagihanRecordValues(array $setValues = array()) {
        $values = array(
            "id" => 1,
            "waktu_tagihan" => "2014-03-01 00:00:00",
            "id_tahun_ajaran" => 1,
            "id_siswa" => 1,
            "id_bulan" => 9,
            "id_jenis_pembayaran" => 3,
            "nilai" => 100000.00000,
            "terbayar" => 0.00000,
            "sisa" => 100000.00000,
            "id_unit" => 4,
            "id_program" => 1,
            "id_jurusan" => 1,
            "id_tingkat" => 15,
            "id_kelas" => 45
        );

        foreach ($setValues as $propertyName => $value) {
            if (array_key_exists($propertyName, $values)) {
                $values[$propertyName] = $value;
            }
        }

        return $values;
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
