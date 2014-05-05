<?php

class MockAlokasiRecord extends AlokasiRecord {

    protected $mockInsertId = NULL;
    protected $mockPersistReturnValue = TRUE;
    protected $mockRetrieveReturnValue = TRUE;
    protected $mockRetrieveSetValues = array();

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

    public function persist() {
        $this->id = $this->mockInsertId;
        return $this->mockPersistReturnValue;
    }

    public function retrieve() {
        $this->setMockValues($this->mockRetrieveSetValues);
        return $this->mockRetrieveReturnValue;
    }

}
