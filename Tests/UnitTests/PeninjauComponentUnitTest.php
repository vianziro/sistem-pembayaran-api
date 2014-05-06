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
     * @dataProvider providerTestException
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
     * @dataProvider providerTestException
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
     * @dataProvider providerTestException
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
     * @dataProvider providerTestException
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
     * @dataProvider providerTestException
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
     * @dataProvider providerTestException
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
     * @dataProvider providerTestException
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
     * @dataProvider providerTestException
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

    public function providerTestException() {
        return array(
            array(array("count_result" => 1), "prepare", "PREPARE_STATEMENT_GAGAL"),
            array(array("count_result" => 1), "execute", "EXECUTE_STATEMENT_GAGAL"),
            array(array("count_result" => 1), "closeCursor", "CLOSE_CURSOR_GAGAL")
        );
    }

    public function providerTestNomorAda() {
        return array(
            array(array("count_result" => 1), "", TRUE, "Return TRUE jika nomor sudah ada."),
            array(array("count_result" => 0), "", FALSE, "Return FALSE jika nomor belum ada.")
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
