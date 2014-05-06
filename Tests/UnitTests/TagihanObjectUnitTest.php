<?php

/**
 * Unit test objek TagihanObject.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class TagihanObjectUnitTest extends PHPUnit_Framework_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();
        $this->object = new TagihanObject;
    }

    /**
     * @group unitTest
     * @group variousObject
     * @covers TagihanObject::setUnitRecord()
     * @covers TagihanObject::getUnitRecord()
     * @covers TagihanObject::unsetUnitRecord()
     */
    public function testSetGetUnsetUnitRecord() {
        $mockUnitRecord = $this->getMock("UnitRecord");

        $this->assertNull($this->object->getUnitRecord());

        $this->object->setUnitRecord($mockUnitRecord);
        $this->assertSame($mockUnitRecord, $this->object->getUnitRecord());

        $this->object->unsetUnitRecord();
        $this->assertNull($this->object->getUnitRecord());
    }

    /**
     * @group unitTest
     * @group variousObject
     * @covers TagihanObject::setJenisPembayaranRecord()
     * @covers TagihanObject::getJenisPembayaranRecord()
     * @covers TagihanObject::unsetJenisPembayaranRecord()
     */
    public function testSetGetUnsetJenisPembayaranRecord() {
        $mockJenisPembayaranRecord = $this->getMock("JenisPembayaranRecord");

        $this->assertNull($this->object->getJenisPembayaranRecord());

        $this->object->setJenisPembayaranRecord($mockJenisPembayaranRecord);
        $this->assertSame($mockJenisPembayaranRecord, $this->object->getJenisPembayaranRecord());

        $this->object->unsetJenisPembayaranRecord();
        $this->assertNull($this->object->getJenisPembayaranRecord());
    }

    /**
     * @group unitTest
     * @group variousObject
     * @covers TagihanObject::setSiswaRecord()
     * @covers TagihanObject::getSiswaRecord()
     * @covers TagihanObject::unsetSiswaRecord()
     */
    public function testSetGetUnsetSiswaRecord() {
        $mockSiswaRecord = $this->getMock("SiswaRecord");

        $this->assertNull($this->object->getSiswaRecord());

        $this->object->setSiswaRecord($mockSiswaRecord);
        $this->assertSame($mockSiswaRecord, $this->object->getSiswaRecord());

        $this->object->unsetSiswaRecord();
        $this->assertNull($this->object->getSiswaRecord());
    }

    /**
     * @group unitTest
     * @group variousObject
     * @covers TagihanObject::setJumlahTagihan()
     * @covers TagihanObject::getJumlahTagihan()
     * @covers TagihanObject::unsetJumlahTagihan()
     */
    public function testSetGetUnsetJumlahTagihan() {
        $jumlahTagihan = 100000.00000;

        $this->assertEquals(0.00000, $this->object->getJumlahTagihan());

        $this->object->setJumlahTagihan($jumlahTagihan);
        $this->assertEquals($jumlahTagihan, $this->object->getJumlahTagihan());

        $this->object->unsetJumlahTagihan();
        $this->assertNull($this->object->getJumlahTagihan());
    }

}
