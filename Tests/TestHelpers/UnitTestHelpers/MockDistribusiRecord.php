<?php

if (!class_exists("DistribusiRecord")) {

    class DistribusiRecord {

    }

}

class MockDistribusiRecord extends DistribusiRecord {

    protected $mockInsertId = NULL;
    protected $mockPersistReturnValue = TRUE;
    protected $mockRetrieveReturnValue = TRUE;
    protected $mockRetrieveSetValues = array();
    protected $persistInsertCallCount = 0;
    protected $persistUpdateCallCount = 0;

    public function setMockInsertId($id) {
        $this->mockInsertId = $id;
    }

    public function setMockPersistReturnValue($persistReturnValue) {
        $this->mockPersistReturnValue = $persistReturnValue;
    }

    public function setMockRetrieveReturnValue($retrieveReturnValue) {
        $this->mockRetrieveReturnValue = $retrieveReturnValue;
    }

    public function setMockRetrieveSetValues($retrieveSetValues) {
        $this->mockRetrieveSetValues = $retrieveSetValues;
    }

    public function setMockValues(array $values) {
        foreach ($values as $propertyName => $value) {
            if (property_exists($this, $propertyName)) {
                $this->$propertyName = $value;
            }
        }
    }

    public function getMockPersistInsertCallCount() {
        return $this->persistInsertCallCount;
    }

    public function getMockPersistUpdateCallCount() {
        return $this->persistUpdateCallCount;
    }

    public function persist() {
        if ($this->id === NULL) {
            $this->persistInsertCallCount ++;
            $this->id = $this->mockInsertId;
        } else {
            $this->persistUpdateCallCount ++;
        }

        return $this->mockPersistReturnValue;
    }

    public function retrieve() {
        $this->setMockValues($this->mockRetrieveSetValues);
        return $this->mockRetrieveReturnValue;
    }

    protected $id = NULL;
    protected $idAlokasi = NULL;
    protected $idTagihan = NULL;
    protected $nilai = NULL;

    public function __construct() {
        $this->setPrimaryKeyPropertyName("id");
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function unsetId() {
        $this->id = NULL;
    }

    public function setIdAlokasi($idAlokasi) {
        $this->idAlokasi = $idAlokasi;
    }

    public function getIdAlokasi() {
        return $this->idAlokasi;
    }

    public function unsetIdAlokasi() {
        $this->idAlokasi = NULL;
    }

    public function setIdTagihan($idTagihan) {
        $this->idTagihan = $idTagihan;
    }

    public function getIdTagihan() {
        return $this->idTagihan;
    }

    public function unsetIdTagihan() {
        $this->idTagihan = NULL;
    }

    public function setNilai($nilai) {
        $this->nilai = $nilai;
    }

    public function getNilai() {
        return $this->nilai;
    }

    public function unsetNilai() {
        $this->nilai = NULL;
    }

}
