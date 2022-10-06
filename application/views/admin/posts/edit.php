@extends("layouts.admin.php")
@section("page:styles")
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('assets/admin/plugins/iCheck/square/blue.css')}}">
@endsection
@section("content")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Posts
        <small>Edit Post</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Posts</a></li>
        <li class="active">Edit Post</li>
      </ol>
      <br>
       @include("partials.admin_alerts")
    </section>

    
    <!-- Main content -->
    <section class="content">
    	<form method="POST" action="{{route('admin.posts.edit')}}">
    		{{csrf_field()}}
        <input type="hidden" name="id" value="{{$post->id}}">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10 col-sm-offset-1">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input class="form-control" type="text" name="title" placeholder="Short Title" required value="{{old('title', $post->title)}}" />
                </div>
                <div class="form-group">
                  <label for="published">Published</label>
                  <?php if(isset($post) && !is_null($post->published)) $p = $post->published; ?>
                  <select class="form-control" name="published">
                    <option selected disabled>Select Published State</option>
                    <option @if( $p || old('published')) selected @endif value="1">TRUE</option>
                    <option @if( !$p && !old('published')) selected @endif value="0">FALSE</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="post">Post</label>
                  <textarea style="resize:resize-y;" class="form-control" rows="20" name="post" required>{{old('post', $post->post)}}</textarea>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success btn-lg">Update Post</button>
                </div> 
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
</form>     


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section("page:scripts")
<!-- iCheck -->
<script src="{{asset('assets/admin/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue'
    });
  });
</script>
@endsection