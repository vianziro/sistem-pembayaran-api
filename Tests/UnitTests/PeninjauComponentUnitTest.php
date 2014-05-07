<?php

/**
 * Unit test objek PeninjauComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class PeninjauComponentUnitTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new PeninjauComponent;
    }

    /**
     * @group unitTest
     * @group componentObject
     * @covers PeninjauComponent::setPDO()
     * @covers PeninjauComponent::getPDO()
     * @covers PeninjauComponent::unsetPDO()
     */
    public function testSetGetUnsetPdo() {
        $mockPDO = $this->getMockPDO();
        $this->assertNull($this->object->getPDO());

        $this->object->setPDO($mockPDO);
        $this->assertSame($mockPDO, $this->object->getPDO());

        $this->object->unsetPDO();
        $this->assertNull($this->object->getPDO());
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestNomorAda
     * @covers PeninjauComponent::nomorTransaksiAda()
     */
    public function testNomorTransaksiAda($fetchReturnValue, $failPoint, $expected, $message) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);

        $this->object->setPDO($mockPDO);
        $this->assertSame($expected, $this->object->nomorTransaksiAda("T001", 1), $message);
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestNomorAda
     * @covers PeninjauComponent::nomorReferensiAda()
     */
    public function testNomorReferensiAda($fetchReturnValue, $failPoint, $expected, $message) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);

        $this->object->setPDO($mockPDO);
        $this->assertSame($expected, $this->object->nomorReferensiAda("R001", 1), $message);
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerRecordAda
     * @covers PeninjauComponent::rekeningAda()
     */
    public function testRekeningAda($fetchReturnValue, $failPoint, $expected, $message) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);

        $this->object->setPDO($mockPDO);
        $this->assertSame($expected, $this->object->rekeningAda(1), $message);
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerRecordAda
     * @covers PeninjauComponent::kasirAda()
     */
    public function testKasirAda($fetchReturnValue, $failPoint, $expected, $message) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);

        $this->object->setPDO($mockPDO);
        $this->assertSame($expected, $this->object->kasirAda(1), $message);
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerRecordAda
     * @covers PeninjauComponent::siswaAda()
     */
    public function testSiswaAda($fetchReturnValue, $failPoint, $expected, $message) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);

        $this->object->setPDO($mockPDO);
        $this->assertSame($expected, $this->object->siswaAda(1), $message);
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerRecordAda
     * @covers PeninjauComponent::jenisPembayaranAda()
     */
    public function testJenisPembayaranAda($fetchReturnValue, $failPoint, $expected, $message) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);

        $this->object->setPDO($mockPDO);
        $this->assertSame($expected, $this->object->jenisPembayaranAda(1), $message);
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerRecordAda
     * @covers PeninjauComponent::unitAda()
     */
    public function testUnitAda($fetchReturnValue, $failPoint, $expected, $message) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);

        $this->object->setPDO($mockPDO);
        $this->assertSame($expected, $this->object->unitAda(1), $message);
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerHitungRecord
     * @covers PeninjauComponent::hitungBanyaknyaAlokasi()
     */
    public function testHitungBanyaknyaAlokasi($fetchReturnValue, $failPoint, $expected) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);

        $this->object->setPDO($mockPDO);
        $this->assertSame($expected, $this->object->hitungBanyaknyaAlokasi(1));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerJumlahTagihanSiswa
     * @covers PeninjauComponent::perolehJumlahTagihanSiswa()
     */
    public function testPerolehJumlahTagihanSiswa($fetchReturnValue, $failPoint, $expected) {
        $idUnit = 4;
        $idJenisPembayaran = 3;
        $idSiswa = 1;
        $waktuTagihan = "2014-05-06 00:00:00";

        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        $this->assertSame($expected, $this->object->perolehJumlahTagihanSiswa($idUnit, $idJenisPembayaran, $idSiswa, $waktuTagihan));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerPerolehIdUnitDanIdJenisPembayaranDariKodeProduk
     * @covers PeninjauComponent::perolehIdUnitDanIdJenisPembayaranDariKodeProduk()
     */
    public function testPerolehIdUnitDanIdJenisPembayaranDariKodeProduk($fetchReturnValue, $failPoint, $expected) {
        $kodeProduk = "33";

        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        $this->assertSame($expected, $this->object->perolehIdUnitDanIdJenisPembayaranDariKodeProduk($kodeProduk));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerPerolehIdSiswaDariNIS
     * @covers PeninjauComponent::perolehIdSiswaDariNIS()
     */
    public function testPerolehIdSiswaDariNIS($fetchReturnValue, $failPoint, $expected) {
        $nis = "1415000379";

        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        $this->assertSame($expected, $this->object->perolehIdSiswaDariNIS($nis));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerPerolehIdTagihanTerlama
     * @covers PeninjauComponent::perolehIdTagihanTerlama()
     */
    public function testPerolehIdTagihanTerlama($fetchReturnValue, $failPoint, $expected) {
        $idUnit = 4;
        $idJenisPembayaran = 3;
        $idSiswa = 1;

        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        $this->assertSame($expected, $this->object->perolehIdTagihanTerlama($idUnit, $idJenisPembayaran, $idSiswa));
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionCount
     * @covers PeninjauComponent::nomorTransaksiAda()
     */
    public function testExceptionNomorTransaksiAda($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        try {
            $this->object->nomorTransaksiAda("T001", 1);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionCount
     * @covers PeninjauComponent::nomorReferensiAda()
     */
    public function testExceptionNomorReferensiAda($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        try {
            $this->object->nomorReferensiAda("R001", 1);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionCount
     * @covers PeninjauComponent::rekeningAda()
     */
    public function testExceptionRekeningAda($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        try {
            $this->object->rekeningAda(1);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionCount
     * @covers PeninjauComponent::kasirAda()
     */
    public function testExceptionKasirAda($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        try {
            $this->object->kasirAda(1);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionCount
     * @covers PeninjauComponent::siswaAda()
     */
    public function testExceptionSiswaAda($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        try {
            $this->object->siswaAda(1);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionCount
     * @covers PeninjauComponent::jenisPembayaranAda()
     */
    public function testExceptionJenisPembayaranAda($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        try {
            $this->object->jenisPembayaranAda(1);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionCount
     * @covers PeninjauComponent::unitAda()
     */
    public function testExceptionUnitAda($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        try {
            $this->object->unitAda(1);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionCount
     * @covers PeninjauComponent::hitungBanyaknyaAlokasi()
     */
    public function testExceptionHitungBanyaknyaAlokasi($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        try {
            $this->object->hitungBanyaknyaAlokasi(1);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionSum
     * @covers PeninjauComponent::perolehJumlahTagihanSiswa()
     */
    public function testExceptionPerolehJumlahTagihanSiswa($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        $idUnit = 4;
        $idJenisPembayaran = 3;
        $idSiswa = 1;
        $waktuTagihan = "2014-05-06 00:00:00";

        try {
            $this->object->perolehJumlahTagihanSiswa($idUnit, $idJenisPembayaran, $idSiswa, $waktuTagihan);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionKodeProduk
     * @covers PeninjauComponent::perolehIdUnitDanIdJenisPembayaranDariKodeProduk()
     */
    public function testExceptionPerolehIdUnitDanIdJenisPembayaranDariKodeProduk($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        $kodeProduk = "33";

        try {
            $this->object->perolehIdUnitDanIdJenisPembayaranDariKodeProduk($kodeProduk);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionPerolehIdSiswaDariNIS
     * @covers PeninjauComponent::perolehIdSiswaDariNIS()
     */
    public function testExceptionPerolehIdSiswaDariNIS($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        $nis = "1415000379";

        try {
            $this->object->perolehIdSiswaDariNIS($nis);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    /**
     * @group unitTest
     * @group componentObject
     * @dataProvider providerTestExceptionPerolehIdTagihanTerlama
     * @covers PeninjauComponent::perolehIdTagihanTerlama()
     */
    public function testExceptionPerolehIdTagihanTerlama($fetchReturnValue, $failPoint, $expectedExceptionMessage) {
        $mockPDO = $this->getMockPDO($fetchReturnValue, $failPoint);
        $this->object->setPDO($mockPDO);

        $idUnit = 4;
        $idJenisPembayaran = 3;
        $idSiswa = 1;

        try {
            $this->object->perolehIdTagihanTerlama($idUnit, $idJenisPembayaran, $idSiswa);
        } catch (Exception $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            return;
        }

        $this->fail("Throw exception jika terjadi error.");
    }

    public function providerHitungRecord() {
        return array(
            array(array("count_result" => 1), "", 1),
            array(array("count_result" => 0), "", 0)
        );
    }

    public function providerRecordAda() {
        return array(
            array(array("count_result" => 1), "", TRUE, "Return TRUE jika record ada."),
            array(array("count_result" => 0), "", FALSE, "Return FALSE jika record tidak ada.")
        );
    }

    public function providerTestExceptionCount() {
        return array(
            array(array("count_result" => 1), "prepare", "PREPARE_STATEMENT_GAGAL"),
            array(array("count_result" => 1), "execute", "EXECUTE_STATEMENT_GAGAL"),
            array(array("count_result" => 1), "closeCursor", "CLOSE_CURSOR_GAGAL")
        );
    }

    public function providerTestExceptionSum() {
        return array(
            array(array("sum_result" => 1), "prepare", "PREPARE_STATEMENT_GAGAL"),
            array(array("sum_result" => 1), "execute", "EXECUTE_STATEMENT_GAGAL"),
            array(array("sum_result" => 1), "closeCursor", "CLOSE_CURSOR_GAGAL")
        );
    }

    public function providerTestExceptionKodeProduk() {
        return array(
            array(array("id_unit" => 3, "id_jenis_pembayaran" => 3), "prepare", "PREPARE_STATEMENT_GAGAL"),
            array(array("id_unit" => 3, "id_jenis_pembayaran" => 3), "execute", "EXECUTE_STATEMENT_GAGAL"),
            array(array("id_unit" => 3, "id_jenis_pembayaran" => 3), "closeCursor", "CLOSE_CURSOR_GAGAL"),
        );
    }

    public function providerTestExceptionPerolehIdSiswaDariNIS() {
        return array(
            array(array("id" => 1), "prepare", "PREPARE_STATEMENT_GAGAL"),
            array(array("id" => 1), "execute", "EXECUTE_STATEMENT_GAGAL"),
            array(array("id" => 1), "closeCursor", "CLOSE_CURSOR_GAGAL")
        );
    }

    public function providerTestExceptionPerolehIdTagihanTerlama() {
        return array(
            array(array("id" => 1), "prepare", "PREPARE_STATEMENT_GAGAL"),
            array(array("id" => 1), "execute", "EXECUTE_STATEMENT_GAGAL"),
            array(array("id" => 1), "closeCursor", "CLOSE_CURSOR_GAGAL")
        );
    }

    public function providerTestNomorAda() {
        return array(
            array(array("count_result" => 1), "", TRUE, "Return TRUE jika nomor sudah ada."),
            array(array("count_result" => 0), "", FALSE, "Return FALSE jika nomor belum ada.")
        );
    }

    public function providerJumlahTagihanSiswa() {
        return array(
            array(array("sum_result" => 100000.00000), "", 100000.00000),
            array(array("sum_result" => 0.00000), "", 0.00000)
        );
    }

    public function providerPerolehIdUnitDanIdJenisPembayaranDariKodeProduk() {
        return array(
            array(array("id_unit" => 3, "id_jenis_pembayaran" => 3), "", array("idUnit" => 3, "idJenisPembayaran" => 3)),
            array(array("id_unit" => 4, "id_jenis_pembayaran" => 3), "", array("idUnit" => 4, "idJenisPembayaran" => 3)),
            array(FALSE, "", array("idUnit" => NULL, "idJenisPembayaran" => NULL)),
        );
    }

    public function providerPerolehIdSiswaDariNIS() {
        return array(
            array(array("id" => 1), "", 1),
            array(array("id" => 2), "", 2),
            array(FALSE, "", NULL),
        );
    }

    public function providerPerolehIdTagihanTerlama() {
        return array(
            array(array("id" => 1), "", 1),
            array(array("id" => 2), "", 2),
            array(FALSE, "", NULL),
        );
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
