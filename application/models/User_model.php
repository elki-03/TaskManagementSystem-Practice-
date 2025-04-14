<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model { //CI_Model with uppercase M or model is not functioning

    //gets user data from database for login and usercheck
    public function get_user_from_db($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users'); //name of table
        return $query->row_array(); //returns value as an array or NULL
    }

    // sets user in database for registration
    public function save_user_in_db($username, $pw) {
        $data = array (
            'username' => $username,
            'password' => $pw
        );
        return $this->db->insert('users', $data);
    }
}