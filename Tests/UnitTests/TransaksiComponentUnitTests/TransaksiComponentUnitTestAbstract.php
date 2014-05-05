<?php

/**
 * Unit test objek TransaksiComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TransaksiComponentUnitTestAbstract extends PHPUnit_Framework_TestCase {

    protected $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new TransaksiComponent;
        $this->object->setPeninjauComponent($this->getMockPeninjauComponent(array()));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers TransaksiComponent::setPeninjauComponent()
     * @covers TransaksiComponent::getPeninjauComponent()
     * @covers TransaksiComponent::unsetPeninjauComponent()
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

    public function providerNilaiAlokasiRecord() {
        return array(
            array(-1.00000, FALSE, "FALSE jika nilai kurang dari nol"),
            array(0.00000, FALSE, "FALSE jika nilai nol")
        );
    }

    public function providerNilaiTransaksiRecord() {
        return array(
            array(-1.00000, FALSE, "FALSE jika nilai kurang dari nol"),
            array(0.00000, FALSE, "FALSE jika nilai nol")
        );
    }

    public function providerMetode() {
        return array(
            array("OFFLINE", TRUE, NULL, "TRUE jika metode OFFLINE."),
            array("ONLINE", TRUE, NULL, "TRUE jika metode ONLINE."),
            array("AIRLINE", FALSE, "METODE_TIDAK_DIKETAHUI", "FALSE jika metode selain OFFLINE atau selain ONLINE.")
        );
    }

    public function providerTestSkipNull() {
        return array(
            array(1, 2, 3, 3),
            array(NULL, 2, 3, 2),
            array(1, NULL, 3, 2),
            array(1, 2, NULL, 2),
            array(NULL, NULL, 3, 1),
            array(NULL, 2, NULL, 1),
            array(NULL, NULL, NULL, 0)
        );
    }

    protected function getArrayMockAlokasiRecordOneIsNotNull() {
        return array(
            $this->getMockAlokasiRecordNotNull(1),
            $this->getMockAlokasiRecordNull(),
            $this->getMockAlokasiRecordNull(),
        );
    }

    protected function getArrayMockAlokasiRecordNull() {
        return array(
            $this->getMockAlokasiRecordNull(),
            $this->getMockAlokasiRecordNull(),
            $this->getMockAlokasiRecordNull(),
        );
    }

    protected function getMockAlokasiRecordNotNull($id) {
        $mock = $this->getMockAlokasiRecord(array("id" => $id, "nilai" => 1.00000, "sisa" => 1.00000, "terdistribusi" => 0.00000));
        return $mock;
    }

    protected function getMockAlokasiRecordNull() {
        $mock = $this->getMockAlokasiRecord(array("id" => NULL, "nilai" => 1.00000, "sisa" => 1.00000, "terdistribusi" => 0.00000));
        return $mock;
    }

    protected function getMockTransaksiRecord(array $setValues) {
        $values = $this->getValueTransaksi();
        $methods = $this->getSetterGetterUnsetterMethods($values);
        $this->setValues($setValues, $values);

        $methods[] = "persist";
        $additionalReturnValues["persist"] = array_key_exists("persist", $setValues) ? $setValues["persist"] : TRUE;

        $mock = $this->createMock("TransaksiRecord", $methods, $values);
        $mock->expects($this->any())->method("persist")->will($this->returnValue($additionalReturnValues["persist"]));

        return $mock;
    }

    protected function getValueTransaksi() {
        $values["id"] = NULL;
        $values["jenis"] = "TRANSAKSI";
        $values["kategori"] = "PEMBAYARAN";
        $values["metode"] = "ONLINE";
        $values["batal"] = FALSE;
        $values["waktuTransaksi"] = "2014-04-30 00:00:00";
        $values["waktuLaporan"] = "2014-04-30 00:00:00";
        $values["waktuEntri"] = "2014-04-30 00:00:00";
        $values["idRekening"] = 1;
        $values["idKasir"] = 1;
        $values["nomorTransaksi"] = "T001";
        $values["nomorReferensi"] = "R001";
        $values["nilai"] = 1.00000;

        return $values;
    }

    protected function getMockAlokasiRecord(array $setValues) {
        $values = $this->getValueAlokasi();
        $methods = $this->getSetterGetterUnsetterMethods($values);
        $this->setValues($setValues, $values);

        $methods[] = "persist";
        $additionalReturnValues["persist"] = array_key_exists("persist", $setValues) ? $setValues["persist"] : TRUE;

        $mock = $this->createMock("AlokasiRecord", $methods, $values);
        $mock->expects($this->any())->method("persist")->will($this->returnValue($additionalReturnValues["persist"]));

        return $mock;
    }

    protected function getValueAlokasi() {
        $values["id"] = NULL;
        $values["idTransaksi"] = NULL;
        $values["idSiswa"] = 1;
        $values["idUnit"] = 1;
        $values["idJenisPembayaran"] = 1;
        $values["nilai"] = 1.00000;
        $values["sisa"] = 1.00000;
        $values["terdistribusi"] = 0.00000;

        return $values;
    }

    protected function setValues($setValues, &$values) {
        foreach ($setValues as $key => $value) {
            if (array_key_exists($key, $values)) {
                $values[$key] = $value;
            }
        }
    }

    protected function getSetterGetterUnsetterMethods($values) {
        $methods = array();

        foreach (array_keys($values) as $propertyName) {
            $methods[] = "set" . ucfirst($propertyName);
            $methods[] = "get" . ucfirst($propertyName);
            $methods[] = "unset" . ucfirst($propertyName);
        }

        return $methods;
    }

    protected function createMock($name, $methods, $values) {
        $mock = $this->getMock($name, $methods);

        foreach ($values as $propertyName => $value) {
            $mock->expects($this->any())->method("get" . ucfirst($propertyName))->will($this->returnValue($value));
        }

        return $mock;
    }

    protected function getMockPeninjauComponent(array $setReturnValues, array $excludeExpects = array()) {
        $returnValues = $this->getReturnValuePeninjauComponent();
        $methods = array_keys($returnValues);

        foreach ($setReturnValues as $methodName => $returnValue) {
            if (array_key_exists($methodName, $returnValues)) {
                $returnValues[$methodName] = $returnValue;
            }
        }

        $mock = $this->getMock("PeninjauComponent", $methods);
        $mock->expects($this->any())->method("nomorTransaksiAda")->with($this->anything(), $this->anything())->will($this->returnValue($returnValues["nomorTransaksiAda"]));
        $mock->expects($this->any())->method("nomorReferensiAda")->with($this->anything(), $this->anything())->will($this->returnValue($returnValues["nomorReferensiAda"]));

        if (!array_key_exists("rekeningAda", $excludeExpects)) {
            $mock->expects($this->any())->method("rekeningAda")->with($this->anything())->will($this->returnValue($returnValues["rekeningAda"]));
        }

        $mock->expects($this->any())->method("kasirAda")->with($this->anything())->will($this->returnValue($returnValues["kasirAda"]));
        $mock->expects($this->any())->method("siswaAda")->with($this->anything())->will($this->returnValue($returnValues["siswaAda"]));
        $mock->expects($this->any())->method("jenisPembayaranAda")->with($this->anything())->will($this->returnValue($returnValues["jenisPembayaranAda"]));
        $mock->expects($this->any())->method("unitAda")->with($this->anything())->will($this->returnValue($returnValues["unitAda"]));
        $mock->expects($this->any())->method("hitungBanyaknyaAlokasi")->with($this->anything())->will($this->returnValue($returnValues["hitungBanyaknyaAlokasi"]));

        return $mock;
    }

    protected function getReturnValuePeninjauComponent() {
        $returnValues["nomorTransaksiAda"] = FALSE;
        $returnValues["nomorReferensiAda"] = FALSE;
        $returnValues["rekeningAda"] = TRUE;
        $returnValues["kasirAda"] = TRUE;
        $returnValues["siswaAda"] = TRUE;
        $returnValues["jenisPembayaranAda"] = TRUE;
        $returnValues["unitAda"] = TRUE;
        $returnValues["hitungBanyaknyaAlokasi"] = 3;

        return $returnValues;
    }

    protected function getMockTransaksiInputBatal(array $setValues = array(), array $setRetrieveValues = array(), $setRetrieveReturnValue = TRUE) {
        $values["id"] = 7;
        $values["batal"] = 0;

        foreach ($setValues as $propertyName => $setValue) {
            if (array_key_exists($propertyName, $values)) {
                $values[$propertyName] = $setValue;
            }
        }

        $retrieveValues = $this->getDefaultRetrieveValuesTransaksiRecord($values);

        foreach ($setRetrieveValues as $propertyName => $setValue) {
            if (array_key_exists($propertyName, $retrieveValues)) {
                $retrieveValues[$propertyName] = $setValue;
            }
        }

        $mock = new MockTransaksiRecord;
        $mock->setMockValues($values);
        $mock->setMockRetrieveSetValues($retrieveValues);
        $mock->setMockRetrieveReturnValue($setRetrieveReturnValue);

        return $mock;
    }

    protected function getDefaultRetrieveValuesTransaksiRecord(array $values = array("id" => 7)) {
        $retrieveValues = array();
        $retrieveValues["id"] = $values["id"];
        $retrieveValues["jenis"] = "TRANSAKSI";
        $retrieveValues["kategori"] = "PEMBAYARAN";
        $retrieveValues["metode"] = "ONLINE";
        $retrieveValues["batal"] = 0;
        $retrieveValues["waktuTransaksi"] = "2014-05-03 00:00:00";
        $retrieveValues["waktuLaporan"] = "2014-05-03 00:00:00";
        $retrieveValues["waktuEntri"] = "2014-05-03 00:00:00";
        $retrieveValues["idRekening"] = 1;
        $retrieveValues["idKasir"] = 1;
        $retrieveValues["nomorTransaksi"] = "T001";
        $retrieveValues["nomorReferensi"] = "R001";
        $retrieveValues["nilai"] = 3.00000;

        return $retrieveValues;
    }

    protected function getMockAlokasiInputBatal(array $setValues = array(), array $setRetrieveValues = array(), $setRetrieveReturnValue = TRUE) {
        $values["id"] = 1;

        foreach ($setValues as $propertyName => $setValue) {
            if (array_key_exists($propertyName, $values)) {
                $values[$propertyName] = $setValue;
            }
        }

        $retrieveValues = $this->getDefaultRetrieveValuesAlokasiRecord($values);


        foreach ($setRetrieveValues as $propertyName => $setValue) {
            if (array_key_exists($propertyName, $retrieveValues)) {
                $retrieveValues[$propertyName] = $setValue;
            }
        }

        $mock = new MockAlokasiRecord;
        $mock->setMockValues($values);
        $mock->setMockRetrieveSetValues($retrieveValues);
        $mock->setMockRetrieveReturnValue($setRetrieveReturnValue);

        return $mock;
    }

    protected function getDefaultRetrieveValuesAlokasiRecord(array $values = array()) {
        if (!array_key_exists("id", $values)) {
            $values["id"] = $this->seq ++;
        }

        $retrieveValues = array();
        $retrieveValues["id"] = $values["id"];
        $retrieveValues["idTransaksi"] = 7;
        $retrieveValues["idSiswa"] = 1;
        $retrieveValues["idUnit"] = 4;
        $retrieveValues["idJenisPembayaran"] = 3;
        $retrieveValues["nilai"] = 1.00000;
        $retrieveValues["sisa"] = 1.00000;
        $retrieveValues["terdistribusi"] = 0.00000;

        return $retrieveValues;
    }

    protected function getMockTransaksiInputBatalEmpty(array $setValues = array()) {
        $mock = new MockTransaksiRecord;
        $values = array("waktuEntri" => "2014-05-03 00:00:00", "waktuLaporan" => "2014-05-03 00:00:00");

        foreach ($setValues as $propertyName => $setValue) {
            if (array_key_exists($propertyName, $values)) {
                $values[$propertyName] = $setValue;
            }
        }

        $mock->setMockValues($values);

        return $mock;
    }

    protected function getMockAlokasiInputBatalEmpty($count = 3) {
        $arrayMock = array();

        for ($i = 0; $i < $count; $i ++) {
            $arrayMock[] = new MockAlokasiRecord;
        }

        return $arrayMock;
    }

    protected function getQualifiedMockTransaksiRecordInputBatal($idTransaksi = 7) {
        return $this->getMockTransaksiInputBatal(array("id" => $idTransaksi), array("id" => $idTransaksi));
    }

    protected function getQualifiedMockAlokasiInputBatal($count = 3, $startId = 19, $idTransaksi = 7) {
        for ($i = 0; $i < $count; $i++) {
            $arrayMockAlokasiRecord[] = $this->getMockAlokasiInputBatal(array("id" => $startId + $i), array("id" => 19, "idTransaksi" => $idTransaksi));
        }

        return $arrayMockAlokasiRecord;
    }

}
