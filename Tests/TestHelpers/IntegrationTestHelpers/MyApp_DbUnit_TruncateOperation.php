<?php

/**
 * Class MyApp_DbUnit_TruncateOperation untuk truncate tabel di database.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class MyApp_DbUnit_TruncateOperation extends PHPUnit_Extensions_Database_Operation_Truncate {

    public function execute(\PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection, \PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet) {
        $connection->getConnection()->query("SET FOREIGN_KEY_CHECKS = 0");
        parent::execute($connection, $dataSet);
        $connection->getConnection()->query("SET FOREIGN_KEY_CHECKS = 1");
    }

}
