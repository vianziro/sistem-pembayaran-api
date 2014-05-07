<?php

/**
 * Unit test objek DistribusiComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class DistribusiComponentUnitTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new DistribusiComponent;
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerNilaiAlokasiDanTagihan
     * @covers DistribusiComponent::distribusikanAlokasi()
     */
    public function testDistribusikanAlokasiKeTagihan($nilaiAlokasi, $sisaAlokasi, $terdistribusiAlokasi, $nilaiTagihan, $sisaTagihan, $terbayarTagihan, $expected) {
        $mockAlokasiRecordValues = $this->getMockAlokasiRecordValues(array("nilai" => $nilaiAlokasi, "sisa" => $sisaAlokasi, "terdistribusi" => $terdistribusiAlokasi));
        $mockTagihanRecordValues = $this->getMockTagihanRecordValues(array("nilai" => $nilaiTagihan, "sisa" => $sisaTagihan, "terbayar" => $terbayarTagihan));
        $mockDistribusiRecordValues = array();

        $mockAlokasiRecord = $this->getMockAlokasiRecord($mockAlokasiRecordValues);
        $mockTagihanRecord = $this->getMockTagihanRecord($mockTagihanRecordValues);
        $mockDistribusiRecord = $this->getMockDistribusiRecord($mockDistribusiRecordValues);

        $mockAlokasiRecord->setMockRetrieveSetValues($mockAlokasiRecordValues);
        $mockAlokasiRecord->setMockRetrieveReturnValue(TRUE);

        $mockTagihanRecord->setMockRetrieveSetValues($mockTagihanRecordValues);
        $mockTagihanRecord->setMockRetrieveReturnValue(TRUE);

        $returnValue = $this->object->distribusikanAlokasi($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord);
        $this->assertDistribusikanAlokasiKeTagihan($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord, $expected, $returnValue);
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers DistribusiComponent::distribusikanAlokasi()
     */
    public function testDistribusikanAlokasiKeTagihanKosong() {
        $mockAlokasiRecordValues = $this->getMockAlokasiRecordValues(array("nilai" => 100.00000, "sisa" => 100.00000, "terdistribusi" => 0.00000));
        $mockTagihanRecordValues = $this->getMockTagihanRecordValues(array("id" => NULL));
        $mockDistribusiRecordValues = array();

        $mockAlokasiRecord = $this->getMockAlokasiRecord($mockAlokasiRecordValues);
        $mockTagihanRecord = $this->getMockTagihanRecord($mockTagihanRecordValues);
        $mockDistribusiRecord = $this->getMockDistribusiRecord($mockDistribusiRecordValues);

        $returnValue = $this->object->distribusikanAlokasi($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord);
        $this->assertDistribusikanAlokasiKeTagihanKosong($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord, $returnValue);
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers DistribusiComponent::distribusikanAlokasi()
     */
    public function testDistribusikanAlokasiReturnFalseJikaTagihanTidakAda() {
        $mockAlokasiRecordValues = $this->getMockAlokasiRecordValues();
        $mockTagihanRecordValues = $this->getMockTagihanRecordValues();
        $mockDistribusiRecordValues = array();

        $mockAlokasiRecord = $this->getMockAlokasiRecord($mockAlokasiRecordValues);
        $mockTagihanRecord = $this->getMockTagihanRecord($mockTagihanRecordValues);
        $mockDistribusiRecord = $this->getMockDistribusiRecord($mockDistribusiRecordValues);

        $mockTagihanRecord->setMockRetrieveReturnValue(FALSE);

        $returnValue = $this->object->distribusikanAlokasi($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord);
        $this->assertFalse($returnValue);
        $this->assertEquals("TAGIHAN_TIDAK_ADA", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerIdTagihan
     * @covers DistribusiComponent::distribusikanAlokasi()
     */
    public function testDistribusikanAlokasiReturnFalseJikaAlokasiTidakAda($idTagihan) {
        $mockAlokasiRecordValues = $this->getMockAlokasiRecordValues();
        $mockTagihanRecordValues = $this->getMockTagihanRecordValues(array("id" => $idTagihan));
        $mockDistribusiRecordValues = array();

        $mockAlokasiRecord = $this->getMockAlokasiRecord($mockAlokasiRecordValues);
        $mockTagihanRecord = $this->getMockTagihanRecord($mockTagihanRecordValues);
        $mockDistribusiRecord = $this->getMockDistribusiRecord($mockDistribusiRecordValues);

        $mockAlokasiRecord->setMockRetrieveReturnValue(FALSE);

        $returnValue = $this->object->distribusikanAlokasi($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord);
        $this->assertFalse($returnValue);
        $this->assertEquals("ALOKASI_TIDAK_ADA", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerIdTagihan
     * @covers DistribusiComponent::distribusikanAlokasi()
     */
    public function testDistribusiAlokasiReturnFalseJikaAlokasiTidakTersimpan($idTagihan) {
        $mockAlokasiRecordValues = $this->getMockAlokasiRecordValues();
        $mockTagihanRecordValues = $this->getMockTagihanRecordValues(array("id" => $idTagihan));
        $mockDistribusiRecordValues = array();

        $mockAlokasiRecord = $this->getMockAlokasiRecord($mockAlokasiRecordValues);
        $mockTagihanRecord = $this->getMockTagihanRecord($mockTagihanRecordValues);
        $mockDistribusiRecord = $this->getMockDistribusiRecord($mockDistribusiRecordValues);

        $mockAlokasiRecord->setMockPersistReturnValue(FALSE);

        $returnValue = $this->object->distribusikanAlokasi($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord);
        $this->assertFalse($returnValue);
        $this->assertEquals("ALOKASI_TIDAK_TERSIMPAN", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers DistribusiComponent::distribusikanAlokasi()
     */
    public function testDistribusiAlokasiReturnFalseJikaTagihanTidakTersimpan() {
        $mockAlokasiRecordValues = $this->getMockAlokasiRecordValues();
        $mockTagihanRecordValues = $this->getMockTagihanRecordValues(array("id" => 1));
        $mockDistribusiRecordValues = array();

        $mockAlokasiRecord = $this->getMockAlokasiRecord($mockAlokasiRecordValues);
        $mockTagihanRecord = $this->getMockTagihanRecord($mockTagihanRecordValues);
        $mockDistribusiRecord = $this->getMockDistribusiRecord($mockDistribusiRecordValues);

        $mockTagihanRecord->setMockPersistReturnValue(FALSE);

        $returnValue = $this->object->distribusikanAlokasi($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord);
        $this->assertFalse($returnValue);
        $this->assertEquals("TAGIHAN_TIDAK_TERSIMPAN", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerIdTagihan
     * @covers DistribusiComponent::distribusikanAlokasi()
     */
    public function testDistribusiAlokasiReturnFalseJikaDistribusiTidakTersimpan($idTagihan) {
        $mockAlokasiRecordValues = $this->getMockAlokasiRecordValues();
        $mockTagihanRecordValues = $this->getMockTagihanRecordValues(array("id" => $idTagihan));
        $mockDistribusiRecordValues = array();

        $mockAlokasiRecord = $this->getMockAlokasiRecord($mockAlokasiRecordValues);
        $mockTagihanRecord = $this->getMockTagihanRecord($mockTagihanRecordValues);
        $mockDistribusiRecord = $this->getMockDistribusiRecord($mockDistribusiRecordValues);

        $mockDistribusiRecord->setMockPersistReturnValue(FALSE);

        $returnValue = $this->object->distribusikanAlokasi($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord);
        $this->assertFalse($returnValue);
        $this->assertEquals("DISTRIBUSI_TIDAK_TERSIMPAN", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers DistribusiComponent::distribusikanAlokasi()
     */
    public function testDistribusiAlokasiTidakUpdateDistribusiJikaAdaIdDistribusiTetapiInsertRecordBaru() {
        $mockAlokasiRecordValues = $this->getMockAlokasiRecordValues();
        $mockTagihanRecordValues = $this->getMockTagihanRecordValues();
        $mockDistribusiRecordValues = array("id" => 1);

        $mockAlokasiRecord = $this->getMockAlokasiRecord($mockAlokasiRecordValues);
        $mockTagihanRecord = $this->getMockTagihanRecord($mockTagihanRecordValues);
        $mockDistribusiRecord = $this->getMockDistribusiRecord($mockDistribusiRecordValues);

        $returnValue = $this->object->distribusikanAlokasi($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord);
        $this->assertTrue($returnValue);
        $this->assertEquals(0, $mockDistribusiRecord->getMockPersistUpdateCallCount());
        $this->assertEquals(1, $mockDistribusiRecord->getMockPersistInsertCallCount());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerPulangkanDistribusi
     * @covers DistribusiComponent::pulangkanDistribusi()
     */
    public function testPulangkanDistribusiKeAlokasi($mockAlokasiValues, $mockDistribusiValues, $expected) {
        $mockDistribusiRecord = $this->getMockDistribusiRecord($mockDistribusiValues);
        $mockAlokasiRecord = $this->getMockAlokasiRecord($mockAlokasiValues);

        $returnValue = $this->object->pulangkanDistribusi($mockDistribusiRecord, $mockAlokasiRecord);

        $this->assertEquals($expected["sisaAlokasi"], $mockAlokasiRecord->getSisa());
        $this->assertEquals($expected["terdistribusiAlokasi"], $mockAlokasiRecord->getTerdistribusi());
        $this->assertEquals(0.00000, $mockDistribusiRecord->getNilai());
        $this->assertEquals($mockDistribusiRecord->getIdAlokasi(), $mockAlokasiRecord->getId());
        $this->assertTrue($returnValue);
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers DistribusiComponent::pulangkanDistribusi()
     */
    public function testPulangkanDistribusiMenyimpanDataDenganBenar() {
        $mockDistribusiRetrieveValues = $this->getMockDistribusiRecordValues(array("nilai" => 100.00000));
        $mockAlokasiRetrieveValues = $this->getMockAlokasiRecordValues(array("nilai" => 100.00000, "sisa" => 0.00000, "terdistribusi" => 100.00000));

        $mockDistribusiRecord = $this->getMockDistribusiRecord(array("id" => $mockDistribusiRetrieveValues["id"], "nilai" => 100.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $mockDistribusiRecord->setMockRetrieveSetValues($mockDistribusiRetrieveValues);
        $mockDistribusiRecord->setMockRetrieveReturnValue(TRUE);

        $mockAlokasiRecord->setMockRetrieveSetValues($mockAlokasiRetrieveValues);
        $mockAlokasiRecord->setMockRetrieveReturnValue(TRUE);

        $this->object->pulangkanDistribusi($mockDistribusiRecord, $mockAlokasiRecord);

        $this->assertGreaterThanOrEqual(1, $mockDistribusiRecord->getMockPersistUpdateCallCount());
        $this->assertEquals(0, $mockDistribusiRecord->getMockPersistInsertCallCount());
        $this->assertGreaterThanOrEqual(1, $mockAlokasiRecord->getMockPersistUpdateCallCount());
        $this->assertEquals(0, $mockAlokasiRecord->getMockPersistInsertCallCount());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers DistribusiComponent::pulangkanDistribusi()
     */
    public function testPulangkanDistribusiReturnFalseJikaDistribusiTidakAda() {
        $mockDistribusiRetrieveValues = $this->getMockDistribusiRecordValues(array("nilai" => 100.00000));
        $mockAlokasiRetrieveValues = $this->getMockAlokasiRecordValues(array("nilai" => 100.00000, "sisa" => 0.00000, "terdistribusi" => 100.00000));

        $mockDistribusiRecord = $this->getMockDistribusiRecord(array("id" => $mockDistribusiRetrieveValues["id"], "nilai" => 100.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $mockDistribusiRecord->setMockRetrieveSetValues($mockDistribusiRetrieveValues);
        $mockDistribusiRecord->setMockRetrieveReturnValue(FALSE);

        $mockAlokasiRecord->setMockRetrieveSetValues($mockAlokasiRetrieveValues);
        $mockAlokasiRecord->setMockRetrieveReturnValue(TRUE);

        $returnValue = $this->object->pulangkanDistribusi($mockDistribusiRecord, $mockAlokasiRecord);

        $this->assertFalse($returnValue);
        $this->assertEquals("DISTRIBUSI_TIDAK_ADA", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers DistribusiComponent::pulangkanDistribusi()
     */
    public function testPulangkanDistribusiReturnFalseJikaAlokasiTidakAda() {
        $mockDistribusiRetrieveValues = $this->getMockDistribusiRecordValues(array("nilai" => 100.00000));
        $mockAlokasiRetrieveValues = $this->getMockAlokasiRecordValues(array("nilai" => 100.00000, "sisa" => 0.00000, "terdistribusi" => 100.00000));

        $mockDistribusiRecord = $this->getMockDistribusiRecord(array("id" => $mockDistribusiRetrieveValues["id"], "nilai" => 100.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $mockDistribusiRecord->setMockRetrieveSetValues($mockDistribusiRetrieveValues);
        $mockDistribusiRecord->setMockRetrieveReturnValue(TRUE);

        $mockAlokasiRecord->setMockRetrieveSetValues($mockAlokasiRetrieveValues);
        $mockAlokasiRecord->setMockRetrieveReturnValue(FALSE);

        $returnValue = $this->object->pulangkanDistribusi($mockDistribusiRecord, $mockAlokasiRecord);

        $this->assertFalse($returnValue);
        $this->assertEquals("ALOKASI_TIDAK_ADA", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers DistribusiComponent::pulangkanDistribusi()
     */
    public function testPulangkanDistribusiReturnFalseJikaDistribusiGagalUpdate() {
        $mockDistribusiRetrieveValues = $this->getMockDistribusiRecordValues(array("nilai" => 100.00000));
        $mockAlokasiRetrieveValues = $this->getMockAlokasiRecordValues(array("nilai" => 100.00000, "sisa" => 0.00000, "terdistribusi" => 100.00000));

        $mockDistribusiRecord = $this->getMockDistribusiRecord(array("id" => $mockDistribusiRetrieveValues["id"], "nilai" => 100.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $mockDistribusiRecord->setMockRetrieveSetValues($mockDistribusiRetrieveValues);
        $mockDistribusiRecord->setMockRetrieveReturnValue(TRUE);
        $mockDistribusiRecord->setMockPersistReturnValue(FALSE);

        $mockAlokasiRecord->setMockRetrieveSetValues($mockAlokasiRetrieveValues);
        $mockAlokasiRecord->setMockRetrieveReturnValue(TRUE);

        $returnValue = $this->object->pulangkanDistribusi($mockDistribusiRecord, $mockAlokasiRecord);

        $this->assertFalse($returnValue);
        $this->assertEquals("DISTRIBUSI_TIDAK_TERSIMPAN", $this->object->getErrorCode());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers DistribusiComponent::pulangkanDistribusi()
     */
    public function testPulangkanDistribusiReturnFalseJikaAlokasiGagalUpdate() {
        $mockDistribusiRetrieveValues = $this->getMockDistribusiRecordValues(array("nilai" => 100.00000));
        $mockAlokasiRetrieveValues = $this->getMockAlokasiRecordValues(array("nilai" => 100.00000, "sisa" => 0.00000, "terdistribusi" => 100.00000));

        $mockDistribusiRecord = $this->getMockDistribusiRecord(array("id" => $mockDistribusiRetrieveValues["id"], "nilai" => 100.00000));
        $mockAlokasiRecord = $this->getMockAlokasiRecord(array());

        $mockDistribusiRecord->setMockRetrieveSetValues($mockDistribusiRetrieveValues);
        $mockDistribusiRecord->setMockRetrieveReturnValue(TRUE);

        $mockAlokasiRecord->setMockRetrieveSetValues($mockAlokasiRetrieveValues);
        $mockAlokasiRecord->setMockRetrieveReturnValue(TRUE);
        $mockAlokasiRecord->setMockPersistReturnValue(FALSE);

        $returnValue = $this->object->pulangkanDistribusi($mockDistribusiRecord, $mockAlokasiRecord);

        $this->assertFalse($returnValue);
        $this->assertEquals("ALOKASI_TIDAK_TERSIMPAN", $this->object->getErrorCode());
    }

    public function providerNilaiAlokasiDanTagihan() {
        return array(
            array(110.00000, 110.00000, 0.00000, 100.00000, 100.00000, 0.00000, array("sisaAlokasi" => 10.00000, "terdistribusiAlokasi" => 100.00000, "nilaiDistribusi" => 100.00000, "sisaTagihan" => 0.00000, "terbayarTagihan" => 100.00000)),
            array(100.00000, 100.00000, 0.00000, 100.00000, 100.00000, 0.00000, array("sisaAlokasi" => 0.00000, "terdistribusiAlokasi" => 100.00000, "nilaiDistribusi" => 100.00000, "sisaTagihan" => 0.00000, "terbayarTagihan" => 100.00000)),
            array(90.00000, 90.00000, 0.00000, 100.00000, 100.00000, 0.00000, array("sisaAlokasi" => 0.00000, "terdistribusiAlokasi" => 90.00000, "nilaiDistribusi" => 90.00000, "sisaTagihan" => 10.00000, "terbayarTagihan" => 90.00000)),
            array(110.00000, 60.00000, 50.00000, 100.00000, 100.00000, 0.00000, array("sisaAlokasi" => 0.00000, "terdistribusiAlokasi" => 110.00000, "nilaiDistribusi" => 60.00000, "sisaTagihan" => 40.00000, "terbayarTagihan" => 60.00000))
        );
    }

    public function providerIdTagihan() {
        return array(
            array(1),
            array(NULL)
        );
    }

    public function providerPulangkanDistribusi() {
        return array(
            array(
                array("id" => 7, "nilai" => 100.00000, "sisa" => 0.00000, "terdistribusi" => 100.00000),
                array("idAlokasi" => 7, "nilai" => 100.00000),
                array("sisaAlokasi" => 100.00000, "terdistribusiAlokasi" => 0.00000)
            ),
            array(
                array("id" => 7, "nilai" => 100.00000, "sisa" => 30.00000, "terdistribusi" => 70.00000),
                array("idAlokasi" => 71, "nilai" => 70.00000),
                array("sisaAlokasi" => 100.00000, "terdistribusiAlokasi" => 0.00000)
            ),
            array(
                array("id" => 7, "nilai" => 100.00000, "sisa" => 30.00000, "terdistribusi" => 70.00000),
                array("idAlokasi" => 7, "nilai" => 10.00000),
                array("sisaAlokasi" => 40.00000, "terdistribusiAlokasi" => 60.00000)
            )
        );
    }

    private function assertDistribusikanAlokasiKeTagihan($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord, $expected, $returnValue) {
        $this->assertEquals($expected["sisaAlokasi"], $mockAlokasiRecord->getSisa());
        $this->assertEquals($expected["terdistribusiAlokasi"], $mockAlokasiRecord->getTerdistribusi());
        $this->assertGreaterThanOrEqual(1, $mockAlokasiRecord->getMockPersistUpdateCallCount());
        $this->assertEquals(0, $mockAlokasiRecord->getMockPersistInsertCallCount());

        $this->assertEquals($mockAlokasiRecord->getId(), $mockDistribusiRecord->getIdAlokasi());
        $this->assertEquals($mockTagihanRecord->getId(), $mockDistribusiRecord->getIdTagihan());
        $this->assertEquals($expected["nilaiDistribusi"], $mockDistribusiRecord->getNilai());
        $this->assertEquals(1, $mockDistribusiRecord->getMockPersistInsertCallCount());
        $this->assertEquals(0, $mockDistribusiRecord->getMockPersistUpdateCallCount());

        $this->assertEquals($expected["sisaTagihan"], $mockTagihanRecord->getSisa());
        $this->assertEquals($expected["terbayarTagihan"], $mockTagihanRecord->getTerbayar());
        $this->assertGreaterThanOrEqual(1, $mockTagihanRecord->getMockPersistUpdateCallCount());
        $this->assertEquals(0, $mockTagihanRecord->getMockPersistInsertCallCount());

        $this->assertTrue($returnValue);
    }

    private function assertDistribusikanAlokasiKeTagihanKosong($mockAlokasiRecord, $mockTagihanRecord, $mockDistribusiRecord, $returnValue) {
        $this->assertEquals(0.00000, $mockAlokasiRecord->getSisa());
        $this->assertEquals(100.00000, $mockAlokasiRecord->getTerdistribusi());
        $this->assertGreaterThanOrEqual(1, $mockAlokasiRecord->getMockPersistUpdateCallCount());
        $this->assertEquals(0, $mockAlokasiRecord->getMockPersistInsertCallCount());

        $this->assertEquals($mockAlokasiRecord->getId(), $mockDistribusiRecord->getIdAlokasi());
        $this->assertNull($mockDistribusiRecord->getIdTagihan());
        $this->assertEquals(100.00000, $mockDistribusiRecord->getNilai());
        $this->assertEquals(1, $mockDistribusiRecord->getMockPersistInsertCallCount());
        $this->assertEquals(0, $mockDistribusiRecord->getMockPersistUpdateCallCount());

        $this->assertEquals(0, $mockTagihanRecord->getMockPersistUpdateCallCount());
        $this->assertEquals(0, $mockTagihanRecord->getMockPersistInsertCallCount());

        $this->assertTrue($returnValue);
    }

    private function getMockAlokasiRecord(array $values = array()) {
        $mock = new MockAlokasiRecord;
        $mock->setMockInsertId(1);
        $mock->setMockPersistReturnValue(TRUE);
        $mock->setMockValues($values);

        return $mock;
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

    private function getMockDistribusiRecordValues(array $setValues = array()) {
        $values["id"] = 1;
        $values["idAlokasi"] = 1;
        $values["idTagihan"] = 1;
        $values["nilai"] = 100000.00000;

        foreach ($setValues as $propertyName => $value) {
            if (array_key_exists($propertyName, $values)) {
                $values[$propertyName] = $value;
            }
        }

        return $values;
    }

    private function getMockAlokasiRecordValues(array $setValues = array()) {
        $values["id"] = 1;
        $values["idTransaksi"] = 1;
        $values["idSiswa"] = 1;
        $values["idUnit"] = 4;
        $values["idJenisPembayaran"] = 3;
        $values["nilai"] = 100000.00000;
        $values["sisa"] = 100000.00000;
        $values["terdistribusi"] = 0.00000;

        foreach ($setValues as $propertyName => $value) {
            if (array_key_exists($propertyName, $values)) {
                $values[$propertyName] = $value;
            }
        }

        return $values;
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

}
