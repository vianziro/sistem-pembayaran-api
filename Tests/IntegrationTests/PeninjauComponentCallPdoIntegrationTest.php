<?php

/**
 * Integration test PeninjauComponent dengan PDO.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class PeninjauComponentCallPdoIntegrationTest extends MyApp_Database_TestCase {

    private $object = NULL;

    public function setUp() {
        parent::setUp();

        $this->object = new PeninjauComponent;
        $this->object->setPDO(self::$pdo);
    }

    /**
     * @group integrationTest
     * @group componentObject
     * @covers PeninjauComponent::nomorTransaksiAda()
     * @covers PeninjauComponent::nomorReferensiAda()
     * @covers PeninjauComponent::nomorRekeningAda()
     * @covers PeninjauComponent::nomorKasirAda()
     * @covers PeninjauComponent::nomorSiswaAda()
     * @covers PeninjauComponent::nomorUnitAda()
     * @covers PeninjauComponent::nomorJenisPembayaranAda()
     * @covers PeninjauComponent::hitungBanyaknyaALokasi()
     * @covers PDO::setAttribute()
     */
    public function testCallSetAttribute() {
        $this->assertTrue($this->object->getPDO()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group componentObject
     * @depends testCallSetAttribute
     * @covers PeninjauComponent::nomorTransaksiAda()
     * @covers PeninjauComponent::nomorReferensiAda()
     * @covers PeninjauComponent::rekeningAda()
     * @covers PeninjauComponent::kasirAda()
     * @covers PeninjauComponent::siswaAda()
     * @covers PeninjauComponent::unitAda()
     * @covers PeninjauComponent::jenisPembayaranAda()
     * @covers PeninjauComponent::hitungBanyaknyaAlokasi()
     * @covers PDO::prepare()
     */
    public function testCallPrepare() {
        $pdoStatements = array();

        foreach ($this->getMethods() as $methodName => $sql) {
            $pdoStatements[$methodName] = $this->object->getPDO()->prepare($sql);
            $this->assertInstanceOf("PDOStatement", $pdoStatements[$methodName], "Gagal prepare statement untuk method " . $methodName . ".");
        }

        return $pdoStatements;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group componentObject
     * @depends testCallPrepare
     * @covers PeninjauComponent::nomorTransaksiAda()
     * @covers PeninjauComponent::nomorReferensiAda()
     * @covers PeninjauComponent::rekeningAda()
     * @covers PeninjauComponent::kasirAda()
     * @covers PeninjauComponent::siswaAda()
     * @covers PeninjauComponent::unitAda()
     * @covers PeninjauComponent::jenisPembayaranAda()
     * @covers PeninjauComponent::hitungBanyaknyaAlokasi()
     * @covers PDOStatement::execute()
     */
    public function testCallExecute($pdoStatements) {
        foreach ($pdoStatements as $methodName => $pdoStatement) {
            foreach ($this->getInputParameters($methodName) as $inputParameter) {
                $this->assertTrue($pdoStatement->execute($inputParameter[0]), "Gagal execute query untuk method " . $methodName . ".");
            }
        }
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group componentObject
     * @depends testCallExecute
     * @covers PeninjauComponent::nomorTransaksiAda()
     * @covers PeninjauComponent::nomorReferensiAda()
     * @covers PeninjauComponent::rekeningAda()
     * @covers PeninjauComponent::kasirAda()
     * @covers PeninjauComponent::siswaAda()
     * @covers PeninjauComponent::unitAda()
     * @covers PeninjauComponent::jenisPembayaranAda()
     * @covers PeninjauComponent::hitungBanyaknyaAlokasi()
     * @covers PDOStatement::fetch()
     */
    public function testCallFetch() {
        $this->mySetDataSet($this->getPresetDataset());
        $this->myDisableForeignKeyChecks();
        $this->mySetup($this->getDataSet());
        $this->myEnableForeignKeyChecks();

        $pdoStatements = array();

        foreach ($this->getMethods() as $methodName => $sql) {
            foreach ($this->getInputParameters($methodName) as $inputParameter) {
                $pdoStatement = $this->object->getPDO()->prepare($sql);
                $pdoStatement->execute($inputParameter[0]);
                $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);

                $this->assertEquals($inputParameter[1], $result["count_result"], "Result yang dikembalikan query pada method " . $methodName . " tidak sesuai harapan. " . $pdoStatement->queryString . " " . print_r($inputParameter[0], TRUE));
                $pdoStatements[] = $pdoStatement;
            }
        }

        return $pdoStatements;
    }

    /**
     * @group integrationTest
     * @group databaseAccess
     * @group componentObject
     * @depends testCallFetch
     * @covers PeninjauComponent::nomorTransaksiAda()
     * @covers PeninjauComponent::nomorReferensiAda()
     * @covers PeninjauComponent::rekeningAda()
     * @covers PeninjauComponent::kasirAda()
     * @covers PeninjauComponent::siswaAda()
     * @covers PeninjauComponent::unitAda()
     * @covers PeninjauComponent::jenisPembayaranAda()
     * @covers PeninjauComponent::hitungBanyaknyaAlokasi()
     * @covers PDOStatement::closeCursor()
     */
    public function testCallCloseCursor($pdoStatements) {
        foreach ($pdoStatements as $pdoStatement) {
            $this->assertTrue($pdoStatement->closeCursor());
        }
    }

    private function getInputParameters($methodName) {
        $inputSet = array(
            "nomorTransaksiAda" => array(
                array(array(":nomor_transaksi" => "T001", ":id_rekening" => 1), 1),
                array(array(":nomor_transaksi" => "T001", ":id_rekening" => 2), 1),
                array(array(":nomor_transaksi" => "T001", ":id_rekening" => 3), 0)
            ),
            "nomorReferensiAda" => array(
                array(array(":nomor_referensi" => "R001", ":id_rekening" => 1), 1),
                array(array(":nomor_referensi" => "R001", ":id_rekening" => 2), 1),
                array(array(":nomor_referensi" => "R001", ":id_rekening" => 3), 0)
            ),
            "rekeningAda" => array(
                array(array(":id" => 1), 1),
                array(array(":id" => 4), 0)
            ),
            "kasirAda" => array(
                array(array(":id" => 1), 1),
                array(array(":id" => 4), 0)
            ),
            "siswaAda" => array(
                array(array(":id" => 1), 1),
                array(array(":id" => 4), 0)
            ),
            "unitAda" => array(
                array(array(":id" => 1), 1),
                array(array(":id" => 5), 0)
            ),
            "jenisPembayaranAda" => array(
                array(array(":id" => 1), 1),
                array(array(":id" => 5), 0)
            ),
            "hitungBanyaknyaAlokasi" => array(
                array(array(":id_transaksi" => 1), 2),
                array(array(":id_transaksi" => 2), 3)
            )
        );

        if (array_key_exists($methodName, $inputSet)) {
            return $inputSet[$methodName];
        }

        return array();
    }

    private function getMethods() {
        return array(
            "nomorTransaksiAda" => "SELECT COUNT(*) AS count_result FROM transaksi t INNER JOIN rekening r ON (t.id_rekening = r.id) WHERE t.nomor_transaksi LIKE :nomor_transaksi AND r.id_bank = (SELECT id_bank FROM rekening WHERE id = :id_rekening)",
            "nomorReferensiAda" => "SELECT COUNT(*) AS count_result FROM transaksi t INNER JOIN rekening r ON (t.id_rekening = r.id) WHERE t.nomor_referensi LIKE :nomor_referensi AND r.id_bank = (SELECT id_bank FROM rekening WHERE id = :id_rekening)",
            "rekeningAda" => "SELECT COUNT(*) AS count_result FROM rekening WHERE id = :id",
            "kasirAda" => "SELECT COUNT(*) AS count_result FROM kasir WHERE id = :id",
            "siswaAda" => "SELECT COUNT(*) AS count_result FROM siswa WHERE id = :id",
            "unitAda" => "SELECT COUNT(*) AS count_result FROM unit WHERE id = :id",
            "jenisPembayaranAda" => "SELECT COUNT(*) AS count_result FROM jenis_pembayaran WHERE id = :id",
            "hitungBanyaknyaAlokasi" => "SELECT COUNT(*) AS count_result FROM alokasi WHERE id_transaksi = :id_transaksi"
        );
    }

    private function getPresetDataset() {
        return array(
            "bank" => array(
                array("id" => 1, "nama" => "Bank 1", "label" => "B1"),
                array("id" => 2, "nama" => "Bank 2", "label" => "B2"),
                array("id" => 3, "nama" => "Bank 3", "label" => "B3")
            ),
            "rekening" => array(
                array("id" => 1, "id_bank" => 1, "nomor" => "309001", "nama" => "Bank 1 9001", "label" => "B1 9001"),
                array("id" => 2, "id_bank" => 1, "nomor" => "309002", "nama" => "Bank 1 9002", "label" => "B1 9002"),
                array("id" => 3, "id_bank" => 2, "nomor" => "307001", "nama" => "Bank 2 7001", "label" => "B2 7001")
            ),
            "transaksi" => array(
                array("id" => 1, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 0, "waktu_transaksi" => "2014-05-04 00:00:00", "waktu_laporan" => "2014-05-04 00:00:00", "waktu_entri" => "2014-05-04 00:00:00", "id_rekening" => 1, "id_kasir" => 1, "nomor_transaksi" => "T001", "nomor_referensi" => "R001", "nilai" => 3.00000),
                array("id" => 2, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 0, "waktu_transaksi" => "2014-05-04 00:00:00", "waktu_laporan" => "2014-05-04 00:00:00", "waktu_entri" => "2014-05-04 00:00:00", "id_rekening" => 2, "id_kasir" => 1, "nomor_transaksi" => "T002", "nomor_referensi" => "R002", "nilai" => 3.00000),
                array("id" => 3, "jenis" => "TRANSAKSI", "kategori" => "PEMBAYARAN", "metode" => "ONLINE", "batal" => 0, "waktu_transaksi" => "2014-05-04 00:00:00", "waktu_laporan" => "2014-05-04 00:00:00", "waktu_entri" => "2014-05-04 00:00:00", "id_rekening" => 3, "id_kasir" => 1, "nomor_transaksi" => "T003", "nomor_referensi" => "R003", "nilai" => 3.00000)
            ),
            "alokasi" => array(
                array("id" => 1, "id_transaksi" => 1, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1.00000, "sisa" => 1.00000, "terdistribusi" => 0.00000),
                array("id" => 2, "id_transaksi" => 1, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 2, "nilai" => 2.00000, "sisa" => 2.00000, "terdistribusi" => 0.00000),
                array("id" => 3, "id_transaksi" => 2, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 1, "nilai" => 1.00000, "sisa" => 1.00000, "terdistribusi" => 0.00000),
                array("id" => 4, "id_transaksi" => 2, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 2, "nilai" => 1.00000, "sisa" => 1.00000, "terdistribusi" => 0.00000),
                array("id" => 5, "id_transaksi" => 2, "id_siswa" => 1, "id_unit" => 1, "id_jenis_pembayaran" => 3, "nilai" => 1.00000, "sisa" => 1.00000, "terdistribusi" => 0.00000)
            ),
            "kasir" => array(
                array("id" => 1, "nama" => "Kasir 1"),
                array("id" => 2, "nama" => "Kasir 2"),
                array("id" => 3, "nama" => "Kasir 3")
            ),
            "siswa" => array(
                array("id" => 1, "nama" => "Siswa 1", "nis" => "10000000001"),
                array("id" => 2, "nama" => "Siswa 2", "nis" => "10000000002"),
                array("id" => 3, "nama" => "Siswa 3", "nis" => "10000000003")
            ),
            "unit" => array(
                array("id" => 1, "nama" => "TK", "label" => "TK"),
                array("id" => 2, "nama" => "SD", "label" => "SD"),
                array("id" => 3, "nama" => "SMP", "label" => "SMP"),
                array("id" => 4, "nama" => "SMA", "label" => "SMA")
            ),
            "jenis_pembayaran" => array(
                array("id" => 1, "nama" => "UM", "label" => "TM"),
                array("id" => 2, "nama" => "UK", "label" => "UK"),
                array("id" => 3, "nama" => "SPP", "label" => "SPP"),
                array("id" => 4, "nama" => "US", "label" => "US")
            )
        );
    }

}
