<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Login</title>
    <!-- Icons-->
         <!-- Main styles for this application-->
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
            <?php 
            echo validation_errors('<div class="alert alert-danger">', '</div>');            
            ?>
            <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger">Access Denied</div>';
                }                
            ?>
          <div class="card-group">
            <div class="card p-4">
              <?php     
                echo form_open('/login/dologin', 'post', array('class'=> "form-horizontal", 'method'=>'post', 'id'=>'loginpost'));
              ?>
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-muted">Sign In to your account</p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <?php
                  echo form_input('username', set_value('username'), array('required'=>'required', 'class'=>'form-control', 'placeholder'=>'Username'));
                  ?>                   
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>                  
                  <input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" placeholder="Password" id="password"> 
                  </div>
                <div class="row">
                  <div class="col-6">
                     <?php
                     echo form_submit('submit', 'Login', array('class'=>'btn btn-primary px-4'));
                     ?>  
                  </div>
                  <div class="col-6 text-right">
                    <button class="btn btn-link px-0" type="button">Forgot password?</button>
                  </div>
                </div>              
              </div>
              <?php
              echo form_close();
              ?>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Instant</p>
                  <button class="btn btn-primary active mt-3" type="button">Register Now!</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </body>
</html>
