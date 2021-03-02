<?php

class User {
    private $_name;
    private $_age;
    private $_address;
    private $_date;

    public function __construct(string $name, string $age, string $address, string $date){
        $this->_name = $name;
        $this->_age = $age;
        $this->_address = $address;
        $this->_date = $date;
    }

    public function get_name() {
        return $this->_name;
    }

    public function get_age() {
        return $this->_age;
    }

    public function get_address() {
        return $this->_address;
    }

    public function get_date() {
        return $this->_date;
    }
}

?>