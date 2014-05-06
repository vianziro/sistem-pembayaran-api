<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "TestHeader.php";
require_once TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "TestHelper.php";
require_once UNIT_TESTS_DIR . DIRECTORY_SEPARATOR . "UnitTestHeader.php";
require_once INTEGRATION_TESTS_DIR . DIRECTORY_SEPARATOR . "IntegrationTestHeader.php";
require_once SYSTEM_TESTS_DIR . DIRECTORY_SEPARATOR . "SystemTestHeader.php";
require_once SECURITY_TESTS_DIR . DIRECTORY_SEPARATOR . "SecurityTestHeader.php";

$__classes = array(
    /**
     * Record Objects
     */
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "RecordAbstract.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "AlokasiRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "BankRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "BulanRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "JenisPembayaranRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "JurusanRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "KasirRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "KelasRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "ProdukRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "ProgramRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "RekeningRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "SiswaRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "TagihanRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "TahunAjaranRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "TingkatRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "TransaksiRecord.php",
    RECORD_OBJECTS_DIR . DIRECTORY_SEPARATOR . "UnitRecord.php",
    /**
     * Component Objects
     */
    COMPONENT_OBJECTS_DIR . DIRECTORY_SEPARATOR . "PeninjauAbstract.php",
    COMPONENT_OBJECTS_DIR . DIRECTORY_SEPARATOR . "PeninjauComponent.php",
    COMPONENT_OBJECTS_DIR . DIRECTORY_SEPARATOR . "PenagihanComponent.php",
    COMPONENT_OBJECTS_DIR . DIRECTORY_SEPARATOR . "TransaksiComponent.php",
    /**
     * Persistence Objects
     */
    /**
     * Worker Objects
     */
    /**
     * Various Objects
     */
    VARIOUS_OBJECTS_DIR . DIRECTORY_SEPARATOR . "TagihanObject.php",
    /**
     * Test Helpers
     */
    UNIT_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MockAlokasiRecord.php",
    UNIT_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MockDateTime.php",
    UNIT_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MockJenisPembayaranRecord.php",
    UNIT_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MockPDO.php",
    UNIT_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MockSiswaRecord.php",
    UNIT_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MockTransaksiRecord.php",
    UNIT_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MockUnitRecord.php",
    INTEGRATION_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MyApp_DbUnit_ArrayDataSet.php",
    INTEGRATION_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MyApp_DbUnit_InsertOperation.php",
    INTEGRATION_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MyApp_DbUnit_TruncateOperation.php",
    INTEGRATION_TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "MyApp_Database_TestCase.php"
);

foreach ($__classes as $__class) {
    require_once $__class;
}
