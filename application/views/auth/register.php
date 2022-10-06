<style>
    .error {
        color: darkred !important;
    }
</style>
<div class="register-box">
  <div class="register-logo">
      <a href="<?php echo base_url('/'); ?>"><b>CodeIgniter</b> Blog</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>
      <?php if(validation_errors()) echo "<ul>" . validation_errors("<li class='error'>", "</li>")."</ul>"; ?>
      <?php if(isset($error)) echo "<p class='login-box-msg' style='color:darkred;'> $error </p>"; ?>
    <form action="<?php echo base_url('/register'); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="name"  value="<?php  echo set_value("name", ''); ?>" class="form-control" placeholder="Full name" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" value="<?php echo set_value("email", ''); ?>" class="form-control" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="<?php base_url("login"); ?>" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->