<?php

/**
 * System test untuk sambungan ke database.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class DatabaseConnectionSystemTest extends PHPUnit_Framework_TestCase {

    protected static $pdo = NULL;

    /**
     * @group systemTest
     * @group fileSystemAccess
     * @group story1
     */
    public function testSocketExists() {
        $socketFile = ini_get("pdo_mysql.default_socket");

        clearstatcache(TRUE, $socketFile);
        $fileExists = file_exists($socketFile);
        $failMessage = "Socket \"" . $socketFile . "\" tidak ditemukan.";

        if (!$fileExists) {
            $this->fail($failMessage);
        } else {
            $this->assertTrue($fileExists, $failMessage);
        }

        return $fileExists;
    }

    /**
     * @group systemTest
     * @group databaseAccess
     * @group story1
     * @depends testSocketExists
     */
    public function testConnect($socketExists) {
        $connected = TRUE;

        if ($socketExists) {
            try {
                self::$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, array(PDO::ERRMODE_EXCEPTION));
                $this->assertTrue(TRUE);
            } catch (PDOException $exception) {
                $connected = FALSE;
                $this->fail("Hubungan ke database gagal. " . $exception->getMessage());
            }
        } else {
            $connected = FALSE;
            $this->fail("File socket tidak ditemukan.");
        }

        return $connected;
    }

    /**
     * @group systemTest
     * @group databaseAccess
     * @group story1
     * @depends testConnect
     */
    public function testQuery($connected) {
        $queryable = TRUE;

        if ($connected) {
            $pdoStatement = self::$pdo->prepare("SELECT \"Query Test\" AS query_test");
            $pdoStatement->execute();
            $result = $pdoStatement->fetchObject();
            $this->assertEquals("Query Test", $result->query_test);
        } else {
            $queryable = FALSE;
            $this->fail("Database tidak terhubung.");
        }

        return $queryable;
    }

    /**
     * @group systemTest
     * @group databaseAccess
     * @group story1
     * @depends testQuery
     */
    public function testMysqlVersion($queryable) {
        if ($queryable) {
            $compatibleVersions = array("5.6.16");

            $pdoStatement = self::$pdo->prepare("SELECT VERSION() AS version");
            $pdoStatement->execute();
            $result = $pdoStatement->fetchObject();

            $versionIsCompatible = in_array($result->version, $compatibleVersions);
            $failMessage = "Versi MySQL \"" . $result->version . "\" tidak termasuk dalam daftar versi yang cocok.";

            if (!$versionIsCompatible) {
                $this->fail($failMessage);
            } else {
                $this->assertTrue($versionIsCompatible, $failMessage);
            }
        } else {
            $this->fail("Query tidak dapat dilakukan.");
        }
    }

}
