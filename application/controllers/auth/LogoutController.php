<?php

/**
 * Created by PhpStorm.
 * User: seun_
 * Date: 11/7/2017
 * Time: 10:38 PM
 */
class LogoutController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("url_helper");
        $this->load->library('session');
    }

    public function logout() {
        $this->session->unset_userdata(['user']);
        redirect($this->redirectTo());
    }

    public function redirectTo() {
        return "/";
    }


}