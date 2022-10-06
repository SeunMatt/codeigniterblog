<?php

require 'BaseAdminController.php';

/**
 * Created by PhpStorm.
 * User: seun_
 * Date: 11/7/2017
 * Time: 12:29 PM
 */
class AdminController extends BaseAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        log_message("info", "Admin Dashboard called");

        $this->load->view("layouts/admin/header");
        $this->load->view("admin/dashboard/index");
        $this->load->view("layouts/admin/footer");
    }



}