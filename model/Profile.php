<?php

class Profile {

    private $userid;
    private $name;
    private $roles;
    private $email;
    private $address;
	private $country;
    private $phone;

    private $skills;
    private $bio;
    private $videoid;
    private $profilepic;
    private $portfoliolink;
    private $portfoliopath;

    private $facebook;
    private $instagram;
    private $youtube;
    private $pinterest;

    function __construct($userid, $name, $roles, $email, $address, $country, $phone, $skills, $bio, $videoid, $profilepic, $portfoliolink, $portfoliopath, $facebook, $instagram, $youtube, $pinterest) {
        $this->userid = $userid;
        $this->name = $name;
        $this->roles = $roles;
        $this->email = $email;
        $this->address = $address;
        $this->country = $country;
        $this->phone = $phone;

        $this->skills = $skills;
        $this->bio = $bio;
        $this->videoid = $videoid;
        $this->profilepic = $profilepic;
        $this->portfoliolink = $portfoliolink;
        $this->portfoliopath = $portfoliopath;
        
        $this->facebook = $facebook;
        $this->instagram = $instagram;
        $this->youtube = $youtube;
        $this->pinterest = $pinterest;
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

    public function getPhone() {
        return $this->phone;
    }





    public function getSkills() {
        return $this->skills;
    }

    public function getBio() {
        return $this->bio;
    }

    public function getVideoid() {
        return $this->videoid;
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




    public function getFacebook() {
        return $this->facebook;
    }
    public function getInstagram() {
        return $this->instagram;
    }
    public function getYoutube() {
        return $this->youtube;
    }
    public function getPinterest() {
        return $this->pinterest;
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