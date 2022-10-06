<?php

require 'BaseAdminController.php';

/**
 * Created by Seun Matt.
 * User: seun_
 * Date: 13-Aug-18
 * Time: 3:27 PM
 */
class ApiLogViewerController extends BaseAdminController {

    private $logViewer;

    public function __construct() {
        parent::__construct();
        $this->logViewer = new \CILogViewer\CILogViewer();
    }

    public function index() {
        $finalContent = $this->logViewer->showLogs();
        echo $finalContent;
        return;
    }

}