<?php

require 'BaseAdminController.php';

/**
 * Created by PhpStorm.
 * User: seun_
 * Date: 13-Nov-17
 * Time: 12:26 PM
 */
class AdminPostsController extends BaseAdminController {


    public function __construct() {
        parent::__construct();
        $this->load->model('post');
    }

    public function index() {
        $this->load->view("admin/posts/index");
    }

    public function getPostsJson() {
        log_message("error", "Get Posts Json Called");
        echo json_encode($this->post->get_posts());
    }

    public function delete() {

        log_message("error", "Admin Delete Posts Controller Invoked!");

        if(is_null($id = $this->input->post("id"))) {
            $this->session->set_flashdata("error", "Invalid Post Id");
            return;
        }

        if($this->post->delete($id)) {
            $this->session->set_flashdata("success", "Post Deleted Successfully");
        } else {
            $this->session->set_flashdata("error", "Unable to Delete Post. Try Again");
        }

        redirect("admin/posts");

        return;
    }

    public function add() {

        if($this->input->server('REQUEST_METHOD') == 'GET') {
            $this->load->view("admin/posts/add");
        }
        else {

            echo "Invalid Method";


        }

    }

    public function bulk() {
        if($this->input->server('REQUEST_METHOD') == 'GET') {
            $this->load->view("admin/posts/bulk");
        }
        else if($this->input->server('REQUEST_METHOD') == 'POST') {


            $data = json_decode($this->input->post("data"), true);
            $columnMap = json_decode($this->input->post("column_map"), true);

            log_message("error", "raw data \n" . $this->input->post("data"));

            log_message("error", "column Map");
            log_message("error", json_encode($columnMap));

            foreach ($data as $datum) {
                log_message("error", json_encode($datum));
            }
            header("Content-type: application/json");
            echo json_encode(["data" => $data]);
        }
        else {
            echo "Invalid Method";
        }
    }

}