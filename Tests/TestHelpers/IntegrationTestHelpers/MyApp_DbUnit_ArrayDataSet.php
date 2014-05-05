<?php

/**
 * Class MyApp_DbUnit_ArrayDataSet untuk data set jenis array.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class MyApp_DbUnit_ArrayDataSet extends PHPUnit_Extensions_Database_DataSet_AbstractDataSet {

    protected $tables = array();

    public function __construct(array $data) {
        foreach ($data as $tableName => $rows) {
            $columns = array();

            if (isset($rows[0])) {
                $columns = array_keys($rows[0]);
            }

            $metaData = new PHPUnit_Extensions_Database_DataSet_DefaultTableMetaData($tableName, $columns);
            $table = new PHPUnit_Extensions_Database_DataSet_DefaultTable($metaData);

            foreach ($rows as $row) {
                $table->addRow($row);
            }

            $this->tables[$tableName] = $table;
        }
    }

    protected function createIterator($reverse = FALSE) {
        return new PHPUnit_Extensions_Database_DataSet_DefaultTableIterator($this->tables, $reverse);
    }

    public function getTable($tableName) {
        if (!isset($this->tables[$tableName])) {
            throw new InvalidArgumentException("$tableName is not a table in the current database");
        }

        return $this->tables[$tableName];
    }

}
