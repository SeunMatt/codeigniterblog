<?php

if($this->session->flashdata("error")) {
    echo "<div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button >
        <h4><i class='icon fa fa-ban'></i> Alert!</h4>".
          $this->session->flashdata("error")
        ."</div>";
}


if($this->session->flashdata("success")) {
    echo "<div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button >
        <h4><i class='icon fa fa-check-circle'></i></h4>".
           $this->session->flashdata("success")
        ."</div>";
}

if($this->session->flashdata("status")) {
    echo "<div class='alert alert-info alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button >
        <h4><i class='icon fa fa-info'></i></h4>".
        $this->session->flashdata("status")
        ."</div>";
}

?>
