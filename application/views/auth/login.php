<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url('/'); ?>"><b>CodeIgniter</b> Blog</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
      <?php include VIEWPATH . "/partials/admin-alerts.php"; ?>
      <?php echo validation_errors(); ?>
      <?php if(isset($error)) echo "<p class='login-box-msg' style='color:darkred;'> $error </p>"; ?>
    <form action="<?php echo base_url('/login'); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email', ''); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

      <div class="social-auth-links text-center">
          <p>- OR -</p>
          <?php if(isset($fbLoginUrl)): ?>
          <a href="<?= $fbLoginUrl; ?>" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
              Facebook</a>
          <?php endif; ?>
      </div>
      <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="<?php echo base_url('register'); ?>" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->