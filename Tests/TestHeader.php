<?php

/**
 * Direktori test.
 */
define("TESTS_DIR", dirname(__FILE__));
define("TEST_HELPERS_DIR", TESTS_DIR . DIRECTORY_SEPARATOR . "TestHelpers");
define("UNIT_TESTS_DIR", TESTS_DIR . DIRECTORY_SEPARATOR . "UnitTests");
define("INTEGRATION_TESTS_DIR", TESTS_DIR . DIRECTORY_SEPARATOR . "IntegrationTests");
define("SYSTEM_TESTS_DIR", TESTS_DIR . DIRECTORY_SEPARATOR . "SystemTests");
define("SECURITY_TESTS_DIR", TESTS_DIR . DIRECTORY_SEPARATOR . "SecurityTests");

define("UNIT_TEST_HELPERS_DIR", TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "UnitTestHelpers");
define("INTEGRATION_TEST_HELPERS_DIR", TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "IntegrationTestHelpers");
define("SYSTEM_TEST_HELPERS_DIR", TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "SystemTestHelpers");
define("SECURITY_TEST_HELPERS_DIR", TEST_HELPERS_DIR . DIRECTORY_SEPARATOR . "SecurityTestHelpers");

/**
 * Direktori source.
 */
define("SOURCES_DIR", dirname(TESTS_DIR));
define("RECORD_OBJECTS_DIR", SOURCES_DIR . DIRECTORY_SEPARATOR . "RecordObjects");
define("COMPONENT_OBJECTS_DIR", SOURCES_DIR . DIRECTORY_SEPARATOR . "ComponentObjects");
define("PERSISTENCE_OBJECTS_DIR", SOURCES_DIR . DIRECTORY_SEPARATOR . "PersistenceObjects");
define("WORKER_OBJECTS_DIR", SOURCES_DIR . DIRECTORY_SEPARATOR . "WorkerObjects");

/**
 * Bootstrap untuk PHPUnit.
 */
define("TESTS_BOOTSTRAP_FILE", TESTS_DIR . DIRECTORY_SEPARATOR . "bootstrap.php");

/**
 * Konfigurasi sambungan ke database.
 */
define("DB_DRIVER", "mysql");
define("DB_HOST", "localhost");
define("DB_PORT", "3306");
define("DB_NAME", "sistem_pembayaran_test_db");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DSN", DB_DRIVER . ":host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME);

/**
 * URL
 */
define("BASE_URL", "http://127.0.0.1/andi-malik/SistemPembayaranAPI");
define("BASE_URL_TLS", "https://127.0.0.1/andi-malik/SistemPembayaranAPI");
define("SERVER_INFO_URL", BASE_URL . "/Tests/ServerInfo.php");
define("SERVER_INFO_URL_TLS", BASE_URL_TLS . "/Tests/ServerInfo.php");
