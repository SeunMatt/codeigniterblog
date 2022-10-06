<?php

/**
 * Created by PhpStorm.
 * User: seun_
 * Date: 14-Nov-17
 * Time: 9:28 AM
 */
class BaseAdminController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->isAllowed();
    }

    public function checkAuth() {
        return $this->session->has_userdata('user');
    }

    public function isAllowed() {

        //add API Authentication here
        $uri = $this->uri->uri_string();

        if(preg_match("/(api\/v1\/).+/", $uri) > 0) {
            //we need to do API authentication here

        }
        else {
            //do validation for other endpoints
            if((!$this->checkAuth())) {
                $this->session->set_flashdata("error", "Unauthorized Access");
                redirect("/login");
            }
        }

    }

}