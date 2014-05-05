<?php

/**
 * Objek PeninjauAbstract.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class PeninjauAbstract {

    protected $_pdo = NULL;

    protected function fetchRowQuery($sql, $input = NULL) {
        if (($pdoStatement = $this->_pdo->prepare($sql, array())) === FALSE) {
            throw new Exception("PREPARE_STATEMENT_GAGAL");
        }

        if ($pdoStatement->execute($input) === FALSE) {
            throw new Exception("EXECUTE_STATEMENT_GAGAL");
        }

        $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        if ($pdoStatement->closeCursor() === FALSE) {
            throw new Exception("CLOSE_CURSOR_GAGAL");
        }

        return $result;
    }

}
