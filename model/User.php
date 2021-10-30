<?php

class User {

    private $userid;
    private $password;
    private $email;
    private $address;
	private $country;
    private $gender;
    private $phone;
    private $personType;

    function __construct($password, $email, $address, $country, $gender, $phone, $personType) {
        $this->password = $password;
        $this->email = $email;
        $this->address = $address;
        $this->country = $country;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->personType = $personType;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPersonType() {
        return $this->personType;
    }

    public function setEmail($e) {
        $this->email = $e;
    }

    public function setPassword($p) {
        $this->password = $p;
    }

    public function setAddress($a) {
        $this->address = $a;
    }

    public function setCountry($c) {
        $this->country = $c;
    }

    public function setGender($g) {
        $this->gender = $g;
    }

    public function setPhone($p) {
        $this->phone = $p;
    }

    public function setPersonType($p) {
        $this->personType = $p;
    }

}

?>