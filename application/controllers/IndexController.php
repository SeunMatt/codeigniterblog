<?php

/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 01/11/2017
 * Time: 02:01 PM
 */
class IndexController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('post');
        $this->load->helper('url_helper');
    }

    public function index() {

        log_message("info", "index called");

        $data['posts'] = $this->post->get_posts();

        $this->load->view("front/index", $data);
    }


}