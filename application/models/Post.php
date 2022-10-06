<?php

/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 01/11/2017
 * Time: 02:40 PM
 */
class Post extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_posts($id = null) {
        if (is_null($id)) {
            $query = $this->db->get('posts');
            return $query->result_array();
        }

        $query = $this->db->where('id', $id)->get("posts");
        return $query->row_array();
    }

    public function delete($id) {
        return $this->db->where("id", $id)->delete("posts");
    }

}