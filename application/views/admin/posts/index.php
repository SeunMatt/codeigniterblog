<?php include APPPATH . "/views/layouts/admin/header.php"; ?>
 <!-- DataTables -->
<!--  <link rel="stylesheet" href="--><?php //echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css'); ?><!--">-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-app="adminPosts" ng-controller="AdminPostsController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Posts
        <small>All Posts</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Posts</li>
      </ol>
      <br>
      <div class="ng-view"></div>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php include APPPATH . "/views/partials/admin-alerts.php"; ?>

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-sm-12">
            <a href="#!add" class="btn btn-success btn-lg">Create New Post</a>
            <br><br>
      			 <!-- /.content-wrapper -->
				<div class="box">
		            <div class="box-header">
		              <h3 class="box-title">Manage Posts</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">

                 <form id="delForm" method="POST" action="<?php echo base_url('admin/posts/delete'); ?>">
                  <input type="hidden" name="id" value="" />
                 </form>
                      <table id="posts-table" class="table table-bordered table-striped">
		                <thead>
		                <tr>
		                  <th>Title</th>
		                  <th>Post</th>
                      <th>Author</th>
		                  <th>Created_at</th>
		                  <th>Published</th>
		                  <th></th>
                      <th></th>
		                </tr>
		                </thead>
		                <tbody>
		                <tr ng-repeat="post in posts">
		                  <td>{{post.title}}</td>
		                  <td>{{post.post | limitTo: 100}}</td>
                          <td>{{post.author}}</td>
                          <td>{{post.created_at}}</td>
		                  <td>{{post.published}}</td>
		                  <td><a href="{{baseUrl + 'admin/posts/' + post.id}}" class="btn btn-xs btn-info">EDIT</a></td>
		                  <td><a href="#" ng-click="deletePost(post.id)" class="btn btn-xs btn-danger del">DEL</a></td>
		                </tr>
		                </tbody>
		              </table>
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

<script src="<?php echo base_url('assets/admin/js/angular.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/angular-route.min.js'); ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- page script -->
<script>
    let app = angular.module("adminPosts", ["ngRoute"]);
    app.controller("AdminPostsController", function ($scope, $http) {

        $http.get("<?php echo base_url('admin/posts/json'); ?>")
            .then(function (response) {
                    $scope.posts = response.data;
            })
            .catch(function (error) {
                console.log("Error Occurred while Loading Data \n" + JSON.stringify(error));
            });

        $scope.deletePost = function (id) {
            console.log("id = " + id);
            swal({
                title: "Are you sure?",
                text: "This action is not reversible!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
             .then((willDelete) => {
                    if (willDelete) {
                        $("input[name='id']").val(id);
                        console.log($("input[name='id']").val());
                        document.getElementById("delForm").submit();
//                        swal("Post is being Deleted...", {
//                            icon: "success",
//                        });
                    } else {
                        swal("Delete Operation Cancelled!");
                    }
                });
        };

        app.config(['$routeProvider',
            function($routeProvider) {
                $routeProvider
                    .when('/add', {
                        template: "<html><h1>Hello Add Posts</h1></html>"
                    }).otherwise({
                        templateUrl: '/admin/posts'
                    });
         }]);

    });

</script>
<!--<script>-->
<!--  $(function () {-->
<!--    $('#posts-table').DataTable({-->
<!--      "paging": true,-->
<!--      "lengthChange": false,-->
<!--      "searching": false,-->
<!--      "ordering": true,-->
<!--      "info": true,-->
<!--      "autoWidth": false,-->
<!--      "aaSorting": [],-->
<!--    });-->
<!---->
<!---->
<!--    $(document).on("click", "#posts-table td .del", function(event) {-->
<!--        event.preventDefault();-->
<!--        swal({-->
<!--            title: "Are you sure?",-->
<!--            text: "This action is not reversible!",-->
<!--            icon: "warning",-->
<!--            buttons: true,-->
<!--            dangerMode: true,-->
<!--          })-->
<!--          .then((willDelete) => {-->
<!--            if (willDelete) {-->
<!--              $("input[name='id']").val( $(this).attr("data-id"));-->
<!--              document.getElementById("delForm").submit();  -->
<!--              swal("Post is being Deleted...", {-->
<!--                icon: "success", -->
<!--              });-->
<!--            } else {-->
<!--              swal("Delete Operation Cancelled!"); -->
<!--            }-->
<!--          });-->

<!--    });-->
<!--  });-->
<!--</script>-->
<?php include APPPATH ."/views/layouts/admin/footer.php"; ?>