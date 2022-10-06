<?php include APPPATH . "/views/layouts/admin/header.php"; ?>
<style>
    .error {
        border: 2px solid red;
    }
</style>
    <!-- DataTables -->
    <!--  <link rel="stylesheet" href="--><?php //echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css'); ?><!--">-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="adminPosts" ng-controller="AdminPostsController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Bulk Upload
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url("admin/dashboard"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Bulk Upload</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <?php include APPPATH . "/views/partials/admin-alerts.php"; ?>

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-sm-12">
<!--                    <a href="#!add" class="btn btn-success btn-lg">Create New Post</a>-->
<!--                    <br><br>-->
                    <!-- /.content-wrapper -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Import Data</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select class="form-control" id="dataType">
                                            <option value="-1" disabled selected>Select Data to Import</option>
                                            <option value="<?= base_url('/admin/posts/add/bulk'); ?>">Import Posts Data</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" id="fileUploader" class="btn btn-fill btn-primary btn-large" />
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div id="tableOutput">
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- DataTables -->

    <script src="<?= base_url('assets/js/sweetalert.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/FileSaver.js'); ?>"></script>
    <script src="<?= base_url("assets/js/vendor/sheetjs/xlsx.full.min.js"); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/excel_uploader.js'); ?>"></script>

    <!-- page script -->
    <script>


        $(document).ready( function () {

            let e = new ExcelUploader({
               maxInAGroup: 10,
               serverColumnNames: ["Facebook URL", "Twitter ID", "Medium Handle"],
               importTypeSelector: "#dataType",
               fileChooserSelector: "#fileUploader",
               outputSelector: "#tableOutput"
           });
        });
    </script>

<?php include APPPATH ."/views/layouts/admin/footer.php"; ?>