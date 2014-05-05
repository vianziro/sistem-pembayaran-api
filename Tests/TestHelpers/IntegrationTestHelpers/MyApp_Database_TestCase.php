<?php

/**
 * Class MyApp_Database_TestCase untuk pengujian yang melibatkan komunikasi database.
 *
 * @author Andi Malik <andi.malik.notifications@gmail.com>
 */
class MyApp_Database_TestCase extends PHPUnit_Extensions_Database_TestCase {

    protected static $pdo = NULL;
    protected $databaseConnection = NULL;
    protected $dataSet = array();

    protected function getSetUpOperation() {
        parent::getSetUpOperation();

        return new PHPUnit_Extensions_Database_Operation_Composite(
                //array(new MyApp_DbUnit_TruncateOperation, PHPUnit_Extensions_Database_Operation_Factory::INSERT())
                array(new MyApp_DbUnit_TruncateOperation, new MyApp_DbUnit_InsertOperation)
        );
    }

    protected function getTearDownOperation() {
        parent::getTearDownOperation();

        return new MyApp_DbUnit_TruncateOperation;
    }

    final public function getConnection() {
        if ($this->databaseConnection === NULL) {
            if (self::$pdo === NULL) {
                self::$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            $this->databaseConnection = $this->createDefaultDBConnection(self::$pdo, DB_NAME);
        }

        return $this->databaseConnection;
    }

    protected function getDataSet() {
        return new MyApp_DbUnit_ArrayDataSet($this->dataSet);
    }

    /**
     * Method untuk menyiapkan data untuk dataset.
     */
    protected function mySetDataSet($dataSet) {
        $this->dataSet = $dataSet;
    }

    /**
     * Method untuk setup data set yang berbeda untuk tiap test case.
     * @link http://tylkowski.net/2011/09/18/phpunit-use-different-dataset-on-every-test-in-a-testcase/ Method untuk setup data set yang berbeda untuk tiap test case.
     */
    protected function mySetup(PHPUnit_Extensions_Database_DataSet_AbstractDataSet $dataSet) {
        PHPUnit_Framework_TestCase::setUp();

        $this->databaseTester = NULL;
        $this->getDatabaseTester()->setSetUpOperation($this->getSetUpOperation());
        $this->getDatabaseTester()->setDataSet($dataSet);
        $this->getDatabaseTester()->onSetUp();
    }

    /**
     * Method untuk menonaktifkan pemeriksaan foreign key.
     */
    protected function myDisableForeignKeyChecks() {
        self::$pdo->query("SET FOREIGN_KEY_CHECKS = 0");
    }

    /**
     * Method untuk mengaktifkan pemeriksaan foreign key.
     */
    protected function myEnableForeignKeyChecks() {
        self::$pdo->query("SET FOREIGN_KEY_CHECKS = 1");
    }

}
