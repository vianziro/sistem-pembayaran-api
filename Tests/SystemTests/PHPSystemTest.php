<?php

/**
 * System test untuk PHP.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class PHPSystemTest extends PHPUnit_Framework_TestCase {

    /**
     * @group systemTest
     * @group story1
     */
    public function testVersiSesuai() {
        $actualVersion = phpversion();
        $compatibleVersions = array("5.5.9");
        $versionIsCompatible = in_array($actualVersion, $compatibleVersions);
        $failMessage = "Versi PHP \"" . $actualVersion . "\" tidak termasuk dalam daftar versi yang cocok.";

        if (!$versionIsCompatible) {
            $this->fail($failMessage);
        } else {
            $this->assertTrue($versionIsCompatible, $failMessage);
        }
    }

    /**
     * @group systemTest
     * @group story1
     */
    public function testPdoTermuat() {
        $pdoLoaded = extension_loaded("pdo");
        $failMessage = "PDO tidak dimuat.";

        if (!$pdoLoaded) {
            $this->fail($failMessage);
        } else {
            $this->assertTrue($pdoLoaded, $failMessage);
        }
    }

    /**
     * @group systemTest
     * @group story1
     * @requires extension openssl
     */
    public function testVersiOpenSslSesuai() {
        $minimumHexVersion = "010001000";
        $versionNumber = OPENSSL_VERSION_NUMBER;
        $versionHex = strtolower(str_pad(dechex($versionNumber), 9, "0", STR_PAD_LEFT));

        if ($versionHex < $minimumHexVersion) {
            $this->fail("Versi OpenSSL < 1.0.1");
        }

        $this->assertTrue(TRUE);
    }

}
