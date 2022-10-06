<?php

/**
 * Created by PhpStorm.
 * User: seun_
 * Date: 11/7/2017
 * Time: 9:56 AM
 */
class RegisterController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library("form_validation");
        $this->load->model("user");
    }

    public function index() {
        $this->loadViews();
    }

    private function validate() {
        $this->form_validation->set_rules("name", "Name", "trim|required|max_length[250]|min_length[3]");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("password", "Password", "trim|required|max_length[50]");
        $this->form_validation->set_rules("password_confirmation", "Confirm Password", "trim|required|matches[password]");
        return $this->form_validation->run();
    }

    public function register() {

        if(!$this->validate()) {
            $this->loadViews();
        } else {
            $resp = $this->user->insert([
                "name" => $this->input->post("name"),
                "email" => $this->input->post("email"),
                "password" => password_hash($this->input->post("password"), PASSWORD_BCRYPT),
                "is_admin" => false,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ]);

            if($resp) {
//                $this->storeUserDataInSession($user);
                redirect($this->redirectTo());
            } else {
                $this->loadViews(["error" => "Error Saving Data to Database. Please Try Again"]);
            }
        }
    }

    private function loadViews($data = null) {
        $this->load->view("layouts/auth/header", ["page" => "register-page"]);
        $this->load->view("auth/register", $data);
        $this->load->view("layouts/auth/footer");
    }

    public function redirectTo() {
        return "admin/dashboard";
    }

    public function storeUserDataInSession($user) {
        $data = [
            "name" => $user['name'],
            "email" => $user['email'],
            "id" => $user['id'],
            "is_admin" => $user['is_admin']
        ];

        $this->session->set_userdata(["user" => $data]);
    }

}