<?php
// Class for Table - vt_user

class vt_user{
    private $user_uid;
    private $user_fname;
    private $user_lname;
    private $user_email;
    private $user_image;
    private $user_active;
    private $user_type;
    private $user_password;
    private $user_date;


    public function get_user_uid() {
        return $this->user_uid;
    }
    public function set_user_uid($p_value) {
        $this->user_uid = $p_value;
    }
    public function get_user_fname() {
        return $this->user_fname;
    }
    public function set_user_fname($p_value) {
        $this->user_fname = $p_value;
    }
    public function get_user_lname() {
        return $this->user_lname;
    }
    public function set_user_lname($p_value) {
        $this->user_lname = $p_value;
    }
    public function get_user_email() {
        return $this->user_email;
    }
    public function set_user_email($p_value) {
        $this->user_email = $p_value;
    }
    public function get_user_image() {
        return $this->user_image;
    }
    public function set_user_image($p_value) {
        $this->user_image = $p_value;
    }
    public function get_user_active() {
        return $this->user_active;
    }
    public function set_user_active($p_value) {
        $this->user_active = $p_value;
    }
    public function get_user_type() {
        return $this->user_type;
    }
    public function set_user_type($p_value) {
        $this->user_type = $p_value;
    }
    public function get_user_password() {
        return $this->user_password;
    }
    public function set_user_password($p_value) {
        $this->user_password = $p_value;
    }
    public function get_user_date() {
        return $this->user_date;
    }
    public function set_user_date($p_value) {
        $this->user_date = $p_value;
    }


}
?>