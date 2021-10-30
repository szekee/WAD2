<?php

class Profile {

    private $userid;
    private $name;
    private $roles;
    private $email;
    private $address;
	private $country;
    private $gender;
    private $phone;
    private $skills;
    private $bio;
    private $profilepic;
    private $portfoliolink;
    private $portfoliopath;

    function __construct($userid, $name, $roles, $email, $address, $country, $gender, $phone, $skills, $bio, $profilepic, $portfoliolink, $portfoliopath) {
        $this->userid = $userid;
        $this->name = $name;
        $this->roles = $roles;
        $this->email = $email;
        $this->address = $address;
        $this->country = $country;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->skills = $skills;
        $this->bio = $bio;
        $this->profilepic = $profilepic;
        $this->portfoliolink = $portfoliolink;
        $this->portfoliopath = $portfoliopath;
    }

    public function getUserid() {
        return $this->userid;
    }

    public function getName() {
        return $this->name;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getEmail() {
        return $this->email;
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

    public function getSkills() {
        return $this->skills;
    }

    public function getBio() {
        return $this->bio;
    }

    public function getProfilepic() {
        return $this->profilepic;
    }

    public function getPortfoliolink() {
        return $this->portfoliolink;
    }

    public function getPortfoliopath() {
        return $this->portfoliopath;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setUserid($userid) {
        $this->userid = $userid;
    }

    public function setRoles($roles) {
        $this->roles = $roles;
    }

    public function setEmail($e) {
        $this->email = $e;
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

    public function setSkills($s) {
        $this->skills = $s;
    }

    public function setBio($b) {
        $this->bio = $b;
    }

    public function setProfilepic($p) {
        $this->profilepic = $p;
    }

    public function setPortfoliolink($p) {
        $this->portfoliolink = $p;
    }

    public function setPortfoliopath($p) {
        $this->portfoliopath = $p;
    }


}

?>