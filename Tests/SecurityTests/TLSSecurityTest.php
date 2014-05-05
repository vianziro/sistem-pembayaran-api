<?php

/**
 * Security test untuk TLS.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 * @todo Security test untuk CRIME attack.
 * @todo Security test untuk BREACH attack.
 */
class TLSSecurityTest extends PHPUnit_Framework_TestCase {

    /**
     * @group securityTest
     * @group story8
     * @group networkAccess
     * @dataProvider providerBeastAttackVulnerability
     */
    public function testBeastAttackVulnerability($ciphers) {
        $vulnerableVersions = array(
            "SSLv2" => "SSL v2.0 rentan downgrade attack.",
            "SSLv3" => "SSL v3.0 rentan downgrade attack.",
            "TLSv1" => "TLS v1.0 rentan BEAST attack"
        );

        $context = stream_context_create(array(
            "http" => array("method" => "GET"),
            "ssl" => array("ciphers" => $ciphers)
        ));

        $data = json_decode(_getPage(SERVER_INFO_URL_TLS, $context), TRUE);

        if ($data === NULL) {
            $this->fail("json_decode(data) return NULL.");
        }

        $tlsVersion = $data["SSL_PROTOCOL"];
        $vulnerable = array_key_exists($tlsVersion, $vulnerableVersions);

        if ($vulnerable) {
            $this->fail($vulnerableVersions[$tlsVersion]);
        }

        $this->assertTrue(TRUE);
    }

    public function providerBeastAttackVulnerability() {
        return array(
            array("SSLv3"),
            array("TLSv1"),
            array("TLSv1.2")
        );
    }

    /**
     * @group securityTest
     * @group story8
     * @requires extension openssl
     * @todo Pengujian TLSSecurityTest::testPHPOpenSSLHeartbleedVulnerability dinonaktifkan sementara.
     */
    //public function testPHPOpenSSLHeartbleedVulnerability() {
    private function yetTestPHPOpenSSLHeartbleedVulnerability() {
        $actualVersionNumber = OPENSSL_VERSION_NUMBER;
        $actualVersionString = OPENSSL_VERSION_TEXT;
        $vulnerable = $this->_isVulnerableOpenSSLVersion($actualVersionNumber);
        $failMessage = "Versi OpenSSL \"" . $actualVersionString . "\" yang digunakan PHP termasuk dalam daftar versi yang rentan Heartbleed.";

        if ($vulnerable) {
            $this->fail($failMessage);
        } else {
            $this->assertFalse($vulnerable, $failMessage);
        }
    }

    private function _isVulnerableOpenSSLVersion($versionNumber) {
        /**
         * Konversi nomor versi OpenSSL dari desimal ke 9 angka heksadesimal.
         */
        $version = strtolower(str_pad(dechex($versionNumber), 9, "0", STR_PAD_LEFT));

        /**
         * Versi OpenSSL yang rentan heartbleed adalah rilis-rilis OpenSSL 1.0.1 dan 1.0.2-beta termasuk 1.0.1f dan 1.0.2-beta1. 1.0.2 akan diperbaiki dalam 1.0.2-beta2.
         * @link http://www.openssl.org/docs/crypto/OPENSSL_VERSION_NUMBER.html Dokumentasi format nomor versi OpenSSL.
         * @link http://www.openssl.org/news/secadv_20140407.txt Informasi versi OpenSSL yang rentan heartbleed.
         */
        return ( $version >= "010001000" ) and ( $version <= "010002ff1" );
    }

}
