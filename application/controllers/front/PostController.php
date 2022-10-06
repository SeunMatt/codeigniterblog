<?php

/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 01/11/2017
 * Time: 02:01 PM
 */
class PostController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('post');
    }


    public function view($id) {

        log_message("debug", "view called id $id");

        if(is_null($id) || is_null($post = $this->post->get_posts($id)) ) {
            $this->session->set_flashdata("error", "Post Not Found!");
            redirect("/");
        }

        $data['post'] = $post;
        $this->load->view("front/view", $data);
    }

}