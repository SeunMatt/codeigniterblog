<?php

/**
 * Created by PhpStorm.
 * User: seun_
 * Date: 11/7/2017
 * Time: 9:08 AM
 */
class LoginController extends CI_Controller {


    private $facebook;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('user');

        $this->facebook = $fb = new Facebook\Facebook([
          'app_id' => '563495527359848',
          'app_secret' => 'b5e9d06ca70c78a29e23c6765570fdf7',
          'default_graph_version' => 'v2.10',
        ]);

    }


    public function index() {


        $helper = $this->facebook->getRedirectLoginHelper();
        $loginUrl = $helper->getLoginUrl(base_url('fb-login-callback'));

        log_message("error", "login URL: " . $loginUrl);

        $this->load->view("layouts/auth/header", ["page" => "login-page"]);
        $this->load->view("auth/login", ["fbLoginUrl" => $loginUrl]);
        $this->load->view("layouts/auth/footer");
    }

    public function login() {

        log_message("info", "RAW INPUTS: " . json_encode($this->input->post()));


        if(!$this->validate() ||
            is_null($user = $this->user->get_user_by_email($this->input->post("email")))
        ) {
            $this->loadViews(["error" => "Username/Password Mismatch"]);
        }

        if(!$this->authenticate($this->input->post("password"), $user['password'])) {
            $this->loadViews(["error" => "Username/Password Mismatch"]);
        }
        else {
            log_message("info", "Log in successful");
            $this->storeUserDataInSession($user);
            redirect($this->redirectTo());
        }

    }

    public function facebookLogin() {

        $helper = $this->facebook->getRedirectLoginHelper();

        try {

            $accessToken = $helper->getAccessToken();

        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            log_message("error", 'Facebook Graph returned an error: ' . $e->getMessage());
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            log_message("error", 'Facebook SDK returned an error: ' . $e->getMessage());
        }

        if (! isset($accessToken)) {

            if ($helper->getError()) {
                log_message("error", "Error: " . $helper->getError() . "\n"
                . "Error Code: " . $helper->getErrorCode() . "\n"
                . "Error Reason: " . $helper->getErrorReason() . "\n"
                . "Error Description: " . $helper->getErrorDescription() . "\n");
            }

            $this->session->set_flashdata("error", "There was an error logging in with Facebook. Please try again");
            redirect("/login");
        }

// Logged in
        log_message("error", "Access Token " . $accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $this->facebook->getOAuth2Client();

// Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        log_message("error", "Metadata: " . json_encode($tokenMetadata));


        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                log_message("error", "Error getting long-lived access token: " . $e->getMessage() . "\n");
                $this->session->set_flashdata("error", "There was an error logging in with Facebook. Please try again");
                redirect("/login");
            }

            log_message("error", "Long-lived : " . $accessToken->getValue());
        }

        $this->session->set_userdata('fb_access_token', $accessToken);


       $this->session->set_flashdata("status", "Facebook Login Successful");
       redirect("/login");

    }


    private function authenticate($password, $hashedpassword) {
        return password_verify($password, $hashedpassword);
    }

    public function redirectTo() {
        return "admin/dashboard";
    }

    private function validate() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        return $this->form_validation->run();
    }

    private function loadViews($data = null) {
        $this->load->view("layouts/auth/header", ["page" => "login-page"]);
        $this->load->view("auth/login", $data);
        $this->load->view("layouts/auth/footer");
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