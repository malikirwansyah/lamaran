
<style type="text/css">
    body{
  background: url('<?php echo base_url(); ?>assets/images/back.jpg')no-repeat center center fixed;
   -webkit-background-size: 100% 100%;
                -moz-background-size: 100% 100%;
                -o-background-size: 100% 100%;
                background-size: 100% 100%;
}
  </style>
  <?php echo $script_captcha; // javascript recaptcha ?>
  <div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body animated zoomIn">
      <?php if($this->session->flashdata('result_login')) { ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">X</button>
    <?php echo $this->session->flashdata('result_login'); ?>
  </div>
  <?php } ?>

    <p class="text-center">
      <font size="5"> <b>Rs.Baiturrahim Jambi</b></font>
    </p>

    <form action="<?php echo base_url(); ?>app/forgot/" method="post" class="animated swing">
      <div class="form-group has-feedback ">
        <input type="text" name="email" required class="form-control" placeholder="Email Anda">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      
      <div class="form-group has-feedback">
        <?php echo $captcha // tampilkan recaptcha ?>
      </div>
       
        <button type="submit" class="btn btn-block bg-green btn-flat" name="submit"><i class="fa fa-sign-in"></i> Sign In</button>
        
    </form><br>

  <div class="form-group has-feedback ">
    Not Registed? <a href="<?php echo base_url(); ?>app/register">Create an Account</a>
  </div>
  
  <div class="form-group has-feedback ">
   if you have any problem please contact me in <a href="">here</a>
  </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

  
