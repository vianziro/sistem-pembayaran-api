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

}
