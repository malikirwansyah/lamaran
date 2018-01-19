
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- animate -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/animate.css">
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
 
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min"></script>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/lib/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/dist/jquery.validate.js"></script>
  
</head>
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
<body>

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

    <form action="<?php echo base_url(); ?>app/m45uk_log1n/" method="post" class="animated swing">
      <div class="form-group has-feedback ">
        <input type="text" name="username" required class="form-control" placeholder="No KTP">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" required class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo $captcha // tampilkan recaptcha ?>
      </div>
       
        <button type="submit" class="btn btn-block bg-green btn-flat"><i class="fa fa-sign-in"></i> Sign In</button>
        
    </form><br>

  <div class="form-group has-feedback ">
    Not Registed? <a href="">Create an Account</a>
  </div>
   <div class="form-group has-feedback ">
   <a href="">Forgot Yout Password ?</a>
  </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

  


<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/plugins/knob/jquery.knob.js"></script>
  <script type="text/javascript">
   

    $( document ).ready( function () {
     

      $( "#signupForm1" ).validate( {
        rules: {
          username: {
            required: true
          },
          password: {
            required: true
          },
         
        },
        messages: {
         
          username: {
            required: "Please enter a username"
          },
          password: {
            required: "Please enter a password"
          },
         
         
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass( "help-block" );

          // Add `has-feedback` class to the parent div.form-group
          // in order to add icons to inputs
          element.parents( ".col-sm-5" ).addClass( "has-feedback" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }

          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !$( element ).next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
          $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
      } );
    } );
  </script>

</body>
</html>
