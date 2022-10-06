<?php

require 'BaseAdminController.php';

/**
 * Created by PhpStorm.
 * User: seun_
 * Date: 06-Jan-18
 * Time: 8:00 AM
 */
class LogViewerController extends BaseAdminController {


    private $logViewer;

    public function __construct() {
        parent::__construct();
        $this->logViewer = new \CILogViewer\CILogViewer();

    }

    public function index() {
        $finalContent = $this->logViewer->showLogs();
//        log_message("error", "content in controller : \n" . $finalContent);
        echo $finalContent;
        return;
    }

}