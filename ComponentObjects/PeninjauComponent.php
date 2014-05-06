<?php

/**
 * Objek PeninjauComponent.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class PeninjauComponent extends PeninjauAbstract {

    public function setPDO(PDO $pdo) {
        $this->_pdo = $pdo;
    }

    public function getPDO() {
        return $this->_pdo;
    }

    public function unsetPDO() {
        $this->_pdo = NULL;
    }

    public function nomorTransaksiAda($nomor, $idRekening) {
        $sql = "SELECT COUNT(*) AS count_result FROM transaksi t INNER JOIN rekening r ON (t.id_rekening = r.id) WHERE t.nomor_transaksi LIKE :nomor_transaksi AND r.id_bank = (SELECT id_bank FROM rekening WHERE id = :id_rekening)";
        $input[":nomor_transaksi"] = $nomor;
        $input[":id_rekening"] = $idRekening;
        $result = $this->fetchRowQuery($sql, $input);

        return $result["count_result"] > 0;
    }

    public function nomorReferensiAda($nomor, $idRekening) {
        $sql = "SELECT COUNT(*) AS count_result FROM transaksi t INNER JOIN rekening r ON (t.id_rekening = r.id) WHERE t.nomor_referensi LIKE :nomor_referensi AND r.id_bank = (SELECT id_bank FROM rekening WHERE id = :id_rekening)";
        $input[":nomor_referensi"] = $nomor;
        $input[":id_rekening"] = $idRekening;
        $result = $this->fetchRowQuery($sql, $input);

        return $result["count_result"] > 0;
    }

    public function rekeningAda($idRekening) {
        $sql = "SELECT COUNT(*) AS count_result FROM rekening WHERE id = :id";
        $input[":id"] = $idRekening;
        $result = $this->fetchRowQuery($sql, $input);

        return $result["count_result"] > 0;
    }

    public function kasirAda($idKasir) {
        $sql = "SELECT COUNT(*) AS count_result FROM kasir WHERE id = :id";
        $input[":id"] = $idKasir;
        $result = $this->fetchRowQuery($sql, $input);

        return $result["count_result"] > 0;
    }

    public function siswaAda($idSiswa) {
        $sql = "SELECT COUNT(*) AS count_result FROM siswa WHERE id = :id";
        $input[":id"] = $idSiswa;
        $result = $this->fetchRowQuery($sql, $input);

        return $result["count_result"] > 0;
    }

    public function unitAda($idUnit) {
        $sql = "SELECT COUNT(*) AS count_result FROM unit WHERE id = :id";
        $input[":id"] = $idUnit;
        $result = $this->fetchRowQuery($sql, $input);

        return $result["count_result"] > 0;
    }

    public function jenisPembayaranAda($idJenisPembayaran) {
        $sql = "SELECT COUNT(*) AS count_result FROM jenis_pembayaran WHERE id = :id";
        $input[":id"] = $idJenisPembayaran;
        $result = $this->fetchRowQuery($sql, $input);

        return $result["count_result"] > 0;
    }

    public function hitungBanyaknyaAlokasi($idTransaksi) {
        $sql = "SELECT COUNT(*) AS count_result FROM alokasi WHERE id_transaksi = :id_transaksi";
        $input[":id_transaksi"] = $idTransaksi;
        $result = $this->fetchRowQuery($sql, $input);

        return $result["count_result"];
    }

    public function perolehJumlahTagihanSiswa($idUnit, $idJenisPembayaran, $idSiswa, $waktuTagihan) {
        $sql = "SELECT SUM(sisa) AS sum_result FROM tagihan WHERE id_unit = :id_unit AND id_jenis_pembayaran = :id_jenis_pembayaran AND id_siswa = :id_siswa AND waktu_tagihan <= :waktu_tagihan AND sisa != 0";

        $input[":id_unit"] = $idUnit;
        $input[":id_jenis_pembayaran"] = $idJenisPembayaran;
        $input[":id_siswa"] = $idSiswa;
        $input[":waktu_tagihan"] = $waktuTagihan;

        $result = $this->fetchRowQuery($sql, $input);

        return $result["sum_result"];
    }

    public function perolehIdUnitDanIdJenisPembayaranDariKodeProduk($kodeProduk) {
        $sql = "SELECT id_unit, id_jenis_pembayaran FROM produk WHERE kode_produk LIKE :kode_produk";
        $input[":kode_produk"] = $kodeProduk;
        $result = $this->fetchRowQuery($sql, $input);

        if ($result === FALSE) {
            return array("idUnit" => NULL, "idJenisPembayaran" => NULL);
        }

        return array(
            "idUnit" => $result["id_unit"],
            "idJenisPembayaran" => $result["id_jenis_pembayaran"]
        );
    }

    public function perolehIdSiswaDariNIS($nis) {
        $sql = "SELECT id FROM siswa WHERE nis LIKE :nis";
        $input[":nis"] = $nis;
        $result = $this->fetchRowQuery($sql, $input);

        if ($result === FALSE) {
            return NULL;
        }

        return $result["id"];
    }

}
