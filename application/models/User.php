<?php

/**
 * Created by PhpStorm.
 * User: seun_
 * Date: 11/7/2017
 * Time: 10:04 AM
 */
class User extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_user($id) {
        if(is_null($id))
            throw new Exception("User id is required");

        return $this->db->get_where('users', array('id' => $id))->row_array();
    }

    public function get_user_by_email($email) {
        if(is_null($email))
            throw new Exception("User id is required");

        return $this->db->get_where('users', array('email' => $email))->row_array();
    }


    public function insert($data) {
        $this->db->insert('users', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

}