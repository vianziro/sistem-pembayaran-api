<?php

/**
 * Objek RecordAbstract.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
abstract class RecordAbstract {

    protected $_pdo = NULL;
    protected $_errorMessage = NULL;
    protected $_primaryKeyPropertyName = "";

    public function setPDO(PDO $pdo) {
        $this->_pdo = $pdo;
    }

    public function getPDO() {
        return $this->_pdo;
    }

    public function unsetPDO() {
        $this->_pdo = NULL;
    }

    public function setPrimaryKeyPropertyName($primaryKeyPropertyName) {
        $this->_primaryKeyPropertyName = $primaryKeyPropertyName;
    }

    public function getPrimaryKeyPropertyName() {
        return $this->_primaryKeyPropertyName;
    }

    abstract protected function getSqlInsert();
    abstract protected function getSqlUpdate();
    abstract protected function getSqlSelect();
    abstract protected function getSqlDelete();
    abstract protected function getInsertParameters();
    abstract protected function getUpdateParameters();
    abstract protected function getSelectParameters();
    abstract protected function getDeleteParameters();

    public function persist() {
        if(!$this->_pdo instanceof PDO) {
            return FALSE;
        }

        /**
         * Periksa apakah ID baru harus di-set setelah pemanggilan persist().
         */
        $mustSetNewId = $this->_mustSetNewId();

        /**
         * Peroleh SQL Statement dan parameter input.
         */
        $sqlStatement = $this->_getPersistOperationSQLStatement($mustSetNewId);
        $inputParameters = $this->_getPersistOperationInputParameters($mustSetNewId);

        /**
         * Set error mode menjadi error mode exception.
         */
        if($this->_setPDOErrorModeException() === FALSE) {
            return FALSE;
        }

        try {
            /**
             * Prepare statement.
             */
            if($this->_prepareStatement($PDOStatement, $sqlStatement) === FALSE) {
                return FALSE;
            }

            /**
             * Execute statement.
             */
            if($this->_executeStatement($PDOStatement, $inputParameters) === FALSE) {
                return FALSE;
            }

            /**
             * Close cursor.
             */
            if($this->_closeCursor($PDOStatement) === FALSE) {
                return FALSE;
            }

            /**
             * Set ID baru.
             */
            if($this->_setNewId($mustSetNewId) === FALSE) {
                return FALSE;
            }

            return TRUE;
        } catch(PDOException $exception) {
            $this->_errorMessage = $exception->getMessage();
            return FALSE;
        }
    }

    public function retrieve() {
        if(!$this->_pdo instanceof PDO) {
            return FALSE;
        }

        /**
         * Peroleh SQL Statement dan parameter input.
         */
        $sqlStatement = $this->getSqlSelect();
        $inputParameters = $this->getSelectParameters();

        /**
         * Set error mode menjadi error mode exception.
         */
        if($this->_setPDOErrorModeException() === FALSE) {
            return FALSE;
        }

        try {
            /**
             * Prepare statement.
             */
            if($this->_prepareStatement($PDOStatement, $sqlStatement) === FALSE) {
                return FALSE;
            }

            /**
             * Execute statement.
             */
            if($this->_executeStatement($PDOStatement, $inputParameters) === FALSE) {
                return FALSE;
            }

            /**
             * Fetch data kemudian set property.
             */
            if($this->_fetchAssoc($PDOStatement, $recordData) === FALSE) {
                return FALSE;
            }

            $this->setProperties($recordData);

            /**
             * Close cursor.
             */
            if($this->_closeCursor($PDOStatement) === FALSE) {
                return FALSE;
            }

            return TRUE;
        } catch(PDOException $exception) {
            $this->_errorMessage = $exception->getMessage();
            return FALSE;
        }
    }

    private function _getPersistOperationSQLStatement($mustSetNewId) {
    	$primaryKeyPropertyName = $this->getPrimaryKeyPropertyName();
        $emptyPrimaryKeyProperty = (strlen($primaryKeyPropertyName) < 1);

        /**
         * Jika harus set ID baru atau tidak ada property ID, maka gunakan statement INSERT. Jika tidak, maka gunakan statement UPDATE.
         */
        if($mustSetNewId or $emptyPrimaryKeyProperty) {
            return $this->getSqlInsert();
        }

        return $this->getSqlUpdate();
    }

    private function _getPersistOperationInputParameters($mustSetNewId) {
    	$primaryKeyPropertyName = $this->getPrimaryKeyPropertyName();
        $emptyPrimaryKeyProperty = (strlen($primaryKeyPropertyName) < 1);

        /**
         * Jika harus set ID baru atau tidak ada property ID, maka gunakan statement INSERT. Jika tidak, maka gunakan statement UPDATE.
         */
        if($mustSetNewId or $emptyPrimaryKeyProperty) {
            return $this->getInsertParameters();
        }

        return $this->getUpdateParameters();
    }

    private function _setPDOErrorModeException() {
        if($this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) === FALSE) {
            $errorInfo = $this->_pdo->errorInfo();
            $this->_errorMessage = "Set PDO attribute failed. " . $errorInfo[2];

            return FALSE;
        }

        return TRUE;
    }

    private function _prepareStatement(&$PDOStatement, $sqlStatement) {
        if(($PDOStatement = $this->_pdo->prepare($sqlStatement)) === FALSE) {
            $errorInfo = $this->_pdo->errorInfo();
            $this->_errorMessage = "Prepare statement failed. " . $errorInfo[2];

            return FALSE;
        }

        return TRUE;
    }

    private function _executeStatement($PDOStatement, $inputParameters) {
        if(empty($inputParemeters)) {
            $inputParemeters = NULL;
        }

        if($PDOStatement->execute($inputParameters) === FALSE) {
            $errorInfo = $this->_pdo->errorInfo();
            $this->_errorMessage = "Statement execution failed. " . $errorInfo[2];
            $PDOStatement->closeCursor();

            return FALSE;
        }

        return TRUE;
    }

    private function _fetchAssoc($PDOStatement, &$recordData) {
        $recordData = array();

        if(($data = $PDOStatement->fetch(PDO::FETCH_ASSOC)) === FALSE) {
            $errorInfo = $this->_pdo->errorInfo();
            $this->_errorMessage = "Record not found. " . $errorInfo[2];
            $PDOStatement->closeCursor();

            return FALSE;
        }

        $recordData = $data;
        return TRUE;
    }

    private function _closeCursor($PDOStatement) {
        if($PDOStatement->closeCursor() === FALSE) {
            $errorInfo = $this->_pdo->errorInfo();
            $this->_errorMessage = "Close cursor failed. " . $errorInfo[2];

            return FALSE;
        }

        return TRUE;
    }

    private function _mustSetNewId() {
        $primaryKeyPropertyName = $this->getPrimaryKeyPropertyName();
        $emptyPrimaryKeyProperty = (strlen($primaryKeyPropertyName) < 1);

        if($emptyPrimaryKeyProperty) {
            return FALSE;
        } else {
            return ($this->$primaryKeyPropertyName === NULL);
        }
    }

    private function _setNewId($mustSetNewId) {
        $lastInsertId = $this->_pdo->lastInsertId();

        /**
         * Jika harus set ID baru, maka set ID baru dengan nilai lastInsertId.
         */
        if($mustSetNewId) {
            if($lastInsertId == "0") {
                $this->_errorMessage = "PDO::lastInsertId returns \"0\".";
                return FALSE;
            }

            $primaryKeyPropertyName = $this->getPrimaryKeyPropertyName();
            $this->$primaryKeyPropertyName = $lastInsertId;
        }

        return TRUE;
    }

    public function getErrorMessage() {
        return $this->_errorMessage;
    }

    protected function setProperties($recordData) {
        foreach($recordData as $column => $value) {
            $parsedColumnName = explode("_", $column);
            $propertyName = "";

            foreach($parsedColumnName as $segment) {
                if(!empty($segment)) {
                    $propertyName .= ucfirst($segment);
                }
            }

            $propertyName = lcfirst($propertyName);
            $this->$propertyName = $value;
        }
    }

}
